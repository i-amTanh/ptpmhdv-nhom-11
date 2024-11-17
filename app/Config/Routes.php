<?php

use App\Controllers\Home;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->group('/', static function ($routes) {
    $routes->get('', [Home::class, 'index']);
});