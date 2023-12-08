<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('chat', 'ChatController::index');
$routes->get('/getdata', 'TryController::getData');
$routes->get('/getstudentdata', 'StudentController::getData');
$routes->get('/studentAttendance', 'AttendanceController::studentAttendance');
$routes->get('/getcoachdata', 'CoachController::getData');
$routes->get('/getsection', 'SectionController::getData');  
$routes->get('/getstudentdata/(:num)', 'StudentController::getDataById/$1');
$routes->post('/register', 'SignupController::register');
$routes->post('/addcoach', 'CoachController::addData');
$routes->post('/addsection', 'SectionController::addData');
$routes->post('/login', 'LoginController::login');
$routes->get('/getUser', 'LoginController::getUser');
$routes->get('getUserMessages/(:num)', 'ChatController::getUserMessages/$1');

$routes->post('logout', 'LoginController::logout');
$routes->get('getConnectedUsers', 'ChatController::getConnectedUsers');
// $routes->match(['get', 'post'], '/login', 'LoginController::login');

$routes->post('/save', 'MainController::save');
$routes->post('/del', 'MainController::del');
$routes->get('/getMessage', 'ChatController::getMessages');
$routes->post('/sendMessage', 'ChatController::sendMessage');
