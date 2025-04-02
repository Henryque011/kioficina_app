<?php

class AgendamentoController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - agendamento';
        
        $this->carregarViews('agendamento', $dados);
    }
}
