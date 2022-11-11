<?php

/** @var \Laravel\Lumen\Routing\Router $router */

use App\Http\Controllers\PostController;
use App\Http\Controllers\AuthController;

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

$router->get('/', function () use ($router) {
   return $router->app->version();
    //echo "Lumen";
});

//$router->get('/', 'FormController@index');
//$router->get('userdata', 'FormController@userdata');



$router->group(['prefix' => 'api'], function () use ($router) {
    $router->post('/register', 'AuthController@register');
    $router->post('/login', 'AuthController@login');

$router->group(['middleware' => 'auth'], function () use ($router) {
        $router->post('/logout', 'AuthController@logout');
       // $router->get('/dashboard', 'FormController@dashboard');
        $router->get('/userdata', 'AuthController@logindata');
        $router->get('/post', 'PostController@index');
        $router->get('/userpost/{userid}', 'PostController@userpost');
        $router->post('/post', 'PostController@store');
        $router->post('/comment', 'PostController@commentpost');
        $router->get('/commentdata/{postid}', 'PostController@commentdata');
        $router->get('/commentdataall', 'PostController@commentdataall');
        $router->post('/like', 'PostController@likepost');
        $router->post('/dislike', 'PostController@dislikepost');
        $router->put('/post/{id}', 'PostController@update');
        $router->get('/post/{id}', 'PostController@view');
        $router->delete('/post/{id}', 'PostController@destroy');
    });
});



