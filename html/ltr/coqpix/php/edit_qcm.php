<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if ($_POST['libelle'] != "" and $_POST['qualitatif'] != "" and $_POST['id'] != "") {
    $pdoStt = $bdd->prepare('SELECT * FROM qcm WHERE id = :id');
    $pdoStt->bindValue(':id', htmlspecialchars($_POST['id']));
    $pdoStt->execute();
    $qcms = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    if (count($qcms) != 1) {
        echo "Qcm introuvable";
    }

    $pdoStt = $bdd->prepare('SELECT * FROM question WHERE idqcm = :id');
    $pdoStt->bindValue(':id', $qcms[0]['id']);
    $pdoStt->execute();
    $questions = $pdoStt->fetchAll(PDO::FETCH_ASSOC);

    if (count($questions) != 0) {
        /*if($qcms[0]['qualitatif'] != $_POST['qualitatif']){
            echo "Merci de supprimer les questions avant de mettre a jour le typ du qcm.";
        }*/
        try {
            $insert = $bdd->prepare("UPDATE qcm SET libelle = ? WHERE id = ?");
            $insert->execute(array(
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_POST['id'])
            ));
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
        }
    } else {
        $qualitatif = array("Oui", "Non");
        if (in_array($_POST['qualitatif'], $qualitatif)) {
            try {
                $insert = $bdd->prepare("UPDATE qcm SET libelle = ?, qualitatif = ? WHERE id = ?");
                $insert->execute(array(
                    htmlspecialchars($_POST['libelle']),
                    htmlspecialchars($_POST['qualitatif']),
                    htmlspecialchars($_POST['id'])
                ));
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
            }
        }
    }
}
exit();
