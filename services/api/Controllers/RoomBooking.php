<?php

namespace Api\Controllers;

use Admin\Models\RoomBookingModel;

class RoomBooking extends RestControllers
{
    protected $modelName = 'Admin\Models\RoomBookingModel';

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
            return $this->failNotFound('RoomBooking not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data, 'RoomBooking created');
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

        return $this->respondUpdated($data, 'RoomBooking updated');
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('RoomBooking not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted('RoomBooking deleted');
    }

    public function getRoomBookingByCustomerId($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $model = new RoomBookingModel();
        $data = $model->getRoomBookingByCustomerId($id);
        if (! $data) {
            return $this->failNotFound('Room not found');
        }
        return $this->respond($data);
    }

}
