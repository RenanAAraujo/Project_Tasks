
# 📋 Tarefas do Projeto

Sistema simples de gestão de tarefas com controle de usuários, autenticação, e atualização de status das tarefas.

## 🚀 Tecnologias Utilizadas
- PHP (Puro)
- MySQL (Banco de Dados)
- HTML/CSS
- PHPMailer (Para meio de e-mails)

## ⁇ ️ Estrutura do Projeto
`
projeto/
├── config/
│ └── db.php
├── público/
│ ├── índice.php
│ ├── login.php
│ ├── logout.php
│ ├── registre.php
│ ├── confirm_email.php
│ └── tarefas.php
├── src/
│ ├── controladores/
│ ├── modelos/
│ ├── visualizações/
│ └── visualizações/modelos/
estilo └──/
 └── estilo.css
`

## 📌 Funcionalidades
- Registro de novos usuários
- Login e Logout
- Listagem de tarefas por usuário
- Criação de novas tarefas
- Atualização do status (concluído ou não)
- Exclusão de tarefas
- Envio de e-mail de confirmação de cadastro (PHPMailer)

## ⁇ ️ Configuração do Banco de Dados
Estrutura minima sugerida:

`sql
-- Tabela de usuários
CRIAR USUÁRIOS DE TABLE (
 ID INT AUTO_INCREMENT PRIMARY KEY,
 nome VARCHAR(100) NÃO NULO,
 email VARCHAR(150) NÃO NULO ÚNICO,
 senha VARCHAR(255) NÃO NULA,
 criado_at TIMESTAMP PADRÃO CURRENT_TIMESTAMP
);

-- Tabela de tarefas
CRIAR tarefas DE TABELA (
 ID INT AUTO_INCREMENT PRIMARY KEY,
 user_id INT NÃO NULO,
 título VARCHAR(255) NÃO NULO,
 descrição TEXTO,
 is_completed TINYINT(1) PADRÃO 0,
 criado_no TIMESTAMP PADRÃO ATUAL_TIMESTAMP,
 atualizado_no TIMESTAMP PADRÃO ATUAL_TIMESTAMP NA ATUALIZAÇÃO ATUAL_TIMESTAMP,
 CHAVE ESTRANGEIRA (user_id) REFERÊNCIAS usuários (id) NO DELETE CASCADE
);
`

## 📧 Configuração do PHPMailer
E-mails de Se desejar enviar:
1. Instale via Compositor:
`bash
compositor requer phpmailer/phpmailer
`
2. Configurar o servidor SMTP no arquivo de ambiente de e-mail (`confirm_email.php`).

## ✅ Requisitos
- PHP 7,4 ou superior
- Servidor Apache ou equivalente (XAMPP, Laragon, etc)
- Banco de Dados MySQL
- Compositor (caso queira utilizar PHPMailer via autoload)

## 💻 Como Rodar o Projeto
1. Clone ou baixa o projeto.
2. Configurar o banco de dados no arquivo `projeto/config/db.php`.
3. Suba o projeto em um servidor local (XAMPP, Laragon, etc).
4. Acesse pelo navegador: `http://localhost/nome-do-projeto/public`
