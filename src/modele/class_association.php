<?php

class Association{
    private $db;
    private $insert;
    private $select;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into association(NomAssociation,Nom,Prenom,Adresse,Email,NumTelephone) values (:NomAssociation,:Nom,:Prenom,:Adresse,:Email,:NumTelephone)");
        $this->select = $db->prepare("select * from association");
    }

    public function insert($nomAssociation,$nom,$prenom,$email,$adresse,$tel){
        $r = true;
        $this->insert->execute(array(':NomAssociation'=>$nomAssociation, ':Nom'=>$nom, ':Prenom'=>$prenom, ':Email'=>$email, ':Adresse'=>$adresse, ':NumTelephone'=>$tel));
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