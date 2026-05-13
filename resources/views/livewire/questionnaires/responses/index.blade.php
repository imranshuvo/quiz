<div class="mx-auto w-full max-w-6xl p-6 space-y-6">
    @include('livewire.questionnaires.partials.subnav', ['questionnaire' => $questionnaire, 'active' => 'responses'])

    <div class="flex flex-wrap items-center justify-between gap-3">
        <div class="flex gap-2">
            <flux:button size="sm" :variant="$statusFilter === 'all' ? 'primary' : 'ghost'" wire:click="setStatus('all')">
                All <flux:badge size="sm" class="ms-1">{{ $statusCounts['all'] }}</flux:badge>
            </flux:button>
            <flux:button size="sm" :variant="$statusFilter === 'submitted' ? 'primary' : 'ghost'" wire:click="setStatus('submitted')">
                Submitted <flux:badge size="sm" class="ms-1">{{ $statusCounts['submitted'] }}</flux:badge>
            </flux:button>
            <flux:button size="sm" :variant="$statusFilter === 'in_progress' ? 'primary' : 'ghost'" wire:click="setStatus('in_progress')">
                In progress <flux:badge size="sm" class="ms-1">{{ $statusCounts['in_progress'] }}</flux:badge>
            </flux:button>
        </div>
        <flux:button
            size="sm"
            variant="ghost"
            icon="arrow-down-tray"
            :href="route('questionnaires.responses.export', $questionnaire)"
        >Export CSV</flux:button>
    </div>

    @if ($responses->isEmpty())
        <flux:callout icon="inbox" color="zinc">
            No responses yet. Share this questionnaire to start collecting answers.
        </flux:callout>
    @else
        <flux:table>
            <flux:table.columns>
                <flux:table.column>#</flux:table.column>
                <flux:table.column>Respondent</flux:table.column>
                <flux:table.column>Status</flux:table.column>
                <flux:table.column>Score</flux:table.column>
                <flux:table.column>Submitted</flux:table.column>
                <flux:table.column class="text-right">Actions</flux:table.column>
            </flux:table.columns>
            <flux:table.rows>
                @foreach ($responses as $r)
                    <flux:table.row :key="'r-'.$r->id">
                        <flux:table.cell>
                            <a href="{{ route('questionnaires.responses.show', [$questionnaire, $r]) }}" wire:navigate class="font-mono text-xs hover:underline">
                                #{{ $r->id }}
                            </a>
                        </flux:table.cell>
                        <flux:table.cell>
                            @if ($r->respondent_email)
                                {{ $r->respondent_email }}
                            @elseif ($r->respondent_user_id)
                                User #{{ $r->respondent_user_id }}
                            @else
                                <span class="text-zinc-500">Anonymous</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            <flux:badge size="sm" :color="$r->status->value === 'submitted' ? 'lime' : 'zinc'">
                                {{ $r->status->label() }}
                            </flux:badge>
                        </flux:table.cell>
                        <flux:table.cell class="tabular-nums">
                            @if ($r->percentage() !== null)
                                {{ $r->percentage() }}%
                                <span class="text-xs text-zinc-500">({{ rtrim(rtrim(number_format((float) $r->score, 2), '0'), '.') }} / {{ rtrim(rtrim(number_format((float) $r->max_score, 2), '0'), '.') }})</span>
                            @else
                                <span class="text-zinc-500">—</span>
                            @endif
                        </flux:table.cell>
                        <flux:table.cell>
                            {{ $r->submitted_at?->diffForHumans() ?? '—' }}
                        </flux:table.cell>
                        <flux:table.cell class="text-right">
                            <flux:button size="xs" variant="ghost" icon="eye" :href="route('questionnaires.responses.show', [$questionnaire, $r])" wire:navigate>View</flux:button>
                        </flux:table.cell>
                    </flux:table.row>
                @endforeach
            </flux:table.rows>
        </flux:table>

        <div>
            {{ $responses->links() }}
        </div>
    @endif
</div>
