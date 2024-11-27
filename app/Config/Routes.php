<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'User::index');
$routes->get('/chatbot', 'User::chatbot');
$routes->get('/konsultasi', 'User::konsultasi');
$routes->get('/konsultasi/reservasi', 'User::reservasi');
$routes->post('/konsultasi/reservasi/submit', 'User::submit_reservasi');
$routes->get('/konsultasi/cekReservasi', 'User::token');
$routes->post('/konsultasi/checkStatus', 'User::checkStatus');
$routes->post('/konsultasi/reservasi/feedback', 'User::feedback');
$routes->post('/konsultasi/reservasi/feedback/submit', 'User::submit_feedback');



$routes->get('/staff', 'Admin::login');
$routes->post('/staff/masuk', 'Admin::masuk');
$routes->get('/logout', 'Admin::logout');
$routes->get('/admin', 'Admin::dashboard');
$routes->get('/dashboard/delete/(:num)', 'Admin::delete/$1');
$routes->get('/dashboard/detail/(:num)', 'Admin::detail/$1');
$routes->post('/dashboard/detail/update/(:num)', 'Admin::updateStatus/$1');
$routes->get('/statistik', 'Admin::statistik');
$routes->get('/pengaturan', 'Admin::pengaturan');
$routes->get('/admin/tambah', 'Admin::tambahAdmin');
$routes->post('/admin/simpan', 'Admin::simpanAdmin');
$routes->get('/admin/detail/(:num)', 'Admin::detailAdmin/$1');
$routes->get('/admin/delete/(:num)', 'Admin::deleteAdmin/$1');
$routes->get('/konsultan/tambah', 'Admin::tambahKonsultan');
$routes->post('/konsultan/simpan', 'Admin::simpanKonsultan');
$routes->get('/konsultan/detail/(:num)', 'Admin::detailKonsultan/$1');
$routes->get('/konsultan/delete/(:num)', 'Admin::deleteKonsultan/$1');



