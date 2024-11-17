<?php

namespace Admin\Entities;

use CodeIgniter\Entity\Entity;

class RoomBooking extends Entity {
    protected $attributes = [
        'id'            => null,
        'customer_id'    => null,
        'room_id'        => null,
        'check_in_date'       => null,
        'check_out_date'   => null,
        'status'    => null,
        'total_amount'    => null,
    ];


}