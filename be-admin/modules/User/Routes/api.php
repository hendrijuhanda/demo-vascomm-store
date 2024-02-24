<?php

$router->group(['namespace' => 'Modules\User\Http\Controllers', 'prefix' => 'v1'], function ($group) {
    $group->post('/register', 'UserController@create');

    $group->get('/users', 'UserController@index');
    $group->get('/user/{id}', 'UserController@show');
    $group->put('/user/{id}', 'UserController@update');
    $group->delete('/user/{id}', 'UserController@destroy');
});
