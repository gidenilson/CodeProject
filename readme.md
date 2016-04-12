## Gerenciador de Projetos

### LARAVEL 5.1 COM ANGULARJS (MODULO DE LARAVEL)

Aplicativo didático desenvolvido em PHP com base no Laravel 5.1 framework.


## Instalação

### Pré requisitos do ambiente

* [PHP 5.6](https://secure.php.net)
* [Composer](https://getcomposer.org)

### Instalar pacotes e dependências

```sh
  $ composer install

  $ php artisan vendor:publish
```

### Configurar o ambiente

```sh
  $ cp .env.example .env

  $ php artisan migrate:refresh --seed
```

### Rodar o aplicativo

```sh
  $ php artisan serve
```

### Abrir no browser

[http://localhost:8000](http://localhost:8000)

#### access_token

username = admin@admin.com

password = admin

client_id = id

client_secret = secret

grant_type = password

### Observação

* Para fins didáticos, utilizamos um banco de dados SQLite.


