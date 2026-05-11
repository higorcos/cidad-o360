@extends('layouts.app')

@section('title', 'Início | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Painel do cidadão"
        title="Acompanhe seus serviços públicos"
        description="Veja protocolos recentes, notificações e atalhos para abrir novas solicitações."
    />

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        <div class="grid gap-4 md:grid-cols-4">
            @foreach ($indicadores as $indicador)
                <div class="rounded-lg border border-slate-200 bg-white p-5">
                    <p class="text-sm font-bold text-slate-500">{{ $indicador['rotulo'] }}</p>
                    <p class="mt-3 text-3xl font-black text-slate-950">{{ $indicador['valor'] }}</p>
                    <p class="mt-2 text-sm font-semibold text-teal-700">{{ $indicador['variacao'] }}</p>
                </div>
            @endforeach
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_22rem]">
            <section class="rounded-lg border border-slate-200 bg-white">
                <div class="flex items-center justify-between gap-4 border-b border-slate-200 p-5">
                    <div>
                        <h2 class="text-xl font-black text-slate-950">Protocolos em andamento</h2>
                        <p class="mt-1 text-sm text-slate-500">Solicitações acompanhadas em tempo real.</p>
                    </div>
                    <a href="{{ route('solicitacoes.create') }}" class="rounded-lg bg-teal-700 px-4 py-2 text-sm font-black text-white transition hover:bg-teal-800">Novo</a>
                </div>

                <div class="divide-y divide-slate-200">
                    @foreach ($protocolos as $protocolo)
                        <a href="{{ route('protocolos.show', ['id' => $protocolo['numero']]) }}" class="block p-5 transition hover:bg-stone-50">
                            <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                                <div>
                                    <p class="text-base font-black text-slate-950">{{ $protocolo['servico'] }}</p>
                                    <p class="mt-1 text-sm text-slate-500">{{ $protocolo['numero'] }} · {{ $protocolo['bairro'] }} · {{ $protocolo['atualizado'] }}</p>
                                </div>
                                <span class="w-fit rounded-lg bg-amber-100 px-3 py-1 text-sm font-black text-amber-800">{{ $protocolo['status'] }}</span>
                            </div>
                            <div class="mt-4 h-2 rounded-full bg-slate-100">
                                <div class="h-2 rounded-full bg-teal-600" style="width: {{ $protocolo['progresso'] }}%"></div>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>

            <aside class="space-y-6">
                <section class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-lg font-black text-slate-950">Notificações</h2>
                    <div class="mt-4 space-y-3">
                        @foreach ($notificacoes as $notificacao)
                            <p class="rounded-lg bg-stone-50 p-3 text-sm leading-6 text-slate-600">{{ $notificacao }}</p>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-lg font-black text-slate-950">Serviços rápidos</h2>
                    <div class="mt-4 grid gap-2">
                        @foreach ($servicos as $servico)
                            <a href="{{ isset($servico['rota']) ? route($servico['rota']) : route('solicitacoes.create', ['servico' => $servico['nome']]) }}" class="rounded-lg border border-slate-200 px-3 py-3 text-sm font-bold text-slate-700 transition hover:border-teal-600 hover:text-teal-800">
                                {{ $servico['nome'] }}
                            </a>
                        @endforeach
                    </div>
                </section>

                <section class="rounded-lg border border-slate-200 bg-white p-5">
                    <h2 class="text-lg font-black text-slate-950">Módulos GovTech</h2>
                    <div class="mt-4 grid gap-3">
                        @foreach ($govtechCards as $card)
                            <a href="{{ route($card['rota']) }}" class="rounded-lg bg-stone-50 p-4 transition hover:bg-teal-50">
                                <p class="text-sm font-black text-slate-950">{{ $card['titulo'] }}</p>
                                <p class="mt-1 text-sm leading-5 text-slate-600">{{ $card['descricao'] }}</p>
                            </a>
                        @endforeach
                    </div>
                </section>
            </aside>
        </div>
    </section>
@endsection
