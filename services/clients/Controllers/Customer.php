<?php

namespace Client\Controllers;

use Admin\Models\AccountModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Customer extends ResourceController
{
    use ResponseTrait;

    public function create()
    {
        $input = $this->request->getPost();

        // Validate input data
        if (!$input || !isset($input['customer_name'])) {
            return $this->failValidationError('Invalid input');
        }

        // Save customer data
        $customerModel = new AccountModel();
        $data = [
            'customer_name' => $input['customer_name'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'address' => $input['address'] ?? null
        ];

        if ($customerModel->insert($data)) {
            return $this->respondCreated(['id' => $customerModel->getInsertID()]);
        } else {
            return $this->failServerError('Failed to create customer');
        }
    }

    public function update($id)
    {
        $input = $this->request->getPost();

        if (!$input || !isset($input['customer_name'])) {
            return $this->failValidationError('Invalid input');
        }

        $customerModel = new AccountModel();
        $data = [
            'customer_name' => $input['customer_name'],
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
            'address' => $input['address'] ?? null
        ];

        // Cập nhật customer
        if ($customerModel->update($id, $data)) {
            return $this->respondUpdated(['id' => $id]);
        } else {
            return $this->failServerError('Failed to update customer');
        }
    }

    public function delete($id)
    {
        $customerModel = new AccountModel();

        // Kiểm tra xem customer có tồn tại không
        $customer = $customerModel->find($id);
        if (!$customer) {
            return $this->failNotFound('Account not found');
        }

        if ($customerModel->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failServerError('Failed to delete customer');
        }
    }

    public function show($id)
    {
        $customerModel = new AccountModel();
        $customer = $customerModel->find($id);

        if ($customer) {
            return $this->respond($customer);
        } else {
            return $this->failNotFound('Account not found');
        }
    }

}
