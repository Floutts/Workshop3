<?php

function actionTableReservation($twig) {
    echo $twig->render('tableReservation.html.twig', array());
}

function actionReserver($twig) {
    echo $twig->render('reserver.html.twig', array());
}