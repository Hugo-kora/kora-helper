<?php

namespace App\Providers;

use App\Models\Category;
use App\Observers\CategoriesObserve;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();
        Category::observe(CategoriesObserve::class);
    }
}
