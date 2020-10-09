<?php

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

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//Users
$app->get('/users/', 'UserController@index');
$app->post('/users/', 'UserController@store');
$app->get('/users/{user_id}', 'UserController@show');
$app->put('/users/{user_id}', 'UserController@update');
$app->delete('/users/{user_id}', 'UserController@destroy');
//Tasks
$app->get('/tasks','PostController@index');
$app->post('/tasks','PostController@store');
$app->get('/tasks/{post_id}','PostController@show');
$app->put('/tasks/{post_id}', 'PostController@update');
$app->delete('/tasks/{post_id}', 'PostController@destroy');
