@extends('layouts.app')

@section('title', 'Abertura de Empresa | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Desburocratização"
        title="Abertura de empresa digital"
        description="Simule o pré-cadastro municipal, confira documentos e gere um protocolo para acompanhar a análise."
    />

    <section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_24rem] lg:px-8">
        <form method="POST" action="{{ route('empresas.abertura.store') }}" class="rounded-lg border border-slate-200 bg-white p-5">
            @csrf

            <div class="grid gap-5">
                <div class="grid gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Nome fantasia</span>
                        <input name="nome_fantasia" value="{{ old('nome_fantasia') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Ex.: Mercado da Maria">
                        @error('nome_fantasia')
                            <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Atividade econômica</span>
                        <input name="atividade" value="{{ old('atividade') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Comércio varejista">
                        @error('atividade')
                            <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <div class="grid gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Responsável legal</span>
                        <input name="responsavel" value="{{ old('responsavel') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Nome completo">
                        @error('responsavel')
                            <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Bairro de funcionamento</span>
                        <input name="bairro" value="{{ old('bairro') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Centro">
                        @error('bairro')
                            <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                        @enderror
                    </label>
                </div>

                <section class="rounded-lg border border-slate-200 bg-stone-50 p-5">
                    <h2 class="text-lg font-black text-slate-950">Etapas do processo</h2>
                    <div class="mt-4 grid gap-3 md:grid-cols-2">
                        @foreach ($etapas as $index => $etapa)
                            <div class="rounded-lg bg-white p-4">
                                <span class="text-xs font-black uppercase tracking-wide text-teal-700">Etapa {{ $index + 1 }}</span>
                                <h3 class="mt-2 font-black text-slate-950">{{ $etapa['titulo'] }}</h3>
                                <p class="mt-1 text-sm leading-6 text-slate-600">{{ $etapa['descricao'] }}</p>
                            </div>
                        @endforeach
                    </div>
                </section>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                    <a href="{{ route('servicos.index') }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 px-5 text-sm font-black text-slate-700">Voltar</a>
                    <button class="inline-flex h-11 items-center justify-center rounded-lg bg-teal-700 px-5 text-sm font-black text-white transition hover:bg-teal-800">
                        Gerar protocolo empresarial
                    </button>
                </div>
            </div>
        </form>

        <aside class="space-y-4">
            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-black text-slate-950">Checklist de documentos</h2>
                <div class="mt-4 space-y-3">
                    @foreach ($documentos as $documento)
                        <div class="flex gap-3 rounded-lg bg-stone-50 p-3">
                            <span class="mt-1 h-3 w-3 shrink-0 rounded-full bg-teal-600"></span>
                            <p class="text-sm font-semibold leading-6 text-slate-700">{{ $documento }}</p>
                        </div>
                    @endforeach
                </div>
            </section>

            <section class="rounded-lg border border-amber-200 bg-amber-50 p-5">
                <p class="text-sm font-black uppercase tracking-wide text-amber-800">Por que isso é GovTech?</p>
                <p class="mt-2 text-sm leading-6 text-amber-900">Reduz atendimento presencial, mostra etapas do processo e torna a abertura de empresas mais previsível.</p>
            </section>
        </aside>
    </section>
@endsection
