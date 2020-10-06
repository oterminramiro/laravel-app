<?php // Code within app\Helpers\Helper.php

namespace App\Helpers;
use Auth;

class Helper
{
	public static function shout(string $string)
	{
		return strtoupper($string);
	}

	public static function checkRole($array)
	{
		$user = Auth::user();
		if (!in_array($user->Role->key, $array))
		{
			return false;
		}
		else
		{
			return true;
		}
	}
}
