<?php

class Option{
    private $db;
    private $insert;
    private $select;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $db->prepare("insert into option(libelle,prix) values (:libelle,:prix)");
        $this->select = $db->prepare("select * from option");
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
}