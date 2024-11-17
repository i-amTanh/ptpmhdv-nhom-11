<?php

namespace Api\Controllers;

use CodeIgniter\Database\Exceptions\DataException;

class Customer extends RestControllers
{
    protected $modelName = 'Admin\Models\CustomerModel';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (! $data) {
            return $this->failNotFound('Customer not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data, 'Customer created');
    }

    public function update($id = null)
    {
        $data = $this->request->getPost();
        if (!$this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondUpdated($data, 'Customer updated');
    }

    public function delete($id = null)
    {
        if (!$this->model->delete($id)) {
            return $this->failNotFound('Customer not found');
        }

        return $this->respondDeleted('Customer deleted');
    }
}
