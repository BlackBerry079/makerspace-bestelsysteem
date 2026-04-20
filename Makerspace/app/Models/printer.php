<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Printer extends Model
{
    protected $table = 'printer';

    public function order()
    {
        return $this->hasOne(Order::class);
    }
}