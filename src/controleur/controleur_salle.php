<?php

function actionGestionSalle($twig,$db) {
    $form = array();
    $salle = new Salle($db);
    $option = new Option($db);
    $listeSalle = $salle-> select();
    $listeOption = $option-> select();
    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $superficie = $_POST['superficie'];
        $form['nom'] = $nom;
        $form['prix'] = $prix;
        $form['superficie'] = $superficie;
        $salle = new Salle($db);
        $exec = $salle->insert($nom, $superficie, $prix);
        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table option ';
        } else {
            $cetteSalle = $salle->selectByNom($nom);
            $idSalle = $cetteSalle["id"];
        }
        if (isset($_POST['salleOption'])){
            $salleOption = $_POST['salleOption'];
        }else{
            $salleOption = NULL;
        }

        if($salleOption != NULL) {
            foreach ($salleOption as $idOption) {
                $exec = $salle->ajoutOption($idSalle, $idOption);
                if (!$exec) {
                    $form['valide'] = false;
                    $form['message'] = "problème d'insertion dans la table optionSalle";
                }
            }
        }

    }

    echo $twig->render('gestionSalle.html.twig', array('form'=>$form,'listeSalle'=>$listeSalle,'listeOption'=>$listeOption));
}
