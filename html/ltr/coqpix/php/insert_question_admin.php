<?php
require_once 'verif_session_connect_admin.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$id = htmlspecialchars($_POST['idqcm']);
if (isset($_POST['critere'])) {
    $critere = array("paramA", "paramB", "paramC", "paramD", "paramE");
    if (in_array($_POST['critere'], $critere, true)) {
        if ($_POST['critere'] == "paramA") {
            $critere_reponse = array("Détermination", "Ambition", "Gout de l'effort", "Esprit de compétition");
        } elseif ($_POST['critere'] == "paramB") {
            $critere_reponse = array("Assurance en public", "Ouverture aux autres", "Diplomatie", "Persuasion");
        } elseif ($_POST['critere'] == "paramC") {
            $critere_reponse = array("Diriger", "Prise de responsabilités", "Organisation", "Vision");
        } elseif ($_POST['critere'] == "paramD") {
            $critere_reponse = array("Confiance en soi", "Indépendance d'esprit", "Créativité", "Autonomie");
        } elseif ($_POST['critere'] == "paramE") {
            $critere_reponse = array("Gestion du stress", "Réactivité", "Patience", "Respect de la hiérarchie");
        }
        if (!array_diff($_POST['critere_reponse'], $critere_reponse)) {
            if (isset($_POST['reponses']) and $_POST['libelle'] != "" and $_POST['idqcm'] != "" and $_POST['points'] != "") {
                if (count($_POST['reponses']) == count($_POST['critere_reponse']) and count($_POST['reponses']) >= 2) {
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
                    $id_question = $bdd->lastInsertId();
                    try {
                        for ($i = 0; $i < count($_POST['reponses']); ++$i) {
                            $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux, statu) VALUES(?, ?, ?, ?)");
                            $insert->execute(array(
                                $id_question,
                                htmlspecialchars($_POST['reponses'][$i]),
                                "Vrai",
                                $_POST['critere_reponse'][$i]
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
    }
} elseif (isset($_POST['reponses']) and isset($_POST['vraioufaux']) and $_POST['libelle'] != "" and $_POST['idqcm'] != "" and $_POST['points'] != "") {
    if (count($_POST['reponses']) == count($_POST['vraioufaux']) and count($_POST['reponses']) >= 2) {
        if (in_array("Vrai", $_POST['vraioufaux'])) {
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
