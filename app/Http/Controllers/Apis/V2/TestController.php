<?php

namespace App\Http\Controllers\Apis\V2;

use App\Http\Controllers\Apis\ApiController;

class TestController extends ApiController
{
	public function test()
	{
		return 'v2';
    }
}
