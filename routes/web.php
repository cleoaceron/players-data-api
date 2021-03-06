<?php

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
});

$router->group(["prefix" => "admin"], function() use ($router) {

	$router->group(["prefix" => "players"], function() use ($router) {

		$router->get("view/{uuid}", ["as" => "admin.players.view", "uses" => "PlayersController@viewPlayer"]);
		$router->post("list[/{page:\d+}]", ["as" => "admin.players.list", "uses" => "PlayersController@getPlayerList"]);

	});

});