<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($title) ? $title.' - '.config('app.name') : config('app.name') }}</title>

    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen font-sans antialiased bg-base-200">

    {{-- NAVBAR mobile only --}}
    <x-nav sticky class="lg:hidden">
        <x-slot:brand>
            <x-app-brand />
        </x-slot:brand>
        <x-slot:actions>
            <label for="main-drawer" class="lg:hidden me-3">
                <x-icon name="o-bars-3" class="cursor-pointer" />
            </label>
        </x-slot:actions>
    </x-nav>

    {{-- MAIN --}}
    <x-main>
        {{-- SIDEBAR --}}
        <x-slot:sidebar drawer="main-drawer" collapsible class="bg-base-100 lg:bg-inherit">

            {{-- BRAND --}}
            <x-app-brand class="px-5 pt-4" />

            {{-- MENU --}}
            <x-menu activate-by-route>

                {{-- User --}}
                @if($user = auth()->user())
                    <x-menu-separator />

                    <x-list-item :item="$user" value="name" sub-value="email" no-separator no-hover class="-mx-2 !-my-2 rounded">
                        <x-slot:actions>
                            <x-button icon="o-arrow-right-start-on-rectangle" class="btn-circle btn-ghost btn-xs" tooltip-left="logout" no-wire-navigate link="/logout" />
                        </x-slot:actions>
                    </x-list-item>

                    <x-menu-separator />
                @endif

                <x-menu-item title="Home" icon="o-home" link="/" />
                <x-menu-sub title="Monitoring" icon="o-computer-desktop" >
                    <x-menu-item title="Temperature & Humidity" icon="o-fire" link="dashboard" />
                    <x-menu-item title="Soil Moisture & Pump Status" icon="o-sun" link="plant_dashboard" />
                </x-menu-sub>
                <x-menu-sub title="Node (Admin)" icon="o-briefcase" >
                    <x-menu-item icon="o-cpu-chip" label="Node Faculty " link="/admin/node" />
                    <x-menu-item icon="o-cpu-chip" label="Node Building" link="/admin/node" />
                    <x-menu-item icon="o-cpu-chip" label="Node Room" link="/admin/node" />
                </x-menu-sub>

                <x-menu-sub title="Settings" icon="o-cog-6-tooth">
                    <x-menu-item title="Wifi" icon="o-wifi" link="####" />
                    <x-menu-item title="Archives" icon="o-archive-box" link="####" />
                </x-menu-sub>
            </x-menu>
        </x-slot:sidebar>

        {{-- The `$slot` goes here --}}
        <x-slot:content>
            {{ $slot }}   {{-- Untuk komponen --}}
        </x-slot:content>
    </x-main>

    {{--  TOAST area --}}
    <x-toast />

</body>
</html>
