<?php
/**
 * Created by PhpStorm.
 * User: shengtaolee
 * Date: 2018/3/9
 * Time: 下午8:42
 */
namespace App\Http\Traits;

use App\Http\HttpStatusCode;

trait ApiHelper
{
	public function success($data = null, $statusCode = HttpStatusCode::HTTP_OK)
	{
		$response = [
			'code' => 1000,
			'message' => 'success'
		];
		$response = is_null($data) ? $response : array_merge($response, ['data' => $data]);

		return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
	}

	public function created($data = null, $statusCode = HttpStatusCode::HTTP_CREATED)
	{
		return $this->success($data, $statusCode);
	}

	public function error($errorCode, $statusCode = HttpStatusCode::HTTP_OK, $errorMessage = '')
	{
		if ($errorMessage === '') {
			$errorMessage = $this->getErrorMessage($errorCode);
		}
		$response = [
			'code' => $errorCode,
			'message' => $errorMessage
		];

		return response()->json($response, $statusCode, [], JSON_UNESCAPED_UNICODE);
	}

	private function getErrorMessage($errorCode)
	{
		return config('errormessages.' . $errorCode) ?? '';
	}
}