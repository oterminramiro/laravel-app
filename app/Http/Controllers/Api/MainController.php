<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Location;
use App\Models\Layout;
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
			$layout = Layout::where('idlocation',$location->id)->get(['name','col','row','available','guid'])->groupBy('row');
			return response()->json([
				'success' => 'true',
				'data' => $layout,
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
