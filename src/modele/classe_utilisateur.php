
<?php
class Utilisateur{
    private $db;
    private $connect;
    private $insert;

    public function __construct($db){
        $this->db = $db;
        $this->connect = $db->prepare("select IdUtilisateur, Email, Mdp, idRole from Utilisateur where Email=:email");
        $this->insert = $db->prepare("INSERT INTO Utilisateur(Nom, Prenom, Email, Mdp, idRole) VALUES (:Nom,:Prenom,:Email,:Mdp,:idRole)");
    }

    public function connect($email){
        $this->connect->execute(array(':email'=>$email));
        if ($this->connect->errorCode()!=0){
            print_r($this->connect->errorInfo());
        }
        return $this->connect->fetch();
    }

    public function insert($email, $mdp, $idRole, $nom, $prenom) { // Étape 3
        $r = true;
        $this->insert->execute(array(':Email' => $email, ':Mdp' => $mdp, ':idRole' => $idRole, ':Nom' => $nom, ':Prenom' => $prenom));
        if ($this->insert->errorCode() != 0) {
            print_r($this->insert->errorInfo());
            $r = false;
        } return $r;
    }
}