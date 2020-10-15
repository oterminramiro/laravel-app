<?php

namespace App\Models;
use Eloquent;

class Booking extends Eloquent
{
	public $table = "booking";
	public $primaryKey = 'id';
	public $timestamps = true;

	public function Customer()
	{
		return $this->belongsTo('App\Models\Customer','idcustomer','id');
	}
}
