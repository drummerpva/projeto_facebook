<?php

class buscaController extends controller {

    public function __construct() {
        $u = new Usuarios();
        $u->verificarLogin();
    }
    
    public function index() {
        $u = new Usuarios($_SESSION['lgSocial']);
        $g = new Grupos($_SESSION['lgSocial']);
        $dados = array(
            "nome" => ""
        );
        $busca = "";
        if(!empty($_GET['q'])){
            $busca = addslashes($_GET['q']);
        }
        $dados['nome'] = $u->getNome();
        $dados['resultado'] = $u->procurar($busca);
        
        //print_r($dados);
        //exit;

        $this->loadTemplate('busca', $dados);
    }

    public function entrar($id) {
        $g = new Grupos($_SESSION['lgSocial']);
        $g->addMembro($id);
        header("Location: " . BASE_URL . "grupos/abrir/" . $id);
    }

}
