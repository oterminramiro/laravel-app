<?php

namespace App\Models;
use Eloquent;

class BookingLayout extends Eloquent
{
	public $table = "bookinglayout";
	public $primaryKey = 'id';
	public $timestamps = true;

	public function Booking()
	{
		return $this->belongsTo('App\Models\Booking','idbooking','id');
	}

	public function Layout()
	{
		return $this->hasMany('App\Models\Layout', 'idlayout', 'id');
	}
}
