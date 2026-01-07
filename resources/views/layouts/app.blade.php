<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>
            :root {
                --color-bg: #000000;
                --color-primary: #4fa3ff;
                --color-secondary: #7b4bff;
                --color-accent: #00ff7f;
                --color-text: #ffffff;
                --color-section: #0f1b3d;
            }

            body {
                background-color: var(--color-bg) !important;
                color: var(--color-text) !important;
                font-family: 'Figtree', sans-serif;
                margin: 0;
            }

            nav {
                background: rgba(0, 0, 0, 0.9) !important;
                border-bottom: 1px solid rgba(79, 163, 255, 0.3) !important;
                backdrop-filter: blur(10px);
            }

            nav a, nav button {
                color: var(--color-primary) !important;
                font-weight: bold !important;
                text-transform: uppercase;
                letter-spacing: 0.1em;
            }

            .custom-header {
                background: var(--color-section);
                border-bottom: 2px solid var(--color-primary);
                padding: 40px 0;
                text-align: center;
                box-shadow: 0 10px 30px rgba(0,0,0,0.5);
            }

            .custom-header h2 {
                font-size: 1.8rem;
                letter-spacing: 0.3em;
                color: var(--color-primary);
                text-shadow: 0 0 10px var(--color-primary);
                margin: 0;
            }

            .main-content {
                padding: 20px 20px;
                background-image: radial-gradient(circle at 50% 0%, #0f1b3d 0%, #000000 70%);
            }
        </style>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <div class="min-h-screen">
            @include('layouts.navigation')

            @if (isset($header))
                <div class="custom-header">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </div>
            @endif

            <main class="main-content">
                {{ $slot }}
            </main>
        </div>
    </body>
</html>