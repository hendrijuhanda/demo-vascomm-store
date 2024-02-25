<?php

$router->group(['namespace' => 'Modules\User\Http\Controllers', "middleware" => ['auth:api', "role:admin"], 'prefix' => 'v1'], function ($router) {
    $router->get('/users', 'UserController@index');
    $router->get('/user/{id}', 'UserController@show');
    $router->post('/user', 'UserController@create');
    $router->put('/user/{id}', 'UserController@update');
    $router->delete('/user/{id}', 'UserController@destroy');
});
