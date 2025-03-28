<?php

use Illuminate\Support\Facades\Route;
use Puzmiki\LeadPipelineSwitcher\Http\Controllers\PipelineSwitcherController;

Route::group(['middleware' => ['web', 'admin']], function () {
    Route::post('admin/leads/{id}/switch-pipeline', [PipelineSwitcherController::class, 'switch'])->name('admin.leads.switch-pipeline');
});