<?php

$router->group(['namespace' => 'Modules\User\Http\Controllers', 'prefix' => 'v1'], function ($group) {
    $group->get('/users', 'UserController@index');
    $group->get('/user/{id}', 'UserController@show');
    $group->post('/user', 'UserController@create');
    $group->put('/user/{id}', 'UserController@update');
    $group->delete('/user/{id}', 'UserController@destroy');
});
