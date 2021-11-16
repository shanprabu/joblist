<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\JobController;

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

/*$router->get('/', function () use ($router) {
    return $router->app->version();
});*/

$router->get('/',['as'=>'home','uses'=>'JobController@homePage']);
$router->get('/viewjob/{id}',['as'=>'viewjob','uses'=>'JobController@viewJob']);
$router->get('/applyjob/{id}', ['as'=>'applyJob', 'uses'=>'JobController@applyJob']);
$router->post('/applyjob', ['as'=>'submitApplication', 'uses'=>'JobController@submitApplication']);
