<?php

class Video{
    private $db;
    private $ajoutVideoInit;
    private $selectVideoInit;
    private $deuxVideos;
    private $ajoutVideoTrad;
    private $deleteVideo;
    private $updateVideoInit;
    private $selectIfTradNull;
    private $selectIfTradNotNull;
    private $deleteVideoTrad;


    

    public function __construct($db){
        $this->db = $db;
        $this->ajoutVideoInit = $db->prepare("INSERT INTO Video(UrlInit,Titre,DescriptionVideo) VALUES (:UrlInit,:Titre,:DescriptionVideo) ");
        $this->selectVideoInit = $db->prepare("SELECT idVideo,UrlInit,Titre,DescriptionVideo FROM Video");
        $this->deuxVideos = $db->prepare("SELECT idVideo,UrlInit,UrlTrad,Titre,DescriptionVideo FROM Video WHERE idVideo = :idVideo");
        $this->ajoutVideoTrad = $db->prepare("UPDATE Video SET UrlTrad = :UrlTrad WHERE idVideo = :idVideo");
        $this->deleteVideo = $db->prepare("DELETE FROM Video WHERE idVideo = :idVideo");
        $this->updateVideoInit = $db->prepare("UPDATE Video SET Titre = :Titre, DescriptionVideo = :DescriptionVideo, UrlInit = :UrlInit WHERE idVideo = :idVideo");
        $this->selectIfTradNull = $db->prepare("SELECT idVideo, UrlInit, Titre, DescriptionVideo FROM `Video` WHERE `UrlTrad` is null");
        $this->selectIfTradNotNull = $db->prepare("SELECT idVideo, UrlInit, Titre, DescriptionVideo FROM `Video` WHERE `UrlTrad` is not null");
        $this->deleteVideoTrad = $db->prepare("UPDATE Video SET UrlTrad = null WHERE idVideo = :idVideo");

    }

    public function ajoutVideoInit($UrlVideo,$Titre,$DescriptionVideo){
        $r = true;
        $this->ajoutVideoInit->execute(array(':UrlInit'=>$UrlVideo,':Titre'=>$Titre,':DescriptionVideo'=>$DescriptionVideo));
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

    public function deuxVideos($idVideo){
        $liste = $this->deuxVideos->execute(array(':idVideo'=>$idVideo));
        if ($this->deuxVideos->errorCode()!=0){
            print_r($this->deuxVideos->errorInfo());
        }
        return $this->deuxVideos->fetch();

    }

    
    public function ajoutVideoTrad($idVideo,$UrlTrad)
    {
        $r = true;
        $this->ajoutVideoTrad->execute(array(':idVideo'=>$idVideo, ':UrlTrad' => $UrlTrad));
        if ($this->ajoutVideoTrad->errorCode() != 0) {
            print_r($this->ajoutVideoTrad->errorInfo());
            $r = false;
        }
        return $r;
    }

    public function deleteVideo($idVideo){
        $r = true;
        $this->deleteVideo->execute(array(':idVideo'=>$idVideo));
        if ($this->deleteVideo->errorCode()!=0){
            print_r($this->deleteVideo->errorInfo());
            $r=false;
        }
        return $r;
    }

    public function updateVideoInit($Titre,$DescriptionVideo,$UrlInit,$idVideo)
    {
        $r = true;
        $this->updateVideoInit->execute(array(':Titre' => $Titre,":DescriptionVideo"=>$DescriptionVideo, ':UrlInit' => $UrlInit,':idVideo'=>$idVideo));
        if ($this->updateVideoInit->errorCode() != 0) {
            print_r($this->updateVideoInit->errorInfo());
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
        $this->deleteVideoTrad->execute(array(':idVideo'=>$idVideo));
        if ($this->deleteVideoTrad->errorCode() != 0) {
            print_r($this->deleteVideoTrad->errorInfo());
            $r = false;
        }
        return $r;
    }
}