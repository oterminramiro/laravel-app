<?php

namespace App\Models;
use Eloquent;

class Layout extends Eloquent
{
	public $table = "layout";
	public $primaryKey = 'id';

	public function Organization()
	{
		return $this->belongsTo('App\Models\Organization','idorganization','id');
	}

	public function Location()
	{
		return $this->belongsTo('App\Models\Location','idlocation','id');
	}
}
