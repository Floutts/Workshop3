<?php

function actionAjoutCollaborateur($twig) {
    echo $twig->render('ajoutCollaborateur.html.twig', array());
}
function actionListeCollaborateur($twig) {
    echo $twig->render('listeCollaborateur.html.twig', array());
}
