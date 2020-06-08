<?php


class Reserver
{
    private $ajoutOption;
    private $insert;
    private $selectById;
    private $selectByNom;
    private $insertOptionReservation;
    private $select;

    public function __construct($db)
    {
        $this->insert = $db->prepare("insert into reservation(NomAssociation,NomLocataire,PrenomLocataire,AdresseLocataire,EmailLocataire,TelLocataire,Motif,idSalle,DateDebut,DateFin) 
values (:NomAssociation,:NomLocataire,:PrenomLocataire,:AdresseLocataire,:EmailLocataire,:TelLocataire,:Motif,:idSalle,:dateTimeDebut,:dateTimeFin)");
        $this->ajoutOption = $db->prepare("insert into optionReservation(idReservation,idOption) values (:idReservation,:idOption)");
        $this->selectById = $db->prepare("select * from reservation where id=:id");
        $this->selectByNom = $db->prepare("select * from reservation where NomAssociation=:NomAssociation");
        $this->insertOptionReservation = $db->prepare("insert into optionReservation(idOption,idReservation) values (:idOption,:idReservation)");
        $this->select = $db->prepare("select * from reservation");

    }



    public function ajoutOption($idReservation, $idOption){
        $r = true;
        $this->ajoutOption->execute(array(':idReservation'=>$idReservation, ':idOption'=>$idOption));
        if ($this->ajoutOption->errorCode()!=0){
            print_r($this->ajoutOption->errorInfo());
            $r=false;
        }
        return $r;
    }


    public function insert($NomAssociation,$nom,$prenom,$email,$adresse,$tel,$motif,$idSalle,$dateTimeDebut,$dateTimeFin){
        $r = true;
        $this->insert->execute(array(':NomAssociation'=>$NomAssociation, ':NomLocataire'=>$nom, ':PrenomLocataire'=>$prenom, ':AdresseLocataire'=>$adresse, ':EmailLocataire'=>$email, ':TelLocataire'=>$tel, ':Motif'=>$motif, ':idSalle'=>$idSalle,':dateTimeDebut'=>$dateTimeDebut,':dateTimeFin'=>$dateTimeFin));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }


    public function selectById($idReservation)
    {
        $this->selectById->execute(array(':id' => $idReservation));
        if ($this->selectById->errorCode() != 0) {
            print_r($this->selectById->errorInfo());
        }
        return $this->selectById->fetch();


    }

    public function selectByNom($NomAssociation){
        $this->selectByNom->execute(array(':NomAssociation'=>$NomAssociation));
        if ($this->selectByNom->errorCode()!=0){
            print_r($this->selectByNom->errorInfo());
        }
        return $this->selectByNom->fetch();

    }

    public function insertOptionReservation($idOption,$idReservation){
        $r = true;
        $this->insertOptionReservation->execute(array(':idOption'=>$idOption, ':idReservation'=>$idReservation));
        if ($this->insertOptionReservation->errorCode()!=0){
            print_r($this->insertOptionReservation->errorInfo());
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