<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    protected $fillable = [
        'id_product',
        'id_stock',
        'quantity',
        'date_moved',
        'type_moved'
    ];
}
