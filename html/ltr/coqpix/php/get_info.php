<?php
$pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
$pdoSta->bindValue(':num',$_SESSION['id_crea']);
$pdoSta->execute();
$crea = $pdoSta->fetch();

if($crea['nom_diri'] == ""){
    $nom_diri = "0";
}else{
    $nom_diri = "1";
}
if($crea['prenom_diri'] == ""){
    $prenom_diri = "0";
}else{
    $prenom_diri = "1";
}
if($crea['tel_diri'] == ""){
    $tel_diri = "0";
}else{
    $tel_diri = "1";
}
if($crea['email_diri'] == ""){
    $email_diri = "0";
}else{
    $email_diri = "1";
}
if($crea['adresse_diri'] == ""){
    $adresse_diri = "0";
}else{
    $adresse_diri = "1";
}
if($crea['ville_diri'] == ""){
    $ville_diri = "0";
}else{
    $ville_diri = "1";
}
if($crea['cp_diri'] == ""){
    $cp_diri = "0";
}else{
    $cp_diri = "1";
}
if($crea['adresse_entreprise'] == ""){
    $cp_diri = "0";
}else{
    $cp_diri = "1";
}
if($crea['ville_entreprise'] == ""){
    $ville_diri = "0";
}else{
    $ville_diri = "1";
}
if($crea['cp_entreprise'] == ""){
    $cp_diri = "0";
}else{
    $cp_diri = "1";
}
if($crea['status_crea'] == ""){
    $status_crea = "0";
}else{
    $status_crea = "1";
}
if($crea['secteur_dactivite'] == ""){
    $secteur_dactivite = "0";
}else{
    $secteur_dactivite = "1";
}
if($crea['name_crea'] == ""){
    $name_crea = "0";
}else{
    $name_crea = "1";
}

?>