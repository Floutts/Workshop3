<?php


class Salle
{
    private $db;
    private $insert;
    private $select;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into salle(libelle,superficie,prix,idStatut) values (:libelle,:superficie ,:prix,1)");
        $this->select = $db->prepare("select * from salle");
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
}

