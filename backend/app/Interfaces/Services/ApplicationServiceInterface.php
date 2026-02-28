<?php

namespace App\Interfaces\Services;

interface ApplicationServiceInterface
{
    public function listAll();
    public function listAvailableForUser(int $userId);
}
