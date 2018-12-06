<?php
/**
 * Created by PhpStorm.
 * User: santo.lee
 * Date: 2018-12-06
 * Time: 22:38
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v1', function($api) {
	$api->group([
		'namespace' => 'App\Http\Controllers\Apis\V1'
	], function ($api) {
		$api->get('test', 'TestController@test');
		$api->post('authorizations', 'AuthController@store');
		$api->put('authorizations', 'AuthController@update');

		// 需授权的路由
		$api->group([
			'middleware' => 'api.auth'
		], function ($api) {
		});
	});
});