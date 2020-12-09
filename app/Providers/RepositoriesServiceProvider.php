<?php

namespace App\Providers;

use App\Repositories\ApplicationRepository;
use App\Repositories\ApplicationRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(ApplicationRepositoryInterface::class, ApplicationRepository::class);
    }
}
