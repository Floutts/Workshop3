<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}


function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}

function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
}

function actionConnexion($twig,$db){
    $form = array();
    $form['valide'] = true;
    if (isset($_POST['btConnecter'])){                
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($email);
        if ($unUtilisateur!=null){
            if(!password_verify($mdp,$unUtilisateur['Mdp'])){
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
            }
            else{
                $_SESSION['login'] = $email;
                $_SESSION['role'] = $unUtilisateur['idRole'];
                $_SESSION['id'] = $unUtilisateur['IdUtilisateur'];
                header("Location:index.php");
            }
        }
        else{
            $form['valide'] = false;
            $form['message'] = 'Login ou mot de passe incorrect';

        }
    }
    echo $twig->render('connexion.html.twig',array('form'=>$form));
}

function actionInscription($twig,$db){
    $form = array();
    if (isset($_POST['btInscrire'])){
        $email = $_POST['email'];
        $nom = $_POST['nom'];
        $prenom = $_POST['prenom'];
        $mdp = $_POST['mdp'];
        $mdp2 =$_POST['mdp2'];
        $role = $_POST['role'];
        $form['valide'] = true;
        if ($mdp!=$mdp2){
            $form['valide'] = false;
            $form['message'] = 'Les mots de passe sont différents';
        }
        else{
            $utilisateur = new Utilisateur($db);
            $exec = $utilisateur->insert($email, password_hash($mdp,PASSWORD_DEFAULT), $role, $nom, $prenom);
            if (!$exec){
                $form['valide'] = false;
                $form['message'] = 'Problème d\'insertion dans la table utilisateur ';
            }

        }
        $form['email'] = $email;
        $form['nom'] = $nom;
        $form['prenom'] = $prenom;
        $form['role'] = $role;
    }
    echo $twig->render('inscription.html.twig',array('form'=>$form));
}

function actionAPropos($twig,$db){

    echo $twig->render('aPropos.html.twig',array());
}

function actionMentions($twig,$db){

    echo $twig->render('mentions.html.twig',array());
}