<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}


function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}

function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
}

function actionConnexion($twig,$db){
    $form = array();
    if (isset($_POST['btConnecter'])) {
        $form['valide'] = true;
        $email = $_POST['Email'];
        $mdp = $_POST['Password'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($email);
        if ($unUtilisateur!=null) {
            if ($mdp != $unUtilisateur['Password']) {                        //!password_verify($mdp,$unUtilisateur['mdp'])){
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
    echo $twig->render('connexion.html.twig',array());
}