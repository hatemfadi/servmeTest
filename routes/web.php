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
$router->group(['prefix' => 'api'], function () use ($router) {
    //Users
    $router->get('/users/', 'UserController@index');
    $router->post('/users/', 'UserController@store');
    $router->get('/users/{user_id}', 'UserController@show');
    $router->put('/users/{user_id}', 'UserController@update');
    $router->delete('/users/{user_id}', 'UserController@destroy');

    //Tasks
    $router->get('/tasks', 'PostController@index');
    $router->post('/tasks', 'PostController@store');
    $router->get('/tasks/{post_id}', 'PostController@show');
    $router->put('/tasks/{post_id}', 'PostController@update');
    $router->delete('/tasks/{post_id}', 'PostController@destroy');
});
