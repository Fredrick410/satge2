<?php 
error_reporting(E_ALL);
session_start();
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $explode = explode(';',$_GET['key']);

    $num = $explode[2];

    $pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
    $pdoSta->bindValue(':num',$num);
    $pdoSta->execute();
    $annonce = $pdoSta->fetch();

    if(isset($_POST['code_annonce'])){

        $code = $_POST['code_annonce'];
        $name = $_GET['annonce'];

        $query = $bdd->prepare("SELECT * FROM rh_annonce WHERE code_annonce = :code"); 
        $query->bindValue(':code',$code);
        $query->execute();
        $count = $query->rowCount();

        if($count >= 1) 
        {
            $_SESSION['invite'] = $_GET['num'];

            header('Location: candidature-recrutement.php?'.$annonce['link'].'$req=true');
            exit();
        }else{

            header('Location: candidature-recrutement.php?'.$annonce['link'].'&req=false');
            exit();
        }  
    }

    if($annonce['code_annonce'] == ""){
        $locked = "red";
        $none_bts = "";
        $none_btd = "none-validation";
    }else{
        if(empty($_SESSION['invite'])){
            $locked = "red";
            $none_bts = "";
            $none_btd = "none-validation";
        }else{
            $locked = "green";
            $none_bts = "none-validation";
            $none_btd = "";
        }
    }

    //1

        if(isset($_FILES['files']) && $_GET['document'] == "cv"){

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
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/recrutement/cv/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE rh_candidature SET cv_doc=:doc WHERE key_candidat=:key_candidat LIMIT 1');
            $pdo->bindValue(':key_candidat', $_GET['key']);
            $pdo->bindValue(':doc', $file_name);
            $pdo->execute();
            
            header('Location: candidature-recrutement-files.php?key='.$_GET['key'].'');
            exit();

        }

    //2

        if(isset($_FILES['files']) && $_GET['document'] == "lettredemotivation"){

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
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/recrutement/lettredemotivation/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE rh_candidature SET lettredemotivation_doc=:doc WHERE key_candidat=:key_candidat LIMIT 1');
            $pdo->bindValue(':key_candidat', $_GET['key']);
            $pdo->bindValue(':doc', $file_name);
            $pdo->execute();
            
            header('Location: candidature-recrutement-files.php?key='.$_GET['key'].'');
            exit();

        }

    //3

        if(isset($_FILES['files']) && $_GET['document'] == "other"){

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
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/recrutement/other/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE rh_candidature SET other_doc=:doc WHERE key_candidat=:key_candidat LIMIT 1');
            $pdo->bindValue(':key_candidat', $_GET['key']);
            $pdo->bindValue(':doc', $file_name);
            $pdo->execute();
            
            header('Location: candidature-recrutement-files.php?key='.$_GET['key'].'');
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
    <title>Recrutement - Etape  3</title>
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

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
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
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: <?= $annonce['color_annonce'] ?>;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item">
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" style="cursor: pointer; font-size: 25px; color: <?= $locked ?>;" data-toggle="modal" data-target="#info"><i class='bx bxs-lock'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content" style="background-color: white;">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="col-lg-12 ">
                <div class="form-group">
                    <p>⚠️ Le téléchargement du document se déclenchera automatiquement lors de la sélection de celui-ci. ⚠️</p>
                    <p>Vous etes sur le point de téléchargé un/une <?php if($_GET['document'] == "cv"){echo "Cv";}elseif($_GET['document'] == "lettredemotivation"){ echo "Lettre de motivation";}elseif($_GET['document'] == "other"){echo "document supplementaire";} ?></p>
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