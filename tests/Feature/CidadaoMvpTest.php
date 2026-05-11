<?php

namespace Tests\Feature;

use Tests\TestCase;

class CidadaoMvpTest extends TestCase
{
    public function test_paginas_principais_do_mvp_renderizam(): void
    {
        $this->get('/')->assertOk()->assertSee('Prefeitura na palma da mão do cidadão');
        $this->get('/dashboard')->assertOk()->assertSee('Protocolos em andamento');
        $this->get('/servicos')->assertOk()->assertSee('Iluminação pública');
        $this->get('/solicitacoes/nova')->assertOk()->assertSee('Abrir nova solicitação');
        $this->get('/empresas/abertura')->assertOk()->assertSee('Abertura de empresa digital');
        $this->get('/pagamentos')->assertOk()->assertSee('Taxas municipais e guias simuladas');
        $this->get('/consulta-publica')->assertOk()->assertSee('Consulta pública de prioridades');
        $this->get('/transparencia')->assertOk()->assertSee('Indicadores de atendimento');
        $this->get('/perfil')->assertOk()->assertSee('Maria Oliveira');
    }

    public function test_envio_de_solicitacao_gera_redirecionamento_para_protocolo(): void
    {
        $response = $this->post('/solicitacoes', [
            'servico' => 'Iluminação pública',
            'descricao' => 'Poste apagado há três dias na praça principal do bairro.',
            'bairro' => 'Centro',
            'endereco' => 'Rua das Palmeiras',
        ]);

        $response->assertRedirect();
        $this->assertStringContainsString('/protocolos/2026-', $response->headers->get('Location'));
    }

    public function test_abertura_de_empresa_gera_protocolo_empresarial(): void
    {
        $response = $this->post('/empresas/abertura', [
            'nome_fantasia' => 'Mercado da Maria',
            'atividade' => 'Comércio varejista',
            'responsavel' => 'Maria Oliveira',
            'bairro' => 'Centro',
        ]);

        $response->assertRedirect();
        $this->assertStringContainsString('/protocolos/EMP-2026-', $response->headers->get('Location'));
    }

    public function test_consulta_publica_registra_voto_simulado(): void
    {
        $response = $this->post('/consulta-publica/votar', [
            'prioridade' => 'Iluminação pública',
            'bairro' => 'Centro',
        ]);

        $response->assertRedirect('/consulta-publica');
        $response->assertSessionHas('voto');
    }
}
