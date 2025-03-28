<?php

namespace Puzmiki\LeadPipelineSwitcher\Providers;

use Illuminate\Support\ServiceProvider;

class PipelineSwitcherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/../Routes/admin-routes.php');
        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'lead_pipeline_switcher');
        $this->publishes([
            __DIR__.'/../Resources/lang' => resource_path('lang/vendor/lead_pipeline_switcher'),
        ]);

        view()->composer('admin::leads.view', function ($view) {
            $view->with('leadPipelineSwitcher', true);
        });
    }

    public function register()
    {
        //
    }
}