<?php

namespace App\Repositories;

use App\Models\User;


class UserRepository
{
    protected $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function getAll()
    {
        $user = $this->user->all();

        return $user;
    }

    public function store(array $requestData)
    {
        $user = $this->user->create($requestData);

        return $user;
    }

    public function findUserById(int $id)
    {
        $user = $this->user->where('id', $id)->first();

        return $user;
    }

    public function findUserByEmail(string $email)
    {
        $user = $this->user->where('email', $email)->first();

        return $user;
    }

}