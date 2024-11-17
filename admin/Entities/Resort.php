<?php

namespace Admin\Entities;

use CodeIgniter\Entity\Entity;

class Resort extends Entity {
    protected $attributes = [
        'id'            => null,
        'resort_name'   => null,
        'location'      => null,
        'description'   => null,
        'rating'        => null,
        'image'         => null,
    ];


}