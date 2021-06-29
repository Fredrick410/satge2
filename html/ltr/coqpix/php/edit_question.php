<?php
require_once 'verif_session_connect.php';
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if (isset($_POST['reponses']) and isset($_POST['vraioufaux']) and $_POST['libelle'] != "" and $_POST['idquestion'] != "" and $_POST['points'] != "") {
    $id = htmlspecialchars($_POST['idquestion']);
    if (count($_POST['reponses']) == count($_POST['vraioufaux']) and count($_POST['reponses']) >= 2) {
        try {
            $insert = $bdd->prepare("UPDATE question SET points = ? , libelle = ? WHERE id = ?");
            $insert->execute(array(
                htmlspecialchars($_POST['points']),
                htmlspecialchars($_POST['libelle']),
                htmlspecialchars($_POST['idquestion'])
            ));
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            echo "qcm-edit.php?id=$id";
        }

        try {
            $insert = $bdd->prepare("DELETE FROM reponse WHERE idquestion = :id");
            $insert->bindValue(':id', htmlspecialchars($_POST['idquestion']), PDO::PARAM_INT);
            $insert->execute();
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            echo "qcm-edit.php?id=$id";
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
        } catch (PDOException $exception) {
            var_dump($exception->getMessage());
            echo "qcm-edit.php?id=$id";
        }
        $pdoStt = $bdd->prepare('SELECT * FROM question WHERE id = :id');
        $pdoStt->bindValue(':id', $id);
        $pdoStt->execute();
        $question = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
        $id = $question[0]['idqcm'];
        echo "rh-recrutement-entretient-question.php?id=$id";
        exit();
    }
}
echo "qcm-edit.php?id=$id";
exit();
