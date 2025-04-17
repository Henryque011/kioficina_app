<?php

class ListarServicoControllerController extends Controller
{
    public function index()
    {

        if (!isset($_SESSION['token'])) {
            header("location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        $dadoToken = TokenHelper::validar($_SESSION['token']);

        if (!$dadoToken) {
            session_destroy();
            unset($_SESSION['token']);
            header("location: " . BASE_URL . "index.php?url=login");
            exit;
        }

        //buscar ordens de serviço na API
        $url = BASE_API . "servicoExecutadoPorcliente/" . $dadoToken['id'];

        //Reconnhecemento da chave(inicializa um sessãqo cURL)
        $ch = curl_init($url);

        //Define que o conteudo venha com string
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'AUTHORIZATION: Bearer ' . $_SESSION['token']

        ]);

        //Recebe os dados dessa solicitação
        $response = curl_exec($ch);

        //Obtem o coidigo HTTP da resposta (200, 400, 401)
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

        //Encerrar a sessaão cURL
        curl_close($ch);

        if ($statusCode != 200) {
            echo "Erro ao buscar as ordens de serviço  na API.\n
            Código HTTP: $statusCode";
            exit;
        }

        //separar os dados em 'campos'
        $ordemServico = json_decode($response, true);

        $dados = array();
        $dados['titulo'] = 'kiOficina - listar_servico';

        $dados['servicos'] = $ordemServico;

        $this->carregarViews('lsitar_servico', $dados);
    }
}
