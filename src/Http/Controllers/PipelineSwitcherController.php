<?php

namespace Puzmiki\LeadPipelineSwitcher\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;
use Webkul\Lead\Repositories\LeadPipelineRepository;
use Webkul\Lead\Repositories\StageRepository;
use Puzmiki\LeadPipelineSwitcher\Repositories\PipelineSwitcherRepository;

class PipelineSwitcherController extends Controller
{
    protected $pipelineSwitcherRepository;

    public function __construct(PipelineSwitcherRepository $pipelineSwitcherRepository)
    {
        $this->pipelineSwitcherRepository = $pipelineSwitcherRepository;
    }

    public function switch(Request $request, $id)
    {
        Validator::make($request->all(), [
            'pipeline_id' => 'required|integer',
            'stage_id'    => 'required|integer',
        ])->validate();

        $this->pipelineSwitcherRepository->switch($id, $request->pipeline_id, $request->stage_id);

        session()->flash('success', 'Lead moved to selected pipeline and stage.');

        return redirect()->back();
    }
}