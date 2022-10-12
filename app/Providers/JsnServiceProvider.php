<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class JsnServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = false;

    /**
     * Package boot method
     */
    public function boot()
    {

    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerBindings();
    }


    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
//        $this->app->bind(
//            \App\Repositories\Backend\Jsn\Parameter\JsnParameterRepositoryContract::class,
//            \App\Repositories\Backend\Jsn\Parameter\EloquentJsnParameterRepository::class
//        );

        $this->app->bind(
            \App\Repositories\Backend\Jsn\JsnRepositoryContract::class,
            \App\Repositories\Backend\Jsn\EloquentJsnRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Jsn\JsnToken\JsnTokenRepositoryContract::class,
            \App\Repositories\Backend\Jsn\JsnToken\EloquentJsnTokenRepository::class
        );
    }

}