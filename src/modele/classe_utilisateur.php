
<?php
class Utilisateur{
    private $db;
    private $connect;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $db->prepare("select Email, Password, idRole from Utilisateur where Email=:email");
    }

    public function connect($email){
        $this->connect->execute(array(':email'=>$email));
        if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
        }
        return $this->connect->fetch();
    }
}