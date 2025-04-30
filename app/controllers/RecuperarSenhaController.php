<?php

class RecuperarSenhaController extends Controller
{
    // Esqueci a senha
    // public function esqueciSenha()
    // {
    //     $dados = array();
    //     $dados['titulo'] = 'Recuperar Senha - KiOficina';

    //     $this->carregarViews('recuperar_senha', $dados);
    // }

    // Recuperação da Senha (esqueceu a senha)
    public function enviarRecuperacao()
    {
        $email = $_POST['email'] ?? null;

        if (!$email) {
            $_SESSION['flash'] = "Informe um e-mail válido.";
            header("Location: " . BASE_URL . "index.php?url=login/esqueciSenha");
            exit;
        }

        $url = BASE_API . "recuperarSenha";

        $postFields = http_build_query([
            'email_cliente' => $email
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $postFields);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($ch);
        $statusCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $data = json_decode($response, true);

        if ($statusCode == 200) {
            $_SESSION['flash'] = $data['mensagem'] ?? 'Verifique seu e-mail para continuar.';
        } else {
            $_SESSION['flash'] = $data['erro'] ?? 'Erro ao solicitar redefinição.';
        }

        header("Location: " . BASE_URL . "index.php?url=login/esqueciSenha");
        exit;
    }
}
