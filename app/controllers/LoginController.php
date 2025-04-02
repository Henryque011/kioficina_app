<?php

class LoginController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - Login';
        
        $this->carregarViews('login', $dados);
    }
}
