<?php

namespace App\Models;
use Eloquent;

class CustomerCode extends Eloquent
{
	public $table = "customercode";
	public $primaryKey = 'id';
	public $timestamps = false;

	public function Customer()
	{
		return $this->belongsTo('App\Models\Customer','idcustomer','id');
	}
}
