<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class ReportServiceProvider extends ServiceProvider
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
        $this->app->bind(
            \App\Repositories\Backend\Report\Group\ReportGroupRepositoryContract::class,
            \App\Repositories\Backend\Report\Group\EloquentReportGroupRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Report\Parameter\ReportParameterRepositoryContract::class,
            \App\Repositories\Backend\Report\Parameter\EloquentReportParameterRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Report\Snapshot\ReportSnapshotRepositoryContract::class,
            \App\Repositories\Backend\Report\Snapshot\EloquentReportSnapshotRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\User\Subscription\UserSubscriptionRepositoryContract::class,
            \App\Repositories\Backend\User\Subscription\EloquentUserSubscriptionRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Report\ReportRepositoryContract::class,
            \App\Repositories\Backend\Report\EloquentReportRepository::class
        );
    }

}