<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if(isset($_POST['reponses']) AND isset($_POST['vraioufaux']) AND $_POST['libelle'] != "" AND $_POST['idqcm'] != "" AND $_POST['points'] != "") {
        $id = htmlspecialchars($_POST['idqcm']);
        if(count($_POST['reponses']) == count($_POST['vraioufaux']) AND count($_POST['reponses']) >= 2){
            if(in_array("Vrai", $_POST['vraioufaux'])){
                try {
                    $insert = $bdd->prepare("INSERT INTO question(idqcm, libelle, points) VALUES(?, ?, ?)");
                    $insert->execute(array(
                        htmlspecialchars($_POST['idqcm']),
                        htmlspecialchars($_POST['libelle']),
                        htmlspecialchars($_POST['points']) 
                    ));
                } catch (PDOException $exception) {
                    var_dump($exception->getMessage());
                    echo "qcm-add.php?id=$id";
                }
                
                $id_question = $bdd->lastInsertId();
                try {
                    for($i = 0; $i < count($_POST['reponses']); ++$i) {
                            $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux) VALUES(?, ?, ?)");
                            $insert->execute(array(
                                $id_question,
                                htmlspecialchars($_POST['reponses'][$i]),
                                htmlspecialchars($_POST['vraioufaux'][$i]) //$_SESSION
                            ));
                    }
                } catch (PDOException $exception) {
                    var_dump($exception->getMessage());
                    echo "qcm-add.php?id=$id";
                }
                $id = $_POST['idqcm'];
                echo "rh-recrutement-entretient-question.php?id=$id";
                exit();
            }
        }
    }
    echo "qcm-add-admin.php?id=$id";
    exit();
    
?>