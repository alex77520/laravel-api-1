<?php

namespace App\Http\Controllers\Apis;

use Dingo\Api\Routing\Helpers;
use App\Http\Controllers\Controller;

class ApiController extends Controller
{
	use Helpers;

	protected function success($data = null, $statusCode = 200)
	{
		$response['status_code'] = $statusCode;
		$response['message'] = 'success';
		if (!empty($data)) {
			$response['data'] = $data;
		}

		return $this->response->array($response)->setStatusCode($statusCode);
	}
}
