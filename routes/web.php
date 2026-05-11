<?php

use App\Http\Controllers\CidadaoController;
use Illuminate\Support\Facades\Route;

Route::get('/', [CidadaoController::class, 'home'])->name('home');
Route::get('/dashboard', [CidadaoController::class, 'dashboard'])->name('dashboard');
Route::get('/servicos', [CidadaoController::class, 'servicos'])->name('servicos.index');
Route::get('/solicitacoes/nova', [CidadaoController::class, 'novaSolicitacao'])->name('solicitacoes.create');
Route::post('/solicitacoes', [CidadaoController::class, 'enviarSolicitacao'])->name('solicitacoes.store');
Route::get('/empresas/abertura', [CidadaoController::class, 'aberturaEmpresa'])->name('empresas.abertura');
Route::post('/empresas/abertura', [CidadaoController::class, 'enviarAberturaEmpresa'])->name('empresas.abertura.store');
Route::get('/pagamentos', [CidadaoController::class, 'pagamentos'])->name('pagamentos.index');
Route::get('/consulta-publica', [CidadaoController::class, 'consultaPublica'])->name('consulta-publica.index');
Route::post('/consulta-publica/votar', [CidadaoController::class, 'votarConsultaPublica'])->name('consulta-publica.votar');
Route::get('/protocolos/{id}', [CidadaoController::class, 'protocolo'])->name('protocolos.show');
Route::get('/transparencia', [CidadaoController::class, 'transparencia'])->name('transparencia.index');
Route::get('/perfil', [CidadaoController::class, 'perfil'])->name('perfil.show');
