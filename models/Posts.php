<?php

class Posts extends model {

    private $id;

    public function __construct($id = null) {
        parent::__construct();
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    public function addPost($post, $foto, $idGrupo = 0) {
        $sql = $this->db->prepare("INSERT INTO posts(id_usuario, data_criacao, tipo, texto, id_grupo, url) VALUES(:usuario, NOW(), :tipo, :post, :grupo, :foto)");
        $sql->bindValue(":usuario", $this->id);
        $sql->bindValue(":tipo", "0");
        $sql->bindValue(":post", $post);
        $sql->bindValue(":grupo", $idGrupo);
        $tipo = 0;
        $url = NULL;
        if (count($foto) > 0) {
            $tipos = ["image/jpeg", "image/jpg", "image/png"];
            if (in_array($foto['type'], $tipos)) {
                $url = md5(time() . rand(0, 9999));
                switch ($foto['type']) {
                    case 'image/jpeg' :
                    case 'image/jpg' :
                        $url .= ".jpg";
                        break;
                    case 'iamge/png':
                        $url .= ".png";
                        break;
                }
                move_uploaded_file($foto['tmp_name'], BASE_URL."assets/images/posts/" . $url);
                $tipo = 1;
            }
        }
        $sql->bindValue(":tipo", $tipo);
        $sql->bindValue(":foto", $url);
        $sql->execute();
    }
    public function getFeed($idGrupo = 0) {
        $array = [];
        $sql = $this->db->prepare("SELECT *,(SELECT nome FROM usuarios WHERE usuarios.id = posts.id_usuario) as nome,"
                . "(SELECT count(1) FROM posts_likes WHERE posts_likes.id_post = posts.id) as likes,"
                . "(SELECT count(1) FROM posts_likes WHERE posts_likes.id_post = posts.id AND posts_likes.id_usuario = :id) as liked FROM posts WHERE id_grupo = :idG AND (id_usuario = :id OR id_usuario IN"
                . "(SELECT usuario_para FROM relacionamentos WHERE usuario_para != :id AND usuario_de = :id) OR"
                . " id_usuario IN(SELECT usuario_de FROM relacionamentos WHERE usuario_de != :id AND usuario_para = :id))  ORDER BY data_criacao DESC");
        $sql->bindValue(":id", $this->id);
        $sql->bindValue(":idG", $idGrupo);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
            foreach ($array as $k => $v) {
                $array[$k]['comentarios'] = [];
                $sql = $this->db->prepare("SELECT *,(SELECT nome FROM usuarios WHERE usuarios.id = posts_comentarios.id_usuario) as nome FROM posts_comentarios WHERE id_post = :post ORDER BY data_criacao DESC");
                $sql->bindValue(":post", $array[$k]['id']);
                $sql->execute();
                if ($sql->rowCount() > 0) {
                    $array[$k]['comentarios'] = $sql->fetchAll(PDO::FETCH_ASSOC);
                }
            }
        }
        /*
          echo("<pre>");
          print_r($array);
          exit;
         */
        return $array;
    }

    public function isLiked($post) {
        $sql = $this->db->prepare("SELECT count(1) as c FROM posts_likes WHERE id_post = :post AND id_usuario = :id");
        $sql->bindValue(":post", $post);
        $sql->bindValue(":id", $this->id);
        $sql->execute();
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        $sql = $sql['c'];
        return $sql;
    }

    public function removeLike($id) {
        $sql = $this->db->prepare("DELETE FROM posts_likes WHERE id_post = :post AND id_usuario = :usuario");
        $sql->bindValue(":post", $id);
        $sql->bindValue(":usuario", $this->id);
        $sql->execute();
    }

    public function addLike($id) {
        $sql = $this->db->prepare("INSERT INTO posts_likes(id_post, id_usuario) VALUES(:post, :usuario)");
        $sql->bindValue(":post", $id);
        $sql->bindValue(":usuario", $this->id);
        $sql->execute();
    }

    public function comentar($post, $txt) {
        $sql = $this->db->prepare("INSERT INTO posts_comentarios(id_post, id_usuario, data_criacao, texto) VALUES(:post, :usuario, NOW(), :txt)");
        $sql->bindValue(":post", $post);
        $sql->bindValue(":usuario", $this->id);
        $sql->bindValue(":txt", $txt);
        $sql->execute();
    }

}
