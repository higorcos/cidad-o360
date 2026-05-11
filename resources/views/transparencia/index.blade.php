@extends('layouts.app')

@section('title', 'Transparência | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Dados públicos"
        title="Indicadores de atendimento"
        description="Uma visão simulada das solicitações, bairros atendidos e serviços mais demandados."
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

        <div class="mt-8 grid gap-6 lg:grid-cols-2">
            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-xl font-black text-slate-950">Demandas por bairro</h2>
                <div class="mt-6 space-y-4">
                    @foreach ($demandasPorBairro as $demanda)
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-black text-slate-800">{{ $demanda['bairro'] }}</span>
                                <span class="text-sm font-bold text-slate-500">{{ $demanda['total'] }} solicitações</span>
                            </div>
                            <div class="mt-2 h-3 rounded-full bg-slate-100">
                                <div class="h-3 rounded-full bg-teal-600" style="width: {{ $demanda['percentual'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-xl font-black text-slate-950">Serviços mais solicitados</h2>
                <div class="mt-6 divide-y divide-slate-200">
                    @foreach ($servicosMaisSolicitados as $servico)
                        <div class="flex items-center justify-between gap-4 py-4 first:pt-0 last:pb-0">
                            <span class="font-black text-slate-800">{{ $servico['servico'] }}</span>
                            <span class="rounded-lg bg-slate-100 px-3 py-1 text-sm font-black text-slate-700">{{ $servico['total'] }}</span>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_24rem]">
            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-xl font-black text-slate-950">Tempo médio por serviço</h2>
                <p class="mt-1 text-sm text-slate-500">Mostra eficiência operacional e ajuda a prefeitura a priorizar filas.</p>
                <div class="mt-6 space-y-4">
                    @foreach ($tempoAtendimento as $tempo)
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-black text-slate-800">{{ $tempo['servico'] }}</span>
                                <span class="text-sm font-bold text-slate-500">{{ $tempo['tempo'] }} · meta {{ $tempo['meta'] }}</span>
                            </div>
                            <div class="mt-2 h-3 rounded-full bg-slate-100">
                                <div class="h-3 rounded-full bg-amber-500" style="width: {{ $tempo['percentual'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-xl font-black text-slate-950">Satisfação do cidadão</h2>
                <div class="mt-6 space-y-4">
                    @foreach ($satisfacao as $item)
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-black text-slate-800">{{ $item['rotulo'] }}</span>
                                <span class="text-sm font-bold text-slate-500">{{ $item['percentual'] }}%</span>
                            </div>
                            <div class="mt-2 h-3 rounded-full bg-slate-100">
                                <div class="h-3 rounded-full bg-teal-600" style="width: {{ $item['percentual'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <section class="mt-8 rounded-lg border border-slate-200 bg-white p-5">
            <div class="grid gap-5 lg:grid-cols-[1fr_20rem] lg:items-center">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">Auditoria pública simulada</p>
                    <h2 class="mt-2 text-xl font-black text-slate-950">{{ $auditoriaConsulta['consulta'] }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $auditoriaConsulta['observacao'] }}</p>
                </div>
                <div class="rounded-lg bg-slate-950 p-5 text-white">
                    <p class="text-sm font-bold text-slate-300">Votos registrados</p>
                    <p class="mt-2 text-3xl font-black">{{ $auditoriaConsulta['votos'] }}</p>
                    <p class="mt-4 text-sm font-bold text-slate-300">Hash público</p>
                    <p class="mt-1 break-all text-lg font-black text-teal-200">{{ $auditoriaConsulta['hash'] }}</p>
                </div>
            </div>
        </section>
    </section>
@endsection
