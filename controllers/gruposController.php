<?php

class gruposController extends controller {

    public function __construct() {
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function abrir($id) {
        $u = new Usuarios($_SESSION['lgSocial']);
        $g = new Grupos($_SESSION['lgSocial']);
        $p = new Posts($_SESSION['lgSocial']);
        $dados = array(
            "nome" => ""
        );
        if (!empty($_POST['post'])) {
            $post = addslashes($_POST['post']);
            $foto = [];
            if (!empty($_FILES['foto']['tmp_name'])) {
                $foto = $_FILES['foto'];
            }
            $p->addPost($post, $foto, $id);
            header("Location: " . BASE_URL."grupos/abrir/".$id);
        }
        $dados['nome'] = $u->getNome();
        $dados['info'] = $g->getInfo($id);
        $dados['idGrupo'] = $id;
        $dados['isMembro'] = $g->isMembro($id);
        $dados['membros'] = $g->getQtdMembros($id);
        $dados['feed'] = $p->getFeed($id);
        //print_r($dados);
        //exit;

        $this->loadTemplate('grupo', $dados);
    }

    public function entrar($id) {
        $g = new Grupos($_SESSION['lgSocial']);
        $g->addMembro($id);
        header("Location: " . BASE_URL . "grupos/abrir/" . $id);
    }

}
