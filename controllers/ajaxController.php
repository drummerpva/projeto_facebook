<?php

class ajaxController extends controller {

    public function __construct() {
        $u = new Usuarios();
        $u->verificarLogin();
    }

    public function index() {
        
    }

    public function addFriend() {
        if (!empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $r = new Relacionamentos($_SESSION['lgSocial']);
            $r->addFriend($id);
        }
    }

    public function accFriend() {
        if (!empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $r = new Relacionamentos($_SESSION['lgSocial']);
            $r->accFriend($id);
        }
    }

    public function recFriend() {
        if (!empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $r = new Relacionamentos($_SESSION['lgSocial']);
            $r->recFriend($id);
        }
    }

    public function curtir() {
        if (!empty($_POST['id'])) {
            $id = addslashes($_POST['id']);
            $p = new Posts($_SESSION['lgSocial']);
            if ($p->isLiked($id)) {
                $p->removeLike($id);
            } else {
                $p->addLike($id);
                echo "add";
            }
        }
    }
    public function comentar(){
        if(!empty($_POST['id'])){
            $id = addslashes($_POST['id']);
            $txt = addslashes($_POST['txt']);
            $p = new Posts($_SESSION['lgSocial']);
            $p->comentar($id, $txt);
        }
    }

}
