<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NieuwsbriefAttachment extends Model
{

	protected $table = 'nieuwsbrief_attachment';

	public $timestamps = false;

	public function nieuwsbrief()
	{
		return $this->belongsTo(Nieuwsbrief::class, 'nieuwsbrief_id', 'id');
	}
}