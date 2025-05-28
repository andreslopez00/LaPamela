<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'productos',
        'total',
        'estado',
    ];

    // Si quieres que Laravel trate 'productos' como un array automáticamente:
    protected $casts = [
        'productos' => 'array',
    ];
}
