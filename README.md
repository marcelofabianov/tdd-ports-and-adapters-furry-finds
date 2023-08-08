# FurryFinds: Demonstrando a Arquitetura Hexagonal e TDD

Bem-vindo ao repositório do FurryFinds! 
Neste projeto, você encontrará uma implementação prática da arquitetura de software Ports and Adapters, 
também conhecida como "Arquitetura Hexagonal", combinada com a metodologia de Desenvolvimento Orientado a Testes (TDD). 
O objetivo é criar um mercado virtual que conecta fornecedores de produtos de petshop a compradores finais

## Sobre o Projeto

O FurFriend Market é um catálogo online de produtos de petshop, criado para demonstrar 
a aplicação somente um exemplo da arquitetura hexagonal e do TDD em um cenário real. A ideia do domínio veio simplesmente pelo fato 
que gosto muito de animais e nesta noite antes de começar a codar estava em uma loja fisica de petshop.

## Tecnologias

- **Arquitetura Hexagonal**: Organizaremos nosso sistema em camadas distintas, separando as regras de negócios do código de adaptação externa.
- **Desenvolvimento Orientado a Testes (TDD)**: Desenvolveremos nosso software com base em testes, garantindo que a qualidade seja mantida e a evolução do código seja segura.
- **Linguagem de Programação**: Utilizaremos php como linguagem principal de desenvolvimento.
- **Bibliotecas e Frameworks**: objetivo deixar o projeto com mínimo possível de dependências, porém utilizaremos algumas bibliotecas e frameworks para testes e qualidade de codigo.
- **Banco de Dados**: Utilizaremos o banco de dados Postgres para armazenar os dados do sistema.
- **Docker**: Utilizaremos o docker para facilitar a execução do projeto.
- **CI/CD**: Utilizaremos o github actions para executar os testes e garantir a qualidade do código.

### Como executar o projeto

O projeto ainda esta sendo construído até o momento não temos uma versão de produção, porém você pode executar o projeto localmente
e ver o andamento do projeto.

__Não leve muito a sério o domínio e tambem as features empregas no projeto, o objetivo é apenas demonstrar as arquiteturas.__

#### Pré-requisitos

- [Docker](https://docs.docker.com/get-docker/)
- [Docker Compose](https://docs.docker.com/compose/install/)
- [Git](https://git-scm.com/downloads)

#### Executando o projeto

1. Clone o repositório

```bash
git clone https://github.com/marcelofabianov/tdd-ports-and-adapters.git
```

2. Copie o arquivo inicializador do projeto

```bash
cp _docker/local/localhost.init.sh .
```

3. Execute o arquivo inicializador

```bash
chmod +x localhost.init.sh && sh localhost.init.sh
```

4. Acompanhe o script sendo executado em seu terminal

#### Extra

Coloquei um alias.sh para facilitar a execução do projeto, caso queira utilizar basta executar o comando abaixo:

```bash
source alias.sh
```

e depois

```bash
furry
```