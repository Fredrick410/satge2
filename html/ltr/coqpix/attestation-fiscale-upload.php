<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire fiscal');
require_once 'php/verif_session_connect_admin.php';

    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num']);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

        //1

        if(isset($_FILES['files'])){

            if($_FILES['files']['error'] > 0){

            echo"Une erreur est survenue lors du téléchargement du fichier";
            die();

            }

            $name_files = $_FILES['files']['name'];   
            $date_h = date("H") + 1;                      
            $date_now = '-'.$date_h.'-'.date("i-s").'';
            $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
            $target_file = $_FILES['files']['tmp_name'];                                     
            $real_name = substr($name_files, 0, -4);
            $file_name = $real_name . $date_now . $type_files;
            $date_donner = date('d/m/Y');
            $id_session= $_GET['num'];
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/attestation_fiscale/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE attestation_fiscale SET files_attestation=:files_attestation, statut_attestation=:statut_attestation, date_donner=:date_donner WHERE id=:id LIMIT 1');
            $pdo->bindValue(':date_donner', $date_donner);
            $pdo->bindValue(':files_attestation', $file_name);
            $pdo->bindValue(':statut_attestation', "Terminée");
            $pdo->bindValue(':id', $_GET['id']);
            $pdo->execute();

             //insert notif front
             $insert_notif = $bdd->prepare('INSERT INTO notif_front (type_demande, date_donner, id_session) VALUES(?,?,?)');
             $insert_notif->execute(array(
                 htmlspecialchars("attestation_fiscale"),
                 htmlspecialchars($date_donner),
                 htmlspecialchars($id_session)
             ));


            $pdo = $bdd->prepare('SELECT id_task from attestation_fiscale WHERE id = ?');
            $pdo->execute(array($_GET['id']));
            $id_task = ($pdo->fetch())['id_task'];

            $pdoS = $bdd->prepare('UPDATE task_fisca SET statut_task = ? WHERE id = ?');
            $pdoS->execute(array('valide',$id_task));
            
            header('Location: attestation-fiscale-view.php?num='.$_GET['num'].'');
            exit();

        }

?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Acte - Etape 3</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns footer-static " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .none-validation{display: none;};

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
    height: 350px;
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
    height: 350px;
    cursor: pointer;
    opacity: 0;
    }

    .gifimg{
        position: relative;
        top: -20px;
        z-index: 1;
    }
    
    .dropzone-wrapper:hover,
    .dropzone-wrapper.dragover {
    background: #ecf0f5;
    z-index: 10;
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
    }
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #e72424;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none text-white"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content" style="background-color: white;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="col-lg-12 ">
                <div class="form-group">
                    <h6>Téléchargement de document :</h6>   
                </div>
                <div class="form-group">
                    <p>Le document demandé devra respecter l'intégralité des condictions sous peine d'un refus de modification.</p>
                </div>
                <div class="form-group">
                    <label>Le document devra :</label><br>
                    <label> - Être fournie sous un format numérique de préférence en PDF (PNG, JPG, JPEG).</label><br>
                    <label> - Être fournie en intégralité (Tous les bords visibles).</label><br>
                    <label> - Être fournie en couleur de préférence.</label><br>
                    <label> - Être parfaitement net et visible.</label><br>
                    <label> - Être une <?= $_GET['document']  ?>.</label>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <p>⚠️ Le téléchargement du document se déclenchera automatiquement lors de la sélection de celui-ci. ⚠️</p>
                    <p>Vous etes sur le point de téléchargé une <?= $_GET['document'] ?> pour <?= $entreprise['nameentreprise'] ?></p>
                </div>
                <div class="form-group">
                    <form name="formSaisie" action="" method="POST" enctype="multipart/form-data">
                        <div class="preview-zone hidden">
                            <div class="box box-solid">
                                <div class="box-header with-border">
                                    <div><b>Aperçu</b></div>
                                        <div class="box-tools pull-right">
                                            <button type="button" class="btn btn-danger btn-xs remove-preview">
                                                <i class="fa fa-times"></i> Réinitialiser
                                            </button>
                                            <button type="button" onclick="valider()" class="btn btn-success btn-xs">
                                                <i class="fa fa-times"></i> Continuer
                                            </button>
                                        </div>
                                    </div>
                                    <div class="box-body"></div>
                                </div>
                            </div>
                            <div class="dropzone-wrapper">
                                <div class="dropzone-desc">
                                    <i class="glyphicon glyphicon-download-alt"></i>
                                    <img class="gifimg img-fluid" src="../../../src/img/plusgif.gif" alt="">
                                </div>
                                <input type="file" name="files" id="fichier"  class="dropzone" accept="image/png, image/jpg, image/jpeg, application/pdf">
                            </div>
                            <small>Un seul document peut être téléchargé</small>
                        </div>
                    </form>											
                </div>
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
    <!-- END: Page JS-->

<script type="text/javascript">

function valider() {
    document.forms["formSaisie"].submit();
}

</script>
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
