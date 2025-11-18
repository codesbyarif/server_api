<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('add-staff', 'ServerApi::addStaff');
$routes->get('get-staff', 'ServerApi::getDataStaff');
$routes->post('delete-staff', 'ServerApi::deleteStaff');
$routes->post('update-staff', 'ServerApi::updateStaff');

