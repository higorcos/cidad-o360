@extends('layouts.app')

@section('title', 'Serviços | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Catálogo municipal"
        title="Serviços públicos em um só lugar"
        description="Escolha um serviço para abrir uma solicitação ou consultar o prazo de atendimento."
    />

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="flex gap-2 overflow-x-auto pb-2">
            @foreach ($categorias as $categoria)
                <span class="shrink-0 rounded-lg border border-slate-200 bg-white px-4 py-2 text-sm font-black text-slate-700">{{ $categoria }}</span>
            @endforeach
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($servicos as $servico)
                <article class="rounded-lg border border-slate-200 bg-white p-5 transition hover:border-teal-600 hover:shadow-md">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-black uppercase tracking-wide text-teal-700">{{ $servico['categoria'] }}</p>
                            <h2 class="mt-2 text-xl font-black text-slate-950">{{ $servico['nome'] }}</h2>
                        </div>
                        <span class="rounded-lg bg-slate-100 px-3 py-1 text-xs font-black text-slate-700">{{ $servico['status'] }}</span>
                    </div>

                    <p class="mt-4 min-h-20 text-sm leading-6 text-slate-600">{{ $servico['descricao'] }}</p>

                    <div class="mt-5 flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <span class="text-sm font-bold text-slate-500">{{ $servico['prazo'] }}</span>
                        <a href="{{ route('solicitacoes.create', ['servico' => $servico['nome']]) }}" class="inline-flex h-10 items-center justify-center rounded-lg bg-teal-700 px-4 text-sm font-black text-white transition hover:bg-teal-800">
                            Solicitar
                        </a>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
@endsection
