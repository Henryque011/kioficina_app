<?php

class MenuController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - Menu';
        
        $this->carregarViews('menu', $dados);
    }
}
