<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nieuwsbrief extends Model
{
	use HasFactory;

	protected $table = 'nieuwsbrief';

	public function nieuwsbriefattachments()
	{
		return $this->hasMany(NieuwsbriefAttachment::class);
	}
}