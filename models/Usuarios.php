<?php

class Usuarios extends model {

    private $id;

    public function __construct($id = null) {
        parent::__construct();
        if (!empty($id)) {
            $this->id = $id;
        }
    }

    public function verificarLogin() {
        if (empty($_SESSION['lgSocial'])) {
            header("Location: " . BASE_URL . "login");
            exit;
        }
    }

    public function logar($email, $senha) {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = :email AND senha = :senha");
        $sql->bindValue(":email", $email);
        $sql->bindValue(":senha", $senha);
        $sql->execute();
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $_SESSION['lgSocial'] = $sql['id'];
            header("Location: " . BASE_URL);
            exit;
        } else {
            return "E-mail e/ou senha inválidos!";
        }
    }

    public function cadastrar($email, $nome, $sexo, $senha) {
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE email = ?");
        $sql->execute(array($email));
        if ($sql->rowCount() == 0) {
            $sql = $this->db->prepare("INSERT INTO usuarios(email, nome, sexo, senha) VALUES(:e, :n, :sx, :se)");
            $sql->bindValue(":e", $email);
            $sql->bindValue(":n", $nome);
            $sql->bindValue(":sx", $sexo);
            $sql->bindValue(":se", $senha);
            $sql->execute();
            if ($this->db->lastInsertId() > 0) {
                $_SESSION['lgSocial'] = $this->db->lastInsertId();
                header("Location: " . BASE_URL);
            } else {
                return "Não foi possivel inserir";
            }
        } else {
            return "E-mail ja cadastrado! Faça Login";
        }
    }

    public function getNome() {
        $sql = $this->db->prepare("SELECT nome FROM usuarios WHERE id = ?");
        $sql->execute(array($this->id));
        $sql = $sql->fetch();
        return $sql['nome'];
    }

    public function getDados() {
        $dados = array();
        $sql = $this->db->prepare("SELECT * FROM usuarios WHERE id = ?");
        $sql->execute(array($this->id));
        if ($sql->rowCount() > 0) {
            $dados = $sql->fetch(PDO::FETCH_ASSOC);
        }

        return $dados;
    }

    public function updatePerfil($nome, $bio) {
        $sql = $this->db->prepare("UPDATE usuarios SET nome = :nome, bio = :bio WHERE id = :id");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":bio", $bio);
        $sql->bindValue(":id", $this->id);
        $sql->execute();
        header("Location: ".BASE_URL);
    }
    public function updateSenha($senha) {
        $sql = $this->db->prepare("UPDATE usuarios SET senha = :senha WHERE id = :id");
        $sql->bindValue(":senha", $senha);
        $sql->bindValue(":id", $this->id);
        $sql->execute();
        header("Location: ".BASE_URL);
    }
    
    public function getSugestoes($qt = 5){
        $array = [];
        $sql = $this->db->prepare("SELECT id,nome FROM usuarios WHERE id NOT IN(SELECT usuario_para FROM relacionamentos "
                . "WHERE usuario_para != :id AND usuario_de = :id) AND id NOT IN(SELECT usuario_de FROM relacionamentos "
                . "WHERE usuario_para = :id) AND id != :id ORDER BY RAND() LIMIT :l");
        $sql->bindValue(":id",$this->id);
        $sql->bindValue(":l",$qt,PDO::PARAM_INT);
        $sql->execute();
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
        
    }
    public function procurar($q){
        $array = [];
        $sql = $this->db->prepare("SELECT *,(SELECT COUNT(1) FROM relacionamentos WHERE usuario_de = usuarios.id OR usuario_para = usuarios.id) as amigo FROM usuarios WHERE nome LIKE :q");
        $sql->bindValue(":q","%".$q."%");
        $sql->execute();
        if($sql->rowCount()>0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);
        }
        return $array;
    }
    


}
