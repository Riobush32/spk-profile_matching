<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::doLogin');
$routes->get('/logout', 'AuthController::logout');

$routes->get('/', 'Home::index', ['filter' => 'authfilter']);

$routes->get('/kriteria', 'Kriteria::index', ['filter' => 'authfilter']);
$routes->get('/kriteria/add', 'Kriteria::add', ['filter' => 'authfilter']);
$routes->post('/kriteria/store', 'Kriteria::store', ['filter' => 'authfilter']);
$routes->get('/kriteria/edit/(:num)', 'Kriteria::edit/$1', ['filter' => 'authfilter']);
$routes->patch('/kriteria/update/(:num)', 'Kriteria::update/$1', ['filter' => 'authfilter']);
$routes->delete('/kriteria/delete', 'Kriteria::delete', ['filter' => 'authfilter']);

$routes->get('/sub-kriteria', 'SubKriteria::index', ['filter' => 'authfilter']);
$routes->get('/sub-kriteria/add', 'SubKriteria::add', ['filter' => 'authfilter']);
$routes->post('/sub-kriteria/store', 'SubKriteria::store', ['filter' => 'authfilter']);
$routes->get('/sub-kriteria/edit/(:num)', 'SubKriteria::edit/$1', ['filter' => 'authfilter']);
$routes->patch('/sub-kriteria/update/(:num)', 'SubKriteria::update/$1', ['filter' => 'authfilter']);
$routes->delete('/sub-kriteria/delete', 'SubKriteria::delete', ['filter' => 'authfilter']);

$routes->get('/alternative', 'Alternative::index', ['filter' => 'authfilter']);
$routes->get('/alternative/add', 'Alternative::add', ['filter' => 'authfilter']);
$routes->post('/alternative/store', 'Alternative::store', ['filter' => 'authfilter']);
$routes->patch('/alternative/update/(:num)', 'Alternative::update/$1', ['filter' => 'authfilter']);
$routes->get('/alternative/edit/(:num)', 'Alternative::edit/$1', ['filter' => 'authfilter']);
$routes->delete('/alternative/delete', 'Alternative::delete', ['filter' => 'authfilter']);

$routes->get('/penilaian', 'Penilaian::index', ['filter' => 'authfilter']);
$routes->get('/penilaian/add', 'Penilaian::add', ['filter' => 'authfilter']);
$routes->post('/penilaian/store', 'Penilaian::store', ['filter' => 'authfilter']);
$routes->get('/penilaian/edit/(:num)', 'Penilaian::edit/$1', ['filter' => 'authfilter']);
$routes->patch('/penilaian/update/(:num)', 'Penilaian::update/$1', ['filter' => 'authfilter']);
$routes->delete('/penilaian/delete', 'Penilaian::delete');

$routes->get('/bobot', 'Bobot::index', ['filter' => 'authfilter']);
$routes->get('/bobot/add', 'Bobot::add', ['filter' => 'authfilter']);
$routes->post('/bobot/store', 'Bobot::store', ['filter' => 'authfilter']);
$routes->get('/bobot/edit/(:num)', 'Bobot::edit/$1', ['filter' => 'authfilter']);
$routes->patch('/bobot/update/(:num)', 'Bobot::update/$1', ['filter' => 'authfilter']);
$routes->delete('/bobot/delete', 'Bobot::delete', ['filter' => 'authfilter']);

$routes->get('/perhitungan', 'Perhitungan::index', ['filter' => 'authfilter']);
$routes->post('/perhitungan', 'Perhitungan::index', ['filter' => 'authfilter']);