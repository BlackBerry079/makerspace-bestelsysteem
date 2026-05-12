<?php

Namespace App\Models;

use hasfactory;
use Illuminate\Database\Eloquent\Model;

class Filament extends Model
{
	protected $table = 'filament';

	protected $fillable = [
		'name',
		'description',
		'amount',
		'active',
		'category_id',
	];

	public function category()
	{
		return $this->belongsTo(FilamentCategory::class, 'category_id', 'id');
	}
}