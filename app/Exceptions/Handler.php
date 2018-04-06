<?php

namespace App\Exceptions;

use Exception;
use App\Http\HttpStatusCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;

class Handler extends ExceptionHandler
{
	/**
	 * A list of the exception types that are not reported.
	 *
	 * @var array
	 */
	protected $dontReport = [
		//
	];

	/**
	 * A list of the inputs that are never flashed for validation exceptions.
	 *
	 * @var array
	 */
	protected $dontFlash = [
		'password',
		'password_confirmation',
	];

	/**
	 * Report or log an exception.
	 *
	 * This is a great spot to send exceptions to Sentry, Bugsnag, etc.
	 *
	 * @param  \Exception $exception
	 * @return void
	 */
	public function report(Exception $exception)
	{
		parent::report($exception);
	}

	/**
	 * Render an exception into an HTTP response.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  \Exception $exception
	 * @return \Illuminate\Http\Response
	 */
	public function render($request, Exception $exception)
	{
		if (!$request->isJson()) {
			return parent::render($request, $exception);
		}

		$code = 1000;
		$message = 'success';
		$statusCode = HttpStatusCode::HTTP_OK;

		if ($exception instanceof ValidationException) {
			$code = 1001;
			$message = $exception->validator->errors()->first();
			$statusCode = HttpStatusCode::HTTP_BAD_REQUEST;
		} else if ($exception instanceof NotFoundHttpException) {
			$code = 1004;
			$message = config('errormessages.' . $code);
			$statusCode = HttpStatusCode::HTTP_NOT_FOUND;
		} else if ($exception instanceof TooManyRequestsHttpException) {
			$code = 1006;
			$message = config('errormessages.' . $code);
			$statusCode = HttpStatusCode::HTTP_TOO_MANY_REQUEST;
		} else if ($exception instanceof AuthenticationException) {
			$code = 2003;
			$message = config('errormessages.' . $code);
			$statusCode = HttpStatusCode::HTTP_UNAUTHORIZED;
		} else {
			$code = 1002;
			$message = $exception->getMessage();
			$statusCode = HttpStatusCode::HTTP_INTERNAL_SERVER_ERROR;
		}

		return response()->json(['code' => $code, 'message' => $message], $statusCode, [], JSON_UNESCAPED_UNICODE);
	}
}
