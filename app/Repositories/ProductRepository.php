<?php

namespace App\Repositories;

use App\Models\Product;


class ProductRepository
{
    protected $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    public function getAll()
    {
        $product = $this->product->all();

        return $product;
    }

    public function store(array $requestData)
    {
        $product = $this->product->create($requestData);

        return $product;
    }

    public function findProductById(int $id)
    {
        $product = $this->product->where('id_product', $id)->first();

        return $product;
    }
}