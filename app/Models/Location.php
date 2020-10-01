<?php

namespace App\Models;
use Eloquent;

class Location extends Eloquent
{
	public $table = "location";
	public $primaryKey = 'id';

	public function Organization()
	{
		return $this->belongsTo('App\Models\Organization','idorganization','id');
	}
}
