<?php

namespace Api\Controllers;

use Admin\Models\RoomModel;

class Room extends RestControllers
{
    protected $modelName = 'Admin\Models\RoomModel';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $data = $this->model->find($id);
        if (! $data) {
            return $this->failNotFound('Room not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data, 'Room created');
    }

    public function update($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $data = $this->request->getRawInput();
        if (! $this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondUpdated($data, 'Room updated');
    }

    public function delete($id = null)
    {

        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Room not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted('Room deleted');
    }

    public function getRoomByResortId($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $model = new RoomModel();
        $data = $model->getRoomsByResortId($id);
        if (! $data) {
            return $this->failNotFound('Room not found');
        }
        return $this->respond($data);
    }

}
