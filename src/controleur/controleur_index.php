<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}

function actionAPropos($twig) {
    echo $twig->render('aPropos.html.twig', array());
}

function actionMentions($twig) {
    echo $twig->render('mentions.html.twig', array());
}



