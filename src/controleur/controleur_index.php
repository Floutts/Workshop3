<?php

function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}

function actionSalles($twig) {
    echo $twig->render('salles.html.twig', array());
}



