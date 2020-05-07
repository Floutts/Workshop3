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
function actionConnexion($twig) {
    $form = array();
    if (isset($_POST['btConnecter'])) {
        $form['valide'] = true;
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $form['email'] = $email;
        $form['mdp'] = $mdp;
        $_SESSION['login'] = $email;
        $_SESSION['role'] = 1;
        header("Location:index.php");
    }
    echo $twig->render('connexion.html.twig', array());
}
function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
}



