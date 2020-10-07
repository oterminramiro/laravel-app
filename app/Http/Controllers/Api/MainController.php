<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\Location;
use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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
			$layout = Layout::where('idlocation',$location->id)->get(['name','col','row','available','guid']);
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
}
