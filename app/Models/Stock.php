<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = [
        'id_product',
        'quantity',
        'type_moved'
    ];

    /**
     * Relacionamento com Product: cada movimentação de estoque pertence a um produto.
     */
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
}
