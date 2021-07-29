<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$explode = explode(';', htmlspecialchars($_POST['key']));

$code = htmlspecialchars($_POST['key']);

$pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :key_candidat');
$pdoS->bindValue(':key_candidat', $code);
$pdoS->execute();
$candidature = $pdoS->fetchAll();

if (count($candidature) != 0) {
    $num = $explode[2];
    $pdoS = $bdd->prepare('SELECT * FROM rh_annonce_qcm WHERE idannonce = :idannonce');
    $pdoS->bindValue(':idannonce', $num);
    $pdoS->execute();
    $qcms = $pdoS->fetchAll();

    foreach ($qcms as $key => $value) {
        $pdoS = $bdd->prepare('SELECT * FROM question WHERE idqcm = :idqcm');
        $pdoS->bindValue(':idqcm', $value['idqcm']);
        $pdoS->execute();
        $questions[] = $pdoS->fetchAll();
    }

    for ($i = 0; $i < count($qcms); $i++) {
        for ($j = 0; $j < count($questions[$i]); ++$j) {
            $des_reponses_candidat[] = $_POST['question' . $questions[$i][$j]['id']];
            $pdoStt = $bdd->prepare('SELECT * FROM reponse WHERE idquestion = :id ORDER BY idquestion, id');
            $pdoStt->bindValue(':id', htmlspecialchars($questions[$i][$j]['id']));
            $pdoStt->execute();
            $desreponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
        }
        $reponses[] = $desreponses;
        unset($desreponses);

        $reponses_candidat[] = $des_reponses_candidat;
        unset($des_reponses_candidat);

        /*$pdoS = $bdd->prepare('SELECT * FROM reponse WHERE idqcm = :idqcm');
            $pdoS->bindValue(':idqcm',$value['idqcm']);
            $pdoS->execute();
            $reponses = $pdoS->fetchAll();

            */
    }
    for ($i = 0; $i < count($qcms); $i++) {
        for ($j = 0; $j < count($questions[$i]); ++$j) {
            foreach ($reponses[$i][$j] as $key => $value) {
                $reponse = 0;
                foreach ($reponses_candidat[$i][$j] as $key => $avalue) {
                    if ($value['id'] == $avalue) {
                        $reponse++;
                    }
                }
                try {
                    $bdd->beginTransaction();
                    $pdoS = $bdd->prepare('INSERT INTO reponses_qcm_candidat(idcandidat, idqcm, idquestion, idreponse, vrai_ou_faux) VALUES(?,?,?,?,?)');
                    if ($reponse == 0) {
                        //print("<pre>". print_r(array($candidature[0]['id'], $qcms[$i], $questions[$i][$j]['id'], $value['id'] , 'Vrai'),true)."</pre>");
                        $pdoS->execute(array(
                            $candidature[0]['id'],
                            $qcms[$i]['idqcm'],
                            $questions[$i][$j]['id'],
                            $value['id'],
                            'Faux'
                        ));
                    } else {
                        //print("<pre>". print_r(array($candidature[0]['id'], $qcms[$i], $questions[$i][$j]['id'], $value['id'] , 'Vrai'),true)."</pre>");
                        $pdoS->execute(array(
                            $candidature[0]['id'],
                            $qcms[$i]['idqcm'],
                            $questions[$i][$j]['id'],
                            $value['id'],
                            'Vrai'
                        ));
                    }
                } catch (PDOException $e) {
                    $response_array['status'] = 'error';
                    $response_array['message'] = $e->GetMessage();
                    echo json_encode($response_array);
                    $bdd->rollBack();
                    header("Location: ../test-qcm.php?key=$code");
                    exit();
                }
            }
        }
    }

    try {
        $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :num');
        $pdoStt->bindValue(':num', $code, PDO::PARAM_STR);
        $pdoStt->execute();
        $candidature = $pdoStt->fetch();
    } catch (PDOException $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->GetMessage();
        echo json_encode($response_array);
        exit();
    }
    $explode = explode(';', $candidature['key_candidat']);
    $num = $explode[2];
    try {
        $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
        $pdoSta->bindValue(':num', $num);
        $pdoSta->execute();
        $annonce = $pdoSta->fetch();
    } catch (PDOException $e) {
        $response_array['status'] = 'error';
        $response_array['message'] = $e->GetMessage();
        echo json_encode($response_array);
        exit();
    }

    $num = $explode[1];

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise', $num);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $message = "Bonjour " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ",\n\n" .
        "Bravo pour ce premier pas et merci de l’intérêt que vous nous portez à " . $entreprise['nameentreprise'] . ".\n\n" .
        "Votre candidature au poste de " . $annonce['poste'] . " a bien été prise en compte.\n\n" .
        "L'équipe de recrutement va l’étudier avec beaucoup d’attention. Nous ne manquerons pas de vous contacter rapidement si votre profil correspond à leurs attentes.\n\n" .
        "A bientôt !\n\n" .
        "Service des Ressources Humaines.\n\n" .
        "Envoyé par Coqpix.";

    $sujet = 'Votre candidature pour le poste de ' . $annonce['poste'] . ' au sein de ' . $entreprise['nameentreprise'] . ".";

    $mail = [
        'nom_recepteur' => $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'],
        'adresse_recepteur' => $candidature['email_candidat'],
        'nom_emetteur' => "Service des ressources humaines",
        'adresse_emetteur' => $entreprise['emailentreprise'],
        'sujet' => $sujet,
        'message' => $message
    ];

    $sent = email($mail);
    if ($sent) {
        $message = "Une candidature envoyée par " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . " pour le poste de " . $annonce['poste'] . " vient d'etre enregistrée.\n\n" .
            "Elle est consultable sur l'espace candidature.\n\n" .
            "Bien cordialement.\n\n" .
            "Envoyé par Coqpix.";

        $sujet = "Réception d'une nouvelle candidature de " . $candidature['nom_candidat'] . " " . $candidature['prenom_candidat'] . ".";

        $mail = [
            'nom_recepteur' => $entreprise['nameentreprise'],
            'adresse_recepteur' => $entreprise['emailentreprise'],
            'nom_emetteur' => "Service des ressources humaines",
            'adresse_emetteur' => "rh-noreply@coqpix.com",
            'sujet' => $sujet,
            'message' => $message
        ];

        $sent = email($mail);
        if ($sent) {
            $response_array['status'] = 'success';
            $response_array['link'] = "candidature-recrutement.php?num=$num";
        }
    } else {
        $response_array['status'] = 'error';
    }
    echo json_encode($response_array);
    exit();
}
exit();
