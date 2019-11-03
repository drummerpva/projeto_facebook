<?php

class perfilController extends controller {

    public function __construct() {
        $u = new Usuarios();
        $u->verificarLogin();
    }
    public function index(){
        $dados = array(
            "info" => "",
            "nome" => ""
        );
        $u = new Usuarios($_SESSION['lgSocial']);
        if(!empty($_POST['nome'])){
            $nome = addslashes($_POST['nome']);
            $bio = addslashes($_POST['bio']);
            $senha = (!empty($_POST['senha']) ? md5($_POST['senha']) : null);
            $u->updatePerfil($nome, $bio);
            if(!empty($senha)){
                $u->updateSenha($senha);
                unset($_SESSION['lgSocial']);
                header("Location: ".BASE_URL);
            }
        }
        
        $dados['nome'] = $u->getNome();
        $dados["info"] = $u->getDados();
        
        $this->loadTemplate("perfil",$dados);
    }

}