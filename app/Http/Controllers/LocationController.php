<?php

namespace App\Http\Controllers;

use App\Models\Location;
use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LocationController extends Controller
{
	public function index()
	{
		$location = Location::all();

		return View::make('cruds.location.index')->with('location', $location);
	}

	public function create()
	{
		return View::make('cruds.location.create');
	}

	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required',
			'idorganization' => 'required',
			'cols' => 'required',
			'rows' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/location/create')->withErrors($validator);
		}
		else
		{
			$location = new Location;
			$location->name = $request->input('name');
			$location->idorganization = $request->input('idorganization');
			$location->cols = $request->input('cols');
			$location->rows = $request->input('rows');
			$location->guid = Str::uuid()->toString();
			$location->save();

			for ($r=1; $r <= $location->rows; $r++) {
				for ($c=1; $c <= $location->cols; $c++) {
					$layout = new Layout;
					$layout->idorganization = $location->idorganization;
					$layout->idlocation = $location->id;
					$layout->guid = Str::uuid()->toString();
					$layout->name = 'Col '.$c.' Row '.$r;
					$layout->col = $c;
					$layout->row = $r;
					$layout->available = 0;
					$layout->save();
				}
			}

			Session::flash('message', 'Successfully created location!');
			return Redirect::to('manage/location');
		}
	}

	public function show($id)
	{
		$location = Location::find($id);

		return View::make('cruds.location.show')->with('location', $location);
	}

	public function edit($id)
	{
		$location = Location::find($id);

		return View::make('cruds.location.edit')->with('location', $location);
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/location/' . $id . '/edit')->withErrors($validator);
		}
		else
		{
			$location = Location::find($id);
			$location->name = $request->input('name');
			$location->save();

			Session::flash('message', 'Successfully updated location!');
			return Redirect::to('manage/location');
		}
	}

	public function destroy($id)
	{
		$location = Location::find($id);
		$location->delete();

		Session::flash('message', 'Successfully deleted the location!');
		return Redirect::to('manage/location');
	}
}
