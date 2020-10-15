<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Location;
use App\Models\Layout;
use App\Models\Booking;
use App\Models\BookingLayout;
use App\Models\Customer;
use App\Mail\ConfirmEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{

	public function create(Request $request)
	{
		try
		{
			$rules = array(
				'customerid' => 'required|uuid',
				'locationid' => 'required|uuid',
				'people' => 'required|integer',
				'layout' => 'required|array',
			);
			$validator = Validator::make($request->all(), $rules);
			if ($validator->fails())
			{
				return response()->json([
					'success' => 'false',
					'msg' => $validator->errors(),
				]);
			}

			$Customer = Customer::where('guid',$request->input('customerid'))->first();
			if($Customer == NULL)
			{
				throw new \Exception("Customer not found");
			}

			$Location = Location::where('guid',$request->input('locationid'))->first();
			if($Location == NULL)
			{
				throw new \Exception("Location not found");
			}

			DB::beginTransaction();

			$Booking = new Booking;
			$Booking->idcustomer = $Customer->id;
			$Booking->idorganization = $Location->idorganization;
			$Booking->idlocation = $Location->id;
			$Booking->people = $request->input('people');
			$Booking->save();

			$layouts = $request->input('layout');
			foreach($layouts as $layout)
			{
				$Layout = Layout::where('guid',$layout['layoutid'])->first();
				if($Layout == NULL)
				{
					throw new \Exception("Layout not found");
				}

				$BookingLayout = new BookingLayout;
				$BookingLayout->idbooking = $Booking->id;
				$BookingLayout->idlayout = $Layout->id;
				$BookingLayout->save();
			}

			DB::commit();

			$data = [
				'organization' => $Location->Organization->name,
				'location' => $Location->name,
			];

			Mail::to('ramiro@cubiq.digital')->send(new ConfirmEmail($data));

			return response()->json([
				'success' => 'true',
				'msg' => 'true',
			]);
		}
		catch (\Exception $e)
		{
			DB::rollback();

			return response()->json([
				'success' => 'false',
				'msg' => $e->getMessage(),
			]);
		}
	}

}
