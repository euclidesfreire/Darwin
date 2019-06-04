Oracle Finance
=======================

Introdução
------------
Esse é o Repositório do Sistema de Aplicação em Algoritmo Genético para a Análise da Bolsa de Valores.

Tecnologias utilizadas:
-----------------------
Backend:
--------
 * PHP 7.1.3+
 * Laravel Framework 5.8.*

Frontend:
---------
 * AdminLTE

Requerimentos do sistema
------------
 * PHP >= 7.1.3
 * OpenSSL PHP Extension
 * PDO PHP Extension
 * Mbstring PHP Extension
 * Tokenizer PHP Extension

Instalação
------------

Usando composer (recomendado)
----------------------------
Clone o repositório e manualmente execute o 'composer':

    cd (Caminho do Diretório em que desejas clonar)
    git clone https://github.com/euclidesfreire/OracleFinance.git
    cd OracleFinance
    php composer self-update
    php composer install

Os comandos acima baixam o código do sistema e instalam suas dependências. Agora é preciso configurar o sistema.

Você pode copiar o arquivo .env.example e criar um novo chamado .env, nesse arquivo ficarão as configurações do banco de dados e demais configurações do sistema.

    cp .env.example .env

Abra o arquivo .env e configure-o de acordo com as informações do seu servidor.

Por fim execute o comando abaixo parar criar uma chave para a aplicação:

    php artisan key:generate


Laravel
------------

O sistema foi desenvolvido utilizando o framework Laravel 5.5. Caso tenha alguma dúvida na configuração, instalação de dependências, ou para entender o funcionamento do framework, você pode utilizar a documentação no site oficial do Laravel.

[https://laravel.com/docs/5.5](https://laravel.com/docs/5.5)