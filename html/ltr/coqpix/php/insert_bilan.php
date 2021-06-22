<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $email_bilan = $_POST['email_bilan'];
    // recuperer name_entreprise 
    $pdoSt = $bdd->prepare('SELECT nameentreprise FROM entreprise WHERE id = :id');
    $pdoSt->bindValue(':id', $_GET['num']);
    $pdoSt->execute();
    $name_entreprise = $pdoSt->fetch();
    
    if ($_POST['date_bilan'] == "") {

        $date_j = date('d');
        $date_m = date('m');
        $date_a = date('Y');
        $dte = date('d/m/Y');
    }else{

        $date_j = "1";
        $date_m = "12";
        $date_a = $_POST['date_bilan'];
        $dte = ''.$date_j.'/'.$date_m.'/'.$date_a.'';

    }

    $id_session = $_GET['num'];

    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
    echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../../src/bilan/';
    
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

        $insert = $bdd->prepare('INSERT INTO bilan (email_bilan, dte, date_j, date_m, date_a, files_bilan, id_session) VALUES(?,?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($email_bilan),
                htmlspecialchars($dte),
                htmlspecialchars($date_j),
                htmlspecialchars($date_m),
                htmlspecialchars($date_a),
                htmlspecialchars($real_name . $date_now . $type_files),
                htmlspecialchars($id_session)
            ));

        // ajouter notification
        $insert_notif = $bdd->prepare('INSERT INTO notif_back (type_demande, date_demande, name_entreprise, id_session) VALUES(?,?,?,?)');
            $insert_notif->execute(array(
                htmlspecialchars("bilan"),
                htmlspecialchars($dte),
                htmlspecialchars($name_entreprise),
                htmlspecialchars($id_session)
            ));

        header('Location: ../bilan-view.php?num='.$_GET['num'].'&time='.$_GET['time'].'');
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