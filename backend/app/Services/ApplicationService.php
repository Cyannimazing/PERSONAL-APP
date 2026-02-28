<?php

namespace App\Services;

use App\Interfaces\Services\ApplicationServiceInterface;
use App\Interfaces\Repositories\ApplicationRepositoryInterface;
use App\Interfaces\Repositories\UserApplicationRepositoryInterface;

class ApplicationService implements ApplicationServiceInterface
{
    public function __construct(
        private ApplicationRepositoryInterface $applications,
        private UserApplicationRepositoryInterface $userApplications
    ) {
    }

    public function listAll()
    {
        return $this->applications->all();
    }

    public function listAvailableForUser(int $userId)
    {
        $all = $this->applications->all();
        $owned = $this->userApplications->getUserApps($userId)->pluck('id')->toArray();

        return $all->whereNotIn('id', $owned)->values();
    }
}
