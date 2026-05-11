<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="theme-color" content="#0f766e">

        <title>@yield('title', 'Cidadão360')</title>

        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    <body class="min-h-screen bg-stone-50 text-slate-950 antialiased">
        <div class="min-h-screen">
            <header class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/95 backdrop-blur">
                <div class="mx-auto flex max-w-7xl items-center justify-between gap-4 px-4 py-3 sm:px-6 lg:px-8">
                    <a href="{{ route('home') }}" class="flex min-w-0 items-center gap-3">
                        <span class="grid h-10 w-10 shrink-0 place-items-center rounded-lg bg-teal-700 text-lg font-black text-white">360</span>
                        <span class="min-w-0">
                            <span class="block text-base font-black leading-tight text-slate-950">Cidadão360</span>
                            <span class="block text-xs font-medium text-slate-500">Portal digital da cidade</span>
                        </span>
                    </a>

                    <nav class="hidden items-center gap-1 md:flex" aria-label="Navegação principal">
                        <x-nav-link route="dashboard">Início</x-nav-link>
                        <x-nav-link route="servicos.index">Serviços</x-nav-link>
                        <x-nav-link route="solicitacoes.create">Solicitar</x-nav-link>
                        <x-nav-link route="transparencia.index">Transparência</x-nav-link>
                        <x-nav-link route="perfil.show">Perfil</x-nav-link>
                    </nav>

                    <a href="{{ route('solicitacoes.create') }}" class="inline-flex h-10 items-center justify-center rounded-lg bg-slate-950 px-4 text-sm font-bold text-white transition hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2">
                        Nova solicitação
                    </a>
                </div>
            </header>

            <main>
                @yield('content')
            </main>

            <nav class="fixed inset-x-0 bottom-0 z-40 border-t border-slate-200 bg-white px-2 py-2 shadow-lg md:hidden" aria-label="Navegação mobile">
                <div class="mx-auto grid max-w-md grid-cols-5 gap-1 text-center text-[11px] font-bold text-slate-600">
                    <a class="rounded-lg px-2 py-2 {{ request()->routeIs('dashboard') ? 'bg-teal-50 text-teal-800' : '' }}" href="{{ route('dashboard') }}">Início</a>
                    <a class="rounded-lg px-2 py-2 {{ request()->routeIs('servicos.*') ? 'bg-teal-50 text-teal-800' : '' }}" href="{{ route('servicos.index') }}">Serviços</a>
                    <a class="rounded-lg px-2 py-2 {{ request()->routeIs('solicitacoes.*') ? 'bg-teal-50 text-teal-800' : '' }}" href="{{ route('solicitacoes.create') }}">Solicitar</a>
                    <a class="rounded-lg px-2 py-2 {{ request()->routeIs('transparencia.*') ? 'bg-teal-50 text-teal-800' : '' }}" href="{{ route('transparencia.index') }}">Dados</a>
                    <a class="rounded-lg px-2 py-2 {{ request()->routeIs('perfil.*') ? 'bg-teal-50 text-teal-800' : '' }}" href="{{ route('perfil.show') }}">Perfil</a>
                </div>
            </nav>

            <footer class="border-t border-slate-200 bg-white pb-20 md:pb-0">
                <div class="mx-auto flex max-w-7xl flex-col gap-3 px-4 py-8 text-sm text-slate-500 sm:px-6 md:flex-row md:items-center md:justify-between lg:px-8">
                    <p>Cidadão360 MVP GovTech. Dados simulados para apresentação.</p>
                    <p>Menos burocracia, mais transparência.</p>
                </div>
            </footer>
        </div>
    </body>
</html>
