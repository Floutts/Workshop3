<?php


class Salle
{
    private $db;
    private $insert;
    private $select;
    private $ajoutOption;
    private $selectByNom;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into salle(libelle,superficie,prix,idStatut) values (:libelle,:superficie ,:prix,1)");
        $this->select = $db->prepare("select * from salle");
        $this->ajoutOption = $db->prepare("insert into optionSalle(idSalle,idOption) values (:idSalle,:idOption)");
        $this->selectByNom = $db->prepare("select * from salle where libelle=:libelle");
    }

    public function insert($nom,$superficie,$prix){
        $r = true;
        $this->insert->execute(array(':libelle'=>$nom, ':superficie'=>$superficie,':prix'=>$prix));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function select(){
        $liste = $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();

    }

    public function ajoutOption($idSalle,$idOption){
        $r = true;
        $this->ajoutOption->execute(array(':idSalle'=>$idSalle, ':idOption'=>$idOption));
        if ($this->ajoutOption->errorCode()!=0){
            print_r($this->ajoutOption->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function selectByNom($nom){
        $liste = $this->selectByNom->execute(array(':libelle'=>$nom));
        if ($this->selectByNom->errorCode()!=0){
            print_r($this->selectByNom->errorInfo());
        }
        return $this->selectByNom->fetch();

    }
}

