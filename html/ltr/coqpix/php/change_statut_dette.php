<?php
require_once 'config.php';    

        if($_GET['statut'] == "yes"){
            $statut = "no";
        }else{
            $statut = "yes";
        }

        $update = $bdd->prepare('UPDATE entreprise SET statut_dette = ? WHERE id = ?');
        $update->execute(array(
            htmlspecialchars($statut),
            htmlspecialchars($_GET['num'])
        ));

        header('Location: ../bilan-view.php?num='.$_GET['num'].'&time='.$_GET['time'].'');
        exit();
?>
