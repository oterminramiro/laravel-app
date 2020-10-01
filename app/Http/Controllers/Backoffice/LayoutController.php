<?php

namespace App\Http\Controllers;

use App\Models\Layout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class LayoutController extends Controller
{
	public function index()
	{
		$layout = Layout::all();

		return View::make('cruds.layout.index')->with('layout', $layout);
	}

	public function show($id)
	{
		$layout = Layout::find($id);

		return View::make('cruds.layout.show')->with('layout', $layout);
	}

	public function edit($id)
	{
		$layout = Layout::find($id);

		return View::make('cruds.layout.edit')->with('layout', $layout);
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
			'available' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/layout/' . $id . '/edit')->withErrors($validator);
		}
		else
		{
			$shark = Layout::find($id);
			$shark->name = $request->input('name');
			$shark->available = $request->input('available');
			$shark->save();

			Session::flash('message', 'Successfully updated layout!');
			return Redirect::to('manage/layout');
		}
	}
}
