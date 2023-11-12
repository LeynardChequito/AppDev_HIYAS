<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/getdata', 'TryController::getData');
$routes->post('/register', 'SignupController::register');
$routes->post('/login', 'LoginController::login');
$routes->post('/save', 'MainController::save');
$routes->post('/del', 'MainController::del');



