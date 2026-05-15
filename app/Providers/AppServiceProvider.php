<?php

namespace App\Providers;

use App\Services\SiteSettingsService;
use App\View\Composers\AdminLayoutComposer;
use App\View\Composers\PublicLayoutComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SiteSettingsService::class, function () {
            return new SiteSettingsService;
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layouts.public', PublicLayoutComposer::class);
        View::composer('public.*', PublicLayoutComposer::class);
        View::composer('layouts.admin', AdminLayoutComposer::class);

        \Illuminate\Pagination\Paginator::useBootstrapFive();
    }
}
