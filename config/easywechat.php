<?php
/**
 * Created by PhpStorm.
 * User: santo.lee
 * Date: 2018-12-07
 * Time: 02:22
 */

return [
	/**
	 * 账号基本信息，请从微信公众平台/开放平台获取
	 */

	'wechat' => [
		/**
		 * 账号基本信息，请从微信公众平台/开放平台获取
		 */
		'app_id'  => 'your-app-id',         // AppID
		'secret'  => 'your-app-secret',     // AppSecret
		'token'   => 'your-token',          // Token
		'aes_key' => '',                    // EncodingAESKey，兼容与安全模式下请一定要填写！！！

		/**
		 * 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		 * 使用自定义类名时，构造函数将会接收一个 `EasyWeChat\Kernel\Http\Response` 实例
		 */
		'response_type' => 'array',

		/**
		 * 日志配置
		 *
		 * level: 日志级别, 可选为：
		 *         debug/info/notice/warning/error/critical/alert/emergency
		 * path：日志文件位置(绝对路径!!!)，要求可写权限
		 */
		'log' => [
			'default' => 'dev', // 默认使用的 channel，生产环境可以改为下面的 prod
			'channels' => [
				// 测试环境
				'dev' => [
					'driver' => 'single',
					'path' => '/tmp/easywechat.log',
					'level' => 'debug',
				],
				// 生产环境
				'prod' => [
					'driver' => 'daily',
					'path' => '/tmp/easywechat.log',
					'level' => 'info',
				],
			],
		],

		/**
		 * 接口请求相关配置，超时时间等，具体可用参数请参考：
		 * http://docs.guzzlephp.org/en/stable/request-config.html
		 *
		 * - retries: 重试次数，默认 1，指定当 http 请求失败时重试的次数。
		 * - retry_delay: 重试延迟间隔（单位：ms），默认 500
		 * - log_template: 指定 HTTP 日志模板，请参考：https://github.com/guzzle/guzzle/blob/master/src/MessageFormatter.php
		 */
		'http' => [
			'max_retries' => 1,
			'retry_delay' => 500,
			'timeout' => 5.0,
			// 'base_uri' => 'https://api.weixin.qq.com/', // 如果你在国外想要覆盖默认的 url 的时候才使用，根据不同的模块配置不同的 uri
		],

		/**
		 * OAuth 配置
		 *
		 * scopes：公众平台（snsapi_userinfo / snsapi_base），开放平台：snsapi_login
		 * callback：OAuth授权完成后的回调页地址
		 */
		'oauth' => [
			'scopes'   => ['snsapi_userinfo'],
			'callback' => '/examples/oauth_callback.php',
		],
	],

	'mini_program' => [
		'app_id' => 'your-app-id',
		'secret' => 'your-app-secret',

		// 下面为可选项
		// 指定 API 调用返回结果的类型：array(default)/collection/object/raw/自定义类名
		'response_type' => 'array',

		'log' => [
			'level' => 'debug',
			'file' => storage_path('logs/wechat/mini_program.log'),
		],
	],
];