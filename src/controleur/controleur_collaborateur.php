<?php

function actionAjoutCollaborateur($twig) {
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

    echo $twig->render('ajoutCollaborateur.html.twig', array('form'=>$form));
}
function actionListeCollaborateur($twig) {
    echo $twig->render('listeCollaborateur.html.twig', array());
}
