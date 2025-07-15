# GLPI-App Laravel 12

Sistema de gestão de chamados interno desenvolvido em **Laravel 12**, inspirado no GLPI. A aplicação permite que usuários registrem problemas, acompanhem o status e que administradores ou técnicos gerenciem os chamados.

---

## 🚀 Funcionalidades

- Cadastro e autenticação de usuários
- Perfis de acesso: `user`, `tecnico` e `admin`
- Abertura e edição de chamados
- Upload de imagens relacionadas ao problema
- Controle de status: Aberto, Em Andamento, Fechado
- Painel de administração para gerenciar permissões
- Interface moderna com Tailwind CSS
- Proteção por middleware para rotas e funções sensíveis

---

## 🛠 Tecnologias Utilizadas

- Laravel 12
- PHP 8.4+
- Tailwind CSS
- Vite (build frontend)
- PostgreSQL ou MySQL
- Composer & NPM

---

## 📸 Capturas de Tela

> ✨ *Adicione aqui prints das telas de login, dashboard, criação e visualização de chamados, etc.*

---

## 📦 Instalação Local

```bash
# 1. Clone o projeto
git clone https://github.com/seu-usuario/glpi-app.git
cd glpi-app

# 2. Instale dependências PHP
composer install

# 3. Instale dependências do frontend
npm install

# 4. Configure o arquivo .env
cp .env.example .env

# 5. Gere a chave da aplicação
php artisan key:generate

# 6. Configure o banco e rode as migrations
php artisan migrate --seed

# 7. Rode o servidor Laravel
php artisan serve

# 8. Em outro terminal, rode o servidor Vite
npm run dev
