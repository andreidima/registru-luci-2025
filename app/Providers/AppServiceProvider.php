<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Route;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

use Barryvdh\Snappy\ServiceProvider as SnappyServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // force-register the Snappy provider so its bindings are available
        $this->app->register(SnappyServiceProvider::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Route::resourceVerbs([
            'create' => 'adauga',
            'edit' => 'modifica'
        ]);
        Paginator::useBootstrap();
        Model::preventLazyLoading();
    }
}
