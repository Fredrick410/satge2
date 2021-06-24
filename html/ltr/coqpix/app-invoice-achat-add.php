<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
   
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id'], PDO::PARAM_INT);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSat = $bdd->prepare('SELECT * FROM flash WHERE id_session =:num');
    $pdoSat->bindValue(':num',$_SESSION['id_session']);
    $pdoSat->execute();
    $fl = $pdoSat->fetch();

    $pdoS = $bdd->prepare('SELECT * FROM fournisseur WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $fournisseur = $pdoS->fetchAll();


?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">

    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Ajouter un facture d'achat</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
	<style>
	/* Code By Webdevtrick ( https://webdevtrick.com ) */
.container {
  padding: 50px 10%;
}
 
.box {
  position: relative;
  background: #ffffff;
  width: 100%;
}
 
.box-header {
  color: #444;
  display: block;
  padding: 10px;
  position: relative;
  border-bottom: 1px solid #f4f4f4;
  margin-bottom: 10px;
}
 
.box-tools {
  position: absolute;
  right: 10px;
  top: 5px;
}
 
.dropzone-wrapper {
  border: 2px dashed #91b0b3;
  color: #92b0b3;
  position: relative;
  height: 150px;
}
 
.dropzone-desc {
  position: absolute;
  margin: 0 auto;
  left: 0;
  right: 0;
  text-align: center;
  width: 40%;
  top: 50px;
  font-size: 16px;
}
 
.dropzone,
.dropzone:focus {
  position: absolute;
  outline: none !important;
  width: 100%;
  height: 150px;
  cursor: pointer;
  opacity: 0;
}
 
.dropzone-wrapper:hover,
.dropzone-wrapper.dragover {
  background: #ecf0f5;
}
 
.preview-zone {
  text-align: center;
}
 
.preview-zone .box {
  box-shadow: none;
  border-radius: 0;
  margin-bottom: 0;
}
 
.btn-primary {
  background-color: crimson;
  border: 1px solid #212121;
}</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                <form action="php/insert_facture_achat.php" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="doc_facture" value="<?= $fl['doc_flash'] ?>">
                                        <div class="row mx-0">
                                            <div class="col-xl-6 col-md-12 d-flex align-items-center pl-0">
                                                <h6 class="invoice-number mr-75">Facture N°</h6>
                                                <input name="num_facture" type="text" class="form-control pt-25 w-50" placeholder="00000" required>
                                            </div>
                                            <div class="col-xl-6 col-md-12 px-0 pt-xl-0 pt-1">
                                                <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">*Date : </small>
                                                        <fieldset class="d-flex ">
                                                            <input name="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" required>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1">
                                                <h4 class="text-primary">Facture d'achats</h4>
                                                <input name="name_facture" type="text" class="form-control" placeholder="Intituler de la facture" required> 
                                            </div>
                                            <div class="col-sm-6 col-12 order-1 order-sm-1 d-flex justify-content-end">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-50">         
                                        <hr>
                                        <div class="invoice-subtotal pt-50">
                                            <div class="row">
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label>*Fournisseur :</label>
                                                        <select name="name_fournisseur" id="fournisseur" class="form-control invoice-item-select">
                                                            <option value="Pas de fournisseur">Sélectionnez un fournisseur</option>
                                                            <optgroup label="Liste des fournisseurs">
                                                            </optgroup>
                                                            <?php foreach($fournisseur as $fournisseurr): ?>
                                                            <option value="<?= $fournisseurr['name_fournisseur'] ?>"><?= $fournisseurr['name_fournisseur'] ?></option>
                                                            <?php endforeach; ?>
                                                            <option value="Pas de fournisseur">Autres</options>
                                                        </select>
                                                    </div>
                                                                                                
                                                </div>
                                                <div class="col-lg-5 col-md-7 offset-lg-2 col-12">
                                                       <div class="form-group">
														   <h6 class="invoice-number mr-75">Fournisseur de la facture</h6>
                                                        <input name="name_fournisseur" id="newfournisseur" type="text" class="form-control" placeholder="Fournisseur de la facture" required>
                                                    </div> 
                                                </div>
                                                <div class="col-lg-12 ">
                                                    <hr>
                                                    <div class="form-group">
                                                        <label class="control-label">Document justificatif</label>
                                                        <div class="preview-zone hidden">
                                                            <div class="box box-solid">
                                                                <div class="box-header with-border">
                                                                    <div><b>Aperçu</b></div>
                                                                        <div class="box-tools pull-right">
                                                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                                                <i class="fa fa-times"></i> Réinitialiser
                                                                            </button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="box-body"></div>
                                                                </div>
                                                            </div>
                                                            <div class="dropzone-wrapper">
                                                                <div class="dropzone-desc">
                                                                    <i class="glyphicon glyphicon-download-alt"></i>
                                                                    <p>Choisissez un fichier image ou faites-le glisser ici.</p>
                                                                </div>
                                                                <input type="file" name="files" name="files" id="fichier"  class="dropzone" accept="image/png, image/jpg, image/jpeg, application/pdf">
                                                            </div>
                                                            <p>1 documents max</p><br>
                                                        </div>											
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 ">
                                                    <li class="list-group-item border-0 pb-0">
                                                        <input type="submit" value="Sauvegarder" class="btn btn-primary btn-block subtotal-preview-btn">
                                                    </li>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>                      
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="../../../app-assets/js/scripts/pages/myFunction_fournisseur.js"></script>
    <!-- END: Page JS-->

<script>// Code By Webdevtrick ( https://webdevtrick.com )
function readFile(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function(e) {
      var htmlPreview =
        '<img width="200" src="' + e.target.result + '" />' +
        '<p>' + input.files[0].name + '</p>';
      var wrapperZone = $(input).parent();
      var previewZone = $(input).parent().parent().find('.preview-zone');
      var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find('.box-body');

      wrapperZone.removeClass('dragover');
      previewZone.removeClass('hidden');
      boxZone.empty();
      boxZone.append(htmlPreview);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

function reset(e) {
  e.wrap('<form>').closest('form').get(0).reset();
  e.unwrap();
}

$(".dropzone").change(function() {
  readFile(this);
});

$('.dropzone-wrapper').on('dragover', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).addClass('dragover');
});

$('.dropzone-wrapper').on('dragleave', function(e) {
  e.preventDefault();
  e.stopPropagation();
  $(this).removeClass('dragover');
});

$('.remove-preview').on('click', function() {
  var boxZone = $(this).parents('.preview-zone').find('.box-body');
  var previewZone = $(this).parents('.preview-zone');
  var dropzone = $(this).parents('.form-group').find('.dropzone');
  boxZone.empty();
  previewZone.addClass('hidden');
  reset(dropzone);
});</script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js'></script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>