<?php

namespace Admin\Controllers;


use Admin\Models\AccountModel;

class Account extends BaseController {
    public function accountIndex(): string
    {
        $model = new AccountModel();
        $accounts = $model->findAll();
        $data = [
            'title' => 'Admin',
            'accounts' => $accounts,
        ];
        return $this->render('account-index',$data);
    }

    /**
     * @throws \ReflectionException
     */
    public function accountCreate(): string
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new AccountModel();

            $data = [
                'name'               => $this->request->getPost('name'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
                'address'            => $this->request->getPost('address'),
                'password'           => $this->request->getPost('password'),
                'flag'               => 1,
            ];

            if ($model->insert($data)) {
                echo '<script>
                        alert("Thêm tài khoản thành công!");
                        window.location.href = "/admin/account"; // Đường dẫn đến trang index
                      </script>';
            } else {
                print_r($model->errors());
            }
        }

        return $this->render('accountCreate');
    }

    /**
     * @throws \ReflectionException
     */
    public function accountUpdate($id = false): string
    {
        $model   = new AccountModel();
        $account = $model->find($id);
        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name'               => $this->request->getPost('name'),
                'phone_number'       => $this->request->getPost('phone_number'),
                'email'              => $this->request->getPost('email'),
                'address'            => $this->request->getPost('address'),
                'password'           => $this->request->getPost('password'),
                'flag'               => $this->request->getPost('flag'),
            ];

            if ($model->update($id, $data)) {
                echo '<script>
                    alert("Cập nhật thành công!");
                    window.location.href = "/admin/account"; // Đường dẫn đến trang index
                  </script>';
            } else {
                print_r($model->errors());
            }
        }
        $data = [
            'title' => 'Admin',
            'account' => $account,
        ];
        return $this->render('accountUpdate',$data);
    }

    public function accountDelete()
    {
        if ($this->request->getMethod() === 'POST') {
            $model = new AccountModel();
            $id    = $this->request->getPost('id');

            if ($id) {
                if ($model->delete($id)) {
                    return $this->response->redirect('/admin/account');
                }
                print_r($model->errors());
            }
        }
    }

    public function accountView($id = false): string {
        $model   = new AccountModel();
        $account = $model->find($id);


        return $this->render('accountView');
    }

}