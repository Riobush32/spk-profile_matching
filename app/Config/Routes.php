<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

$routes->get('/kriteria', 'Kriteria::index');
$routes->get('/kriteria/add', 'Kriteria::add');
$routes->post('/kriteria/store', 'Kriteria::store');
$routes->get('/kriteria/edit/(:num)', 'Kriteria::edit/$1');
$routes->patch('/kriteria/update/(:num)', 'Kriteria::update/$1');
$routes->delete('/kriteria/delete', 'Kriteria::delete');

$routes->get('/sub-kriteria', 'SubKriteria::index');
$routes->get('/sub-kriteria/add', 'SubKriteria::add');
$routes->post('/sub-kriteria/store', 'SubKriteria::store');
$routes->get('/sub-kriteria/edit/(:num)', 'SubKriteria::edit/$1');
$routes->patch('/sub-kriteria/update/(:num)', 'SubKriteria::update/$1');
$routes->delete('/sub-kriteria/delete', 'SubKriteria::delete');

$routes->get('/alternative', 'Alternative::index');
$routes->get('/alternative/add', 'Alternative::add');
$routes->post('/alternative/store', 'Alternative::store');
$routes->patch('/alternative/update/(:num)', 'Alternative::update/$1');
$routes->get('/alternative/edit/(:num)', 'Alternative::edit/$1');
$routes->delete('/alternative/delete', 'Alternative::delete');

$routes->get('/penilaian', 'Penilaian::index');
$routes->get('/penilaian/add', 'Penilaian::add');
$routes->post('/penilaian/store', 'Penilaian::store');
$routes->get('/penilaian/edit/(:num)', 'Penilaian::edit/$1');
$routes->patch('/penilaian/update/(:num)', 'Penilaian::update/$1');
$routes->delete('/penilaian/delete', 'Penilaian::delete');

$routes->get('/bobot', 'Bobot::index');
$routes->get('/bobot/add', 'Bobot::add');
$routes->post('/bobot/store', 'Bobot::store');
$routes->get('/bobot/edit/(:num)', 'Bobot::edit/$1');
$routes->patch('/bobot/update/(:num)', 'Bobot::update/$1');
$routes->delete('/bobot/delete', 'Bobot::delete');

$routes->get('/perhitungan', 'Perhitungan::index');
$routes->post('/perhitungan', 'Perhitungan::index');