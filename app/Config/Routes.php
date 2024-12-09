<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// User Content Routes
$routes->get('/', 'UserContentController::index');
$routes->get('/chatbot', 'UserContentController::chatbot');
$routes->get('/consultation', 'UserContentController::consultation');
$routes->get('/consultation/reserve', 'KonsultasiController::create');
$routes->post('/consultation/reserve/submit', 'KonsultasiController::submit');
$routes->get('/consultation/checkReservation', 'UserContentController::token');
$routes->post('/consultation/status', 'KonsultasiController::checkStatus');
$routes->post('/consultation/feedback', 'FeedbackController::create');
$routes->post('/consultation/feedback/submit', 'FeedbackController::submit');

// admin Authentication Routes
$routes->get('/admin/login', 'AuthController::login');
$routes->post('/admin/login/submit', 'AuthController::loginSubmit');
$routes->get('/admin/logout', 'AuthController::logout');

// Admin Content Routes
$routes->get('/admin/dashboard', 'AdminContentController::index');
$routes->post('/admin/dashboard/filter', 'AdminContentController::filterDashboard');
$routes->get('/admin/statistics', 'AdminContentController::statistik');
$routes->get('/admin/settings', 'AdminContentController::pengaturan');
$routes->get('/admin/dashboard', 'AdminController::dashboard');

// Consultation Management Routes
$routes->get('/admin/consultation/delete/(:num)', 'KonsultasiController::delete/$1');
$routes->get('/admin/consultation/detail/(:num)', 'KonsultasiController::detail/$1');
$routes->post('/admin/consultation/detail/update/(:num)', 'KonsultasiController::updateStatus/$1');

// Jadwal Konsultasi Routes (Admin)
$routes->get('/admin/consultation/schedule/(:num)', 'JadwalKonsultasiController::index/$1');
$routes->post('/admin/consultation/schedule/store', 'JadwalKonsultasiController::store');
$routes->get('/admin/consultation/notification/(:num)', 'JadwalKonsultasiController::notification/$1');
$routes->post('/admin/consultation/notification/send/(:num)', 'JadwalKonsultasiController::sendNotification/$1');

// Admin Management Routes
$routes->get('/admin/manage/add', 'AdminManagementController::create');
$routes->post('/admin/manage/store', 'AdminManagementController::store');
$routes->get('/admin/manage/detail/(:num)', 'AdminManagementController::detail/$1');
$routes->get('/admin/manage/delete/(:num)', 'AdminManagementController::delete/$1');

// Consultant Management Routes
$routes->get('/admin/consultant/add', 'KonsultanManagementController::create');
$routes->post('/admin/consultant/store', 'KonsultanManagementController::store');
$routes->get('/admin/consultant/detail/(:num)', 'KonsultanManagementController::detail/$1');
$routes->get('/admin/consultant/delete/(:num)', 'KonsultanManagementController::delete/$1');

