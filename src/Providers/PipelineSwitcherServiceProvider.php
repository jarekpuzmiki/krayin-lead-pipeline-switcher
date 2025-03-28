<?php

namespace Puzmiki\LeadPipelineSwitcher\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;

class PipelineSwitcherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Log::info('✅ PipelineSwitcherServiceProvider boot() started');

        $this->loadRoutesFrom(__DIR__.'/../Routes/admin-routes.php');
        Log::info('✅ Loaded routes from admin-routes.php');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'lead_pipeline_switcher');
        Log::info('✅ Loaded translations from Resources/lang');

        $this->publishes([
            __DIR__.'/../Resources/lang' => resource_path('lang/vendor/lead_pipeline_switcher'),
        ], 'lead-pipeline-switcher-lang');

        view()->composer('admin::leads.view', function ($view) {
            Log::info('🎯 View composer triggered for admin::leads.view');
            $view->with('leadPipelineSwitcher', true);
        });

        Log::info('✅ PipelineSwitcherServiceProvider boot() completed');
    }

    public function register()
    {
        //
    }
}
