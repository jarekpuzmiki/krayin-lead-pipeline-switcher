<DIV>TEST SWITCHER </DIV>
@if (isset($leadPipelineSwitcher) && $leadPipelineSwitcher)
    <form action="{{ route('admin.leads.switch-pipeline', $lead->id) }}" method="POST" class="flex flex-col gap-4 mt-4 w-1/2">
        @csrf

        <x-admin::form.control-group label="Pipeline" for="pipeline_id">
            <select name="pipeline_id" id="pipeline_id" class="control" required>
                <option value="">-- Wybierz pipeline --</option>
                @foreach ($pipelines as $pipeline)
                    <option value="{{ $pipeline->id }}" {{ $lead->lead_pipeline_id == $pipeline->id ? 'selected' : '' }}>
                        {{ $pipeline->name }}
                    </option>
                @endforeach
            </select>
        </x-admin::form.control-group>

        <x-admin::form.control-group label="Etap" for="stage_id">
            <select name="stage_id" id="stage_id" class="control" required>
                <option value="">-- Wybierz etap --</option>
                @foreach ($stages as $stage)
                    <option value="{{ $stage->id }}" {{ $lead->lead_pipeline_stage_id == $stage->id ? 'selected' : '' }}>
                        {{ $stage->name }}
                    </option>
                @endforeach
            </select>
        </x-admin::form.control-group>

        <button type="submit" class="primary-button">
            Przenieś lead
        </button>
    </form>
@endif

