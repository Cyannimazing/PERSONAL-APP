<?php

namespace App\Interfaces\Services;

interface UserApplicationServiceInterface
{
    public function grant(int $userId, int $applicationId, string $grantType, ?string $expiresAt = null);
    public function revoke(int $userId, int $applicationId);
    public function listUserApps(int $userId);
}
