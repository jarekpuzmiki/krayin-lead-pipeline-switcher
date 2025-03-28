<?php

namespace Puzmiki\LeadPipelineSwitcher\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Log;
use Webkul\Lead\Repositories\PipelineRepository;
use Webkul\Lead\Repositories\StageRepository;

class PipelineSwitcherServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Log::info('✅ PipelineSwitcherServiceProvider boot() started');

        $this->loadRoutesFrom(__DIR__.'/../Routes/admin-routes.php');
        Log::info('✅ Loaded routes from admin-routes.php');

        $this->loadTranslationsFrom(__DIR__.'/../Resources/lang', 'lead_pipeline_switcher');
        Log::info('✅ Loaded translations from Resources/lang');

        $this->loadViewsFrom(__DIR__.'/../Resources/views', 'lead_pipeline_switcher');
        Log::info('✅ Loaded views from Resources/views');

        $this->publishes([
            __DIR__.'/../Resources/lang' => resource_path('lang/vendor/lead_pipeline_switcher'),
        ], 'lead-pipeline-switcher-lang');

        view()->composer('admin::leads.view', function ($view) {
            Log::info('🎯 View composer triggered for admin::leads.view');

            $leadPipelineRepository = app(PipelineRepository::class);
            $stageRepository = app(StageRepository::class);

            $view->with('leadPipelineSwitcher', true);
            $view->with('pipelines', $leadPipelineRepository->all());
            $view->with('stages', $stageRepository->all());
        });

        // Automatyczne wstrzyknięcie naszego widoku do miejsca "admin.leads.view.actions.after"
        app()->bind('events')->listen('admin.leads.view.actions.after', function () {
            return view('lead_pipeline_switcher::admin.leads.view.actions.switcher')->render();
        });

        Log::info('✅ PipelineSwitcherServiceProvider boot() completed');
    }

    public function register()
    {
        //
    }
}
