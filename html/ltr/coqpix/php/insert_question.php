<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
$id = htmlspecialchars($_POST['idqcm']);

// On verifie si le parametre critere est defini
// Si oui c'est un qcm qualitatif
// Si non c'est un qcm quantitatif
if (isset($_POST['critere'])) {
    // On verifie que le critere est l'un des suivants
    $critere = array("paramA", "paramB", "paramC", "paramD", "paramE");
    // Si oui on en fait de meme pour le critere de la reponse
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
            // Si les criteres des reponses sont conformes a l'un de ceux attendu on verifie que les autres champs sont non vides
            if (isset($_POST['reponses']) and $_POST['libelle'] != "" and $_POST['idqcm'] != "" and $_POST['points'] != "") {
                // Si oui on regarde s'il y a au moins deux reponses et deux criteres
                if (count($_POST['reponses']) == count($_POST['critere_reponse']) and count($_POST['reponses']) >= 2) {
                    try {
                        // On insere la question
                        $insert = $bdd->prepare("INSERT INTO question(idqcm, libelle, statu, points) VALUES(?, ?, ?, ?)");
                        $insert->execute(array(
                            htmlspecialchars($_POST['idqcm']),
                            htmlspecialchars($_POST['libelle']),
                            htmlspecialchars($_POST['critere']),
                            htmlspecialchars($_POST['points'])
                        ));
                    } catch (PDOException $exception) {
                        $response_array['status'] = 'error';
                        $response_array['message'] = $e->getMessage();
                        echo json_encode($response_array);
                        exit();
                    }
                    $id_question = $bdd->lastInsertId();
                    try {
                        // On insere les reponses qu'on associe a la question
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
                        $response_array['status'] = 'error';
                        $response_array['message'] = $e->getMessage();
                        echo json_encode($response_array);
                        exit();
                    }
                    $id = $_POST['idqcm'];
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
    // Si c'est un qcm quantitatif on regarde si tous les champs sont remplis
} elseif (isset($_POST['reponses']) and isset($_POST['vraioufaux']) and $_POST['libelle'] != "" and $_POST['idqcm'] != "" and $_POST['points'] != "") {
    // Si oui on regarde s'il y a au moins deux reponses et deux criteres
    if (count($_POST['reponses']) == count($_POST['vraioufaux']) and count($_POST['reponses']) >= 2) {
        // On regarde si on moins une reponse est vraie
        if (in_array("Vrai", $_POST['vraioufaux'])) {
            try {
                // On insere la question
                $insert = $bdd->prepare("INSERT INTO question(idqcm, libelle, points) VALUES(?, ?, ?)");
                $insert->execute(array(
                    htmlspecialchars($_POST['idqcm']),
                    htmlspecialchars($_POST['libelle']),
                    htmlspecialchars($_POST['points'])
                ));
            } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage();
                echo json_encode($response_array);
                exit();
            }

            $id_question = $bdd->lastInsertId();
            try {
                // On insere les reponses qu'on associe a la question
                for ($i = 0; $i < count($_POST['reponses']); ++$i) {
                    $insert = $bdd->prepare("INSERT INTO reponse (idquestion, libelle, vrai_ou_faux) VALUES(?, ?, ?)");
                    $insert->execute(array(
                        $id_question,
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
            $id = $_POST['idqcm'];
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
