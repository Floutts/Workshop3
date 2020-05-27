<?php

class Option{
    private $db;
    private $insert;
    private $select;
    private $ajoutSalle;
    private $selectByNom;
    private $selectById;
    private $update;
    private $delete;
    private $deleteById;
    private $selectOptionSalle;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into option(libelle,prix) values (:libelle,:prix)");
        $this->select = $db->prepare("select * from option");
        $this->ajoutSalle = $db->prepare("insert into optionSalle(idSalle,idOption) values (:idSalle,:idOption)");
        $this->selectByNom = $db->prepare("select * from option where libelle=:libelle");
        $this->selectById = $db->prepare("select * from option where id=:id");
        $this->update = $db->prepare("UPDATE option SET libelle=:libelle,prix=:prix where id=:id");
        $this->delete = $db->prepare("delete from option where id=:id");
        $this->deleteById = $db->prepare("delete from optionSalle where idOption=:idOption");
        $this->selectOptionSalle = $db-> prepare("select * from optionSalle");
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
        $this->ajoutSalle->execute(array(':idSalle' => $idSalle, ':idOption' => $idOption));
        if ($this->ajoutSalle->errorCode() != 0) {
            print_r($this->ajoutSalle->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectById($id)
    {
        $this->selectById->execute(array(':id' => $id));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();


    }
    public function update($nom,$prix,$id)
    {
        $r = true;
        $this->update->execute(array(':libelle' => $nom, ':prix' => $prix, ':id' => $id));
        if ($this->update->errorCode() != 0) {
            print_r($this->update->errorInfo());
            $r = false;
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

    public function delete($id){
        $r = true;
        $this->delete->execute(array(':id'=>$id));
        if ($this->delete->errorCode()!=0){
            print_r($this->delete->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function deleteById($idOption){
        $r = true;
        $this->deleteById->execute(array(':idOption'=>$idOption));
        if ($this->deleteById->errorCode()!=0){
            print_r($this->deleteById->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function selectOptionSalle(){
        $liste = $this->selectOptionSalle->execute();
        if ($this->selectOptionSalle->errorCode()!=0){
            print_r($this->selectOptionSalle->errorInfo());
        }
        return $this->selectOptionSalle->fetchAll();

    }

}