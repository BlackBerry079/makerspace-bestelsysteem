<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderFilaments extends Model
{
	protected $table = 'order_filaments';

	protected $fillable = [
		'order_id',
		'filament_id',
		'quantity',
	];

	public function order()
	{
		return $this->belongsTo(Order::class, 'order_id', 'id');
	}

	public function filament()
	{
		return $this->hasOne(Filament::class, 'filament_id', 'id');
	}

}