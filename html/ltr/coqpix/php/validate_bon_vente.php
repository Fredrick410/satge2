<?php

//page pour valider un bon de vente (commande faite par le client)

session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//confirmer l'envoi de la commande
if($_GET['typ'] == 'confirm'){
  //update le satuts pour informer que la commande va etre livre
 $q= $bdd->prepare("UPDATE BON set commande = 'Commande validée / Livraison en cours' WHERE id= :id");
 $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
 $q->execute();

//mettre la date de l'envoie de la commande
 $q = $bdd ->prepare('UPDATE articles SET datecommande = :dte where numeros = :id');
 $q -> bindValue('dte',Date('Y/m/d'));
 $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
 $q->execute();

  //update le stock
  $q= $bdd->prepare('SELECT referencearticle,quantite from articles where numeros=:num');
  $q->bindValue('num',$_GET['id'], PDO::PARAM_STR);
  $q->execute();
  $ref = $q->fetchAll();


  foreach ($ref as $refs) {
    $q = $bdd->prepare('SELECT stock from article where referencearticle = :ref');
    $q->bindValue('ref',$refs['referencearticle']);
    $q->execute();
    $quantite = $q->fetch();

    $stk = $quantite['stock'] - $refs['quantite'];

    $q= $bdd->prepare("UPDATE article set stock = :stk WHERE referencearticle = :ref");
    $q -> bindValue('stk',$stk, PDO::PARAM_STR);
    $q -> bindValue('ref',$refs['referencearticle'], PDO::PARAM_STR);
    $q->execute();

  }
  sleep(1);
  header('Location: ../inventaire-commande-client.php');
  exit();
}

elseif ($_GET['typ'] == 'end') {
  //update le satuts pour informer que la commande a ete livre
  $q= $bdd->prepare("UPDATE BON set commande = 'Commande bien reçu par le Client' WHERE id= :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();

  sleep(1);
  header('Location: ../inventaire-commande-client.php');
  exit();
}

?>
