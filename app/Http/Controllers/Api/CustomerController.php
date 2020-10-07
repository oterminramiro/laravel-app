<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
	public function index(Request $request)
	{
		echo 'test';
	}
	public function create(Request $request)
	{
		$phone = $request->input('phone');


		$customer = Customer::where('phone',$phone)->first();
		if($customer == NULL)
		{
			$customer = new Customer;
			$customer->phone = $phone;
			$customer->guid = Str::uuid()->toString();
			$customer->save();
		}

		return response()->json([
			'success' => 'true',
			'id' => $customer->guid,
			'phone' => $customer->phone,
		]);
	}
}
