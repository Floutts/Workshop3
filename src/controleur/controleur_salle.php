<?php

function actionGestionSalle($twig,$db) {
    $form = array();
    $salle = new Salle($db);
    $liste = $salle-> select();
    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $superficie = $_POST['superficie'];
        $form['nom'] = $nom;
        $form['prix'] = $prix;
        $form['superficie'] = $superficie;
        $salle = new Salle($db);
        $exec = $salle -> insert($nom,$superficie,$prix);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table option ';
        }

    }

    echo $twig->render('gestionSalle.html.twig', array('form'=>$form,'liste'=>$liste));
}
