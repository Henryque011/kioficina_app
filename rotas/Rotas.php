<?php

class Rotas
{
    public function executar()
    {
        $url = '/';

        if (isset($_GET['url'])) {
            $url .= $_GET['url'];
        }

        $paremetro = array();
        // Verifica se a URL não esrá vazai e não é a raiz
        if (!empty($url) && $url != '/') {

            $url = explode('/', $url);
            array_shift(($url)); //Remover a barra

            $controladorAtual = ucfirst($url[0]) . 'controller'; //primerio caracter em letra maiuscula
            array_shift($url); //Remover a primeira casa do vetor

            if (isset($url[0]) && !empty($url[0])) {
                $acaoAtual = $url[0];
                array_shift($url);
            } else {
                $acaoAtual = 'index';
            }

            //Se ainda tiver algum elemento na URL será considerad parâmetro
            if (count($url) > 0) {
                $paremetro = $url;
            }
        } else {
            $controladorAtual = 'LoginController';
            $acaoAtual = 'index';
        }

        if (!file_exists('../app/controllers/' . $controladorAtual . '.php') || !method_exists($controladorAtual, $acaoAtual)) {
            echo 'Estou aqui - Não existe o arquivo ' . $controladorAtual . ' e nem a ação atual ' . $acaoAtual;

            //Definir um controlador de erro
            $controladorAtual = 'ErroController';
            $acaoAtual = 'index';
        }
        //criar uma instância para o controlador atual
        $controler = new $controladorAtual;

        //chamar a ação dentro do controlador e passar o prametro
        call_user_func_array(array($controler, $acaoAtual), $paremetro);
    }
}
