<?php

namespace Admin\Controllers;


use Admin\Models\RoomBookingModel;

class RoomBooking extends BaseController {
    public function roomBookingIndex(): string
    {
        $model = new RoomBookingModel();
        $roombookings = $model->findAll();
        $data = [
            'title' => 'Admin',
            'roomBookings' => $roombookings,
        ];
        return $this->render('roomBooking-index',$data);
    }

    public function roomBookingUpdate($id = false): string
    {
        $model   = new roomBookingModel();
        $roombooking = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'customer_id'      => $this->request->getPost('customer_id'),
                'room_id'          => $this->request->getPost('room_id'),
                'check_in_date'     => $this->request->getPost('check_in_date'),
                'check_out_date'   => $this->request->getPost('check_out_date'),
                'status'           => $this->request->getPost('status'),
                'total_amount'      => $this->request->getPost('total_amount'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Sửa Thành Công!");
                    window.location.href = "/admin/roombooking"; // Đường dẫn đến trang index
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'title' => 'Admin',
            'roombooking' => $roombooking,
        ];
        return $this->render('roomBookingUpdate',$data);
    }

    public function roomBookingDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new RoomBookingModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/roomBooking');
                }
                print_r($model->errors());
            }
        }
    }

}