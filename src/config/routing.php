<?php
function getPage()
{

    $lesPages['accueil'] = "actionAccueil";
    $lesPages['ajoutCollabo'] = "actionAjoutCollabo";
    $lesPages['listeCollabo'] = "actionListeCollabo";
    $lesPages['gestionSalle'] = "actionGestionSalle";
    $lesPages['gestionOption'] = "actionGestionOption";
    $lesPages['gestionAssos'] = "actionGestionAssos";
    $lesPages['tableReservation'] = "actionTableReservation";
    $lesPages['reserver'] = "actionReserver";
    $lesPages['aPropos'] = "actionAPropos";
    $lesPages['mentions'] = "actionMentions";



    if(isset($_GET['page'])){
        $page = $_GET['page'];
    }
    else{
        $page = 'accueil';
    }
    if (!isset($lesPages[$page])){
        $page = 'accueil';
    }

    $contenu = $lesPages[$page];
    return $contenu; }
?>