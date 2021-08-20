<?php
$pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
$pdoSta->bindValue(':num',$_SESSION['id_crea']);
$pdoSta->execute();
$crea = $pdoSta->fetch();

if($crea['doc_pieceid'] == ""){
    $doc_pieceid = "0";
}else{
    $doc_pieceid = "1";
}
if($crea['doc_cerfaM0'] == ""){
    $doc_cerfaM0 = "0";
}else{
    $doc_cerfaM0 = "1";
}
if($crea['doc_cerfaMBE'] == ""){
    $doc_cerfaMBE = "0";
}else{
    $doc_cerfaMBE = "1";
}
if($crea['doc_justificatifss'] == ""){
    $doc_justificatifss = "0";
}else{
    $doc_justificatifss = "1";
}
if($crea['doc_statuts'] == ""){
    $doc_statuts = "0";
}else{
    $doc_statuts = "1";
}
if($crea['doc_nomination'] == ""){
    $doc_nomination = "0";
}else{
    $doc_nomination = "1";
}
if($crea['doc_pouvoir'] == ""){
    $doc_pouvoir = "0";
}else{
    $doc_pouvoir = "1";
}
if($crea['doc_attestation'] == ""){
    $doc_attestation = "0";
}else{
    $doc_attestation = "1";
}
if($crea['doc_xp'] == ""){
    $doc_xp = "0";
}else{
    $doc_xp = "1";
}
if($crea['doc_peirl'] == ""){
    $doc_peirl = "0";
}else{
    $doc_peirl = "1";
}
if($crea['doc_depot'] == ""){
    $doc_depot = "0";
}else{
    $doc_depot = "1";
}
if($crea['doc_annonce'] == ""){
    $doc_annonce = "0";
}else{
    $doc_annonce = "1";
}
if($crea['doc_domiciliation'] == ""){
    $doc_domiciliation = "0";
}else{
    $doc_domiciliation = "1";
}
if($crea['doc_contrat'] == ""){
    $doc_contrat = "0";
}else{
    $doc_contrat = "1";
}
?>