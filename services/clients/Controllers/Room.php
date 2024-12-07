<?php

namespace Api\Controllers;

use Admin\Models\RoomModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;


class Room extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        $input = $this->request->getPost();

        // Validate input data
        if (!$input || !isset($input['room_type']) || !isset($input['resort_id'])) {
            return $this->failValidationError('Invalid input');
        }

        // Save room data
        $roomModel = new RoomModel();
        $data = [
            'resort_id' => $input['resort_id'],
            'room_type' => $input['room_type'],
            'price_per_night' => $input['price_per_night'],
            'availability' => $input['availability'] ?? true,
            'max_occupancy' => $input['max_occupancy'],
            'image' => $input['image'] ?? null,
            'description' => $input['description'] ?? null
        ];

        if ($roomModel->insert($data)) {
            return $this->respondCreated(['id' => $roomModel->getInsertID()]);
        } else {
            return $this->failServerError('Failed to create room');
        }
    }

    public function update($id = null)
    {
        $input = $this->request->getPost();

        if (!$input || !isset($input['room_type'])) {
            return $this->failValidationError('Invalid input');
        }

        $roomModel = new RoomModel();
        $data = [
            'room_type' => $input['room_type'],
            'price_per_night' => $input['price_per_night'],
            'availability' => $input['availability'] ?? true,
            'max_occupancy' => $input['max_occupancy'],
            'image' => $input['image'] ?? null,
            'description' => $input['description'] ?? null
        ];

        // Cập nhật room
        if ($roomModel->update($id, $data)) {
            return $this->respondUpdated(['id' => $id]);
        } else {
            return $this->failServerError('Failed to update room');
        }
    }

    public function delete($id = null)
    {
        $roomModel = new RoomModel();

        // Kiểm tra xem room có tồn tại không
        $room = $roomModel->find($id);
        if (!$room) {
            return $this->failNotFound('Room not found');
        }

        if ($roomModel->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failServerError('Failed to delete room');
        }
    }

    public function show($id = null)
    {
        $roomModel = new RoomModel();
        $room = $roomModel->find($id);

        if ($room) {
            return $this->respond($room);
        } else {
            return $this->failNotFound('Room not found');
        }
    }

}
