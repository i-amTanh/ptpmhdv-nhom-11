<?php

use Auth\Controllers\Auth;
use Auth\Controllers\Register;
use CodeIgniter\Router\RouteCollection;


/**
 * @var RouteCollection $routes
 */
$routes->group('auth', static function ($routes) {
    $routes->get('login', [Auth::class, 'login']);
    $routes->post('login', [Auth::class, 'login']);
    $routes->get('logout', [Auth::class, 'logout']);
    $routes->get('register', [Register::class, 'register']);
    $routes->post('register', [Register::class, 'register']);
});
