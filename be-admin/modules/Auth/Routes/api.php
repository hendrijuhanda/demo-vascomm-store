<?php

$router->group(['namespace' => 'Modules\Auth\Http\Controllers', 'prefix' => 'v1'], function ($group) {
    $group->post('/login', 'AuthController@login');
    $group->post('/register', 'AuthController@register');
});
