<?php

class LoginController extends Controller
{
    public function index()
    {

        $dados = array();
        $dados['titulo'] = 'kiOficina - Login';

        $this->carregarViews('login', $dados);
    }

    //metodo de autenticação
    public function autenticar()
    {
        $email = $_POST['email'] ?? null;
        $senha = $_POST['senha'] ?? null;

        //fazer a requisição da API DE LOGIN
        $url = BASE_API . "login?email_cliente=$email&senha_cliente=$senha";
        // recebe os dados em campos 
        $response = file_get_contents($url);
        // separa os dados em 'campos'
        $data = json_decode($response, true);

        if (isset($dara['token'])) {
            $idToken = json_decode(base64_decode($data['token']), true);
            $id_cliente = $idToken['id'] ?? null;

            $_SESSION['token'] = $data['token'];
            $_SESSION['id_cliente'] = $id_cliente;
            header("location: " . BASE_URL . "index.php?url=menu");
            exit;
        }else {
            header("location: " . BASE_URL . "index.php?url=login");
            exit;
        }
    }
}
