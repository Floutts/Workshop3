<?php

function actionAjoutVideoInit($twig,$db){

 $form=array();
    if (isset($_POST['submit'])) {
     
        if (! empty($_FILES)) {
            echo '<pre>'.print_r($_FILES,true).'</pre>';
            $file_name = $_FILES['video']['name'];
            $file_extension = strrchr($file_name, ".");
            
            $file_tmp_name = $_FILES['video']['tmp_name'];
            $filedest = '../web/video/videoInit/' . $file_name;
            
            $extension_autorisees = array(
                0 =>'.mp4',
                1 => '.MP4'
            );
            
            echo '<pre>'.print_r($file_extension,true).'</pre>';
            echo '<pre>'.print_r($extension_autorisees,true).'</pre>';
            if (in_array(
                $file_extension,
                $extension_autorisees
            )) {
                echo $file_tmp_name.'<br>';
                echo $filedest;
                if (move_uploaded_file($file_tmp_name, $filedest)) {
                    echo 'Fichier transféré dans '.$filedest;
                    $videoInit = new Video($db);
                    
                    $exec=$videoInit->ajoutVideoInit($filedest);
                    if (!$exec){
                        $form['ajouter'] = false;
                        $form['message'] = 'Problème de d\'ajout d\'une vidéo non traduite';
                    }else{
                        $form['ajouter'] = true;
                    }

                    echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                } else {
                    echo 'Erreur';
                }
            } else {
                echo 'Uniquement .mp4, .MP4';
            }
        }
}
    echo $twig->render('ajoutVideoInit.html.twig',array("form"=>$form));
}

function actionListeVideoInit($twig,$db){
    $video = new Video($db);
    $listeVideo = $video->selectVideoInit();
    echo $twig->render('listeVideoInit.html.twig',array("listeVideo"=>$listeVideo));
}

function actionVideo($twig,$db){

    $idVideo = $_GET['id'];
    
    $video = new Video($db);
    $videoInit = $video->uneVideoInit($idVideo);
    var_dump($videoInit);
    #recup la video traduite via l'id


    echo $twig->render("video.html.twig",array("videoInit"=>$videoInit));
}

function actionAjoutVideoTrad($twig,$db){

    $form=array();
    if(isset($_GET['id'])){
        $form['trad'] = true;
        if (isset($_POST['submit'])) {
            
            if (! empty($_FILES)) {
                echo '<pre>'.print_r($_FILES,true).'</pre>';
                $file_name = $_FILES['video']['name'];
                $file_extension = strrchr($file_name, ".");
                
                $file_tmp_name = $_FILES['video']['tmp_name'];
                $filedest = '../web/video/videoInit/' . $file_name;
                
                $extension_autorisees = array(
                    0 =>'.mp4',
                    1 => '.MP4'
                );
                
                echo '<pre>'.print_r($file_extension,true).'</pre>';
                echo '<pre>'.print_r($extension_autorisees,true).'</pre>';
                if (in_array(
                    $file_extension,
                    $extension_autorisees
                )) {
                    echo $file_tmp_name.'<br>';
                    echo $filedest;
                    if (move_uploaded_file($file_tmp_name, $filedest)) {
                        echo 'Fichier transféré dans '.$filedest;
                        $videoInit = new Video($db);
                        
                        $exec=$videoInit->ajoutVideoInit($filedest);
                        if (!$exec){
                            $form['ajouter'] = false;
                            $form['message'] = 'Problème de d\'ajout d\'une vidéo non traduite';
                        }else{
                            $form['ajouter'] = true;
                        }
    
                        echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                    } else {
                        echo 'Erreur';
                    }
                } else {
                    echo 'Uniquement .mp4, .MP4';
                }
            }
        }
    echo $twig->render('ajoutVideoTrad.html.twig',array("form"=>$form));
    }else{
        $video = new Video($db);
        $listeVideo = $video->selectVideoInit();
        echo $twig->render('ajoutVideoTrad.html.twig',array("form"=>$form,"listeVideo"=>$listeVideo));
    }
   }
   