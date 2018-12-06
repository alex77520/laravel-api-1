<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class DingoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
	    // 开启访问节流
	    $this->app['Dingo\Api\Http\RateLimit\Handler']->extend(function () {
		    return new \Dingo\Api\Http\RateLimit\Throttle\Authenticated;
	    });
	    // 自定义ModelNotFoundException异常响应
	    app('Dingo\Api\Exception\Handler')->register(function (\Illuminate\Database\Eloquent\ModelNotFoundException $exception) {
		    return response()->json([
			    'status_code' => 404,
			    'message' => '未找到对应的数据',
		    ], JSON_UNESCAPED_UNICODE);
	    });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
