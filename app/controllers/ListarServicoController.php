<?php

class ListarServicoControllerController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - listar servico';
        
        $this->carregarViews('lsitar servico', $dados);
    }
}
