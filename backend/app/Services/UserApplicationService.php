<?php

namespace App\Services;

use App\Interfaces\Services\UserApplicationServiceInterface;
use App\Interfaces\Repositories\UserApplicationRepositoryInterface;
use App\Interfaces\Repositories\ApplicationRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UserApplicationService implements UserApplicationServiceInterface
{
    public function __construct(
        private UserApplicationRepositoryInterface $userApplications,
        private ApplicationRepositoryInterface $applications
    ) {
    }

    public function grant(int $userId, int $applicationId, string $grantType, ?string $expiresAt = null)
    {
        $app = $this->applications->findById($applicationId);
        if (!$app) {
            throw new ModelNotFoundException('Application not found.');
        }

        return $this->userApplications->grant($userId, $applicationId, $grantType, $expiresAt);
    }

    public function revoke(int $userId, int $applicationId): bool
    {
        return $this->userApplications->revoke($userId, $applicationId);
    }

    public function listUserApps(int $userId)
    {
        return $this->userApplications->getUserApps($userId);
    }
}
