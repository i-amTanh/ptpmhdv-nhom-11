<?php

namespace Auth\Libraries;

use Auth\Models\AccountModel;

class AuthLib extends AccountModel
{
    public string $email;
    public string $password;
    public string $name;

    public function login(): bool
    {
        // Tìm người dùng theo email
        $user = $this->where('email', $this->email)->first();
        if ($user) {
            // Xác minh mật khẩu
            if ( $this->password == $user->password ) {
                // Thiết lập session
                $session = session();
                $session->set([
                    'user' => [
                        'id'        => $user->id,
                        'email'     => $user->email,
                        'flag'      => $user->flag,
                    ],
                ]);

                return true; // Đăng nhập thành công
            }

            return false; // Sai mật khẩu
        }

        return false; // Người dùng không tồn tại
    }

    public function createAcc(array $data): bool
    {
        $db  = \Config\Database::connect();
        $sql = 'INSERT INTO accounts (name, phone_number, email, address, password, flag) VALUES (?, ?, ?, ?, ?, ?)';

        $query = $db->query($sql, [$data['name'], $data['phone_number'], $data['email'], $data['address'], $data['password'], $data['flag']]);

        return (bool) $query;
    }
}
