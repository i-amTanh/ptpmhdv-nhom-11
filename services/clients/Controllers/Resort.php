<?php

namespace Api\Controllers;

use Admin\Models\ResortModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Resort extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        $input = $this->request->getPost();

        // Validate input data
        if (!$input || !isset($input['resort_name'])) {
            return $this->failValidationError('Invalid input');
        }

        // Save resort data
        $resortModel = new ResortModel();
        $data = [
            'resort_name' => $input['resort_name'],
            'location' => $input['location'] ?? null,
            'description' => $input['description'] ?? null,
            'rating' => $input['rating'] ?? null,
            'image' => $input['image'] ?? null
        ];

        if ($resortModel->insert($data)) {
            return $this->respondCreated(['id' => $resortModel->getInsertID()]);
        } else {
            return $this->failServerError('Failed to create resort');
        }
    }

    public function update($id)
    {
        $input = $this->request->getPost();

        if (!$input || !isset($input['resort_name'])) {
            return $this->failValidationError('Invalid input');
        }

        $resortModel = new ResortModel();
        $data = [
            'resort_name' => $input['resort_name'],
            'location' => $input['location'] ?? null,
            'description' => $input['description'] ?? null,
            'rating' => $input['rating'] ?? null,
            'image' => $input['image'] ?? null
        ];

        // Cập nhật resort
        if ($resortModel->update($id, $data)) {
            return $this->respondUpdated(['id' => $id]);
        } else {
            return $this->failServerError('Failed to update resort');
        }
    }

    public function delete($id)
    {
        $resortModel = new ResortModel();

        // Kiểm tra xem resort có tồn tại không
        $resort = $resortModel->find($id);
        if (!$resort) {
            return $this->failNotFound('Resort not found');
        }

        if ($resortModel->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failServerError('Failed to delete resort');
        }
    }

    public function show($id)
    {
        $resortModel = new ResortModel();
        $resort = $resortModel->find($id);

        if ($resort) {
            return $this->respond($resort);
        } else {
            return $this->failNotFound('Resort not found');
        }
    }

}