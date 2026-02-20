# Helpdesk System

Sistema de gestão de chamados (Helpdesk) desenvolvido com Laravel, com API REST, interface web, filtros e paginação.

O objetivo do projeto é permitir o gerenciamento de chamados de suporte de forma simples, organizada e escalável.

---

# Funcionalidades

- Criar chamados
- Listar chamados
- Filtrar chamados por:
  - Status
  - Categoria
- Deletar chamados
- Criar categorias
- Listar categorias
- Paginação de resultados
- API REST
- Interface web integrada

---

# Tecnologias Utilizadas

- Laravel
- PHP 8+
- MySQL / SQLite
- Bootstrap
- jQuery
- REST API
- PHPUnit

---

# Estrutura do Projeto

app/
├── Http/
│ ├── Controllers/
│ │ ├── Api/
│ │ │ ├── TicketController.php
│ │ │ └── CategoryController.php
│
├── Models/
│ ├── Ticket.php
│ └── Category.php

database/
├── migrations/

resources/
├── views/
│ └── tickets/
│ └── index.blade.php

routes/
├── web.php
└── api.php

# Instalação

## 1. Clonar o repositório

```bash
git clone https://github.com/viniciusnau/HELPDESK.git
cd HELPDESK
```

## 2. Instalar dependências

```bash
composer install
```

## 3. Configurar ambiente

```bash
cp .env.example .env
```

## 4. Configurar banco de dados

Edite o arquivo .env.

```bash
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=helpdesk
DB_USERNAME=helpdesk_user
DB_PASSWORD=123456
```

## 5. Rodar migrations

```bash
php artisan migrate
```

Executar o Projeto
```bash
php artisan serve
```

# API

## Tickets

### Listar chamados


GET /api/tickets


Filtros:

/api/tickets?status=open
/api/tickets?category_id=1

Criar chamado
POST /api/tickets


Exemplo:

{
  "title": "Erro no sistema",
  "description": "Usuário não consegue acessar",
  "category_id": 1,
  "created_by": "Admin"
}


cURL:

curl -X POST http://127.0.0.1:8000/api/tickets \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Erro no login",
    "description": "Usuário não consegue acessar",
    "category_id": 1,
    "created_by": "Admin"
  }'

Deletar chamado
DELETE /api/tickets/{id}


Exemplo:

curl -X DELETE http://127.0.0.1:8000/api/tickets/1

Categorias
Listar categorias
GET /api/categories

Criar categoria
POST /api/categories


Exemplo:

{
  "name": "Suporte Técnico"
}


cURL:

curl -X POST http://127.0.0.1:8000/api/categories \
  -H "Content-Type: application/json" \
  -d '{"name":"Suporte Técnico"}'

Testes

Executar testes automatizados:

php artisan test