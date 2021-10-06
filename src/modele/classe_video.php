<?php

class Video{
    private $db;
    private $ajoutVideoInit;
    private $selectVideoInit;
    private $deuxVideos;
    private $ajoutVideoTrad;
    

    public function __construct($db){
        $this->db = $db;
        $this->ajoutVideoInit = $db->prepare("INSERT INTO Video(UrlInit) VALUES (:UrlInit) ");
        $this->selectVideoInit = $db->prepare("SELECT idVideo,UrlInit FROM Video");
        $this->deuxVideos = $db->prepare("SELECT idVideo,UrlInit,UrlTrad FROM Video WHERE idVideo = :idVideo");
        $this->ajoutVideoTrad = $db->prepare("UPDATE Video SET UrlTrad = :UrlTrad WHERE idVideo = :idVideo");
    }

    public function ajoutVideoInit($UrlVideo){
        $r = true;
        $this->ajoutVideoInit->execute(array(':UrlInit'=>$UrlVideo));
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


}