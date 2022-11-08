<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

/**
 * Class AccessServiceProvider
 * @package App\Providers
 */
class LogsServiceProvider extends ServiceProvider
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
            \App\Repositories\Backend\Report\ReportSendLogs\ReportSendLogsRepositoryContract::class,
            \App\Repositories\Backend\Report\ReportSendLogs\EloquentReportSendLogsRepository::class
        );

        $this->app->bind(
            \App\Repositories\Backend\Report\ReportReadLogs\ReportReadLogsRepositoryContract::class,
            \App\Repositories\Backend\Report\ReportReadLogs\EloquentReportReadLogsRepository::class
        );
    }

}