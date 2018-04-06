<?php

namespace App\Http\Controllers\Api;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
	public function me(Request $request)
	{
		return $this->success(Auth::guard('api')->user());
    }
}
