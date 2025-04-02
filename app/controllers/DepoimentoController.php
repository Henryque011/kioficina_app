<?php

class DepoimentoController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - depoimento';
        
        $this->carregarViews('depoimento', $dados);
    }
}
