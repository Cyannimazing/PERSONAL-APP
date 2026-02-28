<?php

namespace App\Repositories;

use App\Interfaces\Repositories\UserApplicationRepositoryInterface;
use App\Models\UserApplication;
use App\Models\Application;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class UserApplicationRepository implements UserApplicationRepositoryInterface
{
    public function grant(int $userId, int $applicationId, string $grantType, ?string $expiresAt = null): UserApplication
    {
        return UserApplication::updateOrCreate(
            ['user_id' => $userId, 'application_id' => $applicationId],
            [
                'grant_type' => $grantType,
                'granted_at' => Carbon::now(),
                'expires_at' => $expiresAt,
            ]
        );
    }

    public function revoke(int $userId, int $applicationId): bool
    {
        return (bool) UserApplication::where('user_id', $userId)
            ->where('application_id', $applicationId)
            ->delete();
    }

    public function userHasApp(int $userId, int $applicationId): bool
    {
        return UserApplication::where('user_id', $userId)
            ->where('application_id', $applicationId)
            ->exists();
    }

    public function getUserApps(int $userId): Collection
    {
        return Application::whereHas('users', function ($query) use ($userId) {
            $query->where('users.id', $userId);
        })->get();
    }
}
