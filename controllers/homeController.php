<?php

class homeController extends controller {

    public function __construct() {
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index() {
        $u = new Usuarios($_SESSION['lgSocial']);
        $r = new Relacionamentos($_SESSION['lgSocial']);
        $p = new Posts($_SESSION['lgSocial']);
        $g = new Grupos($_SESSION['lgSocial']);
        $dados = array(
            "nome" => ""
        );
        if (!empty($_POST['post'])) {
            $post = addslashes($_POST['post']);
            $foto = [];
            if(!empty($_FILES['foto']['tmp_name'])){
                $foto = $_FILES['foto'];
            }
            $p->addPost($post,$foto);
            header("Location: ".BASE_URL);
        }
        if(!empty($_POST['grupo'])){
            $grupo = addslashes($_POST['grupo']);
            $idGrupo = $g->addGrupo($grupo);
            header("Location: ".BASE_URL."grupos/abrir/".$idGrupo);
            exit;
        }
        $dados['nome'] = $u->getNome();
        $dados['sugestoes'] = $u->getSugestoes(3);
        $dados['requisicoes'] = $r->getRequisicoes();
        $dados['totalAmigos'] = $r->getTotalAmigos();
        $dados['feed'] = $p->getFeed();
        $dados['grupos'] = $g->getGrupos();
        
        
        $this->loadTemplate('home', $dados);
    }

}