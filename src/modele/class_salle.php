<?php


class Salle
{
    private $db;
    private $insert;
    private $select;
    private $ajoutOption;
    private $selectByNom;
    private $selectById;
    private $update;
    private $delete;
    private $deleteById;
    private $selectOptions;
    private $deleteBySalle;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into salle(libelle,superficie,prix,idStatut) values (:libelle,:superficie ,:prix,1)");
        $this->select = $db->prepare("select * from salle");
        $this->ajoutOption = $db->prepare("insert into optionSalle(idSalle,idOption) values (:idSalle,:idOption)");
        $this->selectByNom = $db->prepare("select * from salle where libelle=:libelle");
        $this->selectById = $db->prepare("select * from salle where id=:id");
        $this->update = $db->prepare("UPDATE salle SET libelle=:libelle,prix=:prix,superficie=:superficie where id=:id");
        $this->delete = $db->prepare("delete from salle where id=:id");
        $this->deleteById = $db->prepare("delete from optionSalle where idSalle=:idSalle");
        $this->selectOptions = $db->prepare("select o.libelle,o.id as options from optionSalle os, option o where idSalle=:idSalle and os.idOption=o.id");
        $this->deleteBySalle = $db->prepare("delete from optionSalle where idSalle=:idSalle");


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

    public function selectById($id)
    {
        $this->selectById->execute(array(':id' => $id));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();


    }

    public function update($nom,$prix,$superficie,$id)
    {
        $r = true;
        $this->update->execute(array(':libelle' => $nom, ':prix' => $prix, ':superficie'=> $superficie,':id' => $id));
        if ($this->update->errorCode() != 0) {
            print_r($this->update->errorInfo());
            $r = false;
        }
        return $r;
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

    public function deleteById($idSalle){
        $r = true;
        $this->deleteById->execute(array(':idSalle'=>$idSalle));
        if ($this->deleteById->errorCode()!=0){
            print_r($this->deleteById->errorInfo());
            $r=false;
        }
        return $r;
    }
    public function selectOptions($idSalle){
        $liste = $this->selectOptions->execute(array(':idSalle'=>$idSalle));
        if ($this->selectOptions->errorCode()!=0){
            print_r($this->selectOptions->errorInfo());
        }
        return $this->selectOptions->fetchAll();

    }

    public function deleteBySalle($idSalle){
        $r = true;
        $this->deleteBySalle->execute(array(':idSalle'=>$idSalle));
        if ($this->deleteBySalle->errorCode()!=0){
            print_r($this->deleteBySalle->errorInfo());
            $r=false;
        }
        return $r;
    }

}

