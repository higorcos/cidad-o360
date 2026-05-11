@extends('layouts.app')

@section('title', 'Nova Solicitação | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Atendimento digital"
        title="Abrir nova solicitação"
        description="Preencha os dados do pedido. Nesta versão MVP, o envio gera um protocolo simulado para apresentação."
    />

    <section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_22rem] lg:px-8">
        <form method="POST" action="{{ route('solicitacoes.store') }}" class="rounded-lg border border-slate-200 bg-white p-5">
            @csrf

            <div class="grid gap-5">
                <label class="block">
                    <span class="text-sm font-black text-slate-800">Tipo de serviço</span>
                    <select name="servico" class="mt-2 h-12 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm font-semibold text-slate-900 focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100">
                        <option value="">Selecione um serviço</option>
                        @foreach ($servicos as $servico)
                            <option value="{{ $servico['nome'] }}" @selected(old('servico', $servicoSelecionado) === $servico['nome'])>
                                {{ $servico['nome'] }}
                            </option>
                        @endforeach
                    </select>
                    @error('servico')
                        <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                    @enderror
                </label>

                <label class="block">
                    <span class="text-sm font-black text-slate-800">Descrição do problema</span>
                    <textarea name="descricao" rows="6" class="mt-2 w-full rounded-lg border border-slate-300 px-3 py-3 text-sm leading-6 text-slate-900 focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Ex.: Poste apagado há três dias em frente à praça.">{{ old('descricao') }}</textarea>
                    @error('descricao')
                        <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                    @enderror
                </label>

                <div class="grid gap-5 md:grid-cols-2">
                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Bairro</span>
                        <input name="bairro" value="{{ old('bairro') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold text-slate-900 focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Centro">
                        @error('bairro')
                            <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                        @enderror
                    </label>

                    <label class="block">
                        <span class="text-sm font-black text-slate-800">Endereço ou referência</span>
                        <input name="endereco" value="{{ old('endereco') }}" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold text-slate-900 focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Rua, número ou ponto próximo">
                    </label>
                </div>

                <div class="rounded-lg border border-dashed border-slate-300 bg-stone-50 p-5">
                    <p class="text-sm font-black text-slate-800">Anexo simulado</p>
                    <p class="mt-1 text-sm leading-6 text-slate-500">No MVP, o upload é apenas visual. Na versão com banco, aqui entram fotos e documentos.</p>
                    <button type="button" class="mt-4 rounded-lg border border-slate-300 bg-white px-4 py-2 text-sm font-black text-slate-700">Selecionar arquivo</button>
                </div>

                <div class="flex flex-col-reverse gap-3 border-t border-slate-200 pt-5 sm:flex-row sm:justify-end">
                    <a href="{{ route('servicos.index') }}" class="inline-flex h-11 items-center justify-center rounded-lg border border-slate-300 px-5 text-sm font-black text-slate-700 transition hover:border-slate-400">
                        Cancelar
                    </a>
                    <button class="inline-flex h-11 items-center justify-center rounded-lg bg-teal-700 px-5 text-sm font-black text-white transition hover:bg-teal-800">
                        Enviar solicitação
                    </button>
                </div>
            </div>
        </form>

        <aside class="space-y-4">
            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-lg font-black text-slate-950">Como funciona</h2>
                <ol class="mt-4 space-y-3 text-sm leading-6 text-slate-600">
                    <li><strong class="text-slate-900">1.</strong> O cidadão descreve a demanda.</li>
                    <li><strong class="text-slate-900">2.</strong> O sistema gera um protocolo.</li>
                    <li><strong class="text-slate-900">3.</strong> A prefeitura acompanha o status.</li>
                </ol>
            </section>

            <section class="rounded-lg border border-teal-200 bg-teal-50 p-5">
                <p class="text-sm font-black uppercase tracking-wide text-teal-800">MVP sem banco</p>
                <p class="mt-2 text-sm leading-6 text-teal-900">Os dados desta tela são temporários e servem para demonstrar o fluxo no pitch.</p>
            </section>
        </aside>
    </section>
@endsection
