<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AccountController extends Controller
{
	public function login_as($guid)
	{
		if(!Auth::user()->isImpersonated())
		{
			$other_user = User::where('guid',$guid)->first();
			if(!$other_user) abort(404);

			Auth::user()->impersonate($other_user);
		}

		return redirect('/');
	}

	public function logout()
	{
		if(Auth::user()->isImpersonated())
		{
			Auth::user()->leaveImpersonation();
		}
		else
		{
			Auth::logout();
		}

		return redirect('/');
	}
}
