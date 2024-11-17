<?php

namespace Admin\Models;

use Admin\Entities\Employee;
use CodeIgniter\Model;

class EmployeeModel extends Model {
    protected $table = 'employee';
    protected $primaryKey    = 'id';
    protected $returnType    = Employee::class;
    protected $allowedFields = [
        'id',
        'employee_name',
        'position',
        'phone_number',
        'email',
    ];

    protected $validationRules = [
        //'employee_name' => 'required|alpha_numeric_space',
        //'position'      => 'required|alpha_numeric_space',
        'phone_number'  => 'required|numeric|min_length[7]|max_length[20]',
        'email'         => 'required|valid_email',
    ];

    protected $validationMessages = [
//        'employee_name' => [
//            'required'            => 'Employee name is required.',
//            'alpha_numeric_space' => 'Employee name must be alphanumeric and space-separated.',
//        ],
//        'position' => [
//            'required'            => 'Position is required.',
//            'alpha_numeric_space' => 'Position must be alphanumeric and space-separated.',
//        ],
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