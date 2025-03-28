<?php

use Illuminate\Support\Facades\Route;
use Puzmiki\LeadPipelineSwitcher\Http\Controllers\PipelineSwitcherController;

Route::group([
    'middleware' => ['web', 'admin_locale', 'user'],
    'prefix'     => config('app.admin_path'),
], function () {
    Route::post('leads/view/{id}/switch-pipeline', [
        'uses' => 'Puzmiki\LeadPipelineSwitcher\Http\Controllers\PipelineSwitcherController@switch',
        'as'   => 'admin.leads.switch-pipeline',
    ]);
});