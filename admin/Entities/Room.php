<?php

namespace Admin\Entities;

use CodeIgniter\Entity\Entity;

class Room extends Entity {
    protected $attributes = [
        'id'            => null,
        'resort_id'     => null,
        'room_type'     => null,
        'price_per_night' => null,
        'availability'     => null,
        'max_occupancy' => null,
        'description'    => null,
        'image'          => null,
    ];


}