<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

// $router->post('/users/', 'UserController@register');

$router->get('/api/products', 'ProductController@index');

$router->post('/api/products', 'ProductController@store');

$router->get('/api/products/{id}/', 'ProductController@show');

$router->put('/api/products/{id}/', 'ProductController@update');

$router->delete('/api/products/{id}/', 'ProductController@destroy');