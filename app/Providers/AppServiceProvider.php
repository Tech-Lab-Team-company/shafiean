<?php

namespace App\Providers;

use App\Models\Organization\Relation\Relation;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Support\ServiceProvider;
use App\Observers\OrganizationIdObserver;
use App\Observers\TeacherObserver;
use App\Observers\UserObserver;
use App\Services\Global\Live100MSIntegrationService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        require_once app_path('Helpers/Helper.php');
        $this->app->singleton(Live100MSIntegrationService::class, function ($app) {
            return new Live100MSIntegrationService(env('MS_APP_KEY'), env('MS_APP_SECRET'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void {
        User::observe(UserObserver::class);
        Teacher::observe(TeacherObserver::class);
    }
}
