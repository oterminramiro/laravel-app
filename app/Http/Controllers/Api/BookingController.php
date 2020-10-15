<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\BookingLayout;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{

	public function create(Request $request)
	{
		try
		{
			$phone = $request->input('phone');

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
