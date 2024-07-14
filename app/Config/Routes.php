<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get(env('app.subBase').'/new', 'NewDataController::newDataForm', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new', 'NewDataController::newData', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new/qz3', 'NewDataController::quickAddZyn3', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new/qz6', 'NewDataController::quickAddZyn6', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new/qg2', 'NewDataController::quickAddGum2', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new/qg4', 'NewDataController::quickAddGum4', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/new/qo8', 'NewDataController::quickAddOn8', ['filter' => ['authfilter', 'csrf']]);

$routes->get(env('app.subBase').'/update', 'UpdateDataController::listDataPoints', ['filter' => ['authfilter', 'csrf']]);
// $routes->get(env('app.subBase').'/update/(:segment)', [\App\Controllers\UpdateDataController::class, 'updateDataForm'], ['filter' => ['authfilter', 'csrf']]);
// $routes->post(env('app.subBase').'/update/(:segment)', [\App\Controllers\UpdateDataController::class, 'updateData'], ['filter' => ['authfilter', 'csrf']]);
$routes->get(env('app.subBase').'/update/(:segment)', 'UpdateDataController::updateDataForm/$1', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/update/(:segment)', 'UpdateDataController::updateData/$1', ['filter' => ['authfilter', 'csrf']]);

// $routes->get(env('app.subBase').'/delete/(:segment)', [\App\Controllers\DeleteDataController::class, 'deleteDataForm'], ['filter' => ['authfilter', 'csrf']]);
// $routes->post(env('app.subBase').'/delete/(:segment)', [\App\Controllers\DeleteDataController::class, 'deleteData'], ['filter' => ['authfilter', 'csrf']]);
$routes->get(env('app.subBase').'/delete', 'UpdateDataController::listDataPoints', ['filter' => ['authfilter', 'csrf']]);
// $routes->get(env('app.subBase').'/delete/(:segment)', 'UpdateDataController::updateDataForm/$1', ['filter' => ['authfilter', 'csrf']]);
$routes->post(env('app.subBase').'/delete/(:segment)', 'UpdateDataController::deleteData/$1', ['filter' => ['authfilter', 'csrf']]);

$routes->get(env('app.subBase').'/login', 'AuthLoginController::loginForm', ['filter' => ['csrf']]);
$routes->post(env('app.subBase').'/login', 'AuthLoginController::login', ['filter' => ['csrf']]);
$routes->get(env('app.subBase').'/logout', 'AuthLoginController::logout', ['filter' => ['csrf']]);

$routes->get(env('app.subBase').'/error', 'ErrorsController::index');
$routes->post(env('app.subBase').'/error', 'ErrorsController::index');

$routes->get(env('app.subBase').'/', 'HomeController::home', ['filter' => ['csrf']]);
$routes->post(env('app.subBase').'/', 'HomeController::home', ['filter' => ['csrf']]);

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
