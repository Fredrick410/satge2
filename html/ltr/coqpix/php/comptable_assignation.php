<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    if(empty($_GET['75KUicaG42'])){
        $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
        $pdoSta->bindValue(':num',$_GET['id']);
        $pdoSta->execute();
        $entreprise = $pdoSta->fetch();

        $pdoSta = $bdd->prepare('SELECT * FROM comptable_list WHERE name_societe=:num');
        $pdoSta->bindValue(':num',$entreprise['nameentreprise']);
        $pdoSta->execute();
        $comptable_list = $pdoSta->fetchAll();
        $count = count($comptable_list);

        $num = $_GET['num'];
        $name_societe = $entreprise['nameentreprise'];
        $tel_societe = $entreprise['telentreprise'];
        $email_societe = $entreprise['emailentreprise'];
        $date_crea = $entreprise['datecreation'];
        $id_comptable = $num;
        $perms = "none";

        if($count == 0){

            $insert = $bdd->prepare('INSERT INTO comptable_list (name_societe, tel_societe, email_societe, date_crea, id_comptable, perms) VALUES(?,?,?,?,?,?)');
            $insert->execute(array(
                htmlspecialchars($name_societe),
                htmlspecialchars($tel_societe),
                htmlspecialchars($email_societe),
                htmlspecialchars($date_crea),
                htmlspecialchars($id_comptable),
                htmlspecialchars($perms)
            ));

            header('Location: ../comptable-assignation.php?num='.$num.'&req=mAB3Pk632v');
            exit();

        }else{

            header('Location: ../comptable-assignation.php?num='.$num.'&req=88CpXdaU67&75KUicaG42='.$name_societe.'');
            exit();

        }
    }else{

        $pdoDel = $bdd->prepare('DELETE FROM comptable_list WHERE id_comptable=:id AND name_societe=:name_societe LIMIT 1');        
        $pdoDel->bindValue(':id', $_GET['num']);       
        $pdoDel->bindValue(':name_societe', $_GET['75KUicaG42']); 
        $pdoDel->execute();

        header('Location: ../comptable-assignation.php?num='.$_GET['num'].'');
        exit();

    }

    

?>
