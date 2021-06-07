<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $email_dsn = $_POST['email_dsn'];
    
    if ($_POST['date_dsn'] == "") {

        $date_j = date('d');
        $date_m = date('m');
        $date_a = date('Y');
        $dte = date('d/m/Y');
    }else{

        $date_j = substr($_POST['date_dsn'], -2);
        $date_m = substr($_POST['date_dsn'], 5, -3);
        $date_a = substr($_POST['date_dsn'], 0, 4);
        $dte = ''.$date_j.'/'.$date_m.'/'.$date_a.'';

    }

    $id_session = $_GET['num'];

    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
    echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../../src/dsn/';
    
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

        $insert = $bdd->prepare('INSERT INTO dsn (email_dsn , dte, date_j, date_m, date_a, files_dsn, id_session) VALUES(?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($email_dsn),
                htmlspecialchars($dte),
                htmlspecialchars($date_j),
                htmlspecialchars($date_m),
                htmlspecialchars($date_a),
                htmlspecialchars($real_name . $date_now . $type_files),
                htmlspecialchars($id_session)
            ));

        header('Location: ../dsn-view.php?num='.$_GET['num'].'');
        exit();

    }else{
        echo "Erreur lors du déplacement de fichier !"; 
        exit;
    }
    
    } else {
    echo "Erreur lors de l'upload du fichier : ";
    echo "Nom du fichier : '". $_FILES['doc_files']['tmp_name'] . "'.";
    }
?>