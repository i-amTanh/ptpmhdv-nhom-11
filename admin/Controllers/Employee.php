<?php

namespace Admin\Controllers;


use Admin\Models\EmployeeModel;

class Employee extends BaseController {
    public function employeeIndex(): string
    {
        $model = new EmployeeModel();
        $employees = $model->findAll();
        $data = [
            'title' => 'Admin',
            'employees' => $employees,
        ];
        return $this->render('employee-index',$data);
    }

    /**
     * @throws \ReflectionException
     */
    public function employeeCreate(): string
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new EmployeeModel();

            $data = [
                'employee_name'      => $this->request->getPost('employee_name'),
                'position'           => $this->request->getPost('position'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
            ];

            if ($model->insert($data)) {
                echo '<script>
                        alert("Thêm thành công!");
                        window.location.href = "/admin/employee"; 
                      </script>';
            } else {
                print_r($model->errors());
            }
        }

        return $this->render('employeeCreate');
    }

    /**
     * @throws \ReflectionException
     */
    public function employeeUpdate($id = false): string
    {
        $model   = new EmployeeModel();
        $employee = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'employee_name'      => $this->request->getPost('employee_name'),
                'position'           => $this->request->getPost('position'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Success!");
                    window.location.href = "/admin/employee"; 
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'title' => 'Admin',
            'employee' => $employee,
        ];
        return $this->render('employeeUpdate',$data);
    }

    public function employeeDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new EmployeeModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/employee');
                }
                print_r($model->errors());
            }
        }
    }

    public function employeeView($id = false): string {
        $model   = new EmployeeModel();
        $employee = $model->find($id);


        return $this->render('employeeView');
    }

}