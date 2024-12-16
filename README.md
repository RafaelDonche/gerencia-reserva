# Projeto CakePHP 2.x

Este é um sistema desenvolvido em CakePHP 2.x para o gerenciamento de reservas dos espaços disponíveis.

## Instalação do Projeto

## Pré-requisitos

Antes de começar, certifique-se de ter as seguintes ferramentas instaladas em sua máquina:

- **PHP** (versão 5.6 ou superior compatível com CakePHP 2.x)
- **Composer** (para gerenciar dependências do projeto)
- **MySQL** (ou outro banco de dados compatível)
- **Servidor Web** (Apache com mod_rewrite habilitado ou equivalente)
- **Git** (para clonar o repositório)

### 1. Clonando o Repositório

Execute o seguinte comando para clonar o projeto:

```bash
git clone https://github.com/RafaelDonche/gerencia-reserva
```

### 2. Configuração do Banco de Dados

1. Utilizando o banco MySQL, rode o conteúdo do arquivo **database-script.sql** no seu banco de dados.

2. Configure o arquivo `app/Config/database.php` com as credenciais do banco de dados. Um exemplo de configuração pode ser:

```php
class DATABASE_CONFIG {
    public $default = array(
        'datasource' => 'Database/Mysql',
        'persistent' => false,
        'host' => 'localhost',
        'login' => 'root',
        'password' => '',
        'database' => 'gerenciareserva',
        'prefix' => '',
        'encoding' => 'utf8',
    );
}
```

### 3. Configuração do CakePHP

Certifique-se de que o diretório `app/tmp` e todos os seus subdiretórios têm permissão de escrita.

```bash
chmod -R 777 app/tmp
```

### 4. Instalando Dependências

Instale as dependências do projeto com o Composer:

```bash
composer install
```

### 5. Configurando o Servidor

1. Configure seu servidor web para apontar para o diretório `app/webroot` como raiz do projeto.

### 6. Acessando o Sistema

Abra o navegador e acesse o sistema:

```
http://localhost/gerencia-reserva
```

## Funcionalidades Principais

### Autenticação
- O login do sistema será realizada por um único usuário já existente no banco de dados:
- Nome: Administrador
- Senha: 123456

### Gerenciamento de Reservas e Espaços
- Criação, listagem, edição e exclusão de reservas e espaços.
- Definição de estruturas e serviços adicionais (checkboxes e selects dinâmicos).
- Regras para evitar conflitos de horários e respeitar o horário de funcionamento dos espaços.

-----------

**Autor:** Rafael Donche
