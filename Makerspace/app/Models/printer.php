<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Printer extends Model
{
    protected $table = 'printer';

    protected $fillable = [
        'name',
        'brand',
        'description'
    ];
}