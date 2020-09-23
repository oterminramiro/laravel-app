<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class OrganizationController extends Controller
{
	public function index()
	{
		$organization = Organization::all();

		return View::make('organization.index')->with('organization', $organization);
	}

	public function create()
	{
		return View::make('organization.create');
	}

	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		// process the login
		if ($validator->fails())
		{
			return Redirect::to('organization/create')->withErrors($validator);
		}
		else
		{
			// store
			$organization = new Organization;
			$organization->name = $request->input('name');
			$organization->guid = Str::uuid()->toString();
			$organization->save();

			// redirect
			Session::flash('message', 'Successfully created organization!');
			return Redirect::to('organization');
		}
	}

	public function show($id)
	{
		$organization = Organization::find($id);

		return View::make('organization.show')->with('organization', $organization);
	}

	public function edit($id)
	{
		$organization = Organization::find($id);

		return View::make('organization.edit')->with('organization', $organization);
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		// process the login
		if ($validator->fails())
		{
			return Redirect::to('organization/' . $id . '/edit')->withErrors($validator);
		}
		else
		{
			// store
			$shark = Organization::find($id);
			$shark->name = $request->input('name');
			$shark->save();

			// redirect
			Session::flash('message', 'Successfully updated organization!');
			return Redirect::to('organization');
		}
	}

	public function destroy($id)
	{
		$shark = Organization::find($id);
		$shark->delete();

		// redirect
		Session::flash('message', 'Successfully deleted the organization!');
		return Redirect::to('organization');
	}
}
