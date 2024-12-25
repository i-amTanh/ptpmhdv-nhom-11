<?php

namespace Auth\Entities;

use CodeIgniter\Entity\Entity;

class Account extends Entity
{
    protected $attributes = [
        'id'             => null,
        'name'           => null,
        'phone_number'   => null,
        'email'          => null,
        'address'        => null,
        'password'       => null,
        'flag'            => null,
    ];

}
