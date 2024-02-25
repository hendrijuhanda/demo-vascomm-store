<?php

$router->group(['namespace' => 'Modules\Auth\Http\Controllers', 'prefix' => 'v1'], function ($router) {
    $router->post('/login', 'AuthController@login');
    $router->post('/register', 'AuthController@register');
    $router->post('/logout', 'AuthController@logout');

    $router->group(['middleware' => 'auth:api'], function ($router) {
        $router->get('/authenticate', 'AuthController@authenticate');
    });
});
