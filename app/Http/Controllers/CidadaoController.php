<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CidadaoController extends Controller
{
    public function home(): View
    {
        return view('home', [
            'servicos' => array_slice($this->dadosServicos(), 0, 4),
            'indicadores' => $this->indicadores(),
            'protocolos' => array_slice($this->protocolos(), 0, 2),
        ]);
    }

    public function dashboard(): View
    {
        return view('dashboard', [
            'servicos' => array_slice($this->dadosServicos(), 0, 5),
            'protocolos' => $this->protocolos(),
            'notificacoes' => $this->notificacoes(),
            'indicadores' => $this->indicadores(),
            'govtechCards' => $this->govtechCards(),
        ]);
    }

    public function servicos(): View
    {
        return view('servicos.index', [
            'servicos' => $this->dadosServicos(),
            'categorias' => $this->categorias(),
        ]);
    }

    public function novaSolicitacao(Request $request): View
    {
        return view('solicitacoes.create', [
            'servicos' => $this->dadosServicos(),
            'servicoSelecionado' => $request->query('servico'),
        ]);
    }

    public function enviarSolicitacao(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'servico' => ['required', 'string', 'max:120'],
            'descricao' => ['required', 'string', 'min:10', 'max:800'],
            'bairro' => ['required', 'string', 'max:120'],
            'endereco' => ['nullable', 'string', 'max:180'],
        ]);

        $protocolo = '2026-'.random_int(100000, 999999);

        return redirect()
            ->route('protocolos.show', ['id' => $protocolo])
            ->with('solicitacao', [
                'protocolo' => $protocolo,
                'servico' => $validated['servico'],
                'descricao' => $validated['descricao'],
                'bairro' => $validated['bairro'],
                'endereco' => $validated['endereco'] ?: 'Endereço não informado',
            ]);
    }

    public function protocolo(string $id): View
    {
        $solicitacao = session('solicitacao');

        return view('protocolos.show', [
            'protocolo' => $solicitacao['protocolo'] ?? $id,
            'servico' => $solicitacao['servico'] ?? 'Iluminação pública',
            'descricao' => $solicitacao['descricao'] ?? 'Troca de lâmpada em via pública com baixa iluminação no período noturno.',
            'bairro' => $solicitacao['bairro'] ?? 'Centro',
            'endereco' => $solicitacao['endereco'] ?? 'Rua das Palmeiras, próximo à praça principal',
            'linhaDoTempo' => $solicitacao['linhaDoTempo'] ?? $this->linhaDoTempo(),
        ]);
    }

    public function aberturaEmpresa(): View
    {
        return view('empresas.abertura', [
            'etapas' => $this->etapasAberturaEmpresa(),
            'documentos' => $this->documentosEmpresa(),
        ]);
    }

    public function enviarAberturaEmpresa(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nome_fantasia' => ['required', 'string', 'max:120'],
            'atividade' => ['required', 'string', 'max:160'],
            'responsavel' => ['required', 'string', 'max:120'],
            'bairro' => ['required', 'string', 'max:120'],
        ]);

        $protocolo = 'EMP-2026-'.random_int(1000, 9999);

        return redirect()
            ->route('protocolos.show', ['id' => $protocolo])
            ->with('solicitacao', [
                'protocolo' => $protocolo,
                'servico' => 'Abertura de empresa',
                'descricao' => "Pré-cadastro municipal para {$validated['nome_fantasia']}, atividade {$validated['atividade']}.",
                'bairro' => $validated['bairro'],
                'endereco' => 'Solicitação digital enviada por '.$validated['responsavel'],
                'linhaDoTempo' => $this->linhaDoTempoEmpresa(),
            ]);
    }

    public function pagamentos(Request $request): View
    {
        $codigoGuia = null;
        $taxaSelecionada = $request->query('guia');

        if ($taxaSelecionada) {
            $codigoGuia = 'GUIA-2026-'.str_pad((string) random_int(1, 99999), 5, '0', STR_PAD_LEFT);
        }

        return view('pagamentos.index', [
            'taxas' => $this->taxas(),
            'taxaSelecionada' => $taxaSelecionada,
            'codigoGuia' => $codigoGuia,
        ]);
    }

    public function consultaPublica(): View
    {
        return view('consulta-publica.index', [
            'opcoes' => $this->opcoesConsultaPublica(),
            'voto' => session('voto'),
            'totalVotos' => 1847,
        ]);
    }

    public function votarConsultaPublica(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'prioridade' => ['required', 'string', 'max:120'],
            'bairro' => ['required', 'string', 'max:120'],
        ]);

        $hash = substr(hash('sha256', $validated['prioridade'].'|'.$validated['bairro'].'|'.now()->toIso8601String()), 0, 16);

        return redirect()
            ->route('consulta-publica.index')
            ->with('voto', [
                'prioridade' => $validated['prioridade'],
                'bairro' => $validated['bairro'],
                'hash' => strtoupper($hash),
            ]);
    }

    public function transparencia(): View
    {
        return view('transparencia.index', [
            'indicadores' => $this->indicadores(),
            'demandasPorBairro' => $this->demandasPorBairro(),
            'servicosMaisSolicitados' => $this->servicosMaisSolicitados(),
            'tempoAtendimento' => $this->tempoAtendimento(),
            'satisfacao' => $this->satisfacao(),
            'auditoriaConsulta' => $this->auditoriaConsulta(),
        ]);
    }

    public function perfil(): View
    {
        return view('perfil.show', [
            'usuario' => [
                'nome' => 'Maria Oliveira',
                'email' => 'maria.oliveira@email.com',
                'cpf' => '***.***.***-42',
                'telefone' => '(98) 90000-0142',
                'endereço' => 'Rua das Palmeiras, Centro',
                'notificação' => 'E-mail e WhatsApp',
            ],
        ]);
    }

    private function dadosServicos(): array
    {
        return [
            [
                'nome' => 'Iluminação pública',
                'categoria' => 'Infraestrutura',
                'descricao' => 'Solicite troca de lâmpadas, postes apagados ou pontos com baixa iluminação.',
                'prazo' => 'Até 5 dias úteis',
                'status' => 'Mais acessado',
            ],
            [
                'nome' => 'Buracos na rua',
                'categoria' => 'Infraestrutura',
                'descricao' => 'Informe problemas em vias públicas com endereço, referência e descrição.',
                'prazo' => 'Até 10 dias úteis',
                'status' => 'Prioritário',
            ],
            [
                'nome' => 'Coleta de lixo',
                'categoria' => 'Limpeza urbana',
                'descricao' => 'Acompanhe rotas, solicite recolhimento e registre atrasos na coleta.',
                'prazo' => 'Até 3 dias úteis',
                'status' => 'Rápido',
            ],
            [
                'nome' => 'Emissão de documentos',
                'categoria' => 'Documentos',
                'descricao' => 'Consulte certidões, declarações e documentos municipais disponíveis.',
                'prazo' => 'Atendimento digital',
                'status' => 'Online',
            ],
            [
                'nome' => 'Pagamento de taxas',
                'categoria' => 'Finanças públicas',
                'descricao' => 'Acesse guias, taxas municipais e segunda via de pagamentos.',
                'prazo' => 'Imediato',
                'status' => 'Online',
                'rota' => 'pagamentos.index',
            ],
            [
                'nome' => 'Abertura de empresa',
                'categoria' => 'Empresas',
                'descricao' => 'Encontre orientação para formalização, licenças e acompanhamento inicial.',
                'prazo' => 'Até 15 dias úteis',
                'status' => 'Novo',
                'rota' => 'empresas.abertura',
            ],
        ];
    }

    private function categorias(): array
    {
        return ['Todos', 'Infraestrutura', 'Limpeza urbana', 'Documentos', 'Finanças públicas', 'Empresas'];
    }

    private function protocolos(): array
    {
        return [
            [
                'numero' => '2026-001245',
                'servico' => 'Iluminação pública',
                'bairro' => 'Centro',
                'status' => 'Em execução',
                'atualizado' => 'Hoje, 09:20',
                'progresso' => 72,
            ],
            [
                'numero' => '2026-001198',
                'servico' => 'Buracos na rua',
                'bairro' => 'Cohama',
                'status' => 'Em análise',
                'atualizado' => 'Ontem, 16:40',
                'progresso' => 42,
            ],
            [
                'numero' => '2026-001066',
                'servico' => 'Coleta de lixo',
                'bairro' => 'Turu',
                'status' => 'Concluído',
                'atualizado' => '08/05/2026',
                'progresso' => 100,
            ],
        ];
    }

    private function notificacoes(): array
    {
        return [
            'Sua solicitação 2026-001245 foi encaminhada para equipe de campo.',
            'A coleta programada no Turu foi concluída dentro do prazo.',
            'Novo serviço digital disponível: emissão de certidões municipais.',
            'Consulta pública aberta: escolha a prioridade do seu bairro.',
        ];
    }

    private function indicadores(): array
    {
        return [
            ['rotulo' => 'Solicitações abertas', 'valor' => '1.248', 'variacao' => '+18% no mês'],
            ['rotulo' => 'Concluídas', 'valor' => '932', 'variacao' => '75% resolvidas'],
            ['rotulo' => 'Tempo médio', 'valor' => '3,8 dias', 'variacao' => '-22% desde abril'],
            ['rotulo' => 'Bairros atendidos', 'valor' => '42', 'variacao' => 'Cobertura municipal'],
        ];
    }

    private function govtechCards(): array
    {
        return [
            [
                'titulo' => 'Abertura de empresa',
                'descricao' => 'Pré-cadastro, checklist de documentos e protocolo digital.',
                'rota' => 'empresas.abertura',
            ],
            [
                'titulo' => 'Pagamentos e taxas',
                'descricao' => 'Guias simuladas para IPTU, alvará e taxas municipais.',
                'rota' => 'pagamentos.index',
            ],
            [
                'titulo' => 'Consulta pública',
                'descricao' => 'Votação simulada com hash de auditoria para transparência.',
                'rota' => 'consulta-publica.index',
            ],
        ];
    }

    private function demandasPorBairro(): array
    {
        return [
            ['bairro' => 'Centro', 'total' => 312, 'percentual' => 88],
            ['bairro' => 'Cohama', 'total' => 245, 'percentual' => 69],
            ['bairro' => 'Turu', 'total' => 198, 'percentual' => 56],
            ['bairro' => 'Anil', 'total' => 154, 'percentual' => 43],
            ['bairro' => 'Renascença', 'total' => 121, 'percentual' => 34],
        ];
    }

    private function servicosMaisSolicitados(): array
    {
        return [
            ['servico' => 'Iluminação pública', 'total' => 428],
            ['servico' => 'Buracos na rua', 'total' => 336],
            ['servico' => 'Coleta de lixo', 'total' => 219],
            ['servico' => 'Emissão de documentos', 'total' => 183],
        ];
    }

    private function linhaDoTempo(): array
    {
        return [
            ['status' => 'Enviado', 'descricao' => 'Solicitação registrada no Cidadão360.', 'data' => 'Hoje, 08:14', 'ativo' => true],
            ['status' => 'Em análise', 'descricao' => 'Triagem feita pela central de atendimento.', 'data' => 'Hoje, 08:42', 'ativo' => true],
            ['status' => 'Em execução', 'descricao' => 'Equipe responsável recebeu o chamado.', 'data' => 'Hoje, 09:20', 'ativo' => true],
            ['status' => 'Concluído', 'descricao' => 'Aguardando atualização final da equipe.', 'data' => 'Pendente', 'ativo' => false],
        ];
    }

    private function etapasAberturaEmpresa(): array
    {
        return [
            ['titulo' => 'Pré-cadastro', 'descricao' => 'Informe nome, atividade e responsável legal.'],
            ['titulo' => 'Documentos', 'descricao' => 'Confira o checklist para evitar ida presencial.'],
            ['titulo' => 'Análise municipal', 'descricao' => 'A prefeitura valida zoneamento e exigências.'],
            ['titulo' => 'Liberação', 'descricao' => 'O protocolo indica aprovação ou pendências.'],
        ];
    }

    private function documentosEmpresa(): array
    {
        return [
            'Documento do responsável legal',
            'Comprovante de endereço',
            'Contrato social ou MEI',
            'Descrição da atividade econômica',
            'Consulta de viabilidade do local',
        ];
    }

    private function linhaDoTempoEmpresa(): array
    {
        return [
            ['status' => 'Pré-cadastro enviado', 'descricao' => 'Dados básicos da empresa recebidos.', 'data' => 'Agora', 'ativo' => true],
            ['status' => 'Documentos pendentes', 'descricao' => 'Checklist disponível para conferência.', 'data' => 'Próxima etapa', 'ativo' => true],
            ['status' => 'Análise municipal', 'descricao' => 'Validação de atividade e localização.', 'data' => 'Pendente', 'ativo' => false],
            ['status' => 'Liberação', 'descricao' => 'Emissão de autorização ou pendências.', 'data' => 'Pendente', 'ativo' => false],
        ];
    }

    private function taxas(): array
    {
        return [
            ['nome' => 'IPTU 2026', 'descricao' => 'Consulta e segunda via do imposto predial.', 'valor' => 'R$ 482,70', 'vencimento' => '30/06/2026'],
            ['nome' => 'Alvará de funcionamento', 'descricao' => 'Taxa anual para funcionamento de estabelecimento.', 'valor' => 'R$ 156,40', 'vencimento' => '15/07/2026'],
            ['nome' => 'Licença municipal', 'descricao' => 'Emissão ou renovação de licença municipal.', 'valor' => 'R$ 94,20', 'vencimento' => '20/07/2026'],
            ['nome' => 'Taxa de coleta', 'descricao' => 'Serviço urbano de coleta e destinação de resíduos.', 'valor' => 'R$ 38,90', 'vencimento' => '10/08/2026'],
        ];
    }

    private function opcoesConsultaPublica(): array
    {
        return [
            ['nome' => 'Iluminação pública', 'percentual' => 34, 'votos' => 628],
            ['nome' => 'Asfalto e buracos', 'percentual' => 28, 'votos' => 517],
            ['nome' => 'Limpeza urbana', 'percentual' => 21, 'votos' => 388],
            ['nome' => 'Abertura de empresas', 'percentual' => 17, 'votos' => 314],
        ];
    }

    private function tempoAtendimento(): array
    {
        return [
            ['servico' => 'Iluminação pública', 'tempo' => '2,4 dias', 'meta' => '5 dias', 'percentual' => 82],
            ['servico' => 'Buracos na rua', 'tempo' => '6,1 dias', 'meta' => '10 dias', 'percentual' => 64],
            ['servico' => 'Coleta de lixo', 'tempo' => '1,8 dia', 'meta' => '3 dias', 'percentual' => 76],
            ['servico' => 'Abertura de empresa', 'tempo' => '8,6 dias', 'meta' => '15 dias', 'percentual' => 58],
        ];
    }

    private function satisfacao(): array
    {
        return [
            ['rotulo' => 'Muito satisfeito', 'percentual' => 46],
            ['rotulo' => 'Satisfeito', 'percentual' => 31],
            ['rotulo' => 'Regular', 'percentual' => 16],
            ['rotulo' => 'Insatisfeito', 'percentual' => 7],
        ];
    }

    private function auditoriaConsulta(): array
    {
        return [
            'consulta' => 'Prioridades do bairro 2026',
            'votos' => '1.847',
            'hash' => 'A9F3-7C21-6E88-2B10',
            'observacao' => 'Hash simulado para demonstrar trilha de auditoria e futura integração com blockchain.',
        ];
    }
}
