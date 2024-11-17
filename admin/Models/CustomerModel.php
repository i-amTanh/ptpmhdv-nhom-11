<?php

namespace Admin\Models;

use Admin\Entities\Customer;
use CodeIgniter\Model;

class CustomerModel extends Model {
    protected $table = 'customer';
    protected $primaryKey    = 'id';
    protected $returnType    = Customer::class;
    protected $allowedFields = [
        'id',
        'customer_name',
        'phone_number',
        'email',
        'address',
    ];

    protected $validationRules = [
        'customer_name' => 'required|alpha_numeric_space',
        'phone_number'  => 'required|numeric|min_length[7]|max_length[20]',
        'email'         => 'required|valid_email',
    ];
    protected $validationMessages = [
        'customer_name' => [
            'required'            => 'Customer name is required.',
            'alpha_numeric_space' => 'Customer name must be alphanumeric and space-separated.',
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