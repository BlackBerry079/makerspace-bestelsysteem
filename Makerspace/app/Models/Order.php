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
        'status',
        'user_id',
        'printer_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function printer()
    {
        return $this->belongsTo(Printer::class, 'printer_id', 'id');
    }

    public function filaments()
    {
        return $this->hasMany(OrderFilaments::class, 'order_id', 'id');
    }

}
