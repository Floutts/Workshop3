<?php

class Video{
    private $db;
    private $ajoutVideoInit;
    private $selectVideoInit;

    public function __construct($db){
        $this->db = $db;
        $this->ajoutVideoInit = $db->prepare("INSERT INTO VideoInit(UrlVideo) VALUES (:UrlVideo) ");
        $this->selectVideoInit = $db->prepare("SELECT UrlVideo FROM VideoInit");
    }

    public function ajoutVideoInit($UrlVideo){
        $r = true;
        $this->ajoutVideoInit->execute(array(':UrlVideo'=>$UrlVideo));
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



}