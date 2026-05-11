<?php

use App\Http\Controllers\CidadaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CidadaoController::class, 'home'])->name('home');
Route::get('/dashboard', [CidadaoController::class, 'dashboard'])->name('dashboard');
Route::get('/servicos', [CidadaoController::class, 'servicos'])->name('servicos.index');
Route::get('/solicitacoes/nova', [CidadaoController::class, 'novaSolicitacao'])->name('solicitacoes.create');
Route::post('/solicitacoes', [CidadaoController::class, 'enviarSolicitacao'])->name('solicitacoes.store');
Route::get('/protocolos/{id}', [CidadaoController::class, 'protocolo'])->name('protocolos.show');
Route::get('/transparencia', [CidadaoController::class, 'transparencia'])->name('transparencia.index');
Route::get('/perfil', [CidadaoController::class, 'perfil'])->name('perfil.show');
