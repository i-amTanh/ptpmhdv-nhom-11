<?php

namespace Auth\Controllers;

use Auth\Controllers\BaseController;
use Auth\Libraries\AuthLib;
use Auth\Models\AccountModel;
use CodeIgniter\Config\Services;
use CodeIgniter\HTTP\ResponseInterface;
use ReflectionException;

class Register extends BaseController
{

    public function register(): ResponseInterface|string
    {
        $accountModel = new AccountModel();

        if ($this->request->getMethod() === 'POST') {
            $data = [
                'name'        => $this->request->getPost('name'),
                'phone_number'=> $this->request->getPost('phone_number'),
                'email'       => $this->request->getPost('email'),
                'address'     => $this->request->getPost('address'),
                'password'    => $this->request->getPost('password'),
                'flag'        => 1,
            ];

            if (!Services::validation()->setRules($accountModel->validationRules)->run($data)) {
                // Trả lỗi và giữ lại dữ liệu cũ
                return $this->twig->render('register', [
                    'errors' => Services::validation()->getErrors(),
                    'old'    => $data,
                ]);
            }

            if ((new AuthLib())->createAcc($data)) {
                return redirect()->to('/auth/login')->with('success', 'Registration successful!');
            }
        }

        return $this->render('register', [
            'csrf_token' => csrf_token(),
            'csrf_hash'  => csrf_hash(),
        ]);
    }


}