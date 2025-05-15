<?php

class AgendamentoController extends Controller
{
    public function index()
    {
        try {
            // Verifica se o token está presente na sessão
            if (empty($_SESSION['token'])) {
                $this->redirecionarParaLogin();
            }

            // Valida o token
            $dadoToken = TokenHelper::validar($_SESSION['token']);
            if (!$dadoToken) {
                $this->encerrarSessaoERedirecionar();
            }

            // Monta a URL da API para buscar agendamentos
            $url = BASE_API . "agendamentosPorCliente/" . $dadoToken['id'];

            // Configura cURL
            $ch = curl_init($url);
            curl_setopt_array($ch, [
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_HTTPHEADER => [
                    'Authorization: Bearer ' . $_SESSION['token']
                ]
            ]);

            // Executa a requisição
            $response = curl_exec($ch);

            $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            curl_close($ch);

            // Verifica status HTTP da resposta
            if ($statusCode !== 200) {
                throw new Exception("Erro ao buscar agendamentos. Código HTTP: $statusCode");
            }

            // Decodifica JSON retornado
            $ordensAgendamento = json_decode($response, true);

            // Verifica se o JSON é válido
            if (!is_array($ordensAgendamento)) {
                throw new Exception("Resposta inválida da API.");
            }

            // Prepara dados para a view
            $dados = [
                'titulo' => 'Kioficina - Agendamento',
                'agendamentos' => $ordensAgendamento
            ];

            // Carrega a view com os dados
            $this->carregarViews('agendamento', $dados);
        } catch (Exception $e) {
            echo "<p><strong>Erro:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
            // Opcional: registrar o erro em log
        }
    }

    private function redirecionarParaLogin()
    {
        header("Location: " . BASE_URL . "index.php?url=login");
        exit;
    }

    private function encerrarSessaoERedirecionar()
    {
        session_destroy();
        unset($_SESSION['token']);
        $this->redirecionarParaLogin();
    }
}
