@php
    $post = $post ?? null;

    $url = $post
        ? \App\Filament\Resources\ContentPosts\ContentPostResource::getUrl('edit', ['record' => $post])
        : null;

    $title = $post?->title ?? '—';
@endphp

<div class="rounded-xl border border-white/10 bg-white/[0.03] p-5 h-full flex flex-col items-center justify-center">
    <p class="text-sm text-gray-400 text-center">
        Origen
    </p>

    @if ($url)
        <a
            href="{{ $url }}"
            target="_blank"
            rel="noopener noreferrer"
            class="mt-2 text-lg text-primary-500 underline text-center leading-tight"
        >
            {{ $title }}
        </a>
    @else
        <p class="mt-2 text-2xl text-white text-center">
            —
        </p>
    @endif
</div>