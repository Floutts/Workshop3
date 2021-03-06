<?php

function actionAjoutVideoInit($twig,$db){

    $form=array();
    if (isset($_POST['submit'])) {
        $titre = $_POST['titre'];
        $descriptionVideo = $_POST['descriptionVideo'];
        if (! empty($_FILES)) {
            $file_name = $_FILES['video']['name'];
            $file_extension = strrchr($file_name, ".");
            
            $file_tmp_name = $_FILES['video']['tmp_name'];
            $filedest = '../web/video/videoInit/' . $file_name;
            
            $extension_autorisees = array(
                0 =>'.mp4',
                1 => '.MP4'
            );
            if (in_array(
                $file_extension,
                $extension_autorisees
            )) {
                if (move_uploaded_file($file_tmp_name, $filedest)) {
                $videoInit = new Video($db);
                var_dump($_SESSION);
                
                $exec=$videoInit->ajoutVideoInit($_SESSION['id'],$titre,$descriptionVideo,$filedest);
                if (!$exec){
                    $form['ajouter'] = false;
                    $form['message'] = 'Problème de d\'ajout d\'une vidéo non traduite';
                }else{
                    $form['ajouter'] = true;
                }
                echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                header("Location:index.php?page=listeVideo");
            }else{
                echo 'Erreur lors de l\'ajout de la vidéo dans le serveur';
            }

            } else {
                echo 'Uniquement .mp4, .MP4';
            }
        }
    }  
    echo $twig->render('ajoutVideoInit.html.twig',array("form"=>$form));
}

function actionListeVideo($twig,$db){
    $form = array();
    $video = new Video($db);


    if(isset($_GET['id'])){
        $idVideo = $_GET['id'];
    
        $video = new Video($db);
        $videos = $video->selectByVideoInit($idVideo);
        if(isset($_GET['trad'])){
            $form['uneVideo'] = true;
            
             
            echo $twig->render('listeVideo.html.twig',array("videos"=>$videos,"form"=>$form,"trad"=>$_GET['trad']));
        }else{
        if($videos['IdVideoTrad'] != null){
            $form['Trad'] = true;
        }else{
            $form['Trad'] = false;
        }
        echo $twig->render('listeVideo.html.twig',array("IdVideoInit"=>$idVideo,"IdVideoTrad"=>$videos['IdVideoTrad'],"form"=>$form));

    }
    }else{
        $listeVideo = $video->selectVideoInit();
        echo $twig->render('listeVideo.html.twig',array("listeVideo"=>$listeVideo));
    }
}

function actionAjoutVideoTrad($twig,$db){

    $form=array();
    if(isset($_GET['id'])){
        $form['trad'] = true;
        if (isset($_POST['submit'])) {
            if (! empty($_FILES)) {
                $file_name = $_FILES['video']['name'];
                $file_extension = strrchr($file_name, ".");
                
                $file_tmp_name = $_FILES['video']['tmp_name'];
                $filedest = '../web/video/videoInit/' . $file_name;
                
                $extension_autorisees = array(
                    0 =>'.mp4',
                    1 => '.MP4'
                );
                
                if (in_array(
                    $file_extension,
                    $extension_autorisees
                )) {
                    if (move_uploaded_file($file_tmp_name, $filedest)) {
                        $videoInit = new Video($db);
                        
                        $exec=$videoInit->ajoutVideoTrad($_SESSION['id'],$_GET['id'],$filedest);
                        if (!$exec){
                            $form['ajouter'] = false;
                            $form['message'] = 'Problème de d\'ajout d\'une vidéo traduite';
                        }else{
                            $form['ajouter'] = true;
                        }

                        echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                        header("Location:index.php?page=ajoutVideoTrad");
                    } else {
                        echo 'Erreur lors de l\'ajout du fichier dans le serveur';
                    }
                } else {
                    echo 'Uniquement .mp4, .MP4';
                }
            }
        }
    echo $twig->render('ajoutVideoTrad.html.twig',array("form"=>$form));
    }else{
        $video = new Video($db);
        $listeVideo = $video->selectIfTradNull();
        echo $twig->render('ajoutVideoTrad.html.twig',array("form"=>$form,"listeVideo"=>$listeVideo));
    }
}

function actionGestionVideoInit($twig,$db){
    $form = array();
    $video = new Video($db);
    if(isset($_GET['id'])){
        $form['uneVideo'] = true;
        $idVideo = $_GET['id'];
        $videos = $video->selectByVideoInit($idVideo);
        echo $twig->render('gestionVideoInit.html.twig',array("form"=>$form,"videos"=>$videos)); 
    }else{
        $listeVideo = $video->selectInitByUtilisateur($_SESSION['id']);
        echo $twig->render('gestionVideoInit.html.twig',array("form"=>$form,"listeVideo"=>$listeVideo)); 
    }

}

