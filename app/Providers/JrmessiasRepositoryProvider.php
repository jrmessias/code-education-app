<?php

namespace JrMessias\Providers;

use Illuminate\Support\ServiceProvider;

class JrMessiasRepositoryProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(
            \JrMessias\Repositories\ClientRepository::class,
            \JrMessias\Repositories\ClientRepositoryEloquent::class);

        $this->app->bind(
            \JrMessias\Repositories\ProjectRepository::class,
            \JrMessias\Repositories\ProjectRepositoryEloquent::class);
    }
}
