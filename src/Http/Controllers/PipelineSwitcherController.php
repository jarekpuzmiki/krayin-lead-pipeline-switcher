<?php

namespace Puzmiki\LeadPipelineSwitcher\Http\Controllers;

use Illuminate\Http\Request;
use Webkul\Lead\Repositories\LeadPipelineRepository;
use Webkul\Lead\Repositories\LeadPipelineStageRepository;
use Puzmiki\LeadPipelineSwitcher\Repositories\PipelineSwitcherRepository;

class PipelineSwitcherController
{
    protected $pipelineSwitcherRepository;

    public function __construct(PipelineSwitcherRepository $pipelineSwitcherRepository)
    {
        $this->pipelineSwitcherRepository = $pipelineSwitcherRepository;
    }

    public function switch(Request $request, $id)
    {
        $this->validate($request, [
            'pipeline_id' => 'required|integer',
            'stage_id'    => 'required|integer',
        ]);

        $this->pipelineSwitcherRepository->switch($id, $request->pipeline_id, $request->stage_id);

        session()->flash('success', 'Lead moved to selected pipeline and stage.');

        return redirect()->back();
    }
}