<?php

namespace Admin\Entities;

use CodeIgniter\Entity\Entity;

class Customer extends Entity {
    protected $attributes = [
        'id'             => null,
        'customer_name'  => null,
        'phone_number'   => null,
        'email'          => null,
        'address'        => null,
    ];


}