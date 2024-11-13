<?php

namespace App\Repositories;

use App\Models\Checkout;


class CheckoutRepository
{
    protected $checkout;

    public function __construct(Checkout $checkout)
    {
        $this->checkout = $checkout;
    }

    public function getAll()
    {
        $checkout = $this->checkout->all();

        return $checkout;
    }

    public function store(array $requestData)
    {
        $checkout = $this->checkout->create($requestData);

        return $checkout;
    }

    public function findCheckoutById(int $id)
    {
        $checkout = $this->checkout->where('id_checkout', $id)->first();

        return $checkout;
    }

    public function findCheckoutByDateMoved(string $date)
    {
        $checkout = $this->checkout->where('date_moved', $date)->all();

        return $checkout;
    }
}