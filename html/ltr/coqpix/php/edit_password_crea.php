<?php

session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

        if($_POST['password'] == $_POST['con-password']){

            $password = crypt($_POST['lastpassword'], '5c725a26307c3b5170634a7e2b');
            $id = $_SESSION['id_crea'];

            $query = $bdd->query("SELECT * FROM crea_societe WHERE password_crea = '$password' AND id = '$id'"); 
            $count = $query->rowCount();

            if($count == "1"){

                    $passwordnew = crypt($_POST['password'], '5c725a26307c3b5170634a7e2b');

                    $update = $bdd->prepare('UPDATE crea_societe SET password_crea = ? WHERE id = ?');
                    $update->execute(array(
                        htmlspecialchars($passwordnew),
                        htmlspecialchars($id)
                    ));
                    header('Location: ../page-creation-edit.php?suppression=3');
                    
            }else{
                header('Location: ../page-creation-edit.php?suppression=2');
            }

    }else{
        header('Location: ../page-creation-edit.php?suppression=1');
    }
?>