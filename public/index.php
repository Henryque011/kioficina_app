<?php
require_once('../config/config.php');
// require_once('../rotas/Rotas.php');

$caminho = new Rotas();
$caminho->executar();
