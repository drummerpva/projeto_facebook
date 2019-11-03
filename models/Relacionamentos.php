<?php

class Relacionamentos extends model {

    private $id;

    public function __construct($id = null) {
        parent::__construct();
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    public function addFriend($id) {
        $sql = $this->db->prepare("INSERT INTO relacionamentos (usuario_de, usuario_para, status) VALUES(?, ? , 0)");
        $sql->execute(array($this->id, $id));
    }

    public function getRequisicoes(){
        $array = array();
        $sql =$this->db->prepare("SELECT r.usuario_de, u.nome FROM relacionamentos r INNER JOIN usuarios u ON u.id = r.usuario_de WHERE r.usuario_para = ? AND status = 0");
        $sql->execute(array($this->id));
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
    public function accFriend($id){
        $sql =$this->db->prepare("UPDATE relacionamentos SET status = 1 WHERE usuario_para = ? AND usuario_de = ?");
        $sql->execute(array($this->id,$id));
    }
    public function recFriend($id){
        $sql =$this->db->prepare("DELETE FROM relacionamentos WHERE usuario_para = ? AND usuario_de = ?");
        $sql->execute(array($this->id,$id));
    }
    public function getTotalAmigos(){
        $sql = $this->db->prepare("SELECT COUNT(1) as c FROM relacionamentos WHERE status = 1 AND (usuario_para = :id OR usuario_de = :id)");
        $sql->bindValue(":id",$this->id);
        $sql->execute();
        $sql = $sql->fetch();
        return $sql['c'];
    }
}
