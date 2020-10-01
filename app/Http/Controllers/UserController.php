<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
	public function index()
	{
		$user = User::where('idrole','!=',1)->get();

		return View::make('cruds.user.index')->with('user', $user);
	}

	public function create()
	{
		return View::make('cruds.user.create');
	}

	public function store(Request $request)
	{
		$rules = array(
			'name' => 'required',
			'email' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/user/create')->withErrors($validator);
		}
		else
		{
			$user = new User;
			$user->idrole = 2;
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->guid = Str::uuid()->toString();
			$user->password = Hash::make($user->guid);
			$user->created_at = date('Y-m-d',time());
			$user->updated_at = date('Y-m-d',time());
			$user->save();

			Session::flash('message', 'Successfully created user!');
			return Redirect::to('manage/user');
		}
	}

	public function show($id)
	{
		$user = User::find($id);

		return View::make('cruds.user.show')->with('user', $user);
	}

	public function edit($id)
	{
		$user = User::find($id);

		return View::make('cruds.user.edit')->with('user', $user);
	}

	public function update(Request $request, $id)
	{
		$rules = array(
			'name' => 'required',
		);
		$validator = Validator::make($request->all(), $rules);

		if ($validator->fails())
		{
			return Redirect::to('manage/user/' . $id . '/edit')->withErrors($validator);
		}
		else
		{
			$user = User::find($id);
			$user->name = $request->input('name');
			$user->save();

			Session::flash('message', 'Successfully updated user!');
			return Redirect::to('manage/user');
		}
	}

	public function destroy($id)
	{
		$user = User::find($id);
		$user->delete();

		Session::flash('message', 'Successfully deleted the user!');
		return Redirect::to('manage/user');
	}
}
