<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'rh');
require_once 'php/verif_session_connect.php';

$id = htmlspecialchars($_POST['idquestion']);
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
            if (isset($_POST['reponses']) and $_POST['libelle'] != "" and $_POST['idquestion'] != "" and $_POST['points'] != "") {
                if (count($_POST['reponses']) == count($_POST['critere_reponse']) and count($_POST['reponses']) >= 2) {
                    try {
                        $insert = $bdd->prepare("UPDATE question SET points = ? , libelle = ? WHERE id = ?");
                        $insert->execute(array(
                            htmlspecialchars($_POST['points']),
                            htmlspecialchars($_POST['libelle']),
                            htmlspecialchars($_POST['idquestion'])
                        ));
                    } catch (PDOException $e) {
                        $response_array['status'] = 'error';
                        $response_array['message'] = $e->getMessage();
                        echo json_encode($response_array);
                        exit();
                    }

                    try {
                        $insert = $bdd->prepare("DELETE FROM reponse WHERE idquestion = :id");
                        $insert->bindValue(':id', htmlspecialchars($_POST['idquestion']), PDO::PARAM_INT);
                        $insert->execute();
                    } catch (PDOException $e) {
                        $response_array['status'] = 'error';
                        $response_array['message'] = $e->getMessage();
                        echo json_encode($response_array);
                        exit();
                    }

                    try {
                        for ($i = 0; $i < count($_POST['reponses']); ++$i) {
                            $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux, statu) VALUES(?, ?, ?, ?)");
                            $insert->execute(array(
                                htmlspecialchars($_POST['idquestion']),
                                htmlspecialchars($_POST['reponses'][$i]),
                                "Vrai",
                                htmlspecialchars($_POST['critere_reponse'][$i])
                            ));
                        }
                    } catch (PDOException $e) {
                        $response_array['status'] = 'error';
                        $response_array['message'] = $e->getMessage();
                        echo json_encode($response_array);
                        exit();
                    }
                    $pdoStt = $bdd->prepare('SELECT * FROM question WHERE id = :id');
                    $pdoStt->bindValue(':id', $id);
                    $pdoStt->execute();
                    $question = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
                    $id = $question[0]['idqcm'];
                    $response_array['status'] = 'success';
                    $response_array['link'] = "rh-recrutement-entretient-question.php?id=$id";
                    echo json_encode($response_array);
                    exit();
                } else {
                    $response_array['status'] = 'error';
                    $response_array['message'] = 'Merci d\'ajouter au moins deux réponses';
                    echo json_encode($response_array);
                    exit();
                }
            } else {
                $response_array['status'] = 'error';
                $response_array['message'] = 'Merci de remplir tous les champs et ajouter des réponses';
                echo json_encode($response_array);
                exit();
            }
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Critere inexistant';
            echo json_encode($response_array);
            exit();
        }
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = 'Catégorie de critere inexistante';
        echo json_encode($response_array);
        exit();
    }
} elseif (isset($_POST['reponses']) and isset($_POST['vraioufaux']) and $_POST['libelle'] != "" and $_POST['idquestion'] != "" and $_POST['points'] != "") {
    if (count($_POST['reponses']) == count($_POST['vraioufaux']) and count($_POST['reponses']) >= 2) {
        if (in_array("Vrai", $_POST['vraioufaux'])) {
            try {
                $insert = $bdd->prepare("UPDATE question SET points = ? , libelle = ? WHERE id = ?");
                $insert->execute(array(
                    htmlspecialchars($_POST['points']),
                    htmlspecialchars($_POST['libelle']),
                    htmlspecialchars($_POST['idquestion'])
                ));
            } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage();
                echo json_encode($response_array);
                exit();
            }

            try {
                $insert = $bdd->prepare("DELETE FROM reponse WHERE idquestion = :id");
                $insert->bindValue(':id', htmlspecialchars($_POST['idquestion']), PDO::PARAM_INT);
                $insert->execute();
            } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage();
                echo json_encode($response_array);
                exit();
            }

            try {
                for ($i = 0; $i < count($_POST['reponses']); ++$i) {
                    $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux) VALUES(?, ?, ?)");
                    $insert->execute(array(
                        htmlspecialchars($_POST['idquestion']),
                        htmlspecialchars($_POST['reponses'][$i]),
                        htmlspecialchars($_POST['vraioufaux'][$i]) //$_SESSION
                    ));
                }
            } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage();
                echo json_encode($response_array);
                exit();
            }
            $pdoStt = $bdd->prepare('SELECT * FROM question WHERE id = :id');
            $pdoStt->bindValue(':id', $id);
            $pdoStt->execute();
            $question = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
            $id = $question[0]['idqcm'];
            $response_array['status'] = 'success';
            $response_array['link'] = "rh-recrutement-entretient-question.php?id=$id";
            echo json_encode($response_array);
            exit();
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Merci d\'ajouter au moins une réponse vraie';
            echo json_encode($response_array);
            exit();
        }
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = 'Merci d\'ajouter au moins deux réponses';
        echo json_encode($response_array);
        exit();
    }
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Merci de remplir tous les champs et ajouter des réponses';
    echo json_encode($response_array);
    exit();
}
