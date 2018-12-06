<?php

/**
 * Created by PhpStorm.
 * User: santo.lee
 * Date: 2018-12-07
 * Time: 05:28
 */

namespace App\Traits;

use EasyWeChat\Factory;
use Symfony\Component\Cache\Simple\RedisCache;

trait MiniProgramTrait
{
	protected function miniProgram()
	{
		$config = config('easywechat.mini_program');
		$app = Factory::miniProgram($config);

		// 使用redis作为缓存,取消下面注释
//		$predis = app('redis')->connection()->client();
//		$cache = new RedisCache($predis);
//		$app['cache'] = $cache;

		return $app;
	}
}