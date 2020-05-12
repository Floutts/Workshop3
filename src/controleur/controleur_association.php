
<?php


function actionAjoutAssociation($twig,$db) {
    $form = array();

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

    echo $twig->render('ajoutAssociation.html.twig', array('form'=>$form));
}
function actionListeAssociation($twig,$db) {
    $association = new Association($db);
    $liste = $association-> select();
    echo $twig->render('listeAssociation.html.twig', array('liste'=>$liste));
}