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

    $routes->get('booking/(:num)', [Home::class, 'booking/$1']);
    $routes->post('booking/(:num)', [Home::class, 'booking/$1']);
    $routes->get('history_booking/(:num)', [Home::class, 'historyBooking/$1']);

});

$routes->group('vnpayReturn', static function ($routes) {
    $routes->get('/', [Home::class, 'vnpayReturn']);


});
