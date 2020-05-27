<?php
function getPage($db)
{

    $lesPages['accueil'] = "actionAccueil";
    $lesPages['gestionSalle'] = "actionGestionSalle";
    $lesPages['gestionOption'] = "actionGestionOption";
    $lesPages['listeAssociation'] = "actionListeAssociation";
    $lesPages['ajoutAssociation'] = "actionAjoutAssociation";
    $lesPages['tableReservation'] = "actionTableReservation";
    $lesPages['reserver'] = "actionReserver";
    $lesPages['aPropos'] = "actionAPropos";
    $lesPages['mentions'] = "actionMentions";
    $lesPages['connexion'] = "actionConnexion";
    $lesPages['deconnexion'] = "actionDeconnexion";
    $lesPages['maintenance'] = "actionMaintenance";
    $lesPages['profilSalle'] = "actionProfilsalle";
    $lesPages['reserverBis'] = "actionReserverBis";
    $lesPages['testAjax'] = "actionTestAjax";
    $lesPages['options'] = "actionOptions";
    $lesPages['optionSalle'] = "actionOptionSalle";
    $lesPages['association'] = "actionAssociation";



if ($db != null) {
    if (isset($_GET['page'])) {
        $page = $_GET['page'];
    } else {
        $page = 'accueil';
    }
    if (!isset($lesPages[$page])) {
        $page = 'accueil';
    }

    $contenu = $lesPages[$page];
}
else{
    $contenu = $lesPages['maintenance'];
}
    return $contenu; }
?>