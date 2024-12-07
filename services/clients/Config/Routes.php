<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [\Client\Controllers\Controllers\Home::class, 'index']);
$routes->get('home', [\Client\Controllers\Controllers\Home::class, 'index']);