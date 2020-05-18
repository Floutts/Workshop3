<?php

function actionTableReservation($twig) {
    echo $twig->render('tableReservation.html.twig', array());
}

function actionReserver($twig,$db) {
    $form = array();
    $association = new Association($db);
    $salle = new Salle($db);
    $option = new Option($db);
    $listeAssociation = $association->select();
    $listeSalle = $salle->select();
    $listeOption = $option->select();

    echo $twig->render('reserver.html.twig', array('listeAssociation'=>$listeAssociation,'listeOption'=>$listeOption,'listeSalle'=>$listeSalle));
}