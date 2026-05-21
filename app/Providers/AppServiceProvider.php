<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Kreait\Firebase\Factory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Register Firebase
        $this->app->singleton('firebase.auth', function () {
            $credentialsPath = config('firebase.credentials');

            if (empty($credentialsPath)) {
                throw new \Exception('Firebase credentials not configured. Set FIREBASE_CREDENTIALS in .env');
            }

            $factory = (new Factory)->withServiceAccount(base_path($credentialsPath));
            return $factory->createAuth();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Warm up MongoDB connection to avoid SRV resolution issues
        if (config('database.default') === 'mongodb') {
            try {
                DB::connection()->getCollection('__warmup');
            } catch (\Exception $e) {
                // Ignore warmup errors
            }
        }
    }
}
