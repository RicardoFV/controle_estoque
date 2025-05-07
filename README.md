# Estoque de Produtos - API

Este projeto é uma API para gerenciamento de estoque de produtos, incluindo funcionalidades para cadastro, autenticação, gerenciamento de categorias, produtos e movimentações de estoque. A API é protegida utilizando autenticação via Sanctum.

## Rotas Disponíveis

### Autenticação

#### Registrar Usuário

* **Endpoint:** `POST /registrar_usuario/cadastrar`
* **Descrição:** Cadastra um novo usuário.

#### Login

* **Endpoint:** `POST /auth/login`
* **Descrição:** Realiza login do usuário e retorna o token de autenticação.

### Rotas Protegidas (Requer Autenticação via Sanctum)

#### Usuários

* **Atualizar Usuário**:

  * **Endpoint:** `PUT /usuario/atualizar/{id}`
  * **Descrição:** Atualiza os dados de um usuário.
* **Consultar Usuário**:

  * **Endpoint:** `GET /usuario/consultar/{id}`
  * **Descrição:** Retorna os dados de um usuário específico.
* **Listar Usuários**:

  * **Endpoint:** `GET /usuario/listar`
  * **Descrição:** Retorna a lista de todos os usuários.
* **Deletar Usuário**:

  * **Endpoint:** `DELETE /usuario/deletar/{id}`
  * **Descrição:** Remove um usuário.

#### Categorias

* **Cadastrar Categoria**:

  * **Endpoint:** `POST /categoria/cadastrar`
  * **Descrição:** Adiciona uma nova categoria.
* **Atualizar Categoria**:

  * **Endpoint:** `PUT /categoria/atualizar/{id}`
  * **Descrição:** Atualiza uma categoria existente.
* **Consultar Categoria**:

  * **Endpoint:** `GET /categoria/consultar/{id}`
  * **Descrição:** Retorna os dados de uma categoria específica.
* **Listar Categorias**:

  * **Endpoint:** `GET /categoria/listar`
  * **Descrição:** Lista todas as categorias.
* **Deletar Categoria**:

  * **Endpoint:** `DELETE /categoria/deletar/{id}`
  * **Descrição:** Remove uma categoria.

#### Produtos

* **Cadastrar Produto**:

  * **Endpoint:** `POST /produto/cadastrar`
  * **Descrição:** Adiciona um novo produto.
* **Atualizar Produto**:

  * **Endpoint:** `PUT /produto/atualizar/{id}`
  * **Descrição:** Atualiza um produto existente.
* **Consultar Produto**:

  * **Endpoint:** `GET /produto/consultar/{id}`
  * **Descrição:** Retorna os dados de um produto específico.
* **Listar Produtos por Categoria**:

  * **Endpoint:** `GET /produto/por_categoria/{id}`
  * **Descrição:** Lista produtos de uma categoria específica.
* **Listar Produtos por Movimentação**:

  * **Endpoint:** `GET /produto/movimentacao/{id}`
  * **Descrição:** Lista produtos associados a uma movimentação específica.
* **Listar Produtos Sem Estoque**:

  * **Endpoint:** `GET /produto/sem_estoque`
  * **Descrição:** Lista produtos sem estoque disponível.
* **Listar Produtos Com Estoque**:

  * **Endpoint:** `GET /produto/com_estoque`
  * **Descrição:** Lista produtos com estoque disponível.
* **Listar Produtos**:

  * **Endpoint:** `GET /produto/listar`
  * **Descrição:** Lista todos os produtos cadastrados.

#### Movimentações

* **Registrar Movimentação**:

  * **Endpoint:** `POST /movimentacao/gerar`
  * **Descrição:** Registra uma nova movimentação de estoque.
* **Consultar Movimentação por Produto**:

  * **Endpoint:** `GET /movimentacao/movimentacaoes/{id}`
  * **Descrição:** Retorna as movimentações de um produto específico.
* **Listar Movimentações**:

  * **Endpoint:** `GET /movimentacao/listar`
  * **Descrição:** Lista todas as movimentações de estoque.
* **Deletar Movimentação**:

  * **Endpoint:** `DELETE /movimentacao/deletar/{id}`
  * **Descrição:** Remove uma movimentação de estoque.

## Tecnologias Utilizadas

* **Framework:** Laravel
* **Autenticação:** Sanctum
* **Banco de Dados:** MySQL
* **Servidor:** Nginx
* **Containerização:** Docker

## Configuração do Ambiente

### Configuração com Docker

1. Clone o repositório:

   ```bash
   git clone https://github.com/seu-repositorio/estoque-produtos.git
   ```

2. Crie um arquivo `.env` a partir do modelo:

   ```bash
   cp .env.example .env
   ```

3. Configure as credenciais do banco de dados e as variáveis de ambiente do Sanctum no arquivo `.env`.

4. Inicie os containers:

   ```bash
   docker-compose up -d
   ```

5. Execute as migrações dentro do container:

   ```bash
   docker exec -it app-container-name php artisan migrate
   ```

6. Acesse o projeto:

   * API disponível em: `http://localhost:8000`

### Configuração Local (Sem Docker)

1. Instale as dependências do Laravel:

   ```bash
   composer install
   ```

2. Configure o arquivo `.env`:

   * Defina as credenciais do banco de dados.
   * Configure as variáveis de ambiente para o Sanctum.

3. Execute as migrações:

   ```bash
   php artisan migrate
   ```

4. Inicie o servidor:

   ```bash
   php artisan serve
   ```

Pronto! Agora você pode utilizar a API para gerenciar o estoque de produtos.
