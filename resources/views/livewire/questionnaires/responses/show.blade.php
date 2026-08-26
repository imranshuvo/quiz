<div class="mx-auto w-full max-w-4xl p-6 space-y-6">
    @include('livewire.questionnaires.partials.subnav', ['questionnaire' => $questionnaire, 'active' => 'responses'])

    <flux:button size="sm" variant="ghost" icon="arrow-left" :href="route('questionnaires.responses.index', $questionnaire)" wire:navigate>
        Back to all responses
    </flux:button>

    <div class="grid gap-3 sm:grid-cols-4">
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Status</p>
            <p class="mt-1 font-semibold">{{ $response->status->label() }}</p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Score</p>
            <p class="mt-1 font-semibold tabular-nums">
                @if ($response->percentage() !== null)
                    {{ $response->percentage() }}%
                @else
                    —
                @endif
            </p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Respondent</p>
            <p class="mt-1 font-semibold">
                {{ $response->respondent_email ?: ($response->respondent_user_id ? 'User #'.$response->respondent_user_id : 'Anonymous') }}
            </p>
        </div>
        <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-4">
            <p class="text-xs uppercase tracking-wider text-zinc-500">Submitted</p>
            <p class="mt-1 font-semibold">
                {{ $response->submitted_at?->diffForHumans() ?? '—' }}
            </p>
        </div>
    </div>

    <div class="space-y-4">
        @foreach ($questions as $i => $q)
            @php $a = $answersByQ->get($q->id); @endphp
            <div class="rounded-xl border border-zinc-200 dark:border-zinc-800 p-5 space-y-3">
                <div class="flex items-start justify-between gap-3">
                    <div class="space-y-1">
                        <flux:badge size="sm" variant="subtle">{{ $i + 1 }}. {{ $q->type->label() }}</flux:badge>
                        <p class="font-medium">{{ $q->title }}</p>
                        @if ($q->helper)
                            <p class="text-sm text-zinc-500">{{ $q->helper }}</p>
                        @endif
                    </div>
                    @if ($a && $a->is_correct !== null)
                        @if ($a->is_correct)
                            <flux:icon.check-circle class="size-6 text-emerald-500" />
                        @else
                            <flux:icon.x-circle class="size-6 text-rose-500" />
                        @endif
                    @endif
                </div>

                @if ($a)
                    <div class="rounded-lg bg-zinc-50 dark:bg-zinc-900 px-4 py-3">
                        @php
                            $val = is_array($a->value) ? $a->value : [$a->value];
                            $byOption = $q->options->keyBy('value');
                        @endphp
                        @if ($q->type === \App\Enums\QuestionType::File && is_array($val[0] ?? null))
                            <a class="inline-flex items-center gap-2 text-sm font-medium underline underline-offset-4" href="{{ route('questionnaires.responses.files.download', [$questionnaire, $response, $a]) }}">
                                <flux:icon.arrow-down-tray class="size-4" />
                                {{ $val[0]['name'] ?? 'Download file' }}
                            </a>
                        @elseif ($q->type->hasOptions())
                            <ul class="space-y-1">
                                @foreach ($val as $v)
                                    <li class="text-sm">
                                        @if ($byOption->has($v))
                                            {{ $byOption[$v]->label }}
                                            <span class="text-xs text-zinc-500">({{ $v }})</span>
                                        @else
                                            <span class="font-mono text-xs">{{ $v }}</span>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                        @else
                            <p class="whitespace-pre-wrap text-sm">{{ $val[0] ?? '' }}</p>
                        @endif
                    </div>

                    @if ($a->score !== null)
                        <p class="text-xs text-zinc-500 tabular-nums">
                            Awarded: {{ rtrim(rtrim(number_format((float) $a->score, 2), '0'), '.') }} / {{ rtrim(rtrim(number_format($q->maxScore() ?: ($q->meta['max_points'] ?? 1), 2), '0'), '.') }}
                        </p>
                    @endif
                @else
                    <p class="text-sm text-zinc-500 italic">Not answered.</p>
                @endif
            </div>
        @endforeach
    </div>
</div>
