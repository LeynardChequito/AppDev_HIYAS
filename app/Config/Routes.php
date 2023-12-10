<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'MainController::index');
$routes->get('chat', 'ChatController::index');
$routes->get('/getdata', 'TryController::getData');
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

$routes->get('/getstudentdata', 'StudentController::getData');

$routes->post('/addstudent', 'StudentController::addData');
$routes->put('/updatestudent/(:num)', 'StudentController::updateData/$1');
$routes->delete('/deletestudent/(:num)', 'StudentController::deleteData/$1');


$routes->put('/updatecoach/(:num)', 'CoachController::updateData/$1');
$routes->delete('/deletecoach/(:num)', 'CoachController::deleteData/$1');


$routes->get('/getparent', 'ParentController::getData');
$routes->post('/addparent', 'ParentController::addData');
$routes->put('/updateparent/(:num)', 'ParentController::updateData/$1');
$routes->delete('/deleteparent/(:num)', 'ParentController::deleteData/$1');


$routes->get('/getevent', 'EventController::getData');
$routes->post('/addevent', 'EventController::addData');
$routes->put('/updateevent/(:num)', 'EventController::updateData/$1');
$routes->delete('/deleteevent/(:num)', 'EventController::deleteData/$1');

$routes->post('/addstudentattendance', 'AttendanceController::addStudentAttendance');
$routes->put('/updatestudentattendance/(:num)', 'AttendanceController::updateStudentAttendance/$1');
$routes->delete('/deletestudentattendance/(:num)', 'AttendanceController::deleteStudentAttendance/$1');

$routes->get('/getaccount', 'AccountController::getData');
$routes->post('/addaccount', 'AccountController::addData');
$routes->put('/updateaccount/(:num)', 'AccountController::updateData/$1');
$routes->delete('/deleteaccount/(:num)', 'AccountController::deleteData/$1');

$routes->put('/updatesection/(:num)', 'SectionController::updateData/$1');
$routes->delete('/deletesection/(:num)', 'SectionController::deleteData/$1');
$routes->post('logout', 'LoginController::logout');
$routes->get('getConnectedUsers', 'ChatController::getConnectedUsers');
// $routes->match(['get', 'post'], '/login', 'LoginController::login');

$routes->post('createattendance', 'AttendanceController::createAttendance');
$routes->get('getstudentsforattendance/(:num)', 'AttendanceController::getStudentsForAttendance/$1');
// Add other routes if necessary


$routes->post('/save', 'MainController::save');
$routes->post('/del', 'MainController::del');
$routes->get('/getMessage', 'ChatController::getMessages');
$routes->post('/sendMessage', 'ChatController::sendMessage');
