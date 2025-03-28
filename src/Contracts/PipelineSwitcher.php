<?php

namespace Puzmiki\LeadPipelineSwitcher\Contracts;

interface PipelineSwitcher
{
    public function switch(int $leadId, int $pipelineId, int $stageId): bool;
}