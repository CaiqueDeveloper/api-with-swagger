<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Sobre o Projeto

Eu me deparei em um senário no qual após 4 anos trabalhando com dev PHP/Laravel, eu não sabia documentar uma API usando swagger, então resolvi me aventurar e aprender de uma vez por todas, me desafie criando essa mini api para pôr em prática tudo que aprendi, meu próximo passo agora vai ser integrar a bateria de testes usado o PestPhp

<p align="center"><img src="https://i.postimg.cc/mrrvCn3C/Imagem-do-Whats-App-de-2024-08-01-s-19-03-02-b41159e4.jpg" width="400" alt="Doc "></p>

## Dependências

- [L5-Swagger](https://github.com/DarkaOnLine/L5-Swagger).
- [Swagger-PHP](https://zircote.github.io/swagger-php/)
- [Pest](https://pestphp.com/)

### Requisitos

- PHP (>= 8.2)
- Composer
- Docker

### Instalação

1. Clone esse repositorio em sua máquina local

   ```bash
   git clone https://github.com/CaiqueDeveloper/api-with-swagger.git
   ```

2. Na pasta do projeto excute o composer

   ```bash
   composer install
   ```

3. Agora suba os container usando o sail

   ```bash
   ./vendor/bin/sail up ou sail up
   ```

4. Agora suba as migrations

   ```bash
      sail artisan migrate
   ```

## Funcionalidade do sistema

### Auth

- [x] Register
- [x] login
- [x] Logout

### User

- [x] Register User
- [x] Update User
- [x] Delete User

### Todos

- [x] Register Todo
- [x] Get All Todos
- [x] Get Todo
- [x] Update Todo
- [x] Delete Todo

### Test

- [x] Register
- [x] login
- [x] Logout
- [] Register User
- [] Update User
- [] Delete User
- [] Register Todo
- [] Get All Todos
- [] Get Todo
- [] Update Todo
- [] Delete Todo

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
