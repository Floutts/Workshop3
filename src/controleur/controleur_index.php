<?php



function actionAccueil($twig) {
    echo $twig->render('index.html.twig', array());
}

function actionAPropos($twig) {
    echo $twig->render('aPropos.html.twig', array());
}

function actionMentions($twig) {
    echo $twig->render('mentions.html.twig', array());
}

function actionMaintenance($twig) {
    echo $twig->render('maintenance.html.twig', array());
}
function actionConnexion($twig,$db) {
    $form = array();
    if (isset($_POST['btConnecter'])) {
        $form['valide'] = true;
        $email = $_POST['email'];
        $mdp = $_POST['mdp'];
        $utilisateur = new Utilisateur($db);
        $unUtilisateur = $utilisateur->connect($email);
        if ($unUtilisateur!=null) {
            if ($mdp != $unUtilisateur['mdp']) {                        //!password_verify($mdp,$unUtilisateur['mdp'])){
                $form['valide'] = false;
                $form['message'] = 'Login ou mot de passe incorrect';
            } else {
                $_SESSION['login'] = $email;
                $_SESSION['role'] = $unUtilisateur['idRole'];
                header("Location:index.php");
            }
        }
        else{
            $form['valide'] = false;
            $form['message'] = 'Login ou mot de passe incorrect';

        }
    }
    echo $twig->render('connexion.html.twig', array('form'=>$form));
}

function actionDeconnexion($twig){
    session_unset();
    session_destroy();
    header("Location:index.php");
}

function actionOptions($twig,$db){
    $id = $_GET['id'];
    $option = new Option($db);
    $json = json_encode($liste = $option->selectById($id));
    echo $json;
}

function actionOptionSalle($twig,$db){
    $option = new Option($db);
    $json = json_encode($liste = $option->selectOptionSalle());
    echo $json;
}

function actionAssociation($twig,$db){
    $association = new Association($db);
    $json = json_encode($liste = $association->select());
    echo $json;
}

function actionTest($twig,$db){
    $id = $_GET['id'];
    $option = new Option($db);
    $salle = new Salle($db);
    $uneSalle = $salle->selectById($id);
    $optionSalle = $salle->selectOptions($id);
    $s['salle'] = $uneSalle;
    $s['options'] = $optionSalle;
    $json = json_encode($s);
    echo $json;

}

function actionImprimer($twig,$db){
$form = array();

$year = date('Y');




    $date = new Date($db);
    $events = $date->getEvent($year);
    $dates = $date->getAll($year);
    $m = $_GET['idmonth'];
    var_dump($m);




    ?>
    <div class="periods">


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