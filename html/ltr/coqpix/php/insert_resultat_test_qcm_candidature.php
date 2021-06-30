<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $explode = explode(';', htmlspecialchars($_POST['key']));

    $code = htmlspecialchars($_POST['key']);

    $pdoS = $bdd->prepare('SELECT * FROM rh_candidature WHERE key_candidat = :key_candidat');
    $pdoS->bindValue(':key_candidat',$code);
    $pdoS->execute();
    $candidature = $pdoS->fetchAll();

    if(count($candidature) != 0){
        $num = $explode[2];
        $pdoS = $bdd->prepare('SELECT * FROM rh_annonce_qcm WHERE idannonce = :idannonce');
        $pdoS->bindValue(':idannonce',$num);
        $pdoS->execute();
        $qcms = $pdoS->fetchAll();

        foreach ($qcms as $key => $value) {
            $pdoS = $bdd->prepare('SELECT * FROM question WHERE idqcm = :idqcm');
            $pdoS->bindValue(':idqcm',$value['idqcm']);
            $pdoS->execute();
            $questions[] = $pdoS->fetchAll();
        }

        for($i = 0; $i < count($qcms); $i++) {
            for ($j = 0; $j < count($questions[$i]); ++$j) {
                $des_reponses_candidat[] = $_POST['question'.$questions[$i][$j]['id']];
                $pdoStt = $bdd->prepare('SELECT * FROM reponse WHERE idquestion = :id ORDER BY idquestion, id');
                $pdoStt->bindValue(':id', htmlspecialchars($questions[$i][$j]['id']));
                $pdoStt->execute();
                $desreponses[] = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
            }
            $reponses[] = $desreponses;
            unset($desreponses);

            $reponses_candidat [] = $des_reponses_candidat;
            unset($des_reponses_candidat);

            /*$pdoS = $bdd->prepare('SELECT * FROM reponse WHERE idqcm = :idqcm');
            $pdoS->bindValue(':idqcm',$value['idqcm']);
            $pdoS->execute();
            $reponses = $pdoS->fetchAll();

            */
        }
        for($i = 0; $i < count($qcms); $i++) {
            for ($j = 0; $j < count($questions[$i]); ++$j) {
                foreach ($reponses[$i][$j] as $key => $value) {
                    $reponse = 0;
                    foreach ($reponses_candidat[$i][$j] as $key => $avalue) {
                        if ($value['id'] == $avalue) {
                            $reponse++;
                        }
                    }
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
                    }
                    else {
                        //print("<pre>". print_r(array($candidature[0]['id'], $qcms[$i], $questions[$i][$j]['id'], $value['id'] , 'Vrai'),true)."</pre>");
                        $pdoS->execute(array(
                            $candidature[0]['id'],
                            $qcms[$i]['idqcm'],
                            $questions[$i][$j]['id'],
                            $value['id'],
                            'Vrai'
                        ));
                    }
                }
            }
        }
        echo 'candidature-recrutement-files.php?key='.$code.'';
    }
    exit();
?>
