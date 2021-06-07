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
$id = !empty($_POST['name_client']) ? $_POST['name_client'] : NULL;


if($id){

  $sql = "SELECT id
                ,name_client
                ,adresse
                ,departement
                ,email
                ,tel
          FROM `client` 
          WHERE id_session =:id_session AND name_client = :name_client "; //$_SESSION

  $datas = array(':name_client'=>$id, ':id_session'=>$_SESSION['id_session']);

  try {
    $pdoS = $bdd->prepare($sql);
    $pdoS->execute($datas);
    $client = $pdoS->fetch();
  } catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
  }
}else{
  //Aucun id envoyé dans la requête
  $client = NULL;
}

//on renvoie les données au format JSON
echo json_encode($client);