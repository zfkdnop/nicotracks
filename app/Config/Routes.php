<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/new', 'NewDataController::newDataForm', ['filter' => ['authfilter', 'csrf']]);
$routes->post('/new', 'NewDataController::newData', ['filter' => ['authfilter', 'csrf']]);
// $routes->post('/api/new', 'APIController::newDataEndpoint');

$routes->get('/update', 'UpdateDataController::listDataPoints', ['filter' => ['authfilter', 'csrf']]);
$routes->get('/update/(:segment)', [\App\Controllers\UpdateDataController::class, 'updateDataForm'], ['filter' => ['authfilter', 'csrf']]);
$routes->post('/update/(:segment)', [\App\Controllers\UpdateDataController::class, 'updateData'], ['filter' => ['authfilter', 'csrf']]);
// $routes->post('/api/new', 'APIController::updateDataEndpoint');

$routes->get('/delete', 'DeleteDataController::deleteDataForm', ['filter' => ['authfilter', 'csrf']]);
$routes->post('/delete', 'DeleteDataController::deleteData', ['filter' => ['authfilter', 'csrf']]);
// $routes->post('/api/new', 'APIController::deleteDataEndpoint');

$routes->get('/login', 'AuthLoginController::loginForm', ['filter' => ['csrf']]);
$routes->post('/login', 'AuthLoginController::login', ['filter' => ['csrf']]);
$routes->get('/logout', 'AuthLoginController::logout', ['filter' => ['csrf']]);

$routes->get('/error', 'ErrorsController::index');
$routes->post('/error', 'ErrorsController::index');

$routes->get('/', 'HomeController::home', ['filter' => ['csrf']]);
$routes->post('/', 'HomeController::home', ['filter' => ['csrf']]);

/**
 * Default placeholders
 * (:any)       will match all characters from that point to the end of the URI. This may include multiple URI segments.
 * (:segment)   will match any character except for a forward slash (/) restricting the result to a single segment.
 * (:num)       will match any integer.
 * (:alpha)     will match any string of alphabetic characters
 * (:alphanum)  will match any string of alphabetic characters or integers, or any combination of the two.
 * (:hash)      is the same as (:segment), but can be used to easily see which routes use hashed ids.
 */
/**
 * resource('photos') generates the following routes (NOT in this order)
 * $routes->get('photos/new', 'Photos::new');
 * $routes->post('photos', 'Photos::create');
 * $routes->get('photos', 'Photos::index');
 * $routes->get('photos/(:segment)', 'Photos::show/$1');
 * $routes->get('photos/(:segment)/edit', 'Photos::edit/$1');
 * $routes->put('photos/(:segment)', 'Photos::update/$1');
 * $routes->patch('photos/(:segment)', 'Photos::update/$1');
 * $routes->delete('photos/(:segment)', 'Photos::delete/$1');
 */
