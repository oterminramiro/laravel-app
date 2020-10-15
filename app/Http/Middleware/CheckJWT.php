<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use \Firebase\JWT\JWT;
use App\Models\Customer;

class CheckJWT
{
	public function handle(Request $request, Closure $next)
	{
		try
		{
			$jwt = $request->header('x-auth-token');
			if($jwt == NULL OR $jwt == '')
			{
				throw new \Exception("Invalid token");
			}

			$decodedToken = JWT::decode($jwt, getenv("JWT_SECRET"), array(getenv("JWT_ENC_TYPE")));

			$customer = Customer::where('guid',$decodedToken->data->guid)->first();
			if($customer == NULL)
			{
				throw new \Exception("Invalid token");
			}
			else
			{
				return $next($request);
			}
		}
		catch (\Exception $e)
		{
			return response()->json([
				'success' => 'false',
				'msg' => $e->getMessage(),
			]);
		}


	}
}
