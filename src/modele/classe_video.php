<?php

class Video{
    private $db;
    private $ajoutVideoInit;
    private $selectVideoInit;
    private $selectByVideoInit;
    private $selectByVideoTrad;
    private $ajoutVideoTrad;
    private $deleteVideo;
    private $updateVideoInit;
    private $selectIfTradNull;
    private $selectIfTradNotNull;
    private $deleteVideoTrad;
    private $selectInitByUtilisateur;
    private $selectTradByUtilisateur;

    public function __construct($db){
        $this->db = $db;
        $this->ajoutVideoInit = $db->prepare("INSERT INTO VideoInit(IdUtilisateur,Titre,DescriptionVideo,UrlInit) VALUES (:IdUtilisateur,:Titre,:DescriptionVideo,:UrlInit) ");
        $this->selectVideoInit = $db->prepare("SELECT * FROM VideoInit");
        $this->selectByVideoInit = $db->prepare("SELECT *, vi.IdVideoInit as IdVideoInit FROM VideoInit vi LEFT JOIN VideoTrad vt ON vi.IdVideoInit = vt.IdVideoInit WHERE vi.IdVideoInit = :IdVideoInit");
        $this->selectByVideoTrad = $db->prepare("SELECT *, vi.IdVideoInit as IdVideoInit FROM VideoInit vi LEFT JOIN VideoTrad vt ON vi.IdVideoInit = vt.IdVideoInit WHERE vt.IdVideoTrad = :IdVideoTrad");
        $this->ajoutVideoTrad = $db->prepare("INSERT INTO VideoTrad(IdVideoInit,IdUtilisateur,UrlTrad) VALUES (:IdVideoInit, :IdUtilisateur, :UrlTrad)");
        $this->deleteVideo = $db->prepare("DELETE FROM VideoInit WHERE IdVideoInit = :IdVideoInit");
        $this->updateVideoInit = $db->prepare("UPDATE VideoInit SET Titre = :Titre, DescriptionVideo = :DescriptionVideo, UrlInit = :UrlInit WHERE IdVideoInit = :IdVideoInit");
        $this->updateVideoTrad = $db->prepare("UPDATE VideoTrad SET UrlTrad = :UrlTrad WHERE IdVideoTrad = :IdVideoTrad");
        $this->selectIfTradNull = $db->prepare("SELECT *, vi.IdVideoInit as IdVideoInit FROM VideoInit vi LEFT JOIN VideoTrad vt ON vi.IdVideoInit = vt.IdVideoInit WHERE vt.IdVideoTrad is null");
        $this->selectIfTradNotNull = $db->prepare("SELECT *, vi.IdVideoInit as IdVideoInit FROM VideoInit vi LEFT JOIN VideoTrad vt ON vi.IdVideoInit = vt.IdVideoInit WHERE vt.IdVideoTrad is not null");
        $this->deleteVideoTrad = $db->prepare("DELETE FROM VideoTrad WHERE IdVideoTrad = :IdVideoTrad");
        $this->selectInitByUtilisateur = $db->prepare("SELECT * FROM VideoInit WHERE vi.IdUtilisateur = :IdUtilisateur");
        $this->selectTradByUtilisateur = $db->prepare("SELECT *, vi.IdVideoInit as IdVideoInit FROM VideoInit vi LEFT JOIN VideoTrad vt ON vi.IdVideoInit = vt.IdVideoInit WHERE vt.IdVideoTrad is not null AND vt.IdUtilisateur = :IdUtilisateur");
    }

