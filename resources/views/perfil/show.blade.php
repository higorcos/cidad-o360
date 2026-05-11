@extends('layouts.app')

@section('title', 'Perfil | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Conta do cidadão"
        title="Perfil e preferências"
        description="Dados simulados do usuário para completar a navegação do MVP."
    />

    <section class="mx-auto max-w-4xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="rounded-lg border border-slate-200 bg-white p-5">
            <div class="flex flex-col gap-5 sm:flex-row sm:items-center">
                <div class="grid h-20 w-20 place-items-center rounded-lg bg-teal-700 text-2xl font-black text-white">MO</div>
                <div>
                    <h2 class="text-2xl font-black text-slate-950">{{ $usuario['nome'] }}</h2>
                    <p class="mt-1 text-sm font-semibold text-slate-500">{{ $usuario['email'] }}</p>
                </div>
            </div>

            <dl class="mt-8 grid gap-4 sm:grid-cols-2">
                @foreach ($usuario as $rotulo => $valor)
                    <div class="rounded-lg border border-slate-200 bg-stone-50 p-4">
                        <dt class="text-sm font-black capitalize text-slate-500">{{ str_replace('_', ' ', $rotulo) }}</dt>
                        <dd class="mt-2 font-bold text-slate-950">{{ $valor }}</dd>
                    </div>
                @endforeach
            </dl>
        </div>
    </section>
@endsection
