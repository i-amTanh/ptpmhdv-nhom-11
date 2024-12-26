<?php

namespace Admin\Models;

use CodeIgniter\Model;

class RoomModel extends Model {
    protected $table = 'room';
    protected $primaryKey    = 'id';
    protected $returnType    = RoomModel::class;
    protected $allowedFields = [
        'id',
        'resort_id',
        'room_type',
        'price_per_night',
        'availability',
        'max_occupancy',
        'description',
        'image',
    ];

    protected $validationRules = [
        'resort_id'       => 'required|integer',
        'room_type'       => 'required',
        'price_per_night' => 'required|decimal',
        'availability'    => 'required|in_list[0,1]',
        'max_occupancy'   => 'required|integer',
        //'description'     => 'alpha_numeric_space',
    ];
    protected $validationMessages = [
        'resort_id' => [
            'required' => 'Resort ID is required.',
            'integer'  => 'Resort ID must be an integer.',
        ],
        'room_type' => [
            'required'            => 'RoomModel type is required.',
        ],
        'price_per_night' => [
            'required' => 'Price per night is required.',
            'decimal'  => 'Price per night must be a valid decimal value.',
        ],
        'availability' => [
            'required' => 'Availability status is required.',
            'in_list'  => 'Availability must be either 0 (booked) or 1 (available).',
        ],
        'max_occupancy' => [
            'required' => 'Max occupancy is required.',
            'integer'  => 'Max occupancy must be an integer.',
        ],
//        'description' => [
//            'alpha_numeric_space' => 'Description must be alphanumeric and space-separated.',
//        ],
    ];

    public function getRoomsByResortId($resortId)
    {
        return $this->where('resort_id', $resortId)->findAll();
    }

    public function getRoomPrice($id)
    {
        return $this->where('id', $id)->findColumn('price_per_night');
    }

    public function getRoomSearch($resort_id, $person)
    {
        return $this->where('resort_id', $resort_id) ->where('max_occupancy >=', $person) ->findAll();
    }

}