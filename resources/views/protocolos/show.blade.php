@extends('layouts.app')

@section('title', 'Protocolo '.$protocolo.' | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Acompanhamento"
        title="Protocolo {{ $protocolo }}"
        description="Transparência do pedido desde o envio até a conclusão."
    />

    <section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_22rem] lg:px-8">
        <div class="rounded-lg border border-slate-200 bg-white p-5">
            <div class="flex flex-col gap-3 border-b border-slate-200 pb-5 sm:flex-row sm:items-start sm:justify-between">
                <div>
                    <p class="text-sm font-black uppercase tracking-wide text-teal-700">{{ $servico }}</p>
                    <h2 class="mt-2 text-2xl font-black text-slate-950">{{ $bairro }}</h2>
                    <p class="mt-2 text-sm leading-6 text-slate-600">{{ $endereco }}</p>
                </div>
                <span class="w-fit rounded-lg bg-amber-100 px-3 py-2 text-sm font-black text-amber-800">Em execução</span>
            </div>

            <p class="mt-5 text-base leading-7 text-slate-700">{{ $descricao }}</p>

            <div class="mt-8 space-y-4">
                @foreach ($linhaDoTempo as $item)
                    <div class="grid grid-cols-[2rem_1fr] gap-3">
                        <div class="flex justify-center">
                            <span class="mt-1 h-4 w-4 rounded-full {{ $item['ativo'] ? 'bg-teal-700' : 'bg-slate-300' }}"></span>
                        </div>
                        <div class="rounded-lg border {{ $item['ativo'] ? 'border-teal-200 bg-teal-50' : 'border-slate-200 bg-stone-50' }} p-4">
                            <div class="flex flex-col gap-1 sm:flex-row sm:items-center sm:justify-between">
                                <h3 class="font-black text-slate-950">{{ $item['status'] }}</h3>
                                <p class="text-sm font-bold text-slate-500">{{ $item['data'] }}</p>
                            </div>
                            <p class="mt-2 text-sm leading-6 text-slate-600">{{ $item['descricao'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <aside class="space-y-4">
            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-black text-slate-950">Resumo</h2>
                <dl class="mt-4 space-y-3 text-sm">
                    <div>
                        <dt class="font-bold text-slate-500">Protocolo</dt>
                        <dd class="mt-1 font-black text-slate-950">{{ $protocolo }}</dd>
                    </div>
                    <div>
                        <dt class="font-bold text-slate-500">Serviço</dt>
                        <dd class="mt-1 font-black text-slate-950">{{ $servico }}</dd>
                    </div>
                    <div>
                        <dt class="font-bold text-slate-500">Prazo estimado</dt>
                        <dd class="mt-1 font-black text-slate-950">Até 5 dias úteis</dd>
                    </div>
                </dl>
            </section>

            <a href="{{ route('dashboard') }}" class="block rounded-lg bg-slate-950 px-5 py-4 text-center text-sm font-black text-white transition hover:bg-teal-800">
                Voltar ao painel
            </a>
        </aside>
    </section>
@endsection
