<?php

namespace App\Providers;

use App\Interfaces\TypeDocumentInterfaces;
use App\Repositories\TypeDocumentRepositories;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TypeDocumentInterfaces::class, TypeDocumentRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
