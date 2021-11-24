<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $mode = $_GET['mode'];
    $num = $_GET['num'];
    
    // notification manuelle + creation d'une tache fiscal
    if ($mode=="manual") {
        // verifier si ce n'est pas le dernier rappel (bdd ?)
            //timer ?
        echo "Hello World2"; 
        echo $_POST['sujet'];
        //print_r($_POST['sujet']);
        echo '<br/>';
        print_r($_POST['textfield']);
        
        $name_task = $_POST['sujet'];
        $commentaire = $_POST['textfield'];

        $notif = $bdd->prepare('INSERT INTO notif_back (name_entreprise, date_demande, type_demande, id_session) VALUES(?,?,?,?)');
        $notif->execute(array(
            htmlspecialchars(""),
            htmlspecialchars(date('Y-m-d')),
            htmlspecialchars("task_fisca"),
            htmlspecialchars($num)         
        ));
        

        $pdo = $bdd->prepare('INSERT INTO task_fisca (name_task, favo_task, dte_crea, dte_echeance, pour_task, statut_task, commentaire) VALUES(?,?,?,?,?,?,?)');
        $pdo->execute(array(
            htmlspecialchars($name_task),
            htmlspecialchars(""),
            htmlspecialchars(date('d/m/y')),
            htmlspecialchars(date('d/m/y')),
            htmlspecialchars("Utilisateur actuelle"),
            htmlspecialchars("en cours"),
            htmlspecialchars($commentaire)         
        ));
        header('Location: ../control-fiscal-view.php?num='.$num.'');
        exit();
        
    }
/*
    // notification automatique: Gestion du délai test
    echo "<br/>";
    echo "<br/>";
    echo "Hello World";

    //  dte   
    echo "<br/>";
    echo "<br/>";
    echo $_GET['date'];
    $dteDepart = $_GET['date'];
    $dteDepartTimestamp = strtotime($dteDepart);

    echo "<br/>";
    echo "<br/>";
    echo $dtefin = date('Y-m-d H:i:s', strtotime('+25 days', $dteDepartTimestamp));
    $dtefinY = date('Y', strtotime('+25 days', $dteDepartTimestamp));
    $dtefinM = date('m', strtotime('+25 days', $dteDepartTimestamp));
    $dtefinD = date('d', strtotime('+25 days', $dteDepartTimestamp));

    
    echo "<br/>";
    echo "<br/>";
    $dtefinMK = mktime('0','0','0',$dtefinM,$dtefinD,$dtefinY);
    echo $dtefinMK;
    echo "<br/>";
    echo "<br/>";
    echo time();

    echo "<br/>";
    echo "<br/>";
    //traitement de la dte de fin
    if ($dtefinMK < time()){
        echo "Terminé";
    }

    echo "<br/>";
    echo "<br/>";
    echo $tps_restant = $dtefinMK - time();
*/
/*
//echo "<h1>".$_GET['textfield']."</h2>";
//echo "Hello world";
print_r($_POST['sujet']);
echo '<br/>';
print_r($_POST['textfield']);
///
*//*
    $sujet = $_POST['sujet'];
    $commentaire = $_POST['textfield'];

    $pdoStat = $bdd->prepare('INSERT INTO `notif_fisca`(`name`, `message`) VALUES (?,?)');
    $pdoStat->execute(array(
        htmlspecialchars($sujet),
        htmlspecialchars($commentaire)
    ));

    $pdoStat2 = $bdd->prepare('SELECT * FROM notif_fisca WHERE message!="" LIMIT 1');
    $pdoStat2->execute();
    $array = $pdoStat2->fetch();
    //echo $array;
    while ($result = $array) {
        if ($result['name']!=""){
            echo "request effectué";
        }
    }
*/
/*
    $search_notifs=$bdd->prepare('SELECT type_demande FROM notif_back WHERE id_session=:id LIMIT 1');
    $search_notifs->bindValue(':id',$_GET['num']);
    $search_notifs->execute();
    $result_notifs=$search_notifs->fetch(PDO::FETCH_ASSOC);

    echo $result_notifs['type_demande'];
    // si on passe par les notification automatique
    if ($_GET['']) {
        // verifier si ce n'est pas le dernier rappel (bdd ?)
            //timer ?
    }*/
?>