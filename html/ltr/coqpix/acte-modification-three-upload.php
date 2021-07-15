<?php 
require_once 'php/verif_session_connect_admin.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoSta = $bdd->prepare('SELECT * FROM acte WHERE code=:code');
    $pdoSta->bindValue(':code',$_GET['num']);
    $pdoSta->execute();
    $acte = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM acte_doc WHERE code=:code');
    $pdoSta->bindValue(':code',$_GET['num']);
    $pdoSta->execute();
    $acte_doc = $pdoSta->fetch();

    $verif_one = $_GET['verif_one'];

    //script pour trouver le type de document
   
    if($_GET['document'] == "doc_age"){$document = "AGE";}elseif($_GET['document'] == "doc_edit"){$document = "Statuts modifiés";}elseif($_GET['document'] == "doc_acte"){$document = "Actes de session";}elseif($_GET['document'] == "doc_MBE"){$document = "Cerfa MBE";}elseif($_GET['document'] == "doc_M3"){$document = "Cerfa M3";}elseif($_GET['document'] == "doc_jal"){$document = "Publication JAL";}elseif($_GET['document'] == "doc_attestation"){$document = "Attestation de nom condamnation";}elseif($_GET['document'] == "doc_pieceid"){$document = "Piece identitée du nouveau gérant / président";}elseif($_GET['document'] == "doc_justificatif"){$document = "justificatif de domiciliation";}elseif($_GET['document'] == "doc_cerfaM2"){$document = "Cerfa M2";}elseif($_GET['document'] == "doc_tns"){$document = "Formulaire TNS";}elseif($_GET['document'] == "doc_rcsas"){$document = "Rapport commissaire";}elseif($_GET['document'] == "doc_cerfaAC"){$document = "Certification d'augmentation capital";}

        //insertion de fichier

        //1

        if(isset($_FILES['files']) && $_GET['document'] == "doc_age"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_age=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        //2

        if(isset($_FILES['files']) && $_GET['document'] == "doc_edit"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_edit=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        //3

        if(isset($_FILES['files']) && $_GET['document'] == "doc_acte"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_acte=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_MBE"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_MBE=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_M3"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_M3=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_jal"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_jal=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_attestation"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_attestation=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_pieceid"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_pieceid=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_justificatif"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_justificatif=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_cerfaM2"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_cerfaM2=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_tns"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_tns=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_rcsas"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_rcsas=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
            exit();

        }

        if(isset($_FILES['files']) && $_GET['document'] == "doc_cerfaAC"){

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
            $file_name = $dir. $real_name . $date_now . $type_files;
            
            $tmpName = $_FILES['files']['tmp_name'];                                     //chemin du document
            $path = "../../../src/acte/". $file_name;                     // chemin vers le serveur

            $resultat = move_uploaded_file($tmpName, $path);

            $pdo = $bdd->prepare('UPDATE acte_doc SET doc_cerfaAC=:doc WHERE code=:num LIMIT 1');
            $pdo->bindValue(':doc', $file_name);
            $pdo->bindValue(':num', $_GET['num']);
            $pdo->execute();
            
            header('Location: acte-modification-three-morale.php?num='.$_GET['num'].'&verif_one='.$verif_one.'');
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
    <?php include('php/header_back.php'); ?>
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
                    <label> - Être un/une <?= $document  ?>.</label>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <p>⚠️ Le téléchargement du document se déclenchera automatiquement lors de la sélection de celui-ci. ⚠️</p>
                    <p>Vous etes sur le point de téléchargé un/une <?= $document ?></p>
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
</body>
<!-- END: Body-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
</html>