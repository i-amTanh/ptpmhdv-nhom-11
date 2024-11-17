<?php

namespace Api\Controllers;

class Employee extends RestControllers
{
    protected $modelName = 'Admin\Models\EmployeeModel';

    public function index()
    {
        return $this->respond($this->model->findAll());
    }

    public function show($id = null)
    {
        $data = $this->model->find($id);
        if (! $data) {
            return $this->failNotFound('Employee not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data, 'Employee created');
    }

    public function update($id = null)
    {
        $data = $this->request->getRawInput();
        if (! $this->model->update($id, $data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondUpdated($data, 'Employee updated');
    }

    public function delete($id = null)
    {
        if (! $this->model->delete($id)) {
            return $this->failNotFound('Employee not found');
        }

        return $this->respondDeleted('Employee deleted');
    }
}
