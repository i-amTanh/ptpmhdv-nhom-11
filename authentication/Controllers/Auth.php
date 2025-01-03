<?php

namespace Auth\Controllers;

use Auth\Libraries\AuthLib;
use CodeIgniter\HTTP\ResponseInterface;

class Auth extends BaseController
{
    public function login(): ResponseInterface|string
    {
        if (session()->get('user')) {
            return $this->response->redirect('/vi');
        }
        if ($this->request->getMethod() === 'POST') {
            $form           = new AuthLib();
            $form->email = $this->request->getVar('email');
            $form->password = $this->request->getVar('password');

            if ($form->login()) {
                return $this->response->redirect('/vi');
            } else {
                echo '<script>
                    alert("Email or password is incorrect!");
                  </script>';
            }
        }

        $csrf_token = csrf_token();
        $csrf_hash  = csrf_hash();

        return $this->render('pages-login', [
            'csrf_token' => $csrf_token,
            'csrf_hash'  => $csrf_hash,
        ]);
    }

    public function logout(): ResponseInterface
    {
        $session = session();
        $session->destroy();

        return $this->response->redirect('/auth/login');
    }
}
