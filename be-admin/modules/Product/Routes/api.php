<?php

$router->group(['namespace' => 'Modules\Product\Http\Controllers', 'prefix' => 'v1'], function ($group) {
    $group->get('/products', 'ProductController@index');
    $group->get('/product/{id}', 'ProductController@show');
    $group->post('/product', 'ProductController@create');
    $group->put('/product/{id}', 'ProductController@update');
    $group->delete('/product/{id}', 'ProductController@destroy');
});
