<?php

use Api\Controllers\Customer;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Client\Controllers\Home::class, 'index']);
$routes->get('home', [Client\Controllers\Home::class, 'index']);