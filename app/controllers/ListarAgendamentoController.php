<?php

class ListarAgendamentoControllerController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - listar agendamento';
        
        $this->carregarViews('listar agendamento', $dados);
    }
}
