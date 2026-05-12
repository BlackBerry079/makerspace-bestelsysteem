<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class FilamentCategory extends Model
{
	protected $table = 'filament_categories';

	public function filaments()
	{
		return $this->hasMany(Filament::class); // functie om alle filaments met de id van de categorie op te ropen
	}
}