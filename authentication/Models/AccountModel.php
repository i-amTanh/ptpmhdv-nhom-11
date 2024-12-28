<?php

namespace Auth\Models;

use Auth\Entities\Account;
use CodeIgniter\Model;

class AccountModel extends Model
{
    final public const int FLAG_ADMIN      = 0;
    final public const int FLAG_CUSTOMER    = 1;
    final public const array FLAGS         = [
        '0' => 'Administrator',
        '1' => 'Account',
    ];

    protected $table = 'accounts';
    protected $primaryKey    = 'id';
    protected $returnType    = Account::class;
    protected $allowedFields = [
        'id',
        'name',
        'phone_number',
        'email',
        'address',
        'password',
        'flag',
    ];
    protected $validationRules = [
        'name'        => 'required|min_length[3]|max_length[100]',
        'email'       => 'required|valid_email|is_unique[accounts.email]',
        'address'     => 'required|min_length[5]|max_length[255]',
        'password'    => 'required|min_length[8]|max_length[255]',
        'flag'        => 'in_list[0,1]',
    ];

    protected $validationMessages = [
        'name' => [
            'required'    => 'Name is required.',
            'min_length'  => 'Name must be at least 3 characters long.',
            'max_length'  => 'Name cannot exceed 100 characters.',
        ],
        'email' => [
            'required'    => 'Email is required.',
            'valid_email' => 'Please provide a valid email address.',
            'is_unique'   => 'This email is already registered.',
        ],
        'address' => [
            'required'    => 'Address is required.',
            'min_length'  => 'Address must be at least 5 characters long.',
            'max_length'  => 'Address cannot exceed 255 characters.',
        ],
        'password' => [
            'required'    => 'Password is required.',
            'min_length'  => 'Password must be at least 8 characters long.',
            'max_length'  => 'Password cannot exceed 255 characters.',
        ],
        'flag' => [
            'in_list'     => 'Invalid flag. It must be either 0 (admin) or 1 (user).',
        ],
    ];
    protected $useTimestamps = true;
}