    public function ajoutVideoInit($IdUtilisateur,$Titre,$DescriptionVideo,$UrlVideo){
        $r = true;
        $this->ajoutVideoInit->execute(array(':IdUtilisateur'=>$IdUtilisateur,':Titre'=>$Titre,':DescriptionVideo'=>$DescriptionVideo,':UrlInit'=>$UrlVideo));
        if ($this->ajoutVideoInit->errorCode()!=0){
            print_r($this->ajoutVideoInit->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function selectVideoInit(){
        $liste = $this->selectVideoInit->execute();
        if ($this->selectVideoInit->errorCode()!=0){
            print_r($this->selectVideoInit->errorInfo());
        }
        return $this->selectVideoInit->fetchAll();

    }

    public function selectByVideoInit($idVideo){
        $liste = $this->selectByVideoInit->execute(array(':IdVideoInit'=>$idVideo));
        if ($this->selectByVideoInit->errorCode()!=0){
            print_r($this->selectByVideoInit->errorInfo());
        }
        return $this->selectByVideoInit->fetch();

    }

    public function selectByVideoTrad($idVideo){
        $liste = $this->selectByVideoTrad->execute(array(':IdVideoTrad'=>$idVideo));
        if ($this->selectByVideoTrad->errorCode()!=0){
            print_r($this->selectByVideoTrad->errorInfo());
        }
        return $this->selectByVideoTrad->fetch();

    }

    
    public function ajoutVideoTrad($IdUtilisateur,$idVideo,$UrlTrad)
    {
        $r = true;
        $this->ajoutVideoTrad->execute(array(':IdUtilisateur'=>$IdUtilisateur,':IdVideoInit'=>$idVideo, ':UrlTrad' => $UrlTrad));
        if ($this->ajoutVideoTrad->errorCode() != 0) {
            print_r($this->ajoutVideoTrad->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function deleteVideo($idVideo){
        $r = true;
        $this->deleteVideo->execute(array(':IdVideoInit'=>$idVideo));
        if ($this->deleteVideo->errorCode()!=0){
            print_r($this->deleteVideo->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function updateVideoInit($Titre,$DescriptionVideo,$UrlInit,$idVideo)
    {
        $r = true;
        $this->updateVideoInit->execute(array(':Titre' => $Titre,":DescriptionVideo"=>$DescriptionVideo, ':UrlInit' => $UrlInit,':IdVideoInit'=>$idVideo));
        if ($this->updateVideoInit->errorCode() != 0) {
            print_r($this->updateVideoInit->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function updateVideoTrad($UrlTrad,$idVideo)
    {
        $r = true;
        $this->updateVideoTrad->execute(array(':UrlTrad' => $UrlTrad,':IdVideoTrad'=>$idVideo));
        if ($this->updateVideoTrad->errorCode() != 0) {
            print_r($this->updateVideoTrad->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectIfTradNull(){
        $liste = $this->selectIfTradNull->execute();
        if ($this->selectIfTradNull->errorCode()!=0){
            print_r($this->selectIfTradNull->errorInfo());
        }
        return $this->selectIfTradNull->fetchAll();

    }
    public function selectIfTradNotNull(){
        $liste = $this->selectIfTradNotNull->execute();
        if ($this->selectIfTradNotNull->errorCode()!=0){
            print_r($this->selectIfTradNotNull->errorInfo());
        }
        return $this->selectIfTradNotNull->fetchAll();

    }

    public function deleteVideoTrad($idVideo)
    {
        $r = true;
        $this->deleteVideoTrad->execute(array(':IdVideoTrad'=>$idVideo));
        if ($this->deleteVideoTrad->errorCode() != 0) {
            print_r($this->deleteVideoTrad->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function selectInitByUtilisateur($idUtilisateur){
        $liste = $this->selectInitByUtilisateur->execute(array(':IdUtilisateur'=>$idUtilisateur));
        if ($this->selectInitByUtilisateur->errorCode()!=0){
            print_r($this->selectInitByUtilisateur->errorInfo());
        }
        return $this->selectInitByUtilisateur->fetchAll();

    }


    public function selectTradByUtilisateur($idUtilisateur){
        $liste = $this->selectTradByUtilisateur->execute(array(':IdUtilisateur'=>$idUtilisateur));
        if ($this->selectTradByUtilisateur->errorCode()!=0){
            print_r($this->selectTradByUtilisateur->errorInfo());
        }
        return $this->selectTradByUtilisateur->fetchAll();

    }

}