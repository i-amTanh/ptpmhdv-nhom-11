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
    ];

    protected $validationRules = [
        'resort_name' => 'required|alpha_numeric_space',
//        'location'    => 'alpha_numeric_space',
//        'description' => 'alpha_numeric_space',
         'rating'      => 'decimal',
    ];
    protected $validationMessages = [
        'resort_name' => [
            'required'            => 'Resort name is required.',
            'alpha_numeric_space' => 'Resort name must be alphanumeric and space-separated.',
        ],
//        'location' => [
//            'alpha_numeric_space' => 'Location must be alphanumeric and space-separated.',
//        ],
//        'description' => [
//            'alpha_numeric_space' => 'Description must be alphanumeric and space-separated.',
//        ],
        'rating' => [
            'decimal' => 'Rating must be a decimal value.',
        ],
    ];
}