function actionSupprimerVideo($twig,$db){
    $form = array();
    if (isset($_GET['id'])){
        $idVideo = $_GET['id'];
        $video = new Video($db);
        if(isset($_GET['trad'])){
            $exec = $video->deleteVideoTrad($idVideo);
            if(!$exec){
                $form['supp'] = false;
            }else{
                $form['supp'] = true;
            }
        }else{
            $exec = $video->deleteVideo($idVideo);
            if(!$exec){
                $form['supp'] = false;
            }else{
                $form['supp'] = true;
            }
        }
    }
    echo $twig->render('gestionVideoInit.html.twig',array("form"=>$form)); 
}
   
function actionModifVideoInit($twig,$db){
    $form = array();
    if (isset($_GET['id'])){
        $idVideo = $_GET['id'];
        $form['trad'] = true;
        if (isset($_POST['submit'])) {
            $titre = $_POST['titre'];
            $descriptionVideo = $_POST['descriptionVideo'];
            if (! empty($_FILES)) {
                $file_name = $_FILES['video']['name'];
                $file_extension = strrchr($file_name, ".");
                
                $file_tmp_name = $_FILES['video']['tmp_name'];
                $filedest = '../web/video/videoInit/' . $file_name;
                
                $extension_autorisees = array(
                    0 =>'.mp4',
                    1 => '.MP4'
                );
                
                if (in_array(
                    $file_extension,
                    $extension_autorisees
                )) {
                    if (move_uploaded_file($file_tmp_name, $filedest)) {
                        $videoInit = new Video($db);
                        
                        $exec=$videoInit->updateVideoInit($titre,$descriptionVideo,$filedest,$_GET['id']);
                        if (!$exec){
                            $form['ajouter'] = false;
                            $form['message'] = 'Problème de d\'ajout d\'une vidéo non traduite';
                        }else{
                            $form['ajouter'] = true;
                        }
    
                        echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                        header("Location:index.php?page=gestionVideoInit");

                    } else {
                        echo 'Erreur lors de l\'ajout du fichier dans le serveur';
                    }
                } else {
                    echo 'Uniquement .mp4, .MP4';
                }
            }
        }
    }
    echo $twig->render('modifVideoInit.html.twig',array("form"=>$form)); 
}

function actionModifVideoTrad($twig,$db){
    $form = array();
    if (isset($_GET['id'])){
        $idVideo = $_GET['id'];
        $form['trad'] = true;
        if (isset($_POST['submit'])) {
            if (! empty($_FILES)) {
                $file_name = $_FILES['video']['name'];
                $file_extension = strrchr($file_name, ".");
                
                $file_tmp_name = $_FILES['video']['tmp_name'];
                $filedest = '../web/video/videoInit/' . $file_name;
                
                $extension_autorisees = array(
                    0 =>'.mp4',
                    1 => '.MP4'
                );
                
                if (in_array(
                    $file_extension,
                    $extension_autorisees
                )) {
                    if (move_uploaded_file($file_tmp_name, $filedest)) {
                        $video = new Video($db);
                        
                        $exec=$video->updateVideoTrad($filedest,$_GET['id']);
                        if (!$exec){
                            $form['ajouter'] = false;
                            $form['message'] = 'Problème de d\'ajout d\'une vidéo non traduite';
                        }else{
                            $form['ajouter'] = true;
                        }
    
                        echo "<script>alert(\"Fichier envoyé avec succès\")</script>";
                        header("Location:index.php?page=gestionVideoTrad");

                    } else {
                        echo 'Erreur lors de l\'ajout du fichier dans le serveur';
                    }
                } else {
                    echo 'Uniquement .mp4, .MP4';
                }
            }
        }
    }
    echo $twig->render('modifVideoTrad.html.twig',array("form"=>$form)); 
}

function actionGestionVideoTrad($twig,$db){
    $form = array();
    $video = new Video($db);
    if(isset($_GET['id'])){
        $form['uneVideo'] = true;
        $idVideo = $_GET['id'];
        $videos = $video->selectByVideoTrad($idVideo);
        echo $twig->render('gestionVideoTrad.html.twig',array("form"=>$form,"videos"=>$videos)); 
    }else{
        $listeVideo = $video->selectTradByUtilisateur($_SESSION['id']);
        echo $twig->render('gestionVideoTrad.html.twig',array("form"=>$form,"listeVideo"=>$listeVideo)); 
    }

}