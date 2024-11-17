<?php

namespace Admin\Entities;

use CodeIgniter\Entity\Entity;

class Employee extends Entity {
    protected $attributes = [
        'id'            => null,
        'employee_name'   => null,
        'position'    => null,
        'phone_number'   => null,
        'email'    => null,
    ];

}