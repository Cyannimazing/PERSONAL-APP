<?php

namespace App\Http\Controllers;

use App\Http\Requests\GrantAppRequest;
use App\Http\Requests\RevokeAppRequest;
use App\Interfaces\Services\ApplicationServiceInterface;
use App\Interfaces\Services\UserApplicationServiceInterface;
use App\Interfaces\Repositories\UserRepositoryInterface;
use Illuminate\Http\JsonResponse;

class AdminController extends Controller
{
    public function __construct(
        private UserRepositoryInterface $users,
        private ApplicationServiceInterface $applicationService,
        private UserApplicationServiceInterface $userApplicationService
    ) {
    }

    public function users(): JsonResponse
    {
        return response()->json($this->users->all());
    }

    public function apps(): JsonResponse
    {
        return response()->json($this->applicationService->listAll());
    }

    public function grant(GrantAppRequest $request): JsonResponse
    {
        $grant = $this->userApplicationService->grant(
            $request->validated('user_id'),
            $request->validated('application_id'),
            'admin_grant',
            $request->validated('expires_at')
        );

        return response()->json([
            'message' => 'Access granted',
            'grant' => $grant,
        ], 201);
    }

    public function revoke(RevokeAppRequest $request): JsonResponse
    {
        $revoked = $this->userApplicationService->revoke(
            $request->validated('user_id'),
            $request->validated('application_id')
        );

        return response()->json([
            'message' => $revoked ? 'Access revoked' : 'No access found',
        ]);
    }
}
