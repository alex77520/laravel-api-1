<?php
/**
 * Created by PhpStorm.
 * User: santo.lee
 * Date: 2018-12-06
 * Time: 22:38
 */

$api = app('Dingo\Api\Routing\Router');

$api->version('v2', function($api) {
	$api->group([
		'namespace' => 'App\Http\Controllers\Apis\V2'
	], function ($api) {
		$api->get('test', 'TestController@test');
	});
});