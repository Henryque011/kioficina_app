<?php

class ApiController extends Controller
{
    private $servicoModel;
    private $clienteModel;
    private $depoimentoModel;
    private $veiculoModel;
    private $agendamentoModel;
    private $funcModel;

    public function __construct()
    {
        $this->servicoModel     = new Servico();
        $this->clienteModel     = new Cliente();
        $this->depoimentoModel  = new Depoimento();
        $this->veiculoModel     = new Veiculo();
        $this->agendamentoModel = new Agendamento();
        $this->funcModel        = new Funcionario();
    }

    public function index()
    {
        $dados = array();
        $dados['titulo'] = 'Área de Atuação - Ki Oficina';


        $this->carregarViews('api', $dados);
    }

    /**
     * Obtém o cabeçalho Authorization de forma segura
     */
    private function getAuthorizationHeader()
    {
        if (!empty($_SERVER['HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['HTTP_AUTHORIZATION']);
        }

        if (!empty($_SERVER['REDIRECT_HTTP_AUTHORIZATION'])) {
            return trim($_SERVER['REDIRECT_HTTP_AUTHORIZATION']);
        }

        if (function_exists('getallheaders')) {
            $headers = getallheaders();
            foreach ($headers as $key => $value) {
                if (strtolower($key) === 'authorization') {
                    return trim($value);
                }
            }
        }

        return null;
    }

    /**
     * Valida e decodifica o token
     */
    private function autenticarToken()
    {
        try {
            $authHeader = $this->getAuthorizationHeader();

            if (!$authHeader || !preg_match('/Bearer\s+(.+)/', $authHeader, $matches)) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token não fornecido ou malformado.']);
                exit;
            }

            $token = trim($matches[1]);

            if (!$token || strpos($token, '.') === false) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou incompleto.']);
                exit;
            }

            require_once 'core/TokenHelper.php';
            $TokenHelper = new TokenHelper();

            $dados = $TokenHelper::validar($token);

            if (!$dados || !isset($dados['id'], $dados['email'])) {
                http_response_code(401);
                echo json_encode(['erro' => 'Token inválido ou expirado.']);
                exit;
            }

            $cliente = $this->clienteModel->buscarCliente($dados['email']);

            if (!$cliente || $cliente['id_cliente'] != $dados['id']) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                exit;
            }

            return $cliente;
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro interno: ' . $e->getMessage()]);
            exit;
        }
    }

    /**
     * Endpoint de login que gera token
     */
    public function login()
    {
        $email = $_GET['email_cliente'] ?? null;
        $senha = $_GET['senha_cliente'] ?? null;

        if (!$email || !$senha) {
            http_response_code(400);
            echo json_encode(['erro' => 'E-mail ou senha são obrigatórios'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->buscarCliente($email);

        if (!$cliente || $senha !== $cliente['senha_cliente']) {
            http_response_code(401);
            echo json_encode(['erro' => 'E-mail ou senha inválidos'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            return;
        }

        $dadosToken = [
            'id'    => $cliente['id_cliente'],
            'email' => $cliente['email_cliente'],
            'exp'   => time() + 3600 // 1 hora de validade
        ];

        $token = TokenHelper::gerar($dadosToken);
        //var_dump($token);
        //var_dump(TokenHelper::validar($token));

        if (!class_exists('TokenHelper')) {
            die('TokenHelper não foi carregado!');
        }

        echo json_encode([
            'mensagem' => 'Login realizado com sucesso',
            'token'    => $token
        ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Lista todos os serviços
     */
    public function listarServico()
    {
        $servicos = $this->servicoModel->getTodosServicos();

        if (empty($servicos)) {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Nenhum serviço encontrado.']);
            return;
        }

        echo json_encode($servicos, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function listarFunc()
    {
        $func = $this->funcModel->getTodosFuncionarios();

        if (empty($func)) {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Nenhum funcionário encontrado.']);
            return;
        }

        echo json_encode($func, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Retorna dados do cliente autenticado
     */
    public function cliente($id)
    {
        try {
            $cliente = $this->autenticarToken();

            // Verifica se o token está válido e pertence ao cliente requisitado
            if (!$cliente || !isset($cliente['id_cliente']) || $cliente['id_cliente'] != $id) {
                http_response_code(403);
                echo json_encode(['erro' => 'Acesso negado.']);
                return;
            }

            // Busca os dados completos do cliente no banco
            $dados = $this->clienteModel->getClienteById($id);

            if (!$dados) {
                http_response_code(404);
                echo json_encode(['erro' => 'Cliente não encontrado']);
                return;
            }

            echo json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'erro' => 'Erro interno no servidor',
                'detalhe' => $e->getMessage()
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }
    }

    public function listarEstados()
    {
        $estados = $this->clienteModel->getTodosEstados();

        if (empty($estados)) {
            http_response_code(404);
            echo json_encode(['mensagem' => 'Nenhum estado encontrado.']);
            return;
        }

        echo json_encode($estados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Atualiza os dados do cliente autenticado
     */
    public function atualizarCliente($id)
    {
        $cliente = $this->autenticarToken();
        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        if ($_SERVER['REQUEST_METHOD'] !== 'PATCH') {
            http_response_code(405);
            echo json_encode(['erro' => 'Método não permitido.']);
            return;
        }

        $dados = json_decode(file_get_contents('php://input'), true) ?? $_POST;

        if (!is_array($dados) || empty($dados)) {
            http_response_code(400);
            echo json_encode(['erro' => 'Nenhum dado enviado.']);
            return;
        }

        $dadosAtualizados = array_merge($cliente, $dados);

        if (!empty($_FILES['foto_cliente']['name'])) {
            $foto = $this->uploadFoto($_FILES['foto_cliente'], $cliente['nome_cliente'], $id);
            if ($foto) {
                $dadosAtualizados['foto_cliente'] = $foto;
                $dadosAtualizados['alt_foto_cliente'] = $cliente['nome_cliente'];
            }
        }

        if ($this->clienteModel->atualizarCliente($id, $dadosAtualizados)) {
            echo json_encode(['mensagem' => 'Dados atualizados com sucesso.']);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao atualizar os dados.']);
        }
    }

    /**
     * Upload da foto do cliente
     */
    private function uploadFoto($file, $nome, $id)
    {
        $dir = '../public/uploads/cliente/';
        $nomeLimpo = strtolower(trim(preg_replace('/[^a-zA-Z0-9]/', '-', iconv('UTF-8', 'ASCII//TRANSLIT', $nome))));
        $ext = pathinfo($file['name'], PATHINFO_EXTENSION);
        $arquivo = "{$nomeLimpo}-{$id}.{$ext}";

        if (!file_exists($dir)) mkdir($dir, 0755, true);

        return move_uploaded_file($file['tmp_name'], $dir . $arquivo) ? "cliente/{$arquivo}" : false;
    }

    /**
     * Lista veículos do cliente
     */
    public function veiculo($id)
    {
        $cliente = $this->autenticarToken();
        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        $veiculo = $this->veiculoModel->getVeiculoIdCliente($id);
        echo json_encode($veiculo ?: ['mensagem' => 'Nenhum veículo encontrado.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Lista serviços realizados
     */
    public function servicoExecutadoPorCliente($id)
    {
        $cliente = $this->autenticarToken();
        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        $servicos = $this->clienteModel->servicoExecutadoPorIdCliente($id);
        echo json_encode($servicos ?: ['mensagem' => 'Nenhum serviço executado.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    /**
     * Lista agendamentos do cliente
     */
    public function agendamentosPorCliente($id)
    {
        $cliente = $this->autenticarToken();
        if (!$cliente || $cliente['id_cliente'] != $id) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        $agendamentos = $this->clienteModel->getAgendamentosPorCliente($id);
        echo json_encode($agendamentos ?: ['mensagem' => 'Nenhum agendamento encontrado.'], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }

    public function criarAgendamento()
    {
        $cliente = $this->autenticarToken();
        if (!$cliente) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        $dados = json_decode(file_get_contents("php://input"), true);

        if (!isset($dados['id_veiculo'], $dados['id_funcionario'], $dados['data_agendamento'])) {
            http_response_code(400);
            echo json_encode(['erro' => 'Dados obrigatórios ausentes.']);
            return;
        }


        $dados['status_agendamento'] = 'Em análise';

        $id = $this->clienteModel->criarAgendamento($dados);
        echo json_encode(['mensagem' => 'Agendamento criado com sucesso.', 'id' => $id], JSON_UNESCAPED_UNICODE);
    }

    /**
     * Cancelar agendamento do cliente autenticado
     */
    public function cancelarAgendamento($idAgendamento)
    {
        $cliente = $this->autenticarToken();
        if (!$cliente) {
            http_response_code(403);
            echo json_encode(['erro' => 'Acesso negado.']);
            return;
        }

        // Buscar agendamento e validar se é do cliente
        $agendamento = $this->clienteModel->buscarAgendamentoDoCliente($idAgendamento, $cliente['id_cliente']);

        if (!$agendamento) {
            http_response_code(404);
            echo json_encode(['erro' => 'Agendamento não encontrado ou não pertence ao cliente.']);
            return;
        }

        // Atualizar status para Cancelado
        $sucesso = $this->clienteModel->cancelarAgendamento($idAgendamento);

        if ($sucesso) {
            echo json_encode(['mensagem' => 'Agendamento cancelado com sucesso.'], JSON_UNESCAPED_UNICODE);
        } else {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao cancelar agendamento.']);
        }
    }

    /**
     * O usuÃ¡rio informa o e-mail. Se for vÃ¡lido, um token temporÃ¡rio Ã© gerado e enviado por e-mail com um link de redefiniÃ§Ã£o.
     */
    public function recuperarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'MÃ©todo nÃ£o permitido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $email = filter_input(INPUT_POST, 'email_cliente', FILTER_SANITIZE_EMAIL);

        if (!$email) {
            http_response_code(400);
            echo json_encode(['erro' => 'E-mail Ã© obrigatÃ³rio'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->buscarCliente($email);

        if (!$cliente) {
            http_response_code(404);
            echo json_encode(['erro' => 'E-mail nÃ£o encontrado'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = bin2hex(random_bytes(32));
        $expira = date('Y-m-d H:i:s', strtotime('+1 hour'));

        $this->clienteModel->salvarTokenRecuperacao($cliente['id_cliente'], $token, $expira);

        // ENVIO DE E-MAIL
        require_once("vendors/phpmailer/PHPMailer.php");
        require_once("vendors/phpmailer/SMTP.php");
        require_once("vendors/phpmailer/Exception.php");

        $mail = new PHPMailer\PHPMailer\PHPMailer();

        try {
            $mail->isSMTP();
            $mail->Host       = EMAIL_HOST;
            $mail->Port       = EMAIL_PORT;
            $mail->SMTPAuth   = true;
            $mail->SMTPSecure = 'ssl';
            $mail->Username   = EMAIL_USER;
            $mail->Password   = EMAIL_PASS;

            $mail->CharSet = 'UTF-8';
            $mail->Encoding = 'base64';

            $mail->setFrom(EMAIL_USER, 'Ki Oficina');
            $mail->addAddress($cliente['email_cliente'], $cliente['nome_cliente']);
            $mail->isHTML(true);
            $mail->Subject = 'RecuperaÃ§Ã£o de Senha';

            $link = "https://360criativo.com.br/api/redefinirSenha?token=$token";

            $mail->msgHTML("
            OlÃ¡ {$cliente['nome_cliente']},<br><br>
            Recebemos uma solicitaÃ§Ã£o para redefinir sua senha.<br>
            Clique no link abaixo para criar uma nova senha:<br><br>
            <a href='$link'>$link</a><br><br>
            Se vocÃª nÃ£o fez essa solicitaÃ§Ã£o, ignore este e-mail.
        ");
            $mail->AltBody = "OlÃ¡ {$cliente['nome_cliente']}, acesse $link para redefinir sua senha.";

            $mail->send();

            echo json_encode(['mensagem' => 'Um link de redefiniÃ§Ã£o foi enviado para seu e-mail'], JSON_UNESCAPED_UNICODE);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode(['erro' => 'Erro ao enviar e-mail', 'detalhes' => $mail->ErrorInfo], JSON_UNESCAPED_UNICODE);
        }
    }

    /** View para redefinir senha */
    public function redefinirSenha()
    {
        $dados = array();
        $dados['titulo'] = 'RecuperaÃ§Ã£o de senha - Ki Oficina';
        $this->carregarViews('recuperar-senha', $dados);
    }

    /** O usuÃ¡rio acessa o link com o token, define uma nova senha e salva. */
    public function resetarSenha()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            http_response_code(405);
            echo json_encode(['erro' => 'MÃ©todo nÃ£o permitido'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $token = $_POST['token'] ?? null;
        $novaSenha = $_POST['nova_senha'] ?? null;

        if (!$token || !$novaSenha) {
            http_response_code(400);
            echo json_encode(['erro' => 'Token e nova senha sÃ£o obrigatÃ³rios'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $cliente = $this->clienteModel->getClientePorToken($token);

        if (!$cliente || strtotime($cliente['token_expira']) < time()) {
            http_response_code(403);
            echo json_encode(['erro' => 'Token invÃ¡lido ou expirado'], JSON_UNESCAPED_UNICODE);
            return;
        }

        $atualizado = $this->clienteModel->atualizarSenha($cliente['id_cliente'], $novaSenha);

        if ($atualizado) {
            $this->clienteModel->limparTokenRecuperacao($cliente['id_cliente']);
            $dados['mensagem'] = 'Senha redefinida com sucesso';
            $this->carregarViews('home', $dados);
        } else {
            http_response_code(500);
            $dados['erro'] = 'Erro ao atualizar a senha';
            $this->carregarViews('home', $dados);
        }
    }

    public function NovoDepoimento()
    {
        // Autenticação via token
        $cliente = $this->autenticarToken();

        // ID do cliente do token
        if (!$cliente) {
            http_response_code(401);
            echo json_encode(['erro' => 'Token inválido ou ausente.']);
            return;
        }

        // ID do cliente via POST
        $id_cliente = $cliente['id_cliente'];

        // Coleta os demais dados do POST
        $descricao = $_POST['descricao_depoimento'] ?? null;
        $nota = $_POST['nota_depoimento'] ?? null;

        $datahora = new DateTime('now', new DateTimeZone('America/Sao_Paulo'));
        $datahora = $datahora->format('Y-m-d H:i:s');

        $status = "Em análise";

        // Validação simples (opcional, mas útil)
        if (!$descricao || !$nota) {
            http_response_code(400);
            echo json_encode(['erro' => 'Descrição e nota são obrigatórias.']);
            return;
        }

        // Monta array para o model
        $dados = [
            ':id_cliente'           => $id_cliente,
            ':descricao_depoimento' => $descricao,
            ':nota_depoimento'      => $nota,
            ':datahora_depoimento'  => $datahora,
            ':status_depoimento'    => $status
        ];

        // Insere depoimento
        $resultado = $this->depoimentoModel->addDepoimento($dados);

        // Retorna resposta
        header('Content-Type: application/json');
        echo json_encode(['sucesso' => $resultado]);
        exit;
    }
}
