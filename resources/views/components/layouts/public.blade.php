<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="dark">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="robots" content="noindex">

        <title>{{ $title ?? config('app.name') }}</title>

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600,700" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @fluxAppearance
    </head>
    <body class="min-h-screen bg-gradient-to-br from-zinc-50 to-zinc-100 dark:from-zinc-900 dark:to-zinc-950 text-zinc-900 dark:text-zinc-100 antialiased selection:bg-accent/20">
        <a href="#main-content" class="skip-link">Skip to main content</a>
        <main id="main-content" tabindex="-1" class="min-h-screen w-full">
            {{ $slot }}
        </main>

        @fluxScripts
    </body>
</html>
