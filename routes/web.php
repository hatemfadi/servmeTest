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
    $router->delete('/users/{user_id}', 'UserController@destroy');

    //Tasks
    $router->get('/tasks', 'TaskController@index');
    $router->post('/tasks', 'TaskController@store');
    $router->get('/tasks/{task_id}', 'TaskController@show');
    $router->put('/tasks/{task_id}', 'TaskController@update');
    $router->delete('/tasks/{task_id}', 'TaskController@destroy');

    //categories
    $router->get('/categories', 'CategoryController@index');
    $router->post('/categories', 'CategoryController@store');
    $router->get('/categories/{category_id}', 'CategoryController@show');
    $router->put('/categories/{category_id}', 'CategoryController@update');
    $router->delete('/categories/{category_id}', 'CategoryController@destroy');
});
