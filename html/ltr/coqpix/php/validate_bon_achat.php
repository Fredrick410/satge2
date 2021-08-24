<?php

//page pour valider un bon d'achat (commande faite par l'entreprise)

session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$q = $bdd ->prepare("SELECT referencearticle, quantite from articles where numeros = :id");
$q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
$q->execute();
$ref = $q->fetchAll();

if ($_GET['typ']== 'confirm') {// confirmer la commande
  $q = $bdd ->prepare("UPDATE bon_commande SET commande = 'Commande validée / Livraison en cours' where id_bon_commande = :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();

  //mettre la date de la commande
  $q = $bdd ->prepare('UPDATE articles SET datecommande = :dte where numeros = :id');
  $q -> bindValue('dte',Date('Y/m/d'));
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();

//informer que l'on commande l'article
  foreach ($ref as $refs) {
    $q = $bdd ->prepare("UPDATE article SET commandeatm = 'OUI' where referencearticle = :ref");
    $q -> bindValue('ref',$refs['referencearticle']);
    $q->execute();
  }
  sleep(1);
  header('Location: ../inventaire-commande-fourni.php');
  exit();
}

//valider la conformiter de la commande et ainsi mettre a jours le stock
elseif ($_GET['typ']== 'end') {

  $q = $bdd ->prepare("UPDATE bon_commande SET commande = 'Commande conforme' where id_bon_commande = :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();

  foreach ($ref as $refs) {
    $q = $bdd ->prepare("UPDATE article SET commandeatm = 'NON' where referencearticle = :ref");
    $q -> bindValue('ref',$refs['referencearticle']);
    $q->execute();

    //update le stock
    $q = $bdd ->prepare("SELECT stock from article where referencearticle = :ref");
    $q -> bindValue('ref',$refs['referencearticle']);
    $q->execute();
    $quantite = $q->fetch();

    $stk = $refs['quantite'] + $quantite['stock'];

    $q = $bdd ->prepare("UPDATE article SET stock = :stk where referencearticle = :ref");
    $q -> bindValue('stk',$stk);
    $q -> bindValue('ref',$refs['referencearticle']);
    $q->execute();
  }

  sleep(1);
  header('Location: ../inventaire-reception-commande.php');
  exit();
}

?>
