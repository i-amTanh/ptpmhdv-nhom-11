<?php

namespace Admin\Controllers;


use Admin\Models\CustomerModel;

class Customer extends BaseController {
    public function customerIndex(): string
    {
        $model = new CustomerModel();
        $customers = $model->findAll();
        $data = [
            'title' => 'Admin',
            'customers' => $customers,
        ];
        return $this->render('customer-index',$data);
    }

    /**
     * @throws \ReflectionException
     */
    public function CustomerCreate(): string
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new customerModel();

            $data = [
                'customer_name'      => $this->request->getPost('customer_name'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
                'address'            => $this->request->getPost('address'),
            ];

            if ($model->insert($data)) {
                echo '<script>
                        alert("Thêm thành công!");
                        window.location.href = "/admin/customer"; // Đường dẫn đến trang index
                      </script>';
            } else {
                print_r($model->errors());
            }
        }

        return $this->render('customerCreate');
    }

    /**
     * @throws \ReflectionException
     */
    public function customerUpdate($id = false): string
    {
        $model   = new CustomerModel();
        $customer = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'customer_name'      => $this->request->getPost('customer_name'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
                'address'            => $this->request->getPost('address'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Cập nhật thành công!");
                    window.location.href = "/admin/customer"; // Đường dẫn đến trang index
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'title' => 'Admin',
            'customer' => $customer,
        ];
        return $this->render('customerUpdate',$data);
    }

    public function customerDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new CustomerModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/customer');
                }
                print_r($model->errors());
            }
        }
    }

    public function customerView($id = false): string {
        $model   = new CustomerModel();
        $customer = $model->find($id);


        return $this->render('customerView');
    }

}