<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
	protected $guarded = [];

	public function toppings()
	{
		return $this->hasMany(Topping::class);
	}
}
