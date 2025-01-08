<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/administrator/login', 'Administrator::login');
$routes->get('/administrator/registerpage', 'Administrator::register_page');
$routes->get('/administrator/register', 'Administrator::register');
