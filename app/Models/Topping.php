<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
	protected $guarded = [];

	public function items()
	{
		return $this->hasMany(ToppingItem::class);
	}

}
