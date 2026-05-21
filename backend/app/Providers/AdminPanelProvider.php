<?php

namespace App\Providers;

use App\Filament\Resources\CategoryResource;
use App\Filament\Resources\OrderResource;
use App\Filament\Resources\ProductResource;
use App\Filament\Resources\PromotionResource;
use App\Filament\Resources\ReviewResource;
use App\Filament\Resources\UserResource;
use Filament\Panel;
use Filament\PanelProvider;

class AdminPanelProvider extends PanelProvider
{
    public function panel(Panel $panel): Panel
    {
        return $panel
            ->default()
            ->id('admin')
            ->path('filament')
            ->login()
            ->colors([
                'primary' => '#ef4444',
            ])
            ->resources([
                CategoryResource::class,
                ProductResource::class,
                OrderResource::class,
                UserResource::class,
                PromotionResource::class,
                ReviewResource::class,
            ])
            ->pages([
                \Filament\Pages\Dashboard::class,
            ])
            ->middleware([
                \Illuminate\Cookie\Middleware\EncryptCookies::class,
                \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
                \Illuminate\Session\Middleware\StartSession::class,
                \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            ])
            ->authMiddleware([
                \App\Http\Middleware\VerifyCsrfToken::class,
            ]);
    }
}
