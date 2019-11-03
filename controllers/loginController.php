<?php

class loginController extends controller {

    public function __construct() {
        $u = new Usuarios();
        //$u->verificarLogin();
        if (!empty($_SESSION['lgSocial'])) {
            header("Location: ./");
        }
    }

    public function index() {
        $dados = array("erro" => "");

        $this->loadView('login', $dados);
    }

    public function entrar() {
        $dados = array();
        if (!empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $senha = md5($_POST['senha']);
            $u = new Usuarios();
            $dados['erro'] = $u->logar($email, $senha);
        }
        $this->loadView("loginEntrar", $dados);
    }

    public function cadastrar() {
        $dados = array();
        if (!empty($_POST['email'])) {
            $email = addslashes($_POST['email']);
            $nome = addslashes($_POST['nome']);
            $sexo = addslashes($_POST['sexo']);
            $senha = md5($_POST['senha']);
            $u = new Usuarios();
            $dados['erro'] = $u->cadastrar($email, $nome, $sexo, $senha);
        }

        $this->loadView("loginCadastrar", $dados);
    }
    public function sair(){
        unset($_SESSION['lgSocial']);
        header("Location: ".BASE_URL);
    }

}
