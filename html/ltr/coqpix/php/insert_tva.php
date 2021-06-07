<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $email_tva = $_POST['email_tva'];
    
    $periode = explode(';',$_POST['details_periode']);
    if($periode[1] == "annuel"){
        $dte = date('01-m-');
        $dte = $dte.$periode[0];
        $dte_j = date('01');
        $date_m = date('m');
        $date_a = $periode[0];
    }elseif($periode[1] == "trimestriel"){
        $dte = date('01-');
        $dte = $dte.$periode[0].'-'.date('Y').'';
        $dte_j = date('d');
        $date_m = $periode[0];
        $date_a = date('Y');
    }
    elseif($periode[1] == "mensuel"){
        $dte = date('01-');
        $dte = $dte.$periode[0].'-'.date('Y').'';
        $dte_j = date('01');
        $date_m = $periode[0];
        $date_a = date('Y');
    }

    $id_session = $_GET['num'];

    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
    echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../../src/tva/';
    
    if(!is_dir($dir)){
        echo " Le répertoire de destination n'existe pas !";
        exit();
    }
    
    $name_files = $_FILES['doc_files']['name'];                         
    $date_now = '-'.date("H-i-s");
    $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
    $target_file = $_FILES['doc_files']['tmp_name'];                                     
    $real_name = substr($name_files, 0, -4);
    $file_name = $dir. $real_name . $date_now . $type_files; 
    if(!empty($_GET['periode'])){
        $annu = "annuel";
    }else{
        $annu = "";
    }

    if($resultat = move_uploaded_file($target_file, $file_name)){

        $insert = $bdd->prepare('INSERT INTO tva (email_tva , dte, date_j, date_m, date_a, files_tva, periode, id_session) VALUES(?,?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($email_tva),
                htmlspecialchars($dte),
                htmlspecialchars($date_j),
                htmlspecialchars($date_m),
                htmlspecialchars($date_a),
                htmlspecialchars($real_name . $date_now . $type_files),
                htmlspecialchars($annu),
                htmlspecialchars($id_session)
            ));

        header('Location: ../declarationtva-view.php?num='.$_GET['num'].'');
        exit();

    }else{
        echo "Erreur lors du déplacement de fichier !"; 
        exit;
    }
    
    } else {
    echo "Erreur lors de l'upload du fichier : ";
    echo "Nom du fichier : '". $_FILES['pieceid']['tmp_name'] . "'.";
    }
?>