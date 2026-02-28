<?php

namespace App\Interfaces\Services;

interface AuthServiceInterface
{
    public function register(array $data);
    public function login(string $email, string $password);
}
