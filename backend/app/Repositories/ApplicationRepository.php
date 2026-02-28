<?php

namespace App\Repositories;

use App\Interfaces\Repositories\ApplicationRepositoryInterface;
use App\Models\Application;
use Illuminate\Support\Collection;

class ApplicationRepository implements ApplicationRepositoryInterface
{
    public function all(): Collection
    {
        return Application::orderBy('name')->get();
    }

    public function findById(int $id): ?Application
    {
        return Application::find($id);
    }

    public function findBySlug(string $slug): ?Application
    {
        return Application::where('slug', $slug)->first();
    }
}
