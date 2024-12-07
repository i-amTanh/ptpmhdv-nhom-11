<?php

namespace Api\Controllers;

class Resort extends RestControllers
{
    protected $modelName = 'Admin\Models\ResortModel';

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
            return $this->failNotFound('Resort not found');
        }

        return $this->respond($data);
    }

    public function create()
    {
        $data = $this->request->getPost();
        if (! $this->model->insert($data)) {
            return $this->failValidationErrors($this->model->errors());
        }

        return $this->respondCreated($data, 'Resort created');
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

        return $this->respondUpdated($data, 'Resort updated');
    }

    public function delete($id = null)
    {
        if ($id === null) {
            return $this->failValidationErrors('ID is required');
        }
        $data = $this->model->find($id);
        if (!$data) {
            return $this->failNotFound('Resort not found');
        }
        $this->model->delete($id);
        return $this->respondDeleted('Resort deleted');
    }
}
