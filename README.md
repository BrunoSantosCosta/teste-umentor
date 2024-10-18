# Tabela de Usuários - Atualização em Tempo Real

Este projeto é um aplicativo web que exibe uma tabela de usuários com atualização em tempo real à medida que novos usuários são adicionados ao sistema. O backend foi implementado em PHP e a interface do usuário em HTML, CSS e JavaScript. A aplicação também utiliza AJAX para evitar recarregamento da página e fornecer uma experiência de usuário dinâmica. Além disso, a aplicação suporta filtros de pesquisa e conta com um CRUD básico para gerenciar os usuários.

## Funcionalidades

- Exibição de uma tabela de usuários com os seguintes campos:
  - ID
  - Nome
  - Email
  - Situação
  - Data de Admissão
  - Data e Hora de Cadastro
  - Data e Hora de Atualização
- Atualização em tempo real utilizando AJAX.
- Botão "Adicionar Usuário" para inserir novos usuários.
- Validação de formulário para garantir que os campos do usuário sejam preenchidos.
- Filtro de pesquisa para buscar informações dentro da tabela.
- Estilização responsiva utilizando Bootstrap.
- CRUD completo (Criar, Ler, Atualizar, Deletar).
- SweetAlert2 para mensagens interativas e feedbacks ao usuário.
- Implementação da arquitetura MVC (Model-View-Controller) para separar as responsabilidades do código.
- Uso de Git para versionamento do código.

## Tecnologias Utilizadas

- **PHP**: Backend e conexão com o banco de dados.
- **MySQL**: Armazenamento dos dados dos usuários.
- **HTML, CSS**: Estrutura e estilização da interface.
- **JavaScript**: Interatividade e requisições AJAX.
- **jQuery**: Facilitar as operações AJAX e manipulação do DOM.
- **Bootstrap**: Framework CSS para estilização e responsividade.
- **SweetAlert2**: Biblioteca para melhorar a interação com o usuário.
- **Git**: Versionamento do código.

## Estrutura do Projeto

O projeto segue o padrão de arquitetura MVC (Model-View-Controller), separando claramente as responsabilidades:

- **Model**: Lida com a lógica de negócios e interação com o banco de dados.
- **View**: Contém a interface do usuário, construída com HTML e estilizada com CSS/Bootstrap.
- **Controller**: Gerencia a comunicação entre a View e o Model, controlando as requisições e respostas.

## Como Rodar o Projeto

### Pré-requisitos

- PHP instalado na máquina (preferência pela versão 7.4 ou superior).
- MySQL ou outro banco de dados compatível.
- Git instalado.

### Passos para Instalação

1. Clone o repositório do GitHub:

    ```bash
    git clone https://github.com/BrunoSantosCosta/teste-umentor.git
    ```

2. Navegue até o diretório do projeto:

    ```bash
    cd repo
    ```

3. Configure o banco de dados:
    - Crie um banco de dados MySQL.
    - No arquivo `config.php`, insira as credenciais do seu banco de dados (nome, usuário, senha).

4. Crie a tabela chamada `teste_umentor` e selecione-a para rodar os comandos subsequentes:

    ```sql
    CREATE DATABASE teste_umentor;
    USE teste_umentor;
    ```

5. Execute o script SQL para criar as tabelas de usuários:

    ```sql
    CREATE TABLE usuarios (
      id INT AUTO_INCREMENT PRIMARY KEY,
      nome VARCHAR(255) NOT NULL,
      email VARCHAR(255) NOT NULL,
      situacao VARCHAR(50),
      data_admissao DATE,
      data_cadastro TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
      data_atualizacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    ```

6. Inicie o servidor PHP:

    ```bash
    php -S localhost:8000
    ```

7. Acesse o aplicativo no navegador através de:

    ```bash
    http://localhost:8000
    ```

## Funcionalidades Adicionais

- **CRUD Completo**: Além de adicionar usuários, você pode editá-los, deletá-los e visualizar suas informações em tempo real.
- **Validação**: O formulário de cadastro possui validação básica para evitar campos vazios.
- **Filtros de Pesquisa**: Você pode filtrar os usuários pelo nome ou e-mail diretamente na tabela.
- **Mensagens interativas**: Utilizamos o SweetAlert2 para feedbacks mais dinâmicos e esteticamente agradáveis, como alertas de confirmação e sucesso.
