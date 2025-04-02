<?php

class PerfilController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - perfil';
        
        $this->carregarViews('perfil', $dados);
    }
}
