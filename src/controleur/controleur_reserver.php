<?php


function actionProfilReservation($twig,$db) {
    if(isset($_GET["id"])) {
        $idReservation = $_GET["id"];
        $reserver = new Reserver($db);
        $uneReservation = $reserver->selectById($idReservation);
        $salleReservation = $reserver -> selectSalleReservation($idReservation);
        $optionReservation = $reserver -> selectOptionReservation($idReservation);


    }else{
        $uneReservation = null;
        $salleReservation = null;
        $optionReservation = null;
    }




    echo $twig->render('profilReservation.html.twig', array( 'uneReservation' => $uneReservation, 'salleReservation' => $salleReservation, 'optionReservation'=>$optionReservation));
}




function actionTableReservation($twig,$db){

    $form = array();

    ?>

    <!DOCTYPE HTML>
    <html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
        <title> Calendrier </title>
        <link href="css/calendar.css" rel="stylesheet">

    </head>
    <body class="bg-light">
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary">
        <a class="navbar-brand" href=index.php?page=acceuil>Projet Salle</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php?page=acceuil">Acceuil <span class="sr-only">(current)</span></a>
                </li>

              <?php  if ($_SESSION != NULL):?>
                  <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          Administration
                      </a>
                      <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                          <a class="dropdown-item" href="index.php?page=ajoutAssociation"> Ajouter une association </a>
                          <a class="dropdown-item" href="index.php?page=listeAssociation"> liste des associations </a>
                          <div class="dropdown-divider"></div>
                          <a class="dropdown-item" href="index.php?page=gestionSalle"> Gestion des salles </a>
                          <a class="dropdown-item" href="index.php?page=gestionOption"> Gestion des options</a>
                      </div>
                  </li>
              <?php  endif ?>




                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Salles
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="index.php?page=tableReservation&annee=0"> Tableau de réservation </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="index.php?page=reserver"> Réserver</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=aPropos"> A propos </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=mentions"> Mentions légales </a>
                </li>
                <?php  if ($_SESSION != NULL):?>
            </ul>
            <ul class="nav nav-tabs">
                    <li class="nav-item">
                        <a class="nav-link active" href="index.php?page=deconnexion">Deconnexion</a>
                    </li>
                <li class="nav-item">
                    <a class="nav-link active" href="#"><?php echo $_SESSION['login'] ?></a>
                </li>

                <?php elseif($_SESSION == NULL) : ?>
            </ul>
            <ul class="nav nav-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=connexion">Se connecter</a>
                </li>
                <?php  endif ?>
            </ul>
        </div>
    </nav>
    <table class="table">
        <thead class="thead-dark">
        <tr>
                <th scope="col">
                    <?php
                    $idYear =$_GET['annee'];
                    $year = date('Y');
                    $year = $year + $idYear;


                    ?>
                    <input type="text" id="anneeActuelle" name="anneeActuelle" class="form-control" value="" hidden>

                    <div class="mx-auto" style="width: 200px;">
                        <h4>
                        <a href="index.php?page=tableReservation&annee=<?php echo $idYear = $idYear - 1 ?>"> < </a>
                        <a>  <?php echo $year ?> </a>
                        <a href="index.php?page=tableReservation&annee=<?php echo $idYear = $idYear + 2 ?>"> > </a>
                        </h4>
                    </div>


                </th>

        </tr>
        </thead>
    </table>

    <?php



    $date = new Date($db);
    $events = $date->getEvent($year);
    $dates = $date->getAll($year);




    ?>
    <div class="periods">


        <table class="table">
            <thead class="thead-dark">
            <tr>
                <?php foreach ($date->months as $id=>$m):  ?>
                    <th scope="col">
                        <a href="#" id="linkMonth<?php echo $id+1 ?>"> <?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a>
                    </th>
                <?php endforeach; ?>

            </tr>
            </thead>
        </table>

        <?php $dates = current($dates);
        foreach ($dates as $m=>$days):

            ?>
            <div id="dateActuelle"> </div>
            <div class="months" id="month<?php echo $m ?>">
                <table class="table">
                    <thead>
                    <tr>
                        <?php foreach ($date->days as $d): ?>
                            <th scope="col"> <?php echo substr($d,0,3) ?></th>
                        <?php endforeach; ?>


                    </tr>
                    </thead>
                    <tbody>
                    <br><?php $end = end($days) ;

                    foreach ($days as $d=>$w): ?>
                    <?php if ($d == 1): ?>
                        <?php if($w != 1 ): ?>
                            <td colspan="<?php echo $w-1;  ?> "></td>
                        <?php endif ?>
                    <?php endif ?>

                    <td>
                        <?php echo $d;
                        echo "  Reservations du jour";

                        ?> <h5> </h5> <?php
                        //  init la date

                        $time = ("$year-$m-$d");

                        //$time = strtotime($time);
                        //
                        $salle = new Salle($db);
                        $liste = $salle ->select();
                        $mun = 0;

                        // Seulement les salles réservées sont affichées

                        foreach ($events as $reservation) {
                        // RESERVATION EVENT
                        $unEvent = $events[$mun];

                        $debutEvent = $unEvent[2];
                        $finEvent = $unEvent[4];
                        $HdebutEvent = $unEvent[2];
                        $HfinEvent = $unEvent[4];

                        // $debutEvent = strtotime($debutEvent);
                        // $finEvent = strtotime($finEvent);
                        $idSalleEvent = $unEvent[3];
                        $mun = $mun + 1;
                        $num = 0;
                        $debutEvent =  DateTime::createFromFormat('Y-m-d H:i:s',$debutEvent)->format('Y-n-d');
                        $finEvent =  DateTime::createFromFormat('Y-m-d H:i:s',$finEvent)->format('Y-n-d');
                        $HdebutEvent =  DateTime::createFromFormat('Y-m-d H:i:s',$HdebutEvent)->format('H:i');
                        $HfinEvent =  DateTime::createFromFormat('Y-m-d H:i:s',$HfinEvent)->format('H:i');



                        // date en seconde
                        $d1 = DateTime::createFromFormat('Y-m-d', $debutEvent);
                        //   echo $d1->getTimestamp();
                        ?> <h5> </h5> <?php
                        $d2 = DateTime::createFromFormat('Y-m-d', $finEvent);
                        //  echo $d2->getTimestamp();
                        ?> <h5> </h5> <?php
                        //  echo gettype($d2);


                        //
                        foreach ($liste as $salle) {
                        // recupere info par salle

                        $infoSalle = $liste[$num];
                        $nomSalle = $infoSalle[1];
                        $idSalle = $infoSalle[0];


                        // Condition d'affichage si Reservation
                        if ("$time" == "$debutEvent") {
                            if ($idSalle == $idSalleEvent) {
                        $idEvent = $unEvent[0];

                        if ($debutEvent != $finEvent){
                                    ?> <p style="color:red;">
                                    <a href="index.php?page=profilReservation&id=<?php echo $idEvent ?>" class="text-reset" style="padding-right: 10px"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                    <?php echo "<---  ",$nomSalle, " ", $HdebutEvent  ;

                                }else{

                                    ?> <p style="color:red;">
                            <a href="index.php?page=profilReservation&id=<?php echo $idEvent ?>" class="text-reset" style="padding-right: 10px"><i class="fa fa-eye" aria-hidden="true"></i></a>
                            <?php echo $nomSalle, " ", $HdebutEvent," ", $HfinEvent  ;

                            }
                            }
                        }

                        if ("$time" == "$finEvent") {
                            if ($idSalle == $idSalleEvent) {
                                if ($debutEvent != $finEvent){
                                    ?> <p style="color:red;"> <?php echo $nomSalle, " ", $HfinEvent,  "  --->"  ;
                                }
                            }
                        }
                            $num = $num + 1;


                            // Toutes les salles sont affichés en libre ou réservé
                            /*
                            if ("$time" == "$e") {
                                if ($idSalle == $idSalleEvent) {
                                    ?>
                                    <p style="color:red;"> <?php echo $nomSalle, " : "; ?>
                                    <?php

                                } else {
                                    ?>
                                    <p> <?php echo $nomSalle, " : "; ?>
                                    <?php
                                }
                            } else {
                                ?>
                                <p> <?php echo $nomSalle, " : ";  }?>

                                <?php
                                if ("$time" == "$e") {
                                    if ($idSalle == $idSalleEvent) {
                                        ?>

                                        RESERVE</p>
                                        <?php

                                    } else {
                                        ?>
                                        Libre </p>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    Libre </p>
                                    <?php
                                }
                                ?> <h5></h5> <?php
                                $num = $num + 1;
                            */


                            }
                            }






                            ?>

                    </td>
                    <?php if($w == 7): ?>
                    </tr><tr>
                        <?php endif;
                        endforeach;
                        if ($end != 7):
                            ?>
                            <td colspan="<?php echo 7-$end; ?> ">
                            </td>
                        <?php endif ?>

                    </tr>

                    </tbody>
                </table>


            </div>
        <?php endforeach ;

        ?>

    </div>



    </body>
    <script src="https://code.jquery.com/jquery-3.1.1.min.js" </script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

    <script type="text/javascript" src="js/cal.js" ></script>

    </html>

    <?php



}

