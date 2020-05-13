<?php
function actionGestionOption($twig,$db) {
    $form = array();
    $unOption=NULL;
    $form['modif'] = true;
    $option = new Option($db);
    $liste = $option-> select();
    $id = $_GET['id'];
    $form['id'] = $id;
    if (($_GET['id']) == 0) {
        $form['modif'] = true;

        echo " vrai";
    }else{
            $form['modif'] = false;
            $unOption = $option->selectById($id);

        echo "faux";
    }
    if (isset($_POST['btModifier'])) {

        $form['modifier'] = true;
        $nom = $_POST['nom'];
        $prix = $_POST['prix'];
        $form['nom'] = $nom;
        $form['prix'] = $prix;
        $option = new Option($db);
        $exec = $option -> update($nom,$prix,$id);
        if (!$exec){
            $form['modifier'] = false;
            $form['message'] = 'Problème de modification dans la table option ';
        }
    }

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
    echo $twig->render('gestionOption.html.twig', array('form'=>$form,'liste'=>$liste, 'option'=>$unOption));
}
