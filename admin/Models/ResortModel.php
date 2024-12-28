<?php

namespace Admin\Models;

use Admin\Entities\Resort;
use CodeIgniter\Model;

class ResortModel extends Model {
    protected $table = 'resort';
    protected $primaryKey    = 'id';
    protected $returnType    = Resort::class;
    protected $allowedFields = [
        'id',
        'resort_name',
        'location',
        'description',
        'rating',
        'image',
        'price_per_night',
    ];

}