function actionReserver($twig,$db)
{
    $form = array();
    $uneAssociation = NULL;
    $uneSalle = NULL;
    $optionSalle = NULL;
    $uneReservation = NULL ;
    $association = new Association($db);
    $salle = new Salle($db);
    $option = new Option($db);
    $reserver = new Reserver($db);
    $listeAssociation = $association->select();
    $listeSalle = $salle->select();
    $listeOption = $option->select();



    if (isset($_POST['btValider'])) {
        $NomAssociation = $_POST['nomAssociation'];
        $prenom = $_POST['prenom'];
        $nom = $_POST['nom'];
        $email = $_POST['email'];
        $adresse = $_POST['adresse'];
        $tel = $_POST['tel'];
        $motif = $_POST['motif'];
        $idSalle = $_POST['idSalle'];
        //$dateDebut = $_POST['DateDebut'];
        //$dateFin = $_POST['DateFin'];
        //$heureDebut = $_POST['heureDebut'];
        //$heureFin = $_POST['heureFin'];
        $dateTimeDebut = $_POST['DateTimeDebut'];
        $dateTimeFin = $_POST['DateTimeFin'];


        $form['NomAssociation'] = $NomAssociation;
        $form['prenom'] = $prenom;
        $form['nom'] = $nom;
        $form['email'] = $email;
        $form['adresse'] = $adresse;
        $form['tel'] = $tel;
        $form['motif'] = $motif;
        $form['idSalle'] = $idSalle;
        //$form['dateDebut'] = $dateDebut;
        //$form['dateFin'] = $dateFin;
        //$form['heureDebut'] = $heureDebut;
        //$form['heureFin'] = $heureFin;
        $form['dateTimeDebut'] = $dateTimeDebut;
        $form['dateTimeFin'] = $dateTimeFin;
        if ($idSalle == "-- Selectionner une salle --") {
            $form['valide'] = false;
            $form['message'] = 'Vous n\'avez pas séléctionné de salle ';
        } else {
            $listeReservation = $reserver->selectByDate($idSalle,$dateTimeDebut, $dateTimeFin);
            if ($listeReservation != null) {
                $form['valide'] = false;
                $form['message'] = 'Une reservation a deja lieu sur ce creneau horaire ';
            } else {
                if (strtotime($dateTimeDebut) > strtotime($dateTimeFin)) {
                    $form['valide'] = false;
                    $form['message'] = 'Votre date de fin est inférieure a votre date de début ';
                } else {


                    $exec = $reserver->insert($NomAssociation, $nom, $prenom, $adresse, $email, $tel, $motif, $idSalle, $dateTimeDebut, $dateTimeFin);


                    if (!$exec) {
                        $form['valide'] = false;
                        $form['message'] = 'Problème d\'insertion dans la table option ';
                    } else {
                        $form['valide'] = true;
                        $cetteReservation = $reserver->selectByNom($idSalle, $dateTimeDebut);

                        $idReservation = $cetteReservation["id"];
                        if (isset($_POST['optionSalle'])) {
                            $optionSalle = $_POST['optionSalle'];
                        } else {
                            $optionSalle = NULL;

                        }

                        if ($optionSalle != NULL) {
                            foreach ($optionSalle as $idOption) {
                                $exec = $reserver->insertOptionReservation($idOption, $idReservation);
                                if (!$exec) {

                                    $form['valide'] = false;
                                    $form['message'] = "problème d'insertion dans la table optionSalle";

                                }
                            }
                        }
                    }
                }

            }
        }
    }

    if (isset($_GET['idsup'])) {
        $exec1=$reserver->deleteById($_GET['idsup']);
        if (!$exec1){
            $form['supprimer'] = false;
            $form['message'] = 'Problème de suppression dans la table option';
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
    echo $twig->render('reserver.html.twig', array('form'=>$form,'uneReservation'=>$uneReservation, 'listeAssociation'=>$listeAssociation,'listeOption'=>$listeOption,'listeSalle'=>$listeSalle, 'association'=>$uneAssociation,'reserver'=>$uneSalle, 'salle'=>$uneSalle,'optionSalle'=>$optionSalle));

}
