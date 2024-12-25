<?php

namespace Admin\Models;

use Admin\Entities\Account;
use CodeIgniter\Model;

class AccountModel extends Model {
    final public const int FLAG_ADMIN      = 0;
    final public const int FLAG_CUSTOMER    = 1;
    final public const array FLAGS         = [
        '0' => 'Administrator',
        '1' => 'Customer',
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
        'name' => 'required|alpha_numeric_space',
        'phone_number'  => 'required|numeric|min_length[7]|max_length[20]',
        'email'         => 'required|valid_email',
    ];
    protected $validationMessages = [
        'name' => [
            'required'            => 'Account name is required.',
            'alpha_numeric_space' => 'Account name must be alphanumeric and space-separated.',
        ],
        'phone_number' => [
            'required'   => 'Phone number is required.',
            'numeric'    => 'Phone number must contain only numbers.',
            'min_length' => 'Phone number must be at least 7 digits long.',
            'max_length' => 'Phone number must not exceed 20 digits.',
        ],
        'email' => [
            'required'   => 'Email is required.',
            'valid_email' => 'You must provide a valid email address.',
        ],
    ];

}