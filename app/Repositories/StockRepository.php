<?php

namespace App\Repositories;

use App\Models\Stock;


class StockRepository
{
    protected $stock;

    public function __construct(Stock $stock)
    {
        $this->stock = $stock;
    }

    public function getAll()
    {
        $stock = $this->stock->all();

        return $stock;
    }

    public function store(array $requestData)
    {
        $stock = $this->stock->create($requestData);

        return $stock;
    }

    public function findStockById(int $id)
    {
        $stock = $this->stock->where('id_stock', $id)->first();

        return $stock;
    }
}