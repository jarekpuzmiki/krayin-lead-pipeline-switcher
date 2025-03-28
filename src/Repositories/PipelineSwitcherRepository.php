<?php

namespace Puzmiki\LeadPipelineSwitcher\Repositories;

use Webkul\Lead\Repositories\LeadRepository;
use Webkul\Lead\Repositories\LeadPipelineStageRepository;
use Webkul\Activity\Repositories\ActivityRepository;
use Puzmiki\LeadPipelineSwitcher\Contracts\PipelineSwitcher;
use Illuminate\Support\Facades\Log;
use Exception;

class PipelineSwitcherRepository implements PipelineSwitcher
{
    protected $leadRepository;
    protected $stageRepository;
    protected $activityRepository;

    public function __construct(
        LeadRepository $leadRepository,
        StageRepository $stageRepository,
        ActivityRepository $activityRepository
    ) {
        $this->leadRepository = $leadRepository;
        $this->stageRepository = $stageRepository;
        $this->activityRepository = $activityRepository;
    }

    public function switch(int $leadId, int $pipelineId, int $stageId): bool
    {
        $lead = $this->leadRepository->findOrFail($leadId);

        $stage = $this->stageRepository->findOrFail($stageId);

        if ($stage->lead_pipeline_id !== $pipelineId) {
            throw new Exception("Selected stage does not belong to the specified pipeline.");
        }

        $lead->update([
            'lead_pipeline_id' => $pipelineId,
            'lead_pipeline_stage_id' => $stageId,
        ]);

        $this->activityRepository->create([
            'type'          => 'note',
            'comment'       => __('lead_pipeline_switcher::app.pipeline_switcher.switch_pipeline') . ": {$pipelineId} / Stage: {$stageId}",
            'lead_id'       => $leadId,
            'user_id'       => auth()->id(),
        ]);

        return true;
    }
}
