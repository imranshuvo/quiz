@php $file = is_array($value) ? ($value[0] ?? null) : null; @endphp
<div class="space-y-3">
    @if (is_array($file) && isset($file['name']))
        <div role="status" class="flex items-center gap-3 rounded-xl border border-emerald-300 bg-emerald-50 px-4 py-3 text-sm text-emerald-950 dark:border-emerald-800 dark:bg-emerald-950 dark:text-emerald-100">
            <flux:icon.check-circle class="size-5 shrink-0" />
            <span class="min-w-0 flex-1 truncate">{{ $file['name'] }}</span>
            <span class="shrink-0 text-xs">{{ number_format(($file['size'] ?? 0) / 1024, 1) }} KB</span>
        </div>
    @endif

    <label class="block cursor-pointer rounded-2xl border border-dashed border-zinc-300 p-6 text-center transition hover:border-zinc-500 focus-within:ring-2 focus-within:ring-accent dark:border-zinc-700">
        <span class="block text-sm font-medium">{{ $file ? 'Replace file' : 'Choose a file' }}</span>
        <span class="mt-1 block text-xs text-zinc-500">Maximum {{ number_format(($q->meta['max_size_kb'] ?? 10240) / 1024, 0) }} MB</span>
        <input type="file" class="sr-only" wire:model="uploads.{{ $q->id }}" />
    </label>

    <div wire:loading wire:target="uploads.{{ $q->id }}" role="status" class="text-sm text-zinc-500">Uploading…</div>
    @error('uploads.'.$q->id) <p class="text-sm text-rose-600" role="alert">{{ $message }}</p> @enderror

    @if (isset($uploads[$q->id]))
        <flux:button size="sm" variant="primary" icon="arrow-up-tray" wire:click="saveUpload({{ $q->id }})">Use this file</flux:button>
    @endif
</div>
