<?php
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// vide

if ($_POST['numerosfacture'] == "") {
    $numerosfacture = "000-F";
} else {
    $numerosfacture = $_POST['numerosfacture'];
}

$numeroarticle = $_POST['numeroarticle'];
// $ntitre = $_POST['ntitre'];

// if ($_POST['ntitre'] == "") {
//     $ntitre = "Pas de titre";
// } else {
//     $ntitre = $_POST['ntitre'];
// }

if ($_POST['facturepour'] == "") {
    $facturepour = "Client Passagé";
} else {
    $facturepour = $_POST['facturepour'];
}

// if($_POST['numerosclient'] == ""){
//     $numerosclient = "Client Passagé";
// }else{
//     $numerosclient = $_POST['numerosclient'];
// }

if ($_POST['adressefirst'] == "") {
    $adresse = "Adresse";
} else {
    $adresse = $_POST['adressefirst'];
}

if ($_POST['departementfirst'] == "") {
    $departement = "Ville";
} else {
    $departement = $_POST['departementfirst'];
}

if ($_POST['adressetwo'] == "") {
    $adresse2 = "Adresse";
} else {
    $adresse2 = $_POST['adressetwo'];
}

if ($_POST['departementtwo'] == "") {
    $departement2 = "Ville";
} else {
    $departement2 = $_POST['departementtwo'];
}

if ($_POST['emailfirst'] == "") {
    $email = "email@email.com";
} else {
    $email = $_POST['emailfirst'];
}

if ($_POST['telfirst'] == "") {
    $tel = "06.00.00.00.00";
} else {
    $tel = $_POST['telfirst'];
}

if ($_POST['accompte'] == "") {
    $accompte = "0";
} else {
    $accompte = $_POST['accompte'];
}

if ($_POST['note'] == "") {
    $note = "Pas de commentaire";
} else {
    $note = $_POST['note'];
}

// end vide

if ($_POST['statut'] == "NON PAYE") {
    $color = "badge badge-light-danger badge-pill";
} else {
    $color = "badge badge-light-success badge-pill";
}

if ($_POST['departementtwo'] == "" || $_POST['adressetwo'] == "") {
    $insert = $bdd->prepare('INSERT INTO facture (numerosfacture, dte, dateecheance, nomproduit, reffacture, facturepour, adresse, email, tel, departement, modalite, monnaie, accompte, note, status_facture, status_color, etiquette, id_session, descrip, adresselivraison, deplivraison) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosfacture),
        htmlspecialchars($_POST['dte']),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($_POST['nomproduit']),
        htmlspecialchars($_POST['reffacture']),
        htmlspecialchars($facturepour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($accompte),
        htmlspecialchars($note),
        htmlspecialchars($_POST['statut']),
        htmlspecialchars($color),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_SESSION['id_session']), //$_SESSION
        htmlspecialchars($_POST['descrip']),
        htmlspecialchars($adresse2),
        htmlspecialchars($departement2)
        // htmlspecialchars($numerosclient)
    ));
} else {
    $insert = $bdd->prepare('INSERT INTO facture (numerosfacture, dte, dateecheance, nomproduit, reffacture, facturepour, adresse, email, tel, departement, modalite, monnaie, accompte, note, status_facture, status_color, etiquette, id_session, descrip, adresselivraison, deplivraison) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($numerosfacture),
        htmlspecialchars($_POST['dte']),
        htmlspecialchars($_POST['dateecheance']),
        htmlspecialchars($_POST['nomproduit']),
        htmlspecialchars($_POST['reffacture']),
        htmlspecialchars($facturepour),
        htmlspecialchars($adresse),
        htmlspecialchars($email),
        htmlspecialchars($tel),
        htmlspecialchars($departement),
        htmlspecialchars($_POST['modalite']),
        htmlspecialchars($_POST['monnaie']),
        htmlspecialchars($accompte),
        htmlspecialchars($note),
        htmlspecialchars($_POST['statut']),
        htmlspecialchars($color),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($_SESSION['id_session']), //$_SESSION
        htmlspecialchars($_POST['descrip']),
        htmlspecialchars($adresse2),
        htmlspecialchars($departement2)
        // htmlspecialchars($numerosclient)
    ));
}

// $insertT = $bdd->prepare('INSERT INTO titres (titre, numeros) VALUES(?, ?)');
// $insertT->execute(array(
//     htmlspecialchars($ntitre),
//     htmlspecialchars($numeroarticle)
// ));

// Pour mettre à jour les différents articles utilisés dans une facture, en particulier pour préciser le type de document

$pdoA = $bdd->prepare('UPDATE articles SET typ="facturevente" WHERE typ="" AND numeros=:numeros AND id_session=:num');
$pdoA->bindValue(':num', $_SESSION['id_session']); //$_SESSION
$pdoA->bindValue(':numeros', $numeroarticle);
// $pdoA->bindValue(':titre', $ntitre);
$pdoA->execute();


//calculs

$pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']); // $_SESSION
$pdoS->execute();
$calculs = $pdoS->fetch();

try {

    $sql = "SELECT ROUND(SUM(T.TOTAL), 2) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':num', $_SESSION['id_session']); //$_SESSION
    $req->bindValue(':numeros', $_POST['numeroarticle']);
    $req->execute();
    $res = $req->fetch();
} catch (Exception $e) {
    echo "Erreur " . $e->getMessage();
}

$montant_t = !empty($res) ? $res['MONTANT_T'] : 0;

$montant_tp = !empty($resp) ? $resp['MONTANT_T'] : 0;

$facture_nb = $calculs['facture_nb'] + 1;
$facture_all = $calculs['facture_all'] + $montant_t + $montant_tp;
$devis_all = $calculs['devis_all'];
$lastdte = date('d-m-Y');  // $calculs['lastdte'] pour autre de facture

$pdo = $bdd->prepare('UPDATE calculs SET facture_nb=:facture_nb, facture_all=:facture_all, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');

$pdo->bindValue(':num', $_SESSION['id_session']); //$_SESSION
$pdo->bindValue(':facture_nb', $facture_nb);
$pdo->bindValue(':facture_all', $facture_all);
$pdo->bindValue(':devis_all', $devis_all);
$pdo->bindValue(':lastdte', $lastdte);
$pdo->execute();


//delete tous les articles

$pdoDel = $bdd->prepare('DELETE FROM articles WHERE numeros= ""');
$pdoDel->execute();


// $pdoDelt = $bdd->prepare('DELETE FROM titres WHERE numeros= ""');
// $pdoDelt->execute();

header('Location: ../app-invoice-list.php');
exit();
