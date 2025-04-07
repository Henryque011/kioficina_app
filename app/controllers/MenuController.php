<?php

class MenuController extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['id_cliente'])) {
            header("Location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        $clienteId = $_SESSION['id_cliente'];

        if (!$clienteId) {
            session_destroy();
            header("Location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        // buscar cliente na api
        $url = BASE_API  . "cliente/$clienteId";
        // recebe os dados em campos 
        $response = file_get_contents($url);
        // separa os dados em 'campos'
        $cliente = json_decode($response, true);

        $dados = array();
        $dados['titulo'] = 'kiOficina - Menu';

        $dados['nome_cliente'] = $cliente['nome_cliente'] ?? 'CLiente';

        $this->carregarViews('menu', $dados);
    }
}
