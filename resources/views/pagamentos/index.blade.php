@extends('layouts.app')

@section('title', 'Pagamentos e Taxas | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Pagamentos públicos"
        title="Taxas municipais e guias simuladas"
        description="Consulte cobranças municipais e gere uma guia fictícia para demonstrar o fluxo de pagamento digital."
    />

    <section class="mx-auto max-w-7xl px-4 py-8 sm:px-6 lg:px-8">
        @if ($codigoGuia)
            <div class="mb-6 rounded-lg border border-teal-200 bg-teal-50 p-5">
                <p class="text-sm font-black uppercase tracking-wide text-teal-800">Guia gerada com sucesso</p>
                <p class="mt-2 text-lg font-black text-teal-950">{{ $codigoGuia }}</p>
                <p class="mt-1 text-sm leading-6 text-teal-900">Esta é uma guia simulada para {{ $taxaSelecionada }}. Em uma versão real, o botão integraria boleto, Pix ou gateway público.</p>
            </div>
        @endif

        <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-4">
            @foreach ($taxas as $taxa)
                <article class="rounded-lg border border-slate-200 bg-white p-5">
                    <p class="text-xs font-black uppercase tracking-wide text-teal-700">Tributo municipal</p>
                    <h2 class="mt-2 text-xl font-black text-slate-950">{{ $taxa['nome'] }}</h2>
                    <p class="mt-3 min-h-20 text-sm leading-6 text-slate-600">{{ $taxa['descricao'] }}</p>
                    <dl class="mt-4 space-y-2 text-sm">
                        <div class="flex items-center justify-between gap-3">
                            <dt class="font-bold text-slate-500">Valor</dt>
                            <dd class="font-black text-slate-950">{{ $taxa['valor'] }}</dd>
                        </div>
                        <div class="flex items-center justify-between gap-3">
                            <dt class="font-bold text-slate-500">Vencimento</dt>
                            <dd class="font-black text-slate-950">{{ $taxa['vencimento'] }}</dd>
                        </div>
                    </dl>
                    <a href="{{ route('pagamentos.index', ['guia' => $taxa['nome']]) }}" class="mt-5 inline-flex h-10 w-full items-center justify-center rounded-lg bg-teal-700 px-4 text-sm font-black text-white transition hover:bg-teal-800">
                        Gerar guia
                    </a>
                </article>
            @endforeach
        </div>

        <section class="mt-8 rounded-lg border border-slate-200 bg-white p-5">
            <h2 class="text-xl font-black text-slate-950">Evolução futura</h2>
            <p class="mt-2 text-sm leading-6 text-slate-600">O MVP não processa pagamentos reais. A proposta é demonstrar como o cidadão poderia consultar débitos, emitir segunda via e pagar impostos ou taxas em um só portal.</p>
        </section>
    </section>
@endsection
