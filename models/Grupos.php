<?php

class Grupos extends model {

    private $id;

    public function __construct($id = null) {
        parent::__construct();
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    public function getGrupos() {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM grupos");
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function addGrupo($titulo) {
        $sql = $this->db->prepare("INSERT INTO grupos(id_usuario, titulo) VALUES(:usuario, :titulo)");
        $sql->bindValue(":usuario", $this->id);
        $sql->bindValue(":titulo", $titulo);
        $sql->execute();
        $id = $this->db->lastInsertId();
        if ($id) {
            $sql = $this->db->prepare("INSERT INTO grupos_membros(id_grupo, id_usuario) VALUES(:grupo, :usuario)");
            $sql->bindValue(":grupo", $id);
            $sql->bindValue(":usuario", $this->id);
            $sql->execute();
        }
        return $id;
    }
    
    public function getQtdMembros($grupo){
        $sql = $this->db->prepare("SELECT COUNT(1) as c FROM grupos_membros WHERE id_grupo = ?");
        $sql->execute([$grupo]);
        $sql = $sql->fetch();
        return $sql['c'];
    }
    
    public function addMembro($id){
        $sql = $this->db->prepare("INSERT INTO grupos_membros(id_grupo, id_usuario) VALUES(:idG, :idU)");
        $sql->bindValue(":idG",$id);
        $sql->bindValue(":idU",$this->id);
        $sql->execute();
    }

    public function getInfo($grupo) {
        $array = [];
        $sql = $this->db->prepare("SELECT * FROM grupos WHERE id = ?");
        $sql->execute(array($grupo));
        if ($sql->rowCount() > 0) {
            $array = $sql->fetch(PDO::FETCH_ASSOC);
        }
        return $array;
    }

    public function isMembro($grupo) {
        $sql = $this->db->prepare("SELECT * FROM grupos_membros WHERE id_grupo = :id AND id_usuario = :idUser");
        $sql->bindValue(":id", $grupo);
        $sql->bindValue(":idUser", $this->id);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

}
