<?php

class Video{
    private $db;
    private $ajoutVideoInit;
    private $selectVideoInit;
    private $uneVideoInit;

    public function __construct($db){
        $this->db = $db;
        $this->ajoutVideoInit = $db->prepare("INSERT INTO Video(UrlInit) VALUES (:UrlInit) ");
        $this->selectVideoInit = $db->prepare("SELECT idVideo,UrlInit FROM Video");
        $this->uneVideoInit = $db->prepare("SELECT UrlInit FROM Video WHERE idVideo = :idVideo");
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

    public function uneVideoInit($idVideo){
        $liste = $this->uneVideoInit->execute(array(':idVideo'=>$idVideo));
        if ($this->uneVideoInit->errorCode()!=0){
            print_r($this->uneVideoInit->errorInfo());
        }
        return $this->uneVideoInit->fetchAll();

    }



}