<?php

$router->group(['namespace' => 'Modules\Client\Http\Controllers', 'prefix' => 'v1/client'], function ($router) {
    $router->get('/products', 'ClientProductController@index');
});
