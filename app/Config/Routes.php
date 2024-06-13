<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('products', 'ProductController::index');
$routes->get('categories', 'CategoryController::index');
$routes->get('product/(:segment)', 'ProductController::showCertainProduct/$1');
$routes->get('store/(:segment)', 'StoreController::showCertainStore/$1');
$routes->get('stores', 'StoreController::index');