<?php

class AgendamentoController extends Controller
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
        $urlVeiculos = BASE_API . "veiculo/" . $dadoToken['id'];

        //Reconnhecemento da chave(inicializa um sessãqo cURL)
        $chVeiculos = curl_init($urlVeiculos);

        //Define que o conteudo venha com string
        curl_setopt($chVeiculos, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($chVeiculos, CURLOPT_HTTPHEADER, [
            'AUTHORIZATION: Bearer ' . $_SESSION['token']
        ]);

        //Recebe os dados dessa solicitação
        $responseVeiculos = curl_exec($chVeiculos);

        //Obtem o coidigo HTTP da resposta (200, 400, 401)
        $statusCodeVeiculos = curl_getinfo($chVeiculos, CURLINFO_HTTP_CODE);

        //Encerrar a sessaão cURL
        curl_close($chVeiculos);

        if ($statusCodeVeiculos != 200) {
            echo "Erro ao buscar as ordens de veiculos na API.\n";
            echo "Código HTTP: $statusCodeVeiculos";
            exit;
        }

        $Veiculos = json_decode($responseVeiculos, true);

        // listar os funcionarios

        //buscar ordens de serviço na API
        $urlFuncionarios = BASE_API . "veiculo/" . "listarFunc";

        //Reconnhecemento da chave(inicializa um sessãqo cURL)
        $chFuncionarios = curl_init($urlFuncionarios);

        //Define que o conteudo venha com string
        curl_setopt($chFuncionarios, CURLOPT_RETURNTRANSFER, true);

        curl_setopt($chFuncionarios, CURLOPT_HTTPHEADER, [
            'AUTHORIZATION: Bearer ' . $_SESSION['token']
        ]);

        //Recebe os dados dessa solicitação
        $responseFuncionarios = curl_exec($chFuncionarios);

        //Obtem o coidigo HTTP da resposta (200, 400, 401)
        $statusCodeFuncionarios = curl_getinfo($chFuncionarios, CURLINFO_HTTP_CODE);

        //Encerrar a sessaão cURL
        curl_close($chFuncionarios);

        if ($statusCodeFuncionarios != 200) {
            echo "Erro ao buscar as ordens de Funcionarios na API.\n";
            echo "Código HTTP: $statusFuncionarios";
            exit;
        }

        $uncionarios = json_decode($responseVeiculos, true);
        // listar os veiculos do cliente

        // agendaemento analisando o metodo post
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST['data_agenda'];
            $hora = $_POST['hora_agenda'];
            $dataAgenadamento = $data . ' ' . $hora;

            $dataAgenadamento = [
                'id_veiculo' => $_POST['id_veiculo'],
                'id_funcionario' => $_POST['id_funcionario'],
                'data_Agendamento' => $dataAgendamento
            ];

            $urlAgendar = BASE_API . "criarAgendamento";
            $chAgenda = curl_init($urlAgendar);

            curl_setopt($chAgenda, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($chAgenda, CURLOPT_POSTFIELDS, json_encode($dadosAgendamento));
            curl_setopt($chAgenda, CURLOPT_HTTPHEADER, [
                'AUTHORIZATION: Bearer ' . $_SESSION['token'],
                'Content-Type: application/json'
            ]);

            $resposta = curl_exec($chAgenda);
            $statusCodeAgenda = curl_getinfo($chAgenda, CURLINFO_HTTP_CODE);
            curl_close($chAgenda);

            if($statusCodeAgenda === 200){
                $_SESSION['msg_sucess'] = 'Agendamento realizado como sucesso!';
                header("location: " . BASE_URL . "index.php?url=agendamento");
                exit;
            }else{
                $_SESSION['msg_erro'] = "Erro ao agendar. Código: $statusCodeAgenda";
            }
        }

        $dados = array();
        $dados['titulo'] = 'Kioficina - Agendamento';
        $dados['veiculos'] = $Veiculos;
        $dados['funcionarios'] = $funcioanrios;
        $this->carregarViews('agendamento', $dados);
    }
}
