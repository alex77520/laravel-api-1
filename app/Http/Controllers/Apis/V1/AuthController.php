<?php

namespace App\Http\Controllers\Apis\V1;

use App\Models\User;
use Illuminate\Http\Request;
use App\Traits\MiniProgramTrait;
use App\Http\Controllers\Apis\ApiController;

class AuthController extends ApiController
{
	use MiniProgramTrait;

	public function store(Request $request)
	{
		$this->validate($request, [
			'code'          => 'required',
			'encryptedData' => 'required',
			'iv'            => 'required',
		]);

		$app = $this->miniProgram();

		$session = $app->auth->session($request->code);

		try {
			$userInfo = $app->encryptor->decryptData(
				$session['session_key'], $request->iv, $request->encryptedData
			);
		} catch (\Exception $e) {
			return $this->response->errorForbidden('提交的参数无法解密用户信息');
		}

		$user = User::where('open_id', $userInfo['openId'])->first();
		if (!$user) {
			$user              = new User();
			$user->open_id     = $userInfo['openId'];
			$user->union_id    = $userInfo['unionId'] ?? null;
			$user->session_key = $session['session_key'];
			$user->nick_name   = $userInfo['nickName'];
			$user->gender      = $userInfo['gender'];
			$user->language    = $userInfo['language'];
			$user->city        = $userInfo['city'];
			$user->province    = $userInfo['province'];
			$user->country     = $userInfo['country'];
			$user->avatar_url  = $userInfo['avatarUrl'];
		} else {
			// 如绑定开放平台,需要更新union_id,取消下面注释
//			if (!empty($user->union_id)) {
//				$user->union_id = $userInfo['unionId'] ?? null;
//			}
			$user->session_key = $session['session_key'];
		}

		$user->save();

		if (!$token = \Auth::guard('api')->fromUser($user)) {
			return $this->response->errorUnauthorized('登录失败');
		}

		return $this->respondWithToken($token);
	}

	public function update()
	{
		$token = \Auth::guard('api')->refresh();

		return $this->respondWithToken($token);
	}

	protected function respondWithToken($token)
	{
		return $this->success([
			'token'              => $token,
			'expired_at'         => date('Y-m-d H:i:s', time() + env('JWT_TTL') * 60),
			'refresh_expired_at' => date('Y-m-d H:i:s', time() + env('JWT_REFRESH_TTL') * 60),
		]);
	}
}
