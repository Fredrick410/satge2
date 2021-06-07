<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once '../php/config.php';
require_once '../php/verif_session_connect.php';


if($_GET['type_files_note'] == "note"){$typ = "Note de frais";}
if($_GET['type_files_avoir'] == "avoir"){$typ = "Avoir";}
if($_GET['type_files_fac_achat'] == "fac_achat"){$typ = "Facture d'achat";}
if($_GET['type_files_fac_ventes'] == "fac_ventes"){$typ = "Facture de vente";}
if($_GET['type_files_caisse_ventes'] == "cas_ventes"){$typ = "Note de frais";}
if($_GET['banque'] == "banque"){$typ = "Banque";}

    
?>
<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Validation</title>
  <link rel="stylesheet" href="./style_button_valid.css">

</head>
<body>
  <img src="coqpix.jpg" class="image">
  
<div>Suite à la validation le document que vous avez choisit sera envoye définitivement<br><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp- Vérification que le numéros de facture est présent : &nbsp&nbsp&nbsp&nbsp <a class="blue"><?= $_GET['name_files'] ?></a><br><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp- Vérification du nom de la société : &nbsp&nbsp&nbsp&nbsp <a class="blue"><?= $_GET['name_entreprise'] ?></a>.<br><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp- Vérification de la date du document : &nbsp&nbsp&nbsp&nbsp <a class="blue"><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($_GET['dte_files']));?></a>.<br><br>
    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp- Vérification de la catégorie du document : &nbsp&nbsp&nbsp&nbsp <a class="blue"><?= $typ ?></a>.
    


</div>
<div class="form-group">
<br>
</div>
<a href="../php/send-to-comptable.php?id=<?= $_GET['id'] ?>&name_entreprise=<?= $_GET['name_entreprise'] ?>&name_files=<?= $_GET['name_files'] ?>&size_files=<?= $_GET['size_files'] ?>&dte_files=<?= $_GET['dte_files'] ?>&dte_j=<?= $_GET['dte_j'] ?>&dte_m=<?= $_GET['dte_m'] ?>&dte_a=<?= $_GET['dte_a'] ?>&img_files=<?= $_GET['img_files'] ?>&type_files_note=<?= $_GET['type_files_note'] ?>&type_files_avoir=<?= $_GET['type_files_avoir'] ?>&type_files_fac_achat=<?= $_GET['type_files_fac_achat'] ?>&type_files_fac_ventes=<?= $_GET['type_files_fac_ventes'] ?>&type_files_caisse_ventes=<?= $_GET['type_files_caisse_ventes'] ?>&banque=<?= $_GET['banque'] ?>&send_files=<?= $_GET['send_files'] ?>&id_session=<?= $_SESSION['id_session'] ?>" class="brk-btn white">
  Validation
</a>
<div class="form-group">
<br>
</div>
<a href="../file-manager.php" class="brk-btn white">
  Annulation
</a>
</body>
</html>
