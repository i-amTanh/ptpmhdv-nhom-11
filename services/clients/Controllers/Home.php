<?php

namespace Client\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class Home extends BaseController
{
    public function index(): string
    {
        // Lấy danh sách từ các API khác nhau
        $resorts = $this->fetchApiData('http://pmhdv.local/api/resort');
        $customers = $this->fetchApiData('http://pmhdv.local/api/customer');
        $employees = $this->fetchApiData('http://pmhdv.local/api/employee');
        $rooms = $this->fetchApiData('http://pmhdv.local/api/room');
        $roomBookings = $this->fetchApiData('http://pmhdv.local/api/roombooking');

        // Kiểm tra nếu không lấy được dữ liệu
        if (is_null($resorts) || is_null($customers) || is_null($employees) || is_null($rooms) || is_null($roomBookings)) {
            return $this->render('error', [
                'message' => 'Lỗi khi tải dữ liệu từ API',
            ]);
        }

        // Render view với dữ liệu
        return $this->render('dashboard', [
            'resorts'      => $resorts,
            'customers'    => $customers,
            'employees'    => $employees,
            'rooms'        => $rooms,
            'roomBookings' => $roomBookings,
            'title'        => 'Dashboard',
            'user'         => ucfirst(session()->get('user')['name']),
        ]);
    }

    private function fetchApiData(string $url): ?array
    {
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL            => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_TIMEOUT        => 10,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => 'GET',
            CURLOPT_HTTPHEADER     => [
                'Content-Type: application/json',
            ],
        ]);

        $response = curl_exec($curl);
        $httpCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        curl_close($curl);

        if ($response === false || $httpCode !== ResponseInterface::HTTP_OK) {
            log_message('error', "Failed to fetch data from $url. HTTP Code: $httpCode");
            return null;
        }

        return json_decode($response, true);
    }
}
