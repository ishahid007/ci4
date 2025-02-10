<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');

//    |--------------------------------------------------------------------------
// API Routes
//    |--------------------------------------------------------------------------
//    |
//    | Here is where you can register API routes for your application. These
//    | routes are loaded by the RouteServiceProvider within a group which
//    | is assigned the "api" middleware group. Enjoy building your API!
//    |

// Set the namespace Api in the group
$routes->group('api', ['namespace' => 'App\Controllers\Api', 'filter' => 'session'], static function ($routes) {
    $routes->resource('users', ['only' => 'index,create,show', 'controller' => 'UsersController']);
});

// Auth routes
service('auth')->routes($routes);
