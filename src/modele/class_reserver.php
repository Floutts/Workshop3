<?php


class Reserver
{
    private $ajoutOption;
    private $insert;
    private $selectById;
    private $selectByNom;


    public function __construct($db)
    {
        $this->insert = $db->prepare("insert into reservation(NomAssociation,NomLocataire,PrenomLocataire,AdresseLocataire,EmailLocataire,TelLocataire,Motif,idSalle,DebutLocation,FinLocation) 
values (:NomAssociation,:NomLocataire,:PrenomLocataire,:AdresseLocataire,:EmailLocataire,:TelLocataire,:Motif,:idSalle,:DebutLocation,:FinLocation)");
        $this->ajoutOption = $db->prepare("insert into optionReservation(idReservation,idOption) values (:idReservation,:idOption)");
        $this->selectById = $db->prepare("select * from salle where id=:id");
        $this->selectByNom = $db->prepare("select * from reservation where NomAssociation=:NomAssociation");


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


    public function insert($NomAssociation,$nom,$prenom,$email,$adresse,$tel,$motif,$idSalle,$heureDebut,$heureFin){
        $r = true;
        $this->insert->execute(array(':NomAssociation'=>$NomAssociation, ':NomLocataire'=>$nom, ':PrenomLocataire'=>$prenom, ':EmailLocataire'=>$email, ':AdresseLocataire'=>$adresse, ':TelLocataire'=>$tel, ':Motif'=>$motif, ':idSalle'=>$idSalle, ':DebutLocation'=>$heureDebut, 'FinLocation'=>$heureFin));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
        return $r;
    }


    public function selectById($idSalle)
    {
        $this->selectById->execute(array(':id' => $idSalle));
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
}