<?php
function actionGestionOption($twig,$db) {
    $optionSalle = null;
    $form = array();
    $unOption=NULL;
    $form['modif'] = true;
    $option = new Option($db);
    $salle = new Salle($db);
    $listeOption = $option-> select();
    $listeSalle = $salle-> select();


    if (isset($_GET['id'])) {
        $form['modif'] = true;
        $id = $_GET['id'];
        $form['id'] = $id;
        $unOption = $option->selectById($id);

    }else{
            $form['modif'] = false;
        //$unOption = $option->selectById($id);

    }

    if(isset($_GET['idsup'])){
        $exec2=$option->deleteOptionReservation($_GET['idsup']);
        if (!$exec2) {
            $form['supprimer'] = false;
            $form['message'] = 'Problème de suppression dans la table optionReservation ' ;
        }
        $exec1=$option->deleteById($_GET["idsup"]);
        if (!$exec1){
            $form['supprimer'] = false;
            $form['message'] = 'Problème de suppression dans la table optionSalle';
        }else{
            $exec=$option->delete($_GET['idsup']);
            if (!$exec){
                $form['supprimer'] = false;
                $form['message'] = 'Problème de suppression dans la table option';
            }
            else{
                $form['supprimer'] = true;
                $form['message'] = 'Option supprimée avec succès';
            }
        }

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
        }else {
            $cetteOption = $option->selectByNom($nom);
            $idOption = $cetteOption["id"];
        }
        if (isset($_POST['optionSalle'])){
            $optionSalle = $_POST['optionSalle'];
        }else{
            $optionSalle = NULL;
        }
        $form['modifier']=true;
        $exec = $option->deleteByOption($idOption);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = "problème d'insertion dans la table";
        }
        if($optionSalle != NULL) {
            foreach ($optionSalle as $idSalle) {
                $exec = $option->ajoutSalle($idSalle, $idOption);
                if (!$exec) {
                    $form['valide'] = false;
                    $form['message'] = "problème d'insertion dans la table optionSalle";
                }
            }
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
        }else {
            $cetteOption = $option->selectByNom($nom);
            $idOption = $cetteOption["id"];
        }

        if (isset($_POST['optionSalle'])){
            $optionSalle = $_POST['optionSalle'];
        }else{
            $optionSalle = NULL;
        }
        if($optionSalle != NULL) {
            foreach ($optionSalle as $idSalle) {
                $exec = $option->ajoutSalle($idSalle, $idOption);
                if (!$exec) {
                    $form['valide'] = false;
                    $form['message'] = "problème d'insertion dans la table optionSalle";
                }
            }
        }

    }

    $limite=5;
    if(!isset($_GET['nopage'])){
        $inf=0;
        $nopage=0;
    }
    else{
        $nopage=$_GET['nopage'];
        $inf=$nopage * $limite;
    }
    $r = $option->selectCount();
    $nb = $r['nb'];


    $listeOption = $option->selectLimit($inf,$limite);
    $form['nbpages'] = ceil($nb/$limite);

    echo $twig->render('gestionOption.html.twig', array('form'=>$form,'listeOption'=>$listeOption,'listeSalle'=>$listeSalle,'option'=>$unOption));

}
