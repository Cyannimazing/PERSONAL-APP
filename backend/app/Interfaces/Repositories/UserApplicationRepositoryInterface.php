<?php

namespace App\Interfaces\Repositories;

interface UserApplicationRepositoryInterface
{
    public function grant(int $userId, int $applicationId, string $grantType, ?string $expiresAt = null);
    public function revoke(int $userId, int $applicationId);
    public function userHasApp(int $userId, int $applicationId);
    public function getUserApps(int $userId);
}
