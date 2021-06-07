<?php 

require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoSt = $bdd->prepare('SELECT * FROM etiquette_bookmark WHERE id_session = :num');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$etiq = $pdoSt->fetch();

$pdoSt = $bdd->prepare('SELECT * FROM bookmark WHERE id_session = :num');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$bookmark = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM bookmark WHERE favorite_search=:favorite_search AND id_session = :num');
$pdoSt->bindValue(':favorite_search', "yes");
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$bookmark_favo = $pdoSt->fetchAll();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
  <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
  <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
  <meta name="author" content="Audit action plus - Youness Haddou">
  <title>Bookmark - Coqpix</title>
  <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
  <!-- Google font-->
  <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/fontawesome.css">
  <!-- ico-font-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/icofont.css">
  <!-- Themify icon-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/themify.css">
  <!-- Flag icon-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/flag-icon.css">
  <!-- Feather icon-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/feather-icon.css">
  <!-- Plugins css start-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/scrollbar.css">
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/select2.css">
  <!-- Plugins css Ends-->
  <!-- Bootstrap css-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/bootstrap.css">
  <!-- App css-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/style.css">
  <link id="color" rel="stylesheet" href="../../../cuba/assets/css/color-1.css" media="screen">
  <!-- Responsive css-->
  <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/responsive.css">
</head>

<body>
  
  <!-- tap on top starts-->
 
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        
                        <div class="modal-body">
                        <form action="php/edit_etiq_bookmark.php" method="POST" class="form-bookmark needs-validation">
                            <div class="row g-2">
                            <div class="mb-3 mt-0 col-md-12">
                                <label>Nom du theme</label>
                                <input class="form-control" type="text" name="name_etiq" required autocomplete="off">
                            </div>
                            <div class="mb-3 mt-0 col-md-12">
                                <label>Couleur du theme</label>
                                <input class="form-color d-block" type="color" name="color_etiq" value="#337aff">
                            </div>
                            <input style="display: none;" type="number" name="id" value="<?=$etiq['id']?>" >
                            </div>
                            <button class="btn btn-secondary" type="submit">Sauvegarder</button>
                            <button href="bookmark.php" class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                        </form>
                        </div>
                    </div>
                </div>
                
  <!-- latest jquery-->
  <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
  <!-- Bootstrap js-->
  <script src="../../../cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
  <!-- feather icon js-->
  <script src="../../../cuba/assets/js/icons/feather-icon/feather.min.js"></script>
  <script src="../../../cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
  <!-- scrollbar js-->
  <script src="../../../cuba/assets/js/scrollbar/simplebar.js"></script>
  <script src="../../../cuba/assets/js/scrollbar/custom.js"></script>
  <!-- Sidebar jquery-->
  <script src="../../../cuba/assets/js/config.js"></script>
  <!-- Plugins JS start-->
  <script src="../../../cuba/assets/js/sidebar-menu.js"></script>
  <script src="../../../cuba/assets/js/bookmark/jquery.validate.min.js"></script>
  <script src="../../../cuba/assets/js/bookmark/custom.js"></script>
  <script src="../../../cuba/assets/js/select2/select2.full.min.js"></script>
  <script src="../../../cuba/assets/js/select2/select2-custom.js"></script>
  <script src="../../../cuba/assets/js/form-validation-custom.js"></script>
  <script src="../../../cuba/assets/js/tooltip-init.js"></script>
  <!-- Plugins JS Ends-->
  <!-- Theme js-->
  <script src="../../../cuba/assets/js/script.js"></script>
  <!-- login js-->
  <!-- Plugin used-->
      <!-- TIMEOUT -->
      <?php include('timeout.php'); ?>
</body>

</html>