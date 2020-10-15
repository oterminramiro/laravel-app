<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\Rest\Client;
use \Firebase\JWT\JWT;

class CustomerController extends Controller
{
	public function index(Request $request)
	{
		echo 'test';
	}

	public function create(Request $request)
	{
		try
		{

			$phone = $request->input('phone');
			if($phone == NULL)
			{
				return response()->json([
					'success' => 'false',
					'msg' => 'phone null',
				]);
			}
			$phone = '+549' . $phone;
			$customer = Customer::where('phone',$phone)->first();
			if($customer == NULL)
			{
				$customer = new Customer;
				$customer->phone = $phone;
				$customer->guid = Str::uuid()->toString();
				$customer->save();
			}

			$code = rand(0 , 9) . rand(0 , 9) . rand(0 , 9) . rand(0 , 9) . rand(0 , 9) . rand(0 , 9);
			$Twilio = new Client(getenv("TWILIO_SID"), getenv("TWILIO_TOKEN"));

			$options = array(
				'from' => getenv("TWILIO_FROM"),
				'body' => 'Tu codigo es: ' . $code,
			);

			$result = $Twilio->messages->create( $customer->phone, $options);
			if($result->sid)
			{
				$CustomerCode = new CustomerCode;
				$CustomerCode->idcustomer = $customer->id;
				$CustomerCode->code = $code;
				$CustomerCode->save();
			}

			return response()->json([
				'success' => 'true',
				'id' => $customer->guid,
				'msg' => $result->sid,
			]);
		}
		catch (Exception $e)
		{
			return response()->json([
				'success' => 'false',
				'msg' => $e->getMessage(),
			]);
		}
	}

	public function login(Request $request)
	{
		try
		{
			$customer = Customer::where('guid',$request->input('id'))->first();
			if($customer)
			{
				$CustomerCode = CustomerCode::where('idcustomer',$customer->id)->orderBy('id','desc')->first();
				if($CustomerCode)
				{
					if($CustomerCode->code == $request->input('code'))
					{
						$t = time();
						$payload = array(
							"iss" => '',
							"iat" => $t,
							"nbf" => $t,
							"exp" => $t + 31536000,
							"aud" => "api_user",
							"data" => array(
								"guid" => $customer->guid,
								"phone" => $customer->phone
							)
						);
						$jwt = JWT::encode($payload, getenv("JWT_SECRET"));

						return response()->json([
							'success' => 'true',
							'msg' => $jwt,
						]);
					}
					else
					{
						return response()->json([
							'success' => 'false',
							'msg' => 'wrong code',
						]);
					}
				}
				else
				{
					return response()->json([
						'success' => 'false',
						'msg' => 'code not found',
					]);
				}
			}
			else
			{
				return response()->json([
					'success' => 'false',
					'msg' => 'customer not found',
				]);
			}
		}
		catch (Exception $e)
		{
			return response()->json([
				'success' => 'false',
				'msg' => $e->getMessage(),
			]);
		}
	}

	public function edit(Request $request)
	{
		try
		{
			$jwt = $request->header('x-auth-token');

			$decodedToken = JWT::decode($jwt, getenv("JWT_SECRET"), array(getenv("JWT_ENC_TYPE")));
			$customer = Customer::where('guid',$decodedToken->data->guid)->first();

			return response()->json([
				'success' => 'true',
				'msg' => $customer,
			]);
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
