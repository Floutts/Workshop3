
<?php


function actionAjoutAssociation($twig) {
    $form = array();
    if (isset($_POST['btAjouter'])) {
        $form['valide'] = true;
        $nomAssos = $_POST['nomAssos'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $tel =$_POST['tel'];
        $form['nomAssos'] = $nomAssos;
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['email'] = $email;
        $form['adresse'] = $adresse;
        $form['tel'] = $tel;

    }

    echo $twig->render('ajoutAssociation.html.twig', array('form'=>$form));
}
function actionListeAssociation($twig) {
    echo $twig->render('listeAssociation.html.twig', array());
}