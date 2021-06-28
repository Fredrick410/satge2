<?php
session_start();
require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if(empty($_POST['one'])){
        $one = "off";
    }else{
        $one = $_POST['one'];
    }

    if(empty($_POST['two'])){
        $two = "off";
    }else{
        $two = $_POST['two'];
    }

    if(empty($_POST['three'])){
        $three = "off";
    }else{
        $three = $_POST['three'];
    }

    if(empty($_POST['four'])){
        $four = "off";
    }else{
        $four = $_POST['four'];
    }

    if(empty($_POST['five'])){
        $five = "off";
    }else{
        $five = $_POST['five'];
    }

    if(empty($_POST['six'])){
        $six = "off";
    }else{
        $six = $_POST['six'];
    }

    if(empty($_POST['seven'])){
        $seven = "off";
    }else{
        $seven = $_POST['seven'];
    }

    if(empty($_POST['eight'])){
        $eight = "off";
    }else{
        $eight = $_POST['eight'];
    }


    $pdoA = $bdd->prepare('UPDATE acte SET one=:one, two=:two, three=:three, four=:four, five=:five, six=:six, seven=:seven, eight=:eight WHERE code=:code'); 
    $pdoA->bindValue(':code', $_POST['num']); 
    $pdoA->bindValue(':one', $one);
    $pdoA->bindValue(':two', $two);
    $pdoA->bindValue(':three', $three);
    $pdoA->bindValue(':four', $four);
    $pdoA->bindValue(':five', $five);
    $pdoA->bindValue(':six', $six);
    $pdoA->bindValue(':seven', $seven);
    $pdoA->bindValue(':eight', $eight);
    $pdoA->execute();

    if(!empty($_POST['verif_one'])){
        $verif_one = "&verif_one=on&";
    }else{
        $verif_one = "&verif_one=off&";
    }

    $doc_age = "off";
    $doc_edit = "off";
    $doc_acte = "off";
    $doc_M0 = "off";
    $doc_MBE = "off";
    $doc_M3 = "off";
    $doc_jal = "off";
    $doc_attestation = "off";
    $doc_pieceid = "off";
    $doc_justificatif = "off";
    $doc_cerfaM2 = "off";
    $doc_tns = "off";
    $doc_rcsas = "off";
    $doc_cerfaAC = "off";

    if($one == "on"){
        $doc_age = "on";
        $doc_acte = "on";
        if($verif_one == "&verif_one=on&"){
            $doc_cerfaM2 = "on";
        }else{
            $doc_cerfaM2 = "off";
        }
        $doc_MBE = "on"; 
        $doc_edit = "on";       
    }
    if($two == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_M3 = "on";
        $doc_jal = "on";
        $doc_attestation = "on";
        $doc_pieceid = "on";
    }
    if($three == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_cerfaM2 = "on";
        $doc_jal = "on";
        $doc_justificatif = "on";
    }
    if($four == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_cerfaM2 = "on";
        $doc_jal = "on";
    }
    if($five == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_jal = "on";
        $doc_cerfaM2 = "on";
        $doc_rcsas = "on";
        $doc_tns = "on";
    }
    if($six == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_cerfaM2 = "on";
        $doc_jal = "on";
    }
    if($seven == "on"){
        $doc_age = "on";
        $doc_edit = "on";
        $doc_cerfaM2 = "on";
        $doc_jal = "on";
        $doc_cerfaAC = "on";
    }
    if($eight == "on"){
        $doc_cerfaM2 = "on";
        $doc_jal = "on";
    }

    if($_POST['check'] == "morale"){
        $forme = "morale";
    }else{
        $forme = "physique";
    }  

    $num = $_POST['num'];

    $query = $bdd->prepare("SELECT * FROM acte_doc WHERE code = :num");
    $query->bindValue(':num', $num); 
    $count = $query->rowCount();

    if($count >= 1){
        
        $pdoA = $bdd->prepare('UPDATE acte_doc SET doc_age=:doc_age, doc_edit=:doc_edit, doc_acte=:doc_acte, doc_M0=:doc_M0, doc_MBE=:doc_MBE, doc_M3=:doc_M3, doc_jal=:doc_jal, doc_attestation=:doc_attestation, doc_pieceid=:doc_pieceid, doc_justificatif=:doc_justificatif, doc_cerfaM2=:doc_cerfaM2, doc_tns=:doc_tns, doc_rcsas=:doc_rcsas, doc_cerfaAC=:doc_cerfaAC WHERE code=:code'); 
        $pdoA->bindValue(':code', $_POST['num']); 
        $pdoA->bindValue(':doc_age', $doc_age);
        $pdoA->bindValue(':doc_edit', $doc_edit);
        $pdoA->bindValue(':doc_acte', $doc_acte);
        $pdoA->bindValue(':doc_M0', $doc_M0);
        $pdoA->bindValue(':doc_MBE', $doc_MBE);
        $pdoA->bindValue(':doc_M3', $doc_M3);
        $pdoA->bindValue(':doc_jal', $doc_jal);
        $pdoA->bindValue(':doc_attestation', $doc_attestation);
        $pdoA->bindValue(':doc_pieceid', $doc_pieceid);
        $pdoA->bindValue(':doc_justificatif', $doc_justificatif);
        $pdoA->bindValue(':doc_cerfaM2', $doc_cerfaM2);
        $pdoA->bindValue(':doc_tns', $doc_tns);
        $pdoA->bindValue(':doc_rcsas', $doc_rcsas);
        $pdoA->bindValue(':doc_cerfaAC', $doc_cerfaAC);
        $pdoA->execute();

        $pdo = $bdd->prepare('UPDATE acte SET verif_one=:verif_one, forme=:forme WHERE code=:code'); 
        $pdo->bindValue(':verif_one', $verif_one);
        $pdo->bindValue(':forme', $forme);
        $pdo->bindValue(':code', $_POST['num']); 
        $pdo->execute();

    }else{

        $insert = $bdd->prepare('INSERT INTO acte_doc (doc_age, doc_edit, doc_acte, doc_M0, doc_MBE, doc_M3, doc_jal, doc_attestation, doc_pieceid, doc_justificatif, doc_cerfaM2, doc_tns, doc_rcsas, doc_cerfaAC, code) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($doc_age),
            htmlspecialchars($doc_edit),
            htmlspecialchars($doc_acte),
            htmlspecialchars($doc_M0),
            htmlspecialchars($doc_MBE),
            htmlspecialchars($doc_M3),
            htmlspecialchars($doc_jal),
            htmlspecialchars($doc_attestation),
            htmlspecialchars($doc_pieceid),
            htmlspecialchars($doc_justificatif),
            htmlspecialchars($doc_cerfaM2),
            htmlspecialchars($doc_tns),
            htmlspecialchars($doc_rcsas),
            htmlspecialchars($doc_cerfaAC),
            htmlspecialchars($_POST['num'])
        ));

        $pdo = $bdd->prepare('UPDATE acte SET verif_one=:verif_one, forme=:forme WHERE code=:code'); 
        $pdo->bindValue(':verif_one', $verif_one);
        $pdo->bindValue(':forme', $forme);
        $pdo->bindValue(':code', $_POST['num']); 
        $pdo->execute();

    } 

    sleep(1);
    header('Location: ../acte-modification-three-'.$forme.'.php?num='.$_POST['num'].''.$verif_one.'');
    exit();

?>
