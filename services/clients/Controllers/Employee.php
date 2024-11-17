<?php

namespace Api\Controllers;

use Admin\Models\EmployeeModel;
use CodeIgniter\RESTful\ResourceController;
use CodeIgniter\API\ResponseTrait;

class Employee extends ResourceController
{
    use ResponseTrait;

    // Phương thức tạo mới employee
    public function create()
    {
        $input = $this->request->getPost();

        // Kiểm tra dữ liệu đầu vào
        if (!$input || !isset($input['employee_name']) || !isset($input['phone_number']) || !isset($input['email'])) {
            return $this->failValidationError('Invalid input');
        }

        // Lưu dữ liệu nhân viên
        $employeeModel = new EmployeeModel();
        $data = [
            'employee_name' => $input['employee_name'],
            'position' => $input['position'] ?? null,
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
        ];

        // Chèn dữ liệu vào cơ sở dữ liệu
        if ($employeeModel->insert($data)) {
            return $this->respondCreated(['id' => $employeeModel->getInsertID()]);
        } else {
            return $this->failServerError('Failed to create employee');
        }
    }


    public function update($id)
    {
        $input = $this->request->getPost();

        // Kiểm tra dữ liệu đầu vào
        if (!$input || !isset($input['employee_name']) || !isset($input['phone_number']) || !isset($input['email'])) {
            return $this->failValidationError('Invalid input');
        }

        // Lấy dữ liệu và chuẩn bị cập nhật
        $employeeModel = new EmployeeModel();
        $data = [
            'employee_name' => $input['employee_name'],
            'position' => $input['position'] ?? null,
            'salary' => $input['salary'] ?? null,
            'phone_number' => $input['phone_number'],
            'email' => $input['email'],
        ];

        // Cập nhật thông tin nhân viên
        if ($employeeModel->update($id, $data)) {
            return $this->respondUpdated(['id' => $id]);
        } else {
            return $this->failServerError('Failed to update employee');
        }
    }

    public function delete($id)
    {
        $employeeModel = new EmployeeModel();

        // Kiểm tra xem nhân viên có tồn tại không
        $employee = $employeeModel->find($id);
        if (!$employee) {
            return $this->failNotFound('Employee not found');
        }

        // Xóa nhân viên
        if ($employeeModel->delete($id)) {
            return $this->respondDeleted(['id' => $id]);
        } else {
            return $this->failServerError('Failed to delete employee');
        }
    }

    public function show($id)
    {
        $employeeModel = new EmployeeModel();
        $employee = $employeeModel->find($id);

        if ($employee) {
            return $this->respond($employee);
        } else {
            return $this->failNotFound('Employee not found');
        }
    }
}
