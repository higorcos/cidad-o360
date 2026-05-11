@props(['route'])

@php
    $active = request()->routeIs($route) || request()->routeIs(str_replace('.index', '.*', $route));
@endphp

<a
    href="{{ route($route) }}"
    class="rounded-lg px-3 py-2 text-sm font-bold transition {{ $active ? 'bg-teal-50 text-teal-800' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-950' }}"
>
    {{ $slot }}
</a>
