<?php

namespace App\Interfaces\Repositories;

interface ApplicationRepositoryInterface
{
    public function all();
    public function findById(int $id);
    public function findBySlug(string $slug);
}
