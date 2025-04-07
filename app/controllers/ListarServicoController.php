<?php

class ListarServicoControllerController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - listar_servico';
        
        $this->carregarViews('lsitar_servico', $dados);
    }
}
