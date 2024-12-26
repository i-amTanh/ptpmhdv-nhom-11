<?php

namespace Web\Controllers;


use Exception;

class Home extends BaseController {

    public function index(): string
    {
        $resortResponse = $this->fetchApi("http://pmhdv.local/api/resort");
        $resort = json_decode($resortResponse);
        $message = session()->getFlashdata('message');
        $user = session()->get('user');

        $data = [
            'resorts' => $resort,
            'message' => $message,
            'session' => $_SESSION,
            'user' => $user
        ];

        return $this->render('index', $data);
    }

    public function detail($id): string
    {
        $roomsResponse = $this->fetchApi("http://pmhdv.local/api/room/getroomsbyresortid/".$id);
        $rooms = json_decode($roomsResponse);
        $user = session()->get('user');
        $data = [
            'rooms' => $rooms,
            'session' => $_SESSION,
            'user' => $user
        ];
        return $this->render('detail_room', $data);
    }

    public function historyBooking(): string
    {
        $user = session()->get('user');
        $roomBookingResponse = $this->fetchApi("http://pmhdv.local/api/roombooking/getroombookingbycustomerid/".$user['id']);
        $roomBooking = json_decode($roomBookingResponse);

        $roomNames = [];

        foreach ($roomBooking as $booking) {
            $roomId = $booking->room_id;
            $roomResponse = $this->fetchApi("http://pmhdv.local/api/room/show/".$roomId);
            $room = json_decode($roomResponse);
            $roomNames[] = $room->room_type;
            $resortId = $room->resort_id;
            $roomResponse = $this->fetchApi("http://pmhdv.local/api/resort/show/".$resortId);
            $room = json_decode($roomResponse);
            $resortNames[] = $room->resort_name;

        }
        $data = [
            'roomBooking' => $roomBooking,
            'roomNames' => $roomNames,
            'resortNames' => $resortNames,
            'session' => $_SESSION,
            'user' => $user
        ];

        return $this->render('history_booking', $data);
    }

    public function booking($id): string
    {
        $resortResponse = $this->fetchApi("http://pmhdv.local/api/resort/show/".$id);
        $resort = json_decode($resortResponse);

        $roomsResponse = $this->fetchApi("http://pmhdv.local/api/room/getroomsbyresortid/".$id);
        $rooms = json_decode($roomsResponse);

        $user = session()->get('user');

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'customer_id'        => $user['id'],
                'room_id'            => $this->request->getPost('room_id'),
                'check_in_date'      => $this->request->getPost('check-in-date'),
                'check_out_date'     => $this->request->getPost('check-out-date'),
                'status'             => 'Paid',
                'total_amount'       => $this->request->getPost('total-price'),
            ];
            session()->set('booking_data', [
                'room_id' => $this->request->getPost('room_id'),
                'check_in_date' => $this->request->getPost('check-in-date'),
                'check_out_date' => $this->request->getPost('check-out-date'),
                'total_price' => $this->request->getPost('total-price'),
            ]);
            $vnp_Url = "https://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
            $vnp_Returnurl = "http://pmhdv.local/vnpayReturn";
            $vnp_TmnCode = "FS2MU6UR";//Mã website tại VNPAY
            $vnp_HashSecret = "42BAD7J8RJFGC7C0MGR44EFD18L2MSFH"; //Chuỗi bí mật

            $vnp_TxnRef = rand(00, 9999); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
            $vnp_OrderInfo = 'Noi Dung Thanh Toan';
            $vnp_OrderType = 'BillPayment';
            $vnp_Amount = $this->request->getPost('total-price') * 100;
            $vnp_Locale = 'VN';
            $vnp_BankCode = 'NCB';
            $vnp_IpAddr = $_SERVER['REMOTE_ADDR'];
            $inputData = array(
                "vnp_Version" => "2.1.0",
                "vnp_TmnCode" => $vnp_TmnCode,
                "vnp_Amount" => $vnp_Amount,
                "vnp_Command" => "pay",
                "vnp_CreateDate" => date('YmdHis'),
                "vnp_CurrCode" => "VND",
                "vnp_IpAddr" => $vnp_IpAddr,
                "vnp_Locale" => $vnp_Locale,
                "vnp_OrderInfo" => $vnp_OrderInfo,
                "vnp_OrderType" => $vnp_OrderType,
                "vnp_ReturnUrl" => $vnp_Returnurl,
                "vnp_TxnRef" => $vnp_TxnRef
            );

            if (isset($vnp_BankCode) && $vnp_BankCode != "") {
                $inputData['vnp_BankCode'] = $vnp_BankCode;
            }
            var_dump($inputData);
            ksort($inputData);
            $query = "";
            $i = 0;
            $hashdata = "";
            foreach ($inputData as $key => $value) {
                if ($i == 1) {
                    $hashdata .= '&' . urlencode($key) . "=" . urlencode($value);
                } else {
                    $hashdata .= urlencode($key) . "=" . urlencode($value);
                    $i = 1;
                }
                $query .= urlencode($key) . "=" . urlencode($value) . '&';
            }

            $vnp_Url = $vnp_Url . "?" . $query;
            if (isset($vnp_HashSecret)) {
                $vnpSecureHash = hash_hmac('sha512', $hashdata, $vnp_HashSecret);//
                $vnp_Url .= 'vnp_SecureHash=' . $vnpSecureHash;
            }
            $returnData = array('code' => '00'
            , 'message' => 'success'
            , 'data' => $vnp_Url);
            if (isset($_POST['redirect'])) {
                header('Location: ' . $vnp_Url);
                die();
            } else {
                echo json_encode($returnData);
            }
        }

        $data = [
            'rooms' => $rooms,
            'resort' => $resort,
        ];

        return $this->render('booking', $data);
    }

    public function vnpayReturn()
    {
        $vnp_HashSecret = "42BAD7J8RJFGC7C0MGR44EFD18L2MSFH"; // Chuỗi bí mật
        $inputData = [];
        foreach ($_GET as $key => $value) {
            if (substr($key, 0, 4) == "vnp_") {
                $inputData[$key] = $value;
            }
        }

        $vnp_SecureHash = $inputData['vnp_SecureHash'];
        unset($inputData['vnp_SecureHash']);
        ksort($inputData);
        $hashData = "";
        foreach ($inputData as $key => $value) {
            $hashData .= urlencode($key) . '=' . urlencode($value) . '&';
        }
        $hashData = rtrim($hashData, '&');

        $secureHash = hash_hmac('sha512', $hashData, $vnp_HashSecret);
        if ($secureHash === $vnp_SecureHash) {
            if ($inputData['vnp_ResponseCode'] == '00') {
                // Thanh toán thành công
                $data = [
                    'customer_id'    => session()->get('user')['id'],
                    'room_id'        => session()->get('booking_data')['room_id'], // Lấy từ session
                    'check_in_date'  => session()->get('booking_data')['check_in_date'],
                    'check_out_date' => session()->get('booking_data')['check_out_date'],
                    'status'         => 'Paid',
                    'total_amount'   => $inputData['vnp_Amount'] / 100,
                ];

                $this->createRoomBooking($data);


                session()->setFlashdata('message', 'Payment Complete!');
                return redirect()->to('/vi');
            } else {
                // Thanh toán thất bại
                session()->setFlashdata('message', 'Payment failed!');
                return redirect()->to('/vi');
            }
        } else {
            session()->setFlashdata('message', 'Invalid authentication.!');
            return redirect()->to('/vi');
        }
    }


    private function fetchApi($url)
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array()
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public function createRoomBooking($data)
    {
        $url = "http://pmhdv.local/api/roombooking/create";

        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => $data,
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

}
