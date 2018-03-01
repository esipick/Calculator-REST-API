<?php
use Dingo\Api\Routing\Router;

$api = app(Router::class);

$api->version('v1', function (Router $api) {
    $api->group(['prefix' => 'v1'], function(Router $api) {
        $api->get('add/{slugNum?}', 'App\\Http\\Controllers\\CalculateController@add')->where('slugNum', '(.*)');
        $api->get('subtract', 'App\\Http\\Controllers\\CalculateController@add');
        $api->get('multiple', 'App\\Http\\Controllers\\CalculateController@add');
        $api->get('divide', 'App\\Http\\Controllers\\CalculateController@add');


    });
});
