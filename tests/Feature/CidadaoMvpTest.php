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
}
