<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use Illuminate\Support\Facades\DB;

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

$router->group(['prefix' => '/todolist', 'namespace' => '\LawAdvisor\Domains\TodoList\Controllers'], function () use ($router) {
    $router->get('/', ['uses' => 'TodoListController@index']);
    $router->post('/', ['uses' => 'TodoListController@store']);
    $router->group(['prefix' => '/{todo}'], function () use ($router) {
        $router->get('/', ['uses' => 'TodoListController@retrieve']);
        $router->delete('/', ['uses' => 'TodoListController@delete']);
        $router->patch('/', ['uses' => 'TodoListController@update']);
    });
});
