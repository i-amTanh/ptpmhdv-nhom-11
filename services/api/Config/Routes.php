<?php

use Api\Controllers\Customer;
use Api\Controllers\Employee;
use Api\Controllers\Resort;
use Api\Controllers\Room;
use Api\Controllers\RoomBooking;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('api', static function ($routes) {
    $routes->group('resort', static function ($routes) {
        $routes->get('/', [Resort::class, 'index']);
        $routes->get('show/(:num)', [Resort::class, 'show/$1']);
        $routes->post('create', [Resort::class, 'create']);
        $routes->post('update/(:num)', [Resort::class, 'update/$1']);
        $routes->post('delete/(:num)', [Resort::class, 'delete/$1']);
    });

    $routes->group('customer', static function ($routes) {
        $routes->get('/', [Customer::class, 'index']);
        $routes->get('show/(:num)', [Customer::class, 'show/$1']);
        $routes->post('create', [Customer::class, 'create']);
        $routes->post('update/(:num)', [Customer::class, 'update/$1']);
        $routes->post('delete/(:num)', [Customer::class, 'delete/$1']);
    });

    $routes->group('employee', static function ($routes) {
        $routes->get('/', [Employee::class, 'index']);
        $routes->get('show/(:num)', [Employee::class, 'show/$1']);
        $routes->post('create', [Employee::class, 'create']);
        $routes->post('update/(:num)', [Employee::class, 'update/$1']);
        $routes->post('delete/(:num)', [Employee::class, 'delete/$1']);
    });

    $routes->group('room', static function ($routes) {
        $routes->get('/', [Room::class, 'index']);
        $routes->get('show/(:num)', [Room::class, 'show/$1']);
        $routes->get('getroomprice/(:num)', [Room::class, 'getRoomPrice/$1']);
        $routes->post('create', [Room::class, 'create']);
        $routes->post('update/(:num)', [Room::class, 'update/$1']);
        $routes->post('delete/(:num)', [Room::class, 'delete/$1']);
        $routes->get('getroomsbyresortid/(:num)', [Room::class, 'getRoomByResortId/$1']);
    });

    $routes->group('roombooking', static function ($routes) {
        $routes->get('/', [RoomBooking::class, 'index']);
        $routes->get('show/(:num)', [RoomBooking::class, 'show/$1']);
        $routes->post('create', [RoomBooking::class, 'create']);
        $routes->post('update/(:num)', [RoomBooking::class, 'update/$1']);
        $routes->post('delete/(:num)', [RoomBooking::class, 'delete/$1']);
        $routes->get('getroombookingbycustomerid/(:num)', [RoomBooking::class, 'getRoomBookingByCustomerId/$1']);
    });
});
