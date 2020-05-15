
<?php


function actionAjoutAssociation($twig,$db) {
    $form = array();
    $association = new Association($db);
    $uneAssociation=NULL;
    $id = $_GET['id'];
    $form['id'] = $id;
    if (($_GET['id']) == 0) {
        $form['modif'] = true;
    }else{
        $form['modif'] = false;
        $uneAssociation = $association->selectById($id);
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
        $association = new Association($db);
        $exec = $association -> update($nomAssociation,$nom,$prenom,$email,$adresse,$tel,$id);
        if (!$exec){
            $form['modifier'] = false;
            $form['message'] = 'Problème de modification dans la table association ';
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
        $association = new Association($db);
        $exec = $association -> insert($nomAssociation,$nom,$prenom,$email,$adresse,$tel);
        if (!$exec){
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table option ';
        }
    }

    echo $twig->render('ajoutAssociation.html.twig', array('form'=>$form, 'association'=>$uneAssociation));
}
function actionListeAssociation($twig,$db) {
    $association = new Association($db);
    $liste = $association-> select();
    if(isset($_GET['id'])){
        $exec=$association->delete($_GET['id']);
        if (!$exec){
            $form['modifier'] = false;
            $form['message'] = 'Problème de suppression dans la table produit';
        }
        else{
            $form['modifier'] = true;
            $form['message'] = 'Produit supprimé avec succès';
        }
    }

    echo $twig->render('listeAssociation.html.twig', array('liste'=>$liste ));
}