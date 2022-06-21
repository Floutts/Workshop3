<?php
function getPage($db)
{

    $lesPages['accueil'] = "actionAccueil;0";
    $lesPages['maintenance'] = "actionMaintenance;0";
    $lesPages['connexion'] = "actionConnexion;0";
    $lesPages['deconnexion'] = "actionDeconnexion;0";
    $lesPages['ajoutVideoInit'] = "actionAjoutVideoInit;1;4";
    $lesPages['listeVideo'] = "actionListeVideo;1;2;3;4";
    $lesPages['ajoutVideoTrad'] = "actionAjoutVideoTrad;1;3";
    $lesPages['inscription'] = "actionInscription;0";
    $lesPages['aPropos'] = "actionAPropos;0";
    $lesPages['mentions'] = "actionMentions;0";
    $lesPages['gestionVideoInit'] = "actionGestionVideoInit;1;4";
    $lesPages['supprimerVideo'] = "actionSupprimerVideo;1";
    $lesPages['modifVideoInit'] = "actionModifVideoInit;1;4";
    $lesPages['gestionVideoTrad'] = "actionGestionVideoTrad;1;3";
    $lesPages['modifVideoTrad'] = "actionModifVideoTrad;1;3";
    





    if ($db!=null){
        if(isset($_GET['page'])){
            // Nous mettons dans la variable $page, la valeur qui a été passée dans le lien
            $page = $_GET['page']; }
        else{
            // S'il n'y a rien en mémoire, nous lui donnons la valeur « accueil » afin de lui afficher une page
            //par défaut
            $page = 'accueil';
        }
        if (!isset($lesPages[$page])){
            // Nous rentrons ici si cela n'existe pas, ainsi nous redirigeons l'utilisateur sur la page d'accueil
            $page = 'accueil';
        }

        $explose = explode(";" ,$lesPages[$page]) ;
        $role = array();
        for($i = 1;$i < count($explose);$i++){
            array_push($role,$explose[$i]);
        }
            if ($role[0] != 0){ // Si mon rôle nécessite une vérification
                if(isset($_SESSION['login'])){ // Si je me suis authentifié
                    if(isset($_SESSION['role'])){ // Si j’ai bien un rôle
                        for($i = 0; $i < count($role);$i++){
                                if($role[$i]!=$_SESSION['role']){ // Si mon rôle ne correspond pas à celui qui est nécessaire pour voir la page
                                    $contenu = 'actionAccueil'; // Je le redirige vers l’accueil, car il n’a pas le bon rôle
                                }
                                else{
                                    $contenu = $explose[0];
                                    break; // Je récupère le nom du contrôleur, car il a le bon rôle
                                }
                        }
                    }
                    else{
                        $contenu = 'actionAccueil';
                    }
                }
                else{
                    $contenu = 'actionAccueil'; // Page d’accueil, car il n’est pas authentifié
                }
            }else{
                $contenu = $explose[0]; // Je récupère le contrôleur, car il n’a pas besoin d’avoir un rôle
            }
    }
    else{
    // Si $db est null
    $contenu = 'actionMaintenance';
    }
    // La fonction envoie le contenu
    return $contenu;
}


?>