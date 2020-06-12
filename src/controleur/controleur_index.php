<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}

function actionAPropos($twig) {
    echo $twig->render('aPropos.html.twig', array());
}

function actionMentions($twig) {
    echo $twig->render('mentions.html.twig', array());
}

function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}
function actionConnexion($twig,$db) {
    $form = array();
    if (isset($_POST['btConnecter'])) {
        $form['valide'] = true;
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($email);
        if ($unUtilisateur!=null) {
            if ($mdp != $unUtilisateur['mdp']) {                        //!password_verify($mdp,$unUtilisateur['mdp'])){
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
            } else {
                $_SESSION['login'] = $email;
                $_SESSION['role'] = $unUtilisateur['idRole'];
                header("Location:index.php");
            }
        }
        else{
            $form['valide'] = false;
            $form['message'] = 'Login ou mot de passe incorrect';

        }
    }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}

function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
}

function actionOptions($twig,$db){
    $id = $_GET['id'];
    $option = new Option($db);
    $json = json_encode($liste = $option->selectById($id));
    echo $json;
}

function actionOptionSalle($twig,$db){
    $option = new Option($db);
    $json = json_encode($liste = $option->selectOptionSalle());
    echo $json;
}

function actionAssociation($twig,$db){
    $id = $_GET['id'];
    $association = new Association($db);
    $json = json_encode($liste = $association->selectById($id));
    echo $json;
}

function actionTest($twig,$db){
    $id = $_GET['id'];
    $option = new Option($db);
    $salle = new Salle($db);
    $uneSalle = $salle->selectById($id);
    $optionSalle = $salle->selectOptions($id);
    $s['salle'] = $uneSalle;
    $s['options'] = $optionSalle;
    $json = json_encode($s);
    echo $json;

}


