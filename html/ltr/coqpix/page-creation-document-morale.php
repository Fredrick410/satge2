<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    //edit part

    if(isset($_POST['edit_form'])){

        $sql = $bdd->prepare('UPDATE crea_societe SET name_crea=:name_crea, email_crea=:email_crea, password_crea=:password_crea, date_crea=:date_crea, nom_diri=:nom_diri, prenom_diri=:prenom_diri, tel_diri=:tel_diri, email_diri=:email_diri, status_crea=:status_crea WHERE id=:num LIMIT 1');
        $sql->bindValue(':name_crea', $_POST['name_crea']);
        $sql->bindValue(':email_crea', $_POST['email_crea']);
        $sql->bindValue(':password_crea', $_POST['password_crea']);
        $sql->bindValue(':date_crea', $_POST['date_crea']);
        $sql->bindValue(':nom_diri', $_POST['nom_diri']);
        $sql->bindValue(':prenom_diri', $_POST['prenom_diri']);
        $sql->bindValue(':tel_diri', $_POST['tel_diri']);
        $sql->bindValue(':email_diri', $_POST['email_diri']);
        $sql->bindValue(':status_crea', $_POST['status_crea']);
        $sql->bindValue(':num', $_POST['num']);
        $sql->execute();

        header('Location: creation-view-morale.php?num='.$_POST['num'].'');
        exit();
    }

// UPLOAD PIECE IDENTITE

    if(isset($_POST['piece_id'])){                                        //here

        $name_files = $_FILES['pieceid']['name'];                         //here
        $date_now = '-'.date("H-i-s");
        $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
        $target_file = $_FILES['pieceid']['tmp_name'];                                     //here
        $real_name = substr($name_files, 0, -4);
        $file_name = '../../../src/crea_societe/pieceid/'. $real_name . $date_now . $type_files; //here
        $resultat = move_uploaded_file($target_file, $file_name);

        if($resultat){

            $update = $bdd->prepare('UPDATE crea_societe SET doc_pieceid = ? WHERE id = ?');
            $update->execute(array(

            ($real_name . $date_now . $type_files),
            ($_GET['num'])
            
    ));

            header('Location: creation-view-physique.php?num='.$_GET['num']);
            exit();
        }       
    }



// UPLOAD cerfaM0

    if(isset($_POST['cerfaM0_id'])){                                        //here

        $name_files = $_FILES['cerfaM0']['name'];                         //here
        $date_now = '-'.date("H-i-s");
        $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
        $target_file = $_FILES['cerfaM0']['tmp_name'];                                     //here
        $real_name = substr($name_files, 0, -4);
        $file_name = '../../../src/crea_societe/cerfaM0/'. $real_name . $date_now . $type_files; //here
        $resultat = move_uploaded_file($target_file, $file_name);

        if($resultat){

            $update = $bdd->prepare('UPDATE crea_societe SET doc_cerfaM0 = ? WHERE id = ?');
            $update->execute(array(

            ($real_name . $date_now . $type_files),
            ($_GET['num'])
            
    ));

            header('Location: creation-view-physique.php?num='.$_GET['num']);
            exit();
        }       
    }
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix cr??e By audit action plus - d??velopp?? par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Cr??ation de soci??t??</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">
<style>

.nofavo{text-decoration: none; color : #c7cfd6;}
.nofavoh:hover{text-decoration: none; color : #ffcd02;}
.favo{text-decoration: none; color : #ffcd02;}
.favoh:hover{text-decoration: none; color : #c7cfd6;}
.line{text-decoration: underline;}
.sizeright{font-size: 12px;}
.nonedoc {display : none;}
.esp{color: #828D99; text-decoration: underline;}
.esp:hover{color: #34465b; text-decoration: underline;}

</style>


    <!-- BEGIN: Header-->
     
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="sidebar-content email-app-sidebar d-flex">
                        <!-- sidebar close icon -->
                        <span class="sidebar-close-icon">
                            <i class="bx bx-x"></i>
                        </span>
                        <!-- sidebar close icon -->
                        <div class="email-app-menu">
                            <div class="sidebar-menu-list">
                                <!-- sidebar menu  -->
                                <div class="list-group list-group-messages">
                                    <a href="#" class="list-group-item pt-0 active" id="inbox-menu">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: briefcase.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Tous
                                    </a>
                                    <div class="form-group">
                                        <hr>
                                        <label class="line">Administration</label>
                                    </div>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Piece d'identit??e
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div> 
                                        Cerfa M0
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Cerfa MBE
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Justificatif de si??ge
                                    </a>
                                    <div class="form-group">
                                        <hr>
                                        <label class="line">R??daction</label>
                                    </div>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Affectation pateimoine
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Pouvoir
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Attestation de non condamnation
                                    </a>
                                    <div class="form-group">
                                        <hr>
                                        <label class="line">Banque et Publication</label>
                                    </div>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        D??pot de capital
                                    </a>
                                    <a href="#" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: file-import.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Annonce l??gale
                                    </a>
                                </div>
                                <!-- sidebar menu  end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <!-- email app overlay -->
                        <div class="app-content-overlay"></div>
                        <div class="email-app-area">
                            
                        </div>
                    </div>
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
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->

    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>