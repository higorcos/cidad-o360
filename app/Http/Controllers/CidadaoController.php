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
            'linhaDoTempo' => $this->linhaDoTempo(),
        ]);
    }

    public function transparencia(): View
    {
        return view('transparencia.index', [
            'indicadores' => $this->indicadores(),
            'demandasPorBairro' => $this->demandasPorBairro(),
            'servicosMaisSolicitados' => $this->servicosMaisSolicitados(),
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
            ],
            [
                'nome' => 'Abertura de empresa',
                'categoria' => 'Empresas',
                'descricao' => 'Encontre orientação para formalização, licenças e acompanhamento inicial.',
                'prazo' => 'Até 15 dias úteis',
                'status' => 'Novo',
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
}
