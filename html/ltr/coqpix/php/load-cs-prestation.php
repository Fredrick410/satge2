<?php 
//---------------------------------------------------------//
// FICHIER : load-cs.php
//---------------------------------------------------------//
//Affichage des erreurs PHP
session_start();
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//connexin à la bdd
require_once 'config.php';

//récupération PROPRE des variables AVANT de les utiliser
$id = !empty($_POST['prestation']) ? $_POST['prestation'] : NULL;


if($id){

  $sql = "SELECT prestation
                ,referencepresta
                ,coutachat
                ,tvaachat
                ,umesure
          FROM `prestation` 
          WHERE id_session =:id_session AND prestation = :prestation "; //$_SESSION

  $datas = array(':prestation'=>htmlspecialchars($id), ':id_session'=>$_SESSION['id_session']);

  try {
    $pdoS = $bdd->prepare($sql);
    $pdoS->execute($datas);
    $prestation = $pdoS->fetch();
  } catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
  }
}else{
  //Aucun id envoyé dans la requête
  $prestation = NULL;
}

//on renvoie les données au format JSON
echo json_encode($prestation);