<?php
//page pour annuler/refuser un bon d'achat (commande faite par l'entreprise)
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);



if ($_GET['typ'] == 'annul') {
  $q = $bdd ->prepare("SELECT referencearticle from articles where numeros = :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();
  $ref = $q->fetchAll();
  foreach ($ref as $refs) {
    $q = $bdd ->prepare("UPDATE article SET commandeatm = 'NON' where referencearticle = :ref");
    $q -> bindValue('ref',$refs['referencearticle']);
    $q->execute();
  }
  $q = $bdd ->prepare("UPDATE bon_commande SET commande = 'Commande non conforme' where id_bon_commande = :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();

  sleep(1);
  header('Location: ../inventaire-reception-commande.php');
  exit();

} else {

  $q = $bdd ->prepare("UPDATE bon_commande SET commande = 'Commande refusé' where id_bon_commande = :id");
  $q -> bindValue('id',$_GET['id'], PDO::PARAM_STR);
  $q->execute();
}


sleep(1);
header('Location: ../inventaire-commande-fourni.php');
exit();

?>
