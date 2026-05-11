@extends('layouts.app')

@section('title', 'Cidadão360 | Portal digital da cidade')

@section('content')
    <section class="bg-white">
        <div class="mx-auto grid max-w-7xl gap-10 px-4 py-10 sm:px-6 lg:grid-cols-[1.05fr_0.95fr] lg:px-8 lg:py-14">
            <div class="flex flex-col justify-center">
                <p class="text-sm font-black uppercase tracking-wide text-teal-700">GovTech para serviços públicos municipais</p>
                <h1 class="mt-4 max-w-3xl text-4xl font-black leading-tight text-slate-950 sm:text-5xl">
                    Prefeitura na palma da mão do cidadão.
                </h1>
                <p class="mt-5 max-w-2xl text-lg leading-8 text-slate-600">
                    Consulte serviços, abra solicitações, acompanhe protocolos e veja indicadores públicos em uma experiência simples e transparente.
                </p>

                <div class="mt-8 flex flex-col gap-3 sm:flex-row">
                    <a href="{{ route('dashboard') }}" class="inline-flex h-12 items-center justify-center rounded-lg bg-teal-700 px-5 text-sm font-black text-white transition hover:bg-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2">
                        Acessar como visitante
                    </a>
                    <a href="{{ route('servicos.index') }}" class="inline-flex h-12 items-center justify-center rounded-lg border border-slate-300 bg-white px-5 text-sm font-black text-slate-900 transition hover:border-teal-700 hover:text-teal-800 focus:outline-none focus:ring-2 focus:ring-teal-700 focus:ring-offset-2">
                        Consultar serviços
                    </a>
                </div>

                <div class="mt-10 grid gap-3 sm:grid-cols-3">
                    @foreach (array_slice($indicadores, 0, 3) as $indicador)
                        <div class="rounded-lg border border-slate-200 bg-stone-50 p-4">
                            <p class="text-2xl font-black text-slate-950">{{ $indicador['valor'] }}</p>
                            <p class="mt-1 text-sm font-semibold text-slate-600">{{ $indicador['rotulo'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="relative flex items-center justify-center">
                <div class="w-full max-w-md rounded-[2rem] border border-slate-200 bg-slate-950 p-3 shadow-2xl">
                    <div class="overflow-hidden rounded-[1.55rem] bg-stone-50">
                        <div class="bg-teal-700 px-5 py-5 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <p class="text-xs font-black uppercase text-teal-100">Resumo de hoje</p>
                                    <p class="mt-1 text-xl font-black">Olá, Maria</p>
                                </div>
                                <span class="rounded-lg bg-white/15 px-3 py-2 text-xs font-bold">MVP</span>
                            </div>
                        </div>

                        <div class="space-y-4 p-5">
                            @foreach ($protocolos as $protocolo)
                                <div class="rounded-lg border border-slate-200 bg-white p-4">
                                    <div class="flex items-start justify-between gap-3">
                                        <div>
                                            <p class="text-sm font-black text-slate-950">{{ $protocolo['servico'] }}</p>
                                            <p class="mt-1 text-xs text-slate-500">{{ $protocolo['numero'] }} · {{ $protocolo['bairro'] }}</p>
                                        </div>
                                        <span class="rounded-md bg-amber-100 px-2 py-1 text-[11px] font-black text-amber-800">{{ $protocolo['status'] }}</span>
                                    </div>
                                    <div class="mt-4 h-2 rounded-full bg-slate-100">
                                        <div class="h-2 rounded-full bg-teal-600" style="width: {{ $protocolo['progresso'] }}%"></div>
                                    </div>
                                </div>
                            @endforeach

                            <div class="grid grid-cols-2 gap-3">
                                @foreach ($servicos as $servico)
                                    <a href="{{ isset($servico['rota']) ? route($servico['rota']) : route('solicitacoes.create', ['servico' => $servico['nome']]) }}" class="rounded-lg border border-slate-200 bg-white p-3 text-sm font-black text-slate-800 shadow-sm transition hover:border-teal-600 hover:text-teal-800">
                                        {{ $servico['nome'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="border-t border-slate-200 bg-stone-50">
        <div class="mx-auto max-w-7xl px-4 py-10 sm:px-6 lg:px-8">
            <div class="max-w-3xl">
                <p class="text-sm font-black uppercase tracking-wide text-teal-700">Mais aderente ao tema GovTech</p>
                <h2 class="mt-2 text-3xl font-black text-slate-950">Transparência, desburocratização e participação cidadã.</h2>
            </div>

            <div class="mt-6 grid gap-4 md:grid-cols-3">
                <a href="{{ route('empresas.abertura') }}" class="rounded-lg border border-slate-200 bg-white p-5 transition hover:border-teal-600 hover:shadow-md">
                    <h3 class="text-lg font-black text-slate-950">Abertura de empresa</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Pré-cadastro digital com etapas, documentos e protocolo.</p>
                </a>
                <a href="{{ route('pagamentos.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 transition hover:border-teal-600 hover:shadow-md">
                    <h3 class="text-lg font-black text-slate-950">Pagamentos e taxas</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Guias simuladas para IPTU, alvará, licença e coleta.</p>
                </a>
                <a href="{{ route('consulta-publica.index') }}" class="rounded-lg border border-slate-200 bg-white p-5 transition hover:border-teal-600 hover:shadow-md">
                    <h3 class="text-lg font-black text-slate-950">Consulta pública</h3>
                    <p class="mt-2 text-sm leading-6 text-slate-600">Voto simulado com hash para demonstrar auditoria e blockchain futuro.</p>
                </a>
            </div>
        </div>
    </section>
@endsection
