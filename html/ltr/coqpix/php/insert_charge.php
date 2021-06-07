<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $email_charge = $_POST['email_charge'];
    
    if ($_POST['date_charge'] == "") {

        $date_j = date('d');
        $date_m = date('m');
        $date_a = date('Y');
        $dte = date('d/m/Y');
    }else{

        $date_j = substr($_POST['date_charge'], -2);
        $date_m = substr($_POST['date_charge'], 5, -3);
        $date_a = substr($_POST['date_charge'], 0, 4);
        $dte = ''.$date_j.'/'.$date_m.'/'.$date_a.'';

    }

    $id_session = $_GET['num'];

    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
    echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../../src/charge/';
    
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

    if($resultat = move_uploaded_file($target_file, $file_name)){

        $insert = $bdd->prepare('INSERT INTO charge (email_charge , dte, date_j, date_m, date_a, files_charge, id_session) VALUES(?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($email_charge),
                htmlspecialchars($dte),
                htmlspecialchars($date_j),
                htmlspecialchars($date_m),
                htmlspecialchars($date_a),
                htmlspecialchars($real_name . $date_now . $type_files),
                htmlspecialchars($id_session)
            ));

        header('Location: ../charge-view.php?num='.$_GET['num'].'');
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