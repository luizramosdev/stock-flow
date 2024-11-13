<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'description',
        'category',
        'value'
    ];

    /**
     * Relacionamento com Stock: um Produto pode ter várias movimentações de estoque.
     */
    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id_product');
    }
}
