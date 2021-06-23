<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    if($_GET['type'] == "statut_task"){
        if($_GET['categorie'] == "compta"){

            if($_GET['statut_categorie'] == "valide"){
                $statut_categorie = "en cours";
            }else{
                $statut_categorie = "valide";
            }

            $pdo = $bdd->prepare('UPDATE task_compta SET statut_task=:statut_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':statut_task', $statut_categorie);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-compta.php');
            exit();
            
        }
        if($_GET['categorie'] == "sociale"){

            if($_GET['statut_categorie'] == "valide"){
                $statut_categorie = "en cours";
            }else{
                $statut_categorie = "valide";
            }

            $pdo = $bdd->prepare('UPDATE task_sociale SET statut_task=:statut_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':statut_task', $statut_categorie);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-sociale.php');
            exit();
            
        }
        if($_GET['categorie'] == "fisca"){

            if($_GET['statut_categorie'] == "valide"){
                $statut_categorie = "en cours";
            }else{
                $statut_categorie = "valide";
            }

            $pdo = $bdd->prepare('UPDATE task_fisca SET statut_task=:statut_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':statut_task', $statut_categorie);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-fisca.php');
            exit();

        }
    }

    if($_GET['type'] == "favo"){
        if($_GET['categorie'] == "compta"){

            if($_GET['favo'] == "no"){
                $favo = "yes";
            }else{
                $favo = "no";
            }
            
            $pdo = $bdd->prepare('UPDATE task_compta SET favo_task=:favo_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':favo_task', $favo);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-compta.php');
            exit();
            
        }
        if($_GET['categorie'] == "sociale"){

            if($_GET['favo'] == "no"){
                $favo = "yes";
            }else{
                $favo = "no";
            }
            
            $pdo = $bdd->prepare('UPDATE task_sociale SET favo_task=:favo_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':favo_task', $favo);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-sociale.php');
            exit();
            
        }
        if($_GET['categorie'] == "fisca"){
            
            if($_GET['favo'] == "no"){
                $favo = "yes";
            }else{
                $favo = "no";
            }
            
            $pdo = $bdd->prepare('UPDATE task_fisca SET favo_task=:favo_task WHERE id=:num LIMIT 1');
            $pdo->bindValue(':favo_task', $favo);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();

            header('Location: ../task-fisca.php');
            exit();

        }
    }

    if($_GET['type'] == "delete"){
        if($_GET['categorie'] == "compta"){

            $pdoDel = $bdd->prepare('DELETE FROM task_compta WHERE id=:num LIMIT 1');
            $pdoDel->bindValue(':num', $_GET['num']);
            $pdoDel->execute();

            header('Location: ../task-compta.php');
            exit();
            
        }
        if($_GET['categorie'] == "sociale"){

            $pdoDel = $bdd->prepare('DELETE FROM task_sociale WHERE id=:num LIMIT 1');
            $pdoDel->bindValue(':num', $_GET['num']);
            $pdoDel->execute();

            header('Location: ../task-sociale.php');
            exit();
            
        }
        if($_GET['categorie'] == "fisca"){

            $pdoDel = $bdd->prepare('DELETE FROM task_fisca WHERE id=:num LIMIT 1');
            $pdoDel->bindValue(':num', $_GET['num']);
            $pdoDel->execute();

            header('Location: ../task-fisca.php');
            exit();
            
        }
    }   

?>