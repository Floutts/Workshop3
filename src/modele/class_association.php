<?php

class Association{
    private $db;
    private $insert;
    private $select;
    private $selectById;
    private $update;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into association(NomAssociation,Nom,Prenom,Adresse,Email,NumTelephone) values (:NomAssociation,:Nom,:Prenom,:Adresse,:Email,:NumTelephone)");
        $this->select = $db->prepare("select * from association");
        $this->selectById = $db->prepare("select * from association where id=:id");
        $this->update = $db->prepare("UPDATE association SET NomAssociation=:NomAssociation,Nom=:Nom,Prenom=:Prenom,Adresse=:Adresse,Email=:Email,NumTelephone=:NumTelephone  where id=:id");


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
    public function selectById($id)
    {
        $this->selectById->execute(array(':id' => $id));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();
    }

    public function update($nomAssociation,$nom,$prenom,$email,$adresse,$tel,$id)
    {
        $r = true;
        $this->update->execute(array(':NomAssociation'=>$nomAssociation, ':Nom'=>$nom, ':Prenom'=>$prenom, ':Email'=>$email, ':Adresse'=>$adresse, ':NumTelephone'=>$tel, ':id' => $id));
        if ($this->update->errorCode() != 0) {
            print_r($this->update->errorInfo());
            $r = false;
        }
        return $r;
    }
}