<?php
define('BASE_URL', 'http://localhost/kioficina_app/public/');

// definir uma API base 
define('BASEE_API', 'https://360criativo.com.br/api/');

//Sisitema para carregametno automatico das classes
spl_autoload_register(function ($class) {
    if (file_exists('..app/controllers/' . $class . '.php')) {
        require_once '../app/controllers/' . $class . '.php';
    }
    if (file_exists('..rotas/' . $class . '.php')) {
        require_once '..rotas/' . $class . '.php';
    }
});
