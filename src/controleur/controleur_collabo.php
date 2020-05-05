<?php

function actionAjoutCollabo($twig) {
    $form = array();
    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $confMdp =$_POST['confMdp'];
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $email;
        $form['mdp'] = $mdp;
        $form['confMdp'] = $confMdp;

        if ($mdp!=$confMdp){
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        }
    }

    echo $twig->render('ajoutCollabo.html.twig', array('form'=>$form));
}
function actionListeCollabo($twig) {
    echo $twig->render('listeCollabo.html.twig', array());
}
