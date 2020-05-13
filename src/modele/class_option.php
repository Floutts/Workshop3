<?php

class Option{
    private $db;
    private $insert;
    private $select;
    private $ajoutSalle;
    private $selectByNom;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into option(libelle,prix) values (:libelle,:prix)");
        $this->select = $db->prepare("select * from option");
        $this->ajoutSalle = $db->prepare("insert into optionSalle(idSalle,idOption) values (:idSalle,:idOption)");
        $this->selectByNom = $db->prepare("select * from option where libelle=:libelle");
    }

    public function insert($nom,$prix){
        $r = true;
        $this->insert->execute(array(':libelle'=>$nom, ':prix'=>$prix));
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

    public function ajoutSalle($idSalle,$idOption){
        $r = true;
        $this->ajoutSalle->execute(array(':idSalle'=>$idSalle, ':idOption'=>$idOption));
        if ($this->ajoutSalle->errorCode()!=0){
            print_r($this->ajoutSalle->errorInfo());
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