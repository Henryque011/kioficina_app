<?php

require_once('../rotas/Rotas.php');
//Carregue as configuraçoes da aplicação

require_once('../config/config.php');

$caminho = new Rotas();
$caminho->executar();
