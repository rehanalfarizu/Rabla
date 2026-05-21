<?php

namespace App\Filament;

use Filament\Plugin;
use Filament\Resources\Resource;

class FilamentPlugin extends Plugin
{
    public function getId(): string
    {
        return 'rabla';
    }

    public function register(): void
    {
        // Register resources here
    }

    public function boot(): void
    {
        //
    }
}