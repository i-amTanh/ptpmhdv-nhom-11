<?php

use CodeIgniter\Router\RouteCollection;
use Web\Controllers\Home;

/**
 * @var RouteCollection $routes
 */
$routes->group('vi', static function ($routes) {
    $routes->get('/', [Home::class, 'index']);

    $routes->group('resort', static function ($routes) {
        $routes->get('detailroom/(:num)', [Home::class, 'detail/$1']);
    });

});
