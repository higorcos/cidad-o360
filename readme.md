# Cidadão360

MVP GovTech para aproximar cidadãos e prefeitura por meio de um portal digital simples, transparente e acessível.

O projeto permite consultar serviços públicos, abrir uma solicitação simulada, acompanhar protocolo, visualizar indicadores de transparência e acessar um perfil de cidadão com dados fictícios.

## Objetivo da P2

Entregar um pitch de startup com:

- MVP de app funcional, com front-end executável e sem necessidade de banco de dados.
- Projeto no Figma.
- Wireframe.
- Mapa de personas.
- Arquitetura da informação.
- Área de atuação definida.

## Área de Atuação

GovTech, com foco em serviços públicos digitais municipais.

## Problema

Cidadãos perdem tempo tentando descobrir onde solicitar serviços públicos, quais documentos são necessários e como acompanhar o andamento de pedidos.

Do lado da prefeitura, demandas chegam por muitos canais diferentes, dificultando organização, priorização e transparência.

## Solução

O Cidadão360 centraliza serviços públicos municipais em um único app. O cidadão pode consultar serviços, abrir solicitações, acompanhar protocolos e ver indicadores públicos.

Para a prefeitura, a plataforma organiza demandas e gera dados para tomada de decisão.

## Pitch Resumido

O Cidadão360 é uma plataforma GovTech que coloca a prefeitura na palma da mão do cidadão. Nosso MVP permite consultar serviços públicos, abrir solicitações como iluminação pública, buracos na rua, coleta de lixo e emissão de documentos, além de acompanhar cada pedido por protocolo.

Com isso, reduzimos burocracia, aumentamos a transparência e ajudamos a gestão pública a responder melhor às necessidades da população.

## Stack

- Laravel 13
- Laravel Sail
- Docker
- Blade
- Vite
- Tailwind CSS 4
- PHPUnit
- PostgreSQL, Redis e Mailpit configurados no Sail para evolução futura

## Telas Implementadas

- Tela inicial
- Dashboard do cidadão
- Lista de serviços
- Formulário de nova solicitação
- Acompanhamento de protocolo
- Transparência pública
- Perfil do cidadão

## Rotas

```text
GET  /                    Tela inicial
GET  /dashboard           Dashboard do cidadão
GET  /servicos            Lista de serviços
GET  /solicitacoes/nova   Formulário de solicitação
POST /solicitacoes        Gera protocolo simulado
GET  /protocolos/{id}     Acompanhamento do protocolo
GET  /transparencia       Indicadores públicos
GET  /perfil              Perfil do usuário
```

## Como Rodar com Sail

Suba os containers:

```bash
./vendor/bin/sail up -d
```

Rode as migrations se quiser preparar o banco para evolução futura:

```bash
./vendor/bin/sail artisan migrate
```

Inicie o Vite:

```bash
./vendor/bin/sail npm run dev
```

Acesse:

```text
http://localhost:8095
```

Mailpit:

```text
http://localhost:8026
```

## Como Rodar sem Docker

Instale dependências:

```bash
composer install
npm install
```

Rode o build:

```bash
npm run build
```

Inicie o servidor:

```bash
php artisan serve --port=8095
```

## Testes

```bash
php artisan test
```

Ou com Sail:

```bash
./vendor/bin/sail artisan test
```

## Estrutura Principal

```text
app/Http/Controllers/CidadaoController.php
resources/views/layouts/app.blade.php
resources/views/home.blade.php
resources/views/dashboard.blade.php
resources/views/servicos/index.blade.php
resources/views/solicitacoes/create.blade.php
resources/views/protocolos/show.blade.php
resources/views/transparencia/index.blade.php
resources/views/perfil/show.blade.php
routes/web.php
```

## Personas

### Maria, cidadã comum

- Idade: 42 anos.
- Profissão: comerciante.
- Objetivo: resolver problemas do bairro sem ir à prefeitura.
- Dores: falta de tempo, dificuldade para saber onde solicitar serviços e pouca transparência.

### João, servidor público

- Idade: 35 anos.
- Profissão: atendente da prefeitura.
- Objetivo: organizar melhor as demandas recebidas.
- Dores: muitos pedidos por telefone, papelada e dificuldade em priorizar chamados.

### Ana, gestora pública

- Idade: 50 anos.
- Cargo: secretária municipal de administração.
- Objetivo: melhorar a eficiência dos serviços públicos.
- Dores: falta de dados para tomada de decisão e baixa satisfação da população.

## Arquitetura da Informação

```text
Cidadão360
|
|-- Início
|   |-- Serviços em destaque
|   |-- Protocolos recentes
|   |-- Indicadores resumidos
|
|-- Serviços Públicos
|   |-- Infraestrutura
|   |-- Limpeza urbana
|   |-- Documentos
|   |-- Finanças públicas
|   |-- Empresas
|
|-- Solicitações
|   |-- Nova solicitação
|   |-- Protocolo
|   |-- Linha do tempo
|
|-- Transparência
|   |-- Indicadores
|   |-- Demandas por bairro
|   |-- Serviços mais solicitados
|
|-- Perfil
    |-- Dados do usuário
    |-- Endereço
    |-- Preferências
```

## Figma e Wireframe

Telas recomendadas para o Figma:

- Splash ou tela inicial.
- Dashboard.
- Lista de serviços.
- Formulário de solicitação.
- Tela de protocolo.
- Transparência.
- Perfil.

Frase final do pitch:

> Com o Cidadão360, a prefeitura fica na palma da mão do cidadão: menos burocracia, mais transparência e serviços públicos mais eficientes.
