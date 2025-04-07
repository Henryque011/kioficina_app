<?php

class LoginController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - Login';
        
        $this->carregarViews('login', $dados);
    }

    //metodo de autenticação
    public function autenticar()
    {
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

        //fazer a requisiçã da API DE LOGIN
        $url = BASE_API . ;
    }
}
