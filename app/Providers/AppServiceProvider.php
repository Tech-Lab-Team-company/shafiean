<?php

namespace App\Providers;

use App\Models\Organization\Relation\Relation;
use Illuminate\Support\ServiceProvider;
use App\Observers\OrganizationIdObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/Helper.php');
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {}
}
