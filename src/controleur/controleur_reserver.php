<?php




function actionTableReservation($twig) {
    echo $twig->render('tableReservation.html.twig', array());
}


function actionCalendrier($twig){


    $form = array();
?>
    <!DOCTYPE HTML>
    <html>
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
            <title> Calendrier </title>
            <link href="css/calendar.css" rel="stylesheet">
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">

        </head>
        <body>
        <?php
        $year = date('Y');
        $date = new Date();
        $dates = $date->getAll($year);

        ?>
        <div class="periods">
            <div class="year">
                <?php echo $year ?>
            </div>
            <div class="months">
                <ul>
                    <?php foreach ($date->months as $id=>$m):  ?>
                        <li>
                            <a href="#" id="linkMonth<?php echo $id+1 ?>"> <?php echo utf8_encode(substr(utf8_decode($m),0,3)); ?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <?php $dates = current($dates);
            foreach ($dates as $m=>$days):
            ?>

            <div class="months" id="month<?php echo $m ?>"
            <table class="table">
                <thead>
                <tr>
                    <?php foreach ($date->days as $d): ?>
                        <th scope="col"> <?php echo substr($d,0,3) ?></th>
                    <?php endforeach; ?>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <?php foreach ($days as $d=>$w): ?>
                    <td> <?php echo $d ?> </td>
                    <?php if($w == 7): ?>
                </tr><tr>
                    <?php endif;
                    endforeach;
                    ?>

                </tr>

                </tbody>
            </table>
            <table class="table">
                <thead>
                <tr>
                   <?php foreach ($date->days as $d): ?>
                       <th scope="col"> <?php echo substr($d,0,3) ?></th>
                    <?php endforeach; ?>


                </tr>
                </thead>
                <tbody>
                <tr><?php $end = end($days) ;
                    foreach ($days as $d=>$w): ?>
                    <?php if ($d == 1): ?>
                    <td colspan="<?php echo $w-1; ?> "></td>

                    <?php endif ?>
                    <td> <?php echo $d ?> </td>
                    <?php if($w == 7): ?>
                </tr><tr>
                    <?php endif;
                    endforeach;
                    if ($end != 7):
                    ?>
                    <td colspan="<?php echo 7-$end; ?> "></td>
                    <?php endif ?>

                </tr>

                </tbody>
            </table>


        </div>
                <?php endforeach ?>
        </div>


        <pre><?php print_r($dates)?></pre>


        </body>
        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

        <script type="text/javascript" src="js/cal.js" ></script>

    </html>

    <?php


    foreach ($dates as $m=>$days){
        echo $m;

    foreach ($date->days as $d){
        echo substr($d,0,3);


    }
    }

}

function actionReserver($twig,$db)
{
    $form = array();
    $uneAssociation = NULL;
    $uneSalle = NULL;
    $optionSalle = NULL;
    $association = new Association($db);
    $salle = new Salle($db);
    $option = new Option($db);
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
        $dateDebut = $_POST['DateDebut'];
        $dateFin = $_POST['DateFin'];
        $heureDebut = $_POST['heureDebut'];
        $heureFin = $_POST['heureFin'];

        $form['NomAssociation'] = $NomAssociation;
        $form['prenom'] = $prenom;
        $form['nom'] = $nom;
        $form['email'] = $email;
        $form['adresse'] = $adresse;
        $form['tel'] = $tel;
        $form['motif'] = $motif;
        $form['idSalle'] = $idSalle;
        $form['dateDebut'] = $dateDebut;
        $form['dateFin'] = $dateFin;
        $form['heureDebut'] = $heureDebut;
        $form['heureFin'] = $heureFin;

        $reserver = new Reserver($db);
        $exec = $reserver->insert($NomAssociation, $nom, $prenom, $adresse,$email, $tel, $motif, $idSalle,$dateDebut,$dateFin,$heureDebut, $heureFin);


        if (!$exec) {
            $form['valide'] = false;
            $form['message'] = 'Problème d\'insertion dans la table option ';
        } else {
            $form['valide'] = true;
            $cetteReservation = $reserver->selectByNom($NomAssociation);
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

    echo $twig->render('reserver.html.twig', array('form'=>$form,'listeAssociation'=>$listeAssociation,'listeOption'=>$listeOption,'listeSalle'=>$listeSalle, 'association'=>$uneAssociation,'reserver'=>$uneSalle, 'salle'=>$uneSalle,'optionSalle'=>$optionSalle));

}
