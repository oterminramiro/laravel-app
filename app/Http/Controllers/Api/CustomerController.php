<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\CustomerCode;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Twilio\Rest\Client;

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

			$customer = Customer::where('phone',$phone)->first();
			if($customer == NULL)
			{
				$customer = new Customer;
				$customer->phone = '+549' . $phone;
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
						return response()->json([
							'success' => 'true',
							'msg' => 'TOKEN',
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
}
