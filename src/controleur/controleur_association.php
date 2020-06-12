
<?php


function actionAjoutAssociation($twig,$db) {
    $form = array();
    $association = new Association($db);
    $uneAssociation=NULL;

    if (isset($_GET['id'])) {
        $form['modif'] = true;
        $id = $_GET['id'];
        $form['id'] = $id;
        $uneAssociation = $association->selectById($id);
    }else{
        $form['modif'] = false;
    }





    if (isset($_POST['btModifier'])) {

        $form['modifier'] = true;
        $nomAssociation = $_POST['nomAssociation'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $tel =$_POST['tel'];
        $form['nomAssociation'] = $nomAssociation;
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $email;
        $form['adresse'] = $adresse;
        $form['tel'] = $tel;
        $longueur = strlen($tel);
        if ($longueur != 10 or $tel{0}!=0 ){
            $form['modifier'] = false;
            $form['message'] = 'Le numero de téléphone n\'est pas valide ';
        }
        else {
            $association = new Association($db);
            $exec = $association -> update($nomAssociation,$nom,$prenom,$email,$adresse,$tel,$id);
            if (!$exec){
                $form['modifier'] = false;
                $form['message'] = 'Problème d\'insertion dans la table option ';
            }
        }

    }


    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nomAssociation = $_POST['nomAssociation'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $tel =$_POST['tel'];
        $form['nomAssociation'] = $nomAssociation;
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $email;
        $form['adresse'] = $adresse;
        $form['tel'] = $tel;
        $longueur = strlen($tel);
        if ($longueur != 10 or $tel{0}!=0 ){
            $form['valide'] = false;
            $form['message'] = 'Le numero de téléphone n\'est pas valide ';
        }
        else {
            $association = new Association($db);
            $exec = $association -> insert($nomAssociation,$nom,$prenom,$email,$adresse,$tel);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table option ';
            }
        }


    }

    echo $twig->render('ajoutAssociation.html.twig', array('form'=>$form, 'association'=>$uneAssociation));
}
function actionListeAssociation($twig,$db) {
    $form = array();
    $association = new Association($db);
    $liste = $association-> select();
    if(isset($_GET['idsup'])){
        $exec=$association->delete($_GET['idsup']);
        if (!$exec){
            $form['supprimer'] = false;
            $form['message'] = 'Problème de suppression dans la table produit';
        }
        else{
            $form['supprimer'] = true;
            $form['message'] = 'Association supprimée avec succès';
        }
    }

    echo $twig->render('listeAssociation.html.twig', array('liste'=>$liste,'form'=>$form ));
}