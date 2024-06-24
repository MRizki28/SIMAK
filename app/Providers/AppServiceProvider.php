<?php

namespace App\Providers;

use App\Interfaces\ArsipInterfaces;
use App\Interfaces\AuthInterfaces;
use App\Interfaces\PositionInterfaces;
use App\Interfaces\TypeDocumentInterfaces;
use App\Interfaces\YearInterfaces;
use App\Repositories\ArsipRepositories;
use App\Repositories\AuthRepositories;
use App\Repositories\PositionRepositories;
use App\Repositories\TypeDocumentRepositories;
use App\Repositories\YearRepositories;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TypeDocumentInterfaces::class, TypeDocumentRepositories::class);
        $this->app->bind(ArsipInterfaces::class, ArsipRepositories::class);
        $this->app->bind(AuthInterfaces::class, AuthRepositories::class);
        $this->app->bind(PositionInterfaces::class, PositionRepositories::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
