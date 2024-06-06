<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('auth/login', 'AuthController::login');
$routes->get('products', 'ProductController::index');