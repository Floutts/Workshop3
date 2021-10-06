<?php
function getPage($db)
{

    $lesPages['accueil'] = "actionAccueil;0";
    $lesPages['maintenance'] = "actionMaintenance;0";
    $lesPages['connexion'] = "actionConnexion;0";
    $lesPages['deconnexion'] = "actionDeconnexion;0";
    $lesPages['ajoutVideoInit'] = "actionAjoutVideoInit;0";
    $lesPages['listeVideo'] = "actionListeVideo;0";
    $lesPages['ajoutVideoTrad'] = "actionAjoutVideoTrad;0";
    





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
        $role = $explose[1] ; // Le rôle est dans la 2ème partie du tableau $explose
        if ($role != 0){ // Si mon rôle nécessite une vérification
            if(isset($_SESSION['login'])){ // Si je me suis authentifié
                if(isset($_SESSION['role'])){ // Si j’ai bien un rôle
                    if($role!=$_SESSION['role']){ // Si mon rôle ne correspond pas à celui qui est nécessaire pour voir la page

                        $contenu = 'actionAccueil'; // Je le redirige vers l’accueil, car il n’a pas le bon rôle
                    }
                    else{
                        $contenu = $explose[0]; // Je récupère le nom du contrôleur, car il a le bon rôle
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