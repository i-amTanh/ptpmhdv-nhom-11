<?php

namespace Api\Controllers;

use Admin\Models\RoomBookingModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class RoomBooking extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        $input = $this->request->getPost();

        // Validate input data
        if (!$input || !isset($input['customer_id']) || !isset($input['room_id'])) {
            return $this->failValidationError('Invalid input');
        }

        // Save room booking data
        $roomBookingModel = new RoomBookingModel();
        $data = [
            'customer_id' => $input['customer_id'],
            'room_id' => $input['room_id'],
            'check_in_date' => $input['check_in_date'],
            'check_out_date' => $input['check_out_date'],
            'status' => $input['status'],
            'total_amount' => $input['total_amount']
        ];

        if ($roomBookingModel->insert($data)) {
            return $this->respondCreated(['id' => $roomBookingModel->getInsertID()]);
        } else {
            return $this->failServerError('Failed to create room booking');
        }
    }

    public function update($id)
    {
        $input = $this->request->getPost();

        if (!$input || !isset($input['status'])) {
            return $this->failValidationError('Invalid input');
        }

        $roomBookingModel = new RoomBookingModel();
        $data = [
            'check_in_date' => $input['check_in_date'],
            'check_out_date' => $input['check_out_date'],
            'status' => $input['status'],
            'total_amount' => $input['total_amount']
        ];

        // Cập nhật room booking
        if ($roomBookingModel->update($id, $data)) {
            return $this->respondUpdated(['id' => $id]);
        } else {
            return $this->failServerError('Failed to update room booking');
        }
    }

    public function delete($id)
    {
        $roomBookingModel = new RoomBookingModel();

        // Kiểm tra xem booking có tồn tại không
        $roomBooking = $roomBookingModel->find($id);
        if (!$roomBooking) {
            return $this->failNotFound('Room booking not found');
        }

        if ($roomBookingModel->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failServerError('Failed to delete room booking');
        }
    }

    public function show($id)
    {
        $roomBookingModel = new RoomBookingModel();
        $roomBooking = $roomBookingModel->find($id);

        if ($roomBooking) {
            return $this->respond($roomBooking);
        } else {
            return $this->failNotFound('Room booking not found');
        }
    }

}
