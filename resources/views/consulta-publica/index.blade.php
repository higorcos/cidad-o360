@extends('layouts.app')

@section('title', 'Consulta Pública | Cidadão360')

@section('content')
    <x-page-header
        eyebrow="Participação cidadã"
        title="Consulta pública de prioridades"
        description="Vote na prioridade do seu bairro e veja resultados simulados com código de auditoria."
    />

    <section class="mx-auto grid max-w-7xl gap-6 px-4 py-8 sm:px-6 lg:grid-cols-[1fr_24rem] lg:px-8">
        <div class="space-y-6">
            @if ($voto)
                <section class="rounded-lg border border-teal-200 bg-teal-50 p-5">
                    <p class="text-sm font-black uppercase tracking-wide text-teal-800">Voto registrado</p>
                    <p class="mt-2 text-lg font-black text-teal-950">{{ $voto['prioridade'] }} · {{ $voto['bairro'] }}</p>
                    <p class="mt-2 text-sm leading-6 text-teal-900">Hash de auditoria simulado: <strong>{{ $voto['hash'] }}</strong></p>
                </section>
            @endif

            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <h2 class="text-xl font-black text-slate-950">Resultado parcial</h2>
                <p class="mt-1 text-sm text-slate-500">{{ $totalVotos }} votos simulados registrados.</p>
                <div class="mt-6 space-y-4">
                    @foreach ($opcoes as $opcao)
                        <div>
                            <div class="flex items-center justify-between gap-3">
                                <span class="text-sm font-black text-slate-800">{{ $opcao['nome'] }}</span>
                                <span class="text-sm font-bold text-slate-500">{{ $opcao['votos'] }} votos</span>
                            </div>
                            <div class="mt-2 h-3 rounded-full bg-slate-100">
                                <div class="h-3 rounded-full bg-teal-600" style="width: {{ $opcao['percentual'] }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>

        <aside class="space-y-4">
            <form method="POST" action="{{ route('consulta-publica.votar') }}" class="rounded-lg border border-slate-200 bg-white p-5">
                @csrf

                <h2 class="text-lg font-black text-slate-950">Registrar voto simulado</h2>
                <label class="mt-4 block">
                    <span class="text-sm font-black text-slate-800">Prioridade</span>
                    <select name="prioridade" class="mt-2 h-12 w-full rounded-lg border border-slate-300 bg-white px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100">
                        <option value="">Selecione</option>
                        @foreach ($opcoes as $opcao)
                            <option value="{{ $opcao['nome'] }}">{{ $opcao['nome'] }}</option>
                        @endforeach
                    </select>
                    @error('prioridade')
                        <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                    @enderror
                </label>

                <label class="mt-4 block">
                    <span class="text-sm font-black text-slate-800">Bairro</span>
                    <input name="bairro" class="mt-2 h-12 w-full rounded-lg border border-slate-300 px-3 text-sm font-semibold focus:border-teal-700 focus:outline-none focus:ring-2 focus:ring-teal-100" placeholder="Centro">
                    @error('bairro')
                        <span class="mt-2 block text-sm font-bold text-red-700">{{ $message }}</span>
                    @enderror
                </label>

                <button class="mt-5 inline-flex h-11 w-full items-center justify-center rounded-lg bg-teal-700 px-5 text-sm font-black text-white transition hover:bg-teal-800">
                    Votar
                </button>
            </form>

            <section class="rounded-lg border border-slate-200 bg-white p-5">
                <p class="text-sm font-black uppercase tracking-wide text-slate-500">Blockchain no pitch</p>
                <p class="mt-2 text-sm leading-6 text-slate-600">O MVP usa hash simulado. No pitch, explique que uma versão futura poderia registrar votos em blockchain para auditoria pública.</p>
            </section>
        </aside>
    </section>
@endsection
