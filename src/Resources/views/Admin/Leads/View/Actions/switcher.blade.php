@if (isset($leadPipelineSwitcher) && $leadPipelineSwitcher)
    <form action="{{ route('admin.leads.switch-pipeline', $lead->id) }}" method="POST" class="flex items-center gap-2 mt-4">
        @csrf

        <select name="pipeline_id" class="form-control" required>
            <option value="">-- Select Pipeline --</option>
            @foreach ($pipelines as $pipeline)
                <option value="{{ $pipeline->id }}">{{ $pipeline->name }}</option>
            @endforeach
        </select>

        <select name="stage_id" class="form-control" required>
            <option value="">-- Select Stage --</option>
            @foreach ($stages as $stage)
                <option value="{{ $stage->id }}">{{ $stage->name }} (Pipeline {{ $stage->lead_pipeline_id }})</option>
            @endforeach
        </select>

        <button type="submit" class="btn btn-sm btn-primary">
            @lang('lead_pipeline_switcher::app.pipeline_switcher.switch_button')
        </button>
    </form>
@endif
