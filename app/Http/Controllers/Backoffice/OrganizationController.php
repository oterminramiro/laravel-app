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

		return View::make('cruds.organization.index')->with('organization', $organization);
	}

	public function create()
	{
		return View::make('cruds.organization.create');
	}

	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/organizations/create')->withErrors($validator);
		}
		else
		{
			$organization = new Organization;
			$organization->name = $request->input('name');
			$organization->guid = Str::uuid()->toString();
			$organization->save();

			Session::flash('message', 'Successfully created organization!');
			return Redirect::to('manage/organizations');
		}
	}

	public function show($id)
	{
		$organization = Organization::find($id);

		return View::make('cruds.organization.show')->with('organization', $organization);
	}

	public function edit($id)
	{
		$organization = Organization::find($id);

		return View::make('cruds.organization.edit')->with('organization', $organization);
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/organizations/' . $id . '/edit')->withErrors($validator);
		}
		else
		{
			$organization = Organization::find($id);
			$organization->name = $request->input('name');
			$organization->save();

			Session::flash('message', 'Successfully updated organization!');
			return Redirect::to('manage/organizations');
		}
	}

	public function destroy($id)
	{
		$organization = Organization::find($id);
		$organization->delete();

		Session::flash('message', 'Successfully deleted the organization!');
		return Redirect::to('manage/organizations');
	}
}
