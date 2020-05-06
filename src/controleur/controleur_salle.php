<?php

function actionGestionSalle($twig) {
    $form = array();
    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $superficie = $_POST['superficie'];

        $form['nom'] = $nom;
        $form['prix'] = $prix;
        $form['superficie'] = $superficie;


    }

    echo $twig->render('gestionSalle.html.twig', array('form'=>$form));
}
