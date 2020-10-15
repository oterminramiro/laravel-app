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

	public function Organization()
	{
		return $this->belongsTo('App\Models\Organization','idorganization','id');
	}

	public function Location()
	{
		return $this->belongsTo('App\Models\Location','idlocation','id');
	}
}
