<section class="w-full">
    @include('partials.settings-heading')

    <x-settings.layout :heading="__('Audit log')" :subheading="__('Review content, team, integration, and API-token changes in this workspace.')">
        @if ($activities->isEmpty())
            <flux:callout icon="clock" color="zinc">No recorded activity yet.</flux:callout>
        @else
            <ol class="space-y-3" aria-label="Workspace activity">
                @foreach ($activities as $activity)
                    @php
                        $subject = $activity->subject_type ? class_basename($activity->subject_type) : null;
                        $changes = $activity->attribute_changes ?? collect();
                    @endphp
                    <li class="rounded-xl border border-zinc-200 p-4 dark:border-zinc-700">
                        <div class="flex items-start justify-between gap-3">
                            <div>
                                <p class="text-sm font-medium">
                                    {{ $activity->causer?->name ?? 'System' }}
                                    <span class="font-normal text-zinc-600 dark:text-zinc-400">{{ str_replace(['.', '_'], ' ', $activity->description) }}</span>
                                    @if ($subject)
                                        <span class="font-normal text-zinc-600 dark:text-zinc-400">{{ $subject }} #{{ $activity->subject_id }}</span>
                                    @endif
                                </p>
                                @if ($changes->isNotEmpty())
                                    <p class="mt-1 text-xs text-zinc-500">
                                        Changed: {{ collect($changes->get('attributes', []))->keys()->implode(', ') }}
                                    </p>
                                @endif
                            </div>
                            <time class="shrink-0 text-xs text-zinc-500" datetime="{{ $activity->created_at?->toISOString() }}">
                                {{ $activity->created_at?->diffForHumans() }}
                            </time>
                        </div>
                    </li>
                @endforeach
            </ol>

            <div class="mt-5">{{ $activities->links() }}</div>
        @endif
    </x-settings.layout>
</section>
