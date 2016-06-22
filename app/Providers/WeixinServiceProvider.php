<?php

namespace App\Providers;

use App\Services\Weixin\Weixin;
use Illuminate\Support\ServiceProvider;

/**
 * Class WeixinServiceProvider
 * @package App\Providers
 */
class WeixinServiceProvider extends ServiceProvider
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
        //$this->registerBladeExtensions();
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerWeixin();
        $this->registerFacade();
        //$this->registerBindings();
    }

    /**
     * Register the application bindings.
     *
     * @return void
     */
    private function registerWeixin()
    {
        $this->app->singleton('weixin', function ($app) {
            return new Weixin($app);
        });
    }

    /**
     * Register the vault facade without the user having to add it to the app.php file.
     *
     * @return void
     */
    public function registerFacade()
    {
        $this->app->booting(function () {
            $loader = \Illuminate\Foundation\AliasLoader::getInstance();
            $loader->alias('Weixin', \App\Services\Weixin\Facades\Weixin::class);
        });
    }

    /**
     * Register service provider bindings
     */
    public function registerBindings()
    {
        //
    }

    /**
     * Register the blade extender to use new blade sections
     */
    protected function registerBladeExtensions()
    {
       //
    }
}