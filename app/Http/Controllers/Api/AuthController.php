<?php

namespace App\Http\Controllers\Api;

use Auth;
use Socialite;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\Response;

class AuthController extends Controller
{
	public function register(Request $request)
	{
		$this->validate($request, [
			'phone'    => 'required|string|phone',
			'password' => 'required|string|max:255',
		]);

		$user = new User();
		$user->phone = $request->phone;
		$user->password = bcrypt($request->password);
		$user->save();

		$token = Auth::guard('api')->fromUser($user);

		return $this->respondWithToken($token);
	}

	/**
	 * 用户登录
	 * @param Request $request
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function login(Request $request)
	{
		$this->validate($request, [
			'phone'    => 'required|phone|min:6',
			'password' => 'required|min:6',
		]);

		$credentials = $request->only('phone', 'password');

		if (!$token = Auth::guard('api')->attempt($credentials)) {
			$this->error(2001, Response::HTTP_UNAUTHORIZED);
		}

		return $this->respondWithToken($token);
	}

	public function socialLogin($type, Request $request)
	{
		$this->validate($request, [
			'code' => 'required|string',
		]);
		if (!in_array($type, ['weixin'])) {
			$this->error(2002, Response::HTTP_UNAUTHORIZED);
		}

		$driver = Socialite::driver($type);

		try {
			$response = $driver->getAccessTokenResponse(code);
			$oauthUser = $driver->userFromToken($response['access_token']);
		} catch (\Exception $e) {
			$this->error(2001, Response::HTTP_UNAUTHORIZED, '参数错误,获取用户信息失败');
		}

		switch ($type) {
			case 'weixin':
				$unionid = $oauthUser->offsetExists('unionid') ? $oauthUser->offsetGet('unionid') : null;
				if ($unionid) {
					$user = User::where('weixin_unionid', $unionid)->first();
				} else {
					$user = User::where('weixin_openid', $oauthUser->getId())->first();
				}
				// 用户不存在,则创建用户
				if (!$user) {
					$user = User::create([
						'name' => $oauthUser->getNickName(),
						'avatar' => $oauthUser->getAvatar(),
						'weixin_openid' => $oauthUser->getId(),
						'weixin_unionid' => $unionid
					]);
				}
				break;
		}

		$token = Auth::guard('api')->fromUser($user);

		return $this->respondWithToken($token);
	}

	/**
	 * 用户登出
	 * @return \Illuminate\Http\JsonResponse
	 */
	public function logout()
	{
		Auth::guard('api')->logout(true);

		return $this->success();
	}

	public function refreshToken(Request $request)
	{
		return $this->respondWithToken(Auth::guard('api')->refresh());
	}

	public function respondWithToken($token)
	{
		return $this->success([
			'access_token' => $token,
			'token_type'   => 'bearer',
			'expires_in'   => Auth::guard('api')->factory()->getTTL() * 60,
		]);
	}

	protected function username($string)
	{
		return filter_var($string, FILTER_VALIDATE_EMAIL) ? 'email' : 'phone';
	}
}
