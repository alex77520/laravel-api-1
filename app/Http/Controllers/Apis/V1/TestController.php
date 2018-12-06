<?php

namespace App\Http\Controllers\Apis\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Apis\ApiController;

class TestController extends ApiController
{
	public function test(Request $request)
	{
		return $this->response->errorForbidden(['hello' => 'world']);
    }

	public function test2()
	{
		return 'ok';
    }
}
