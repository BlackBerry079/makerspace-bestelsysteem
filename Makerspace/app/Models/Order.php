<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'title',
        'description',
        'file_path',
        'user_id',
        'filament_id',
        'printer_id',
    ];
}
