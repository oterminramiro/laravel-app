<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Location;
use App\Models\Layout;
use App\Models\Booking;
use App\Models\BookingLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Carbon\CarbonInterval;

class MainController extends Controller
{
	public function get_organizations(Request $request)
	{
		$organization = Organization::get(['name','guid']);
		return response()->json([
			'success' => 'true',
			'data' => $organization,
		]);
	}

	public function get_locations(Request $request)
	{
		$organization = Organization::where('guid',$request->input('guid'))->first();
		if($organization)
		{
			$location = Location::where('idorganization',$organization->id)->get(['name','guid']);
			return response()->json([
				'success' => 'true',
				'data' => $location,
			]);
		}
		else
		{
			return response()->json([
				'success' => 'false',
				'data' => 'organization not found',
			]);
		}
	}

	public function get_layouts(Request $request)
	{
		$location = Location::where('guid',$request->input('guid'))->first();
		if($location)
		{
			$date = $request->input('date');
			$id_keys = array();

			$bookings = Booking::where('IdLocation',$location->id)->where('date',$date)->get();
			foreach($bookings as $booking)
			{
				$bookingLayout = BookingLayout::where('IdBooking',$booking->id)->get();
				foreach($bookingLayout as $item)
				{
					$id_keys[] = $item->idlayout;
				}
			}

			$layout = Layout::where('idlocation',$location->id)
			->get(['id','name','col','row','available','guid'])
			->groupBy('row');

			$response = array();
			foreach ($layout as $key => $row) {

				foreach($row as $col)
				{
					if(in_array( $col->id , $id_keys) )
					{
						$response[$key][] = [
							'name' => $col->name,
							'col' => $col->col,
							'row' => $col->row,
							'available' => 0,
							'guid' => $col->guid,
						];
					}
					else
					{
						$response[$key][] = [
							'name' => $col->name,
							'col' => $col->col,
							'row' => $col->row,
							'available' => $col->available,
							'guid' => $col->guid,
						];
					}
				}

			}

			return response()->json([
				'success' => 'true',
				'data' => $response,
			]);
		}
		else
		{
			return response()->json([
				'success' => 'false',
				'data' => 'location not found',
			]);
		}
	}

	public function get_time(Request $request)
	{
		$location = Location::where('guid',$request->input('guid'))->first();
		if($location)
		{
			$start = $location->since;
			$end = $location->until;
			$timeStep = '60';
			$intervals = CarbonInterval::minutes($timeStep)->toPeriod($start, $end);

			$response = array();
			foreach ($intervals as $date) {
				$response[] = $date->format('H:i');
			}

			return response()->json([
				'success' => 'true',
				'data' => $response,
			]);
		}
		else
		{
			return response()->json([
				'success' => 'false',
				'data' => 'location not found',
			]);
		}
	}
}
