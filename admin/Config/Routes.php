<?php

use Admin\Controllers\Employee;
use Admin\Controllers\Home;
use Admin\Controllers\Resort;
use Admin\Controllers\Room;
use Admin\Controllers\Account;
use Admin\Controllers\RoomBooking;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('admin', static function ($routes) {
    $routes->get('/', [Home::class, 'index']);

    $routes->group('resort', static function ($routes) {
        $routes->get('/', [Resort::class, 'resortIndex']);
        $routes->get('create', [Resort::class, 'resortCreate']);
        $routes->post('create', [Resort::class, 'resortCreate']);
        $routes->get('update/(:num)', [Resort::class, 'resortUpdate/$1']);
        $routes->post('update/(:num)', [Resort::class, 'resortUpdate/$1']);
        $routes->post('', [Resort::class, 'resortDelete/$1']);
        $routes->get('view/(:num)', [Resort::class, 'resortView/$1']);
        $routes->post('view/(:num)', [Resort::class, 'resortView/$1']);
    });

    $routes->group('room', static function ($routes) {
        $routes->get('/', [Room::class, 'roomIndex']);
        $routes->get('create', [Room::class, 'roomCreate']);
        $routes->post('create', [Room::class, 'roomCreate']);
        $routes->get('update/(:num)', [Room::class, 'roomUpdate/$1']);
        $routes->post('update/(:num)', [Room::class, 'roomUpdate/$1']);
        $routes->post('', [Room::class, 'roomDelete/$1']);
        $routes->get('view/(:num)', [Room::class, 'roomView/$1']);
        $routes->post('view/(:num)', [Room::class, 'roomView/$1']);
    });

    $routes->group('account', static function ($routes) {
        $routes->get('/', [Account::class, 'accountIndex']);
        $routes->get('create', [Account::class, 'accountCreate']);
        $routes->post('create', [Account::class, 'accountCreate']);
        $routes->get('update/(:num)', [Account::class, 'accountUpdate/$1']);
        $routes->post('update/(:num)', [Account::class, 'accountUpdate/$1']);
        $routes->post('', [Account::class, 'accountDelete/$1']);
    });

    $routes->group('employee', static function ($routes) {
        $routes->get('/', [Employee::class, 'employeeIndex']);
        $routes->get('create', [Employee::class, 'employeeCreate']);
        $routes->post('create', [Employee::class, 'employeeCreate']);
        $routes->get('update/(:num)', [Employee::class, 'employeeUpdate/$1']);
        $routes->post('update/(:num)', [Employee::class, 'employeeUpdate/$1']);
        $routes->post('', [Employee::class, 'employeeDelete/$1']);
    });

    $routes->group('roombooking', static function ($routes) {
        $routes->get('/', [RoomBooking::class, 'roomBookingIndex']);
        $routes->get('update/(:num)', [RoomBooking::class, 'roomBookingUpdate/$1']);
        $routes->post('update/(:num)', [RoomBooking::class, 'roomBookingUpdate/$1']);
        $routes->post('', [RoomBooking::class, 'roomBookingDelete/$1']);
    });

});
