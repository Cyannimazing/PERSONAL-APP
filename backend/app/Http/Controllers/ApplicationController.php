<?php

namespace App\Http\Controllers;

use App\Http\Requests\PurchaseAppRequest;
use App\Interfaces\Services\ApplicationServiceInterface;
use App\Interfaces\Services\UserApplicationServiceInterface;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct(
        private ApplicationServiceInterface $applicationService,
        private UserApplicationServiceInterface $userApplicationService
    ) {
    }

    public function available(Request $request): JsonResponse
    {
        $apps = $this->applicationService->listAvailableForUser($request->user()->id);
        return response()->json($apps);
    }

    public function myApps(Request $request): JsonResponse
    {
        $apps = $this->userApplicationService->listUserApps($request->user()->id);
        return response()->json($apps);
    }

    public function purchase(PurchaseAppRequest $request): JsonResponse
    {
        $appId = $request->validated('application_id');
        $grant = $this->userApplicationService->grant(
            $request->user()->id,
            $appId,
            'purchase'
        );

        return response()->json([
            'message' => 'Purchase successful',
            'grant' => $grant,
        ], 201);
    }
}
