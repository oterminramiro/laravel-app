<?php

namespace App\Models;
use Eloquent;

class Customer extends Eloquent
{
	public $table = "customer";
	public $primaryKey = 'id';
}
