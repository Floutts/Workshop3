<?php
function actionGestionOption($twig,$db) {
    $form = array();
    $option = new Option($db);
    $liste = $option-> select();

    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];

        $form['nom'] = $nom;
        $form['prix'] = $prix;

        $option = new Option($db);
        $exec = $option -> insert($nom,$prix);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table option ';
        }
    }
    echo $twig->render('gestionOption.html.twig', array('form'=>$form,'liste'=>$liste));
}
