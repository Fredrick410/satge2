<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$id = htmlspecialchars($_POST['idqcm']);
if (isset($_POST['reponses']) and isset($_POST['vraioufaux']) and $_POST['libelle'] != "" and $_POST['idqcm'] != "" and $_POST['points'] != "") {
    if (count($_POST['reponses']) == count($_POST['vraioufaux']) and count($_POST['reponses']) >= 2) {
        if (in_array("Vrai", $_POST['vraioufaux'])) {
            if (isset($_POST['critere'])) {
                try {
                    $insert = $bdd->prepare("INSERT INTO question(idqcm, libelle, statu, points) VALUES(?, ?, ?, ?)");
                    $insert->execute(array(
                        htmlspecialchars($_POST['idqcm']),
                        htmlspecialchars($_POST['libelle']),
                        htmlspecialchars($_POST['critere']),
                        htmlspecialchars($_POST['points'])
                    ));
                } catch (PDOException $exception) {
                    var_dump($exception->getMessage());
                    echo "question-add-admin.php?id=$id";
                }
            } else {
                try {
                    $insert = $bdd->prepare("INSERT INTO question(idqcm, libelle, points) VALUES(?, ?, ?)");
                    $insert->execute(array(
                        htmlspecialchars($_POST['idqcm']),
                        htmlspecialchars($_POST['libelle']),
                        htmlspecialchars($_POST['points'])
                    ));
                } catch (PDOException $exception) {
                    var_dump($exception->getMessage());
                    echo "question-add-admin.php?id=$id";
                }
            }

            $id_question = $bdd->lastInsertId();
            try {
                for ($i = 0; $i < count($_POST['reponses']); ++$i) {
                    $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux) VALUES(?, ?, ?)");
                    $insert->execute(array(
                        $id_question,
                        htmlspecialchars($_POST['reponses'][$i]),
                        htmlspecialchars($_POST['vraioufaux'][$i]) //$_SESSION
                    ));
                }
            } catch (PDOException $exception) {
                var_dump($exception->getMessage());
                echo "question-add-admin.php?id=$id";
            }
            $id = $_POST['idqcm'];
            echo "recrutement-list-question.php?id=$id";
            exit();
        }
    }
}
echo "question-add-admin.php?id=$id";
exit();
