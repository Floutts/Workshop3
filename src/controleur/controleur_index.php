<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}


function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}
