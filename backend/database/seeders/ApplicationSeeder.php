<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Application;

class ApplicationSeeder extends Seeder
{
    public function run(): void
    {
        Application::updateOrCreate([
            'slug' => 'hello-world'
        ], [
            'name' => 'Hello World',
            'description' => 'Sample Hello World app for rental demo.',
            'icon' => 'sparkles',
            'price' => 0.00,
        ]);

        Application::updateOrCreate([
            'slug' => 'invoice-lite'
        ], [
            'name' => 'Invoice Lite',
            'description' => 'Simple invoicing tool for freelancers.',
            'icon' => 'receipt',
            'price' => 19.00,
        ]);

        Application::updateOrCreate([
            'slug' => 'team-chat'
        ], [
            'name' => 'Team Chat',
            'description' => 'Lightweight internal messaging.',
            'icon' => 'message-circle',
            'price' => 29.00,
        ]);

        Application::updateOrCreate([
            'slug' => 'task-board'
        ], [
            'name' => 'Task Board',
            'description' => 'Kanban board for simple team workflows.',
            'icon' => 'layout',
            'price' => 9.00,
        ]);

        Application::updateOrCreate([
            'slug' => 'meeting-notes'
        ], [
            'name' => 'Meeting Notes',
            'description' => 'Capture agendas, notes, and action items.',
            'icon' => 'file-text',
            'price' => 12.00,
        ]);

        Application::updateOrCreate([
            'slug' => 'link-vault'
        ], [
            'name' => 'Link Vault',
            'description' => 'Save and share important links with your team.',
            'icon' => 'link',
            'price' => 5.00,
        ]);
    }
}
