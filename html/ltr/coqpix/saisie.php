<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    $pdoSt = $bdd->prepare('SELECT * FROM stockage_admin WHERE id=:num');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $file = $pdoSt->fetch();


?>



<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Coqpix</title>
  <link rel="stylesheet" href="style.css">

</head>
<body>
<!-- partial:index.partial.html -->
<div class="login-box">
  <h2>Numéros de Saisie</h2>
  <?php 
  

  if($file['type_files_note'] == "note"){
    $typ = "note";
  }

  if($file['type_files_avoir'] == "avoir"){
    $typ = "avoir";
  }

  if($file['type_files_fac_achat'] == "fac_achat"){
    $typ = "fac_achat";
  }

  if($file['type_files_fac_ventes'] == "fac_ventes"){
    $typ = "fac_ventes";
  }

  if($file['banque'] == "banque"){
    $typ = "banque";
  }

  if($file['type_files_caisse_ventes'] == "cas_ventes"){
    $typ = "cas_ventes";
  }

  if($_GET['num_ok'] == "one"){
    $typ = "valide";
  }

  if($_GET['num_ok'] == "two"){
    $typ = "nonvalide";
  }

  if($_GET['num_ok'] == "three"){
    $typ = "important";
  }



  
  
  ?>
  <form action="php/ok-by-comptable-<?= $typ ?>.php" method="GET">
  <input type="hidden" name="num" value="<?= $_GET['num'] ?>">
    <div class="user-box">
      <input type="number" name="num_saisie" required>
      <label></label>
    </div>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<button class="one" type="submit">
      Continuer
    </button>
  </form>
</div>
<!-- partial -->
  
</body>
</html>
