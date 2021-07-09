<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

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
    <title>Création de société</title>
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
.namecolor{color: #626262;}
.none-validation{display: none;}

</style>


    <!-- BEGIN: Header-->
    <?php include('php/header_back.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

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
                            <div class="form-group form-group-compose">
                                <!-- compose button  -->
                                <button type="button" class="btn btn-primary btn-block my-2 compose-btn">
                                    <i class="bx bx-plus"></i>
                                    Nouveau
                                </button>
                            </div>
                            <div class="sidebar-menu-list">
                                <!-- sidebar menu  -->
                                <?php include('php/sidebar_crea.php'); ?>
                                <!-- sidebar menu  end-->

                                <!-- sidebar label start -->
                                <?php include('php/sidebar_label_crea.php'); ?>
                                <!-- sidebar label end -->
                            </div>
                        </div>
                    </div>
                    <!-- User new mail right area -->
                    <div class="compose-new-mail-sidebar">
                        <div class="card shadow-none quill-wrapper p-0">
                            <div class="card-header">
                                <h3 class="card-title" id="emailCompose">Création de societe</h3>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form action="php/insert_crea.php" id="compose-form" method="POST">
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="form-group">
                                            <label>Nom de l'entreprise</label>
                                            <input type="text" id="name_crea" name="crea_societe" class="form-control" placeholder="Nom de l'entreprise" required>
                                        </div>
                                        <fieldset class="form-group">
                                            <label>Forme juridique</label>
                                            <select name="status_crea" class="form-control invoice-item-select">
                                                <option value="SAS" selected>Choisir une forme juridique</option>
                                                <optgroup label="Morale">
                                                    <option value="SARL">SARL</option>
                                                    <option value="SAS">SAS</option>
                                                    <option value="SASU">SASU</option>
                                                    <option value="SCI">SCI</option>
                                                    <option value="EURL">EURL</option>
                                                </optgroup>
                                                <optgroup label="Physique">
                                                    <option value="EIRL">EIRL</option>
                                                    <option value="EI">EI</option>
                                                    <option value="Micro-entreprise">Micro-entreprise</option>
                                                </optgroup>
                                            </select>
                                        </fieldset>
                                        <div class="form-group">
                                            <label>Nom du dirigeant</label>
                                            <input type="text" id="nom_diri" name="nom_diri" class="form-control" placeholder="Nom du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Prenom du dirigeant</label>
                                            <input type="text" id="prenom_diri" name="prenom_diri" class="form-control" placeholder="Prenom du dirigeant" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Téléphone du dirigeant</label>
                                            <input type="number" id="tel_diri" name="tel_diri" class="form-control" placeholder="06.00.00.00.00" required>
                                        </div>
                                        <div class="form-group">
                                        <hr>
                                        <label>Information de connexion</label>
                                        </div>
                                        <div class="form-group">
                                            <input type="email" id="email_crea" name="email_crea" class="form-control" placeholder="E-mail de contact" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" id="password_crea" name="password_crea" class="form-control" placeholder="Mot de passe" required>
                                        </div>

                                        <!-- IMAGE INSERTION -->
                                        <!-- <div class="form-group mt-2">
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="emailAttach">
                                                <label class="custom-file-label" for="emailAttach">Attach file</label>
                                            </div>
                                        </div> -->

                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end pt-0">
                                    <button type="reset" class="btn btn-light-secondary cancel-btn mr-1">
                                        <i class='bx bx-x mr-25'></i>
                                        <span class="d-sm-inline d-none">Annuler</span>
                                    </button>
                                    <button type="submit" class="btn-send btn btn-primary">
                                        <i class='bx bx-send mr-25'></i> <span class="d-sm-inline d-none">Créer</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->
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
                            <!-- Email list Area -->
                            <div class="email-app-list-wrapper">
                                <div class="email-app-list">
                                    <div class="email-action">
                                        <!-- action left start here -->
                                        <div class="action-left d-flex align-items-center">
                                            <!-- delete unread dropdown -->
                                            <ul class="list-inline m-0 d-flex">
                                                <li class="list-inline-item mail-delete">
                                                </li>
                                                <li class="list-inline-item">
                                                    <div class="dropdown">
                                                        <button type="button" class="btn btn-icon dropdown-toggle action-icon" id="tag" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <span class="fonticon-wrap">
                                                                <i class="livicon-evo" data-options="name: tag.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                                                </i>
                                                            </span>
                                                        </button>
                                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="tag">
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-success bullet-sm"></span>
                                                                <span>SARL</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-primary bullet-sm"></span>
                                                                <span>SAS</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-warning bullet-sm"></span>
                                                                <span>SASU</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-danger bullet-sm"></span>
                                                                <span>SCI</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-info bullet-sm"></span>
                                                                <span>EIRL</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-light bullet-sm"></span>
                                                                <span>EI</span>
                                                            </a>
                                                            <a href="#" class="dropdown-item align-items-center">
                                                                <span class="bullet bullet-black bullet-sm"></span>
                                                                <span>Micro-entreprise</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <!-- action left end here -->

                                        <!-- action right start here -->
                                        <div class="action-right d-flex flex-grow-1 align-items-center justify-content-around">
                                            <!-- search bar  -->
                                            <div class="email-fixed-search flex-grow-1">
                                                <div class="sidebar-toggle d-block d-lg-none">
                                                    <i class="bx bx-menu"></i>
                                                </div>
                                                <fieldset class="form-group position-relative has-icon-left m-0">
                                                    <input type="text" class="form-control" id="email-search" placeholder="Rechercher un dossier">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-search"></i>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <!-- pagination and page count -->
                                            <button class="btn btn-icon email-pagination-prev d-none d-sm-block">
                                                <i class="bx bx-chevron-left"></i>
                                            </button>
                                            <button class="btn btn-icon email-pagination-next d-none d-sm-block">
                                                <i class="bx bx-chevron-right"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <!-- / action right -->

                                    <!-- email user list start -->
                                    <div class="email-user-list list-group">
                                        <ul class="users-list-wrapper media-list">
                                            <?php foreach($crea as $creation): ?>
                                                <?php 

                                                    if($creation['status_crea'] == "EURL"){
                                                            $linkview = "morale";
                                                    }else{        
                                                        if($creation['status_crea'] == "SARL"){
                                                            $linkview = "morale";
                                                        }else{
                                                            if($creation['status_crea'] == "SAS"){
                                                                $linkview = "morale";
                                                            }else{
                                                                if($creation['status_crea'] == "SASU"){
                                                                    $linkview = "morale";
                                                                }else{
                                                                    if($creation['status_crea'] == "SCI"){
                                                                        $linkview = "morale";
                                                                    }else{
                                                                        if($creation['status_crea'] == "EIRL"){
                                                                            $linkview = "physique";
                                                                        }else{
                                                                            if($creation['status_crea'] == "Micro-entreprise"){
                                                                                $linkview = "physique";
                                                                            }else{
                                                                                $linkview = "physique";
                                                                            }
                                                                        }
                                                                    }
                                                                }
                                                            }
                                                        }
                                                    }
                                                    
                                                    ?>
                                                <?php $pourc = "0"; if($linkview == "morale"){if($creation['doc_pieceid'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_cerfaM0'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_cerfaMBE'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_justificatifss'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_statuts'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_nomination'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_pouvoir'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_attestation'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_annonce'] !== ""){$pourc = $pourc + "7.69230769231";}if($creation['doc_depot'] !== ""){$pourc = $pourc + "7.69230769231";}if(substr($creation['frais'], -3) == "yes"){$pourc = $pourc + "7.69230769231";}if(substr($creation['depo_greffe'], -3) == "yes"){$pourc = $pourc + "7.69230769231";}if(substr($creation['depo_cfe'], -3) == "yes"){$pourc = $pourc + "7.69230769231";}} 
                                                                    if($linkview == "physique"){if($creation['doc_pieceid'] !== ""){$pourc = $pourc + "9.09090909090";}if($creation['doc_cerfaM0'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_xp'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_justificatifd'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_peirl'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_affectation'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_pouvoir'] !== ""){$pourc = $pourc + "9.09090909091";}if($creation['doc_attestation'] !== ""){$pourc = $pourc + "9.09090909091";}if(substr($creation['frais'], -3) == "yes"){$pourc = $pourc + "9.09090909091";}if(substr($creation['depo_greffe'], -3) == "yes"){$pourc = $pourc + "9.09090909091";}if(substr($creation['depo_cfe'], -3) == "yes"){$pourc = $pourc + "9.09090909091";}}
                                                ?>
                                                <li class="media <?php if($creation['notification_admin'] > "0"){echo "mail-read";}?>">
                                                    <div class="user-action">
                                                        <div class="checkbox-con mr-25">
                                                            <div class="checkbox checkbox-shadow checkbox-sm">
                                                                <input type="checkbox" id="checkboxsmall1">
                                                                <label for="checkboxsmall1"></label>
                                                            </div>
                                                        </div>
                                                        <span class="favorite">
                                                            <a href="php/favo_crea.php?num=<?= $creation['id'] ?>" class="<?php if($creation['favorite_crea'] == "1"){echo "favo favoh";}else{echo "nofavo nofavoh";} ?>"><i class="bx bx<?php if($creation['favorite_crea'] == "1"){echo "s";} ?>-star"></i></a>
                                                        </span>
                                                    </div>
                                                    <div class="pr-50">
                                                        <div class="avatar">
                                                            <a href="creation-view-<?php echo $linkview; ?>.php?num=<?= $creation['id'] ?>"><img src="../../../app-assets/images/ico/<?= $creation['img_crea'] ?>" alt="avtar img holder"></a>
                                                        </div>
                                                    </div>
                                                    <div class="media-body">
                                                        <div class="user-details">
                                                            <div class="mail-items">
                                                                <a href="creation-view-<?php echo $linkview;  ?>.php?num=<?= $creation['id'] ?>"><span class="list-group-item-text text-truncate line namecolor"><?= $creation['name_crea'] ?></span></a>
                                                            </div>
                                                            <div class="mail-meta-item">
                                                                <span class="float-right">
                                                                    <a href="creation-view-<?php echo $linkview;  ?>.php?num=<?= $creation['id'] ?>"><span class="mail-date"><?= $creation['date_crea'] ?> à <?= $creation['date_crea_h'] ?>:<?= $creation['date_crea_m'] ?></span></a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                        <div class="mail-message">
                                                            <a href="creation-view-<?php echo $linkview;  ?>.php?num=<?= $creation['id'] ?>"><p class="list-group-item-text truncate mb-0"><?php if($pourc >= 100){echo "Dossier de création validé ✔️";}else{echo "Dossier en cour de traitement ... ⏳";} ?></p></a>
                                                            <div class="mail-meta-item">
                                                                <span class="float-right">
                                                                    <span class="float-right d-flex align-items-center">
                                                                        <a href="creation-view-<?php echo $linkview;  ?>.php?num=<?= $creation['id'] ?>"><i class='bx bx-diamond' style="<?php if($creation['frais'] == "" || $creation['honoraire'] == ""){echo "display: none;";}else{$frais_ex = explode('!', $creation['frais']); $honoraire_ex = explode('!', $creation['honoraire']); if($frais_ex[1] == "no" || $honoraire_ex[1] == "no"){echo "display: none;";}} ?> position: relative; top: 5px; color: #00ffdc; font-size: 20px;"></i><i class='bx bxs-coin-stack'></i><i class="bx bx-paperclip mr-50" style="position: relative; top: 3px; color: <?php if($pourc > 0 && $pourc < 33){echo "#ff0000";} if($pourc > 33 && $pourc < 100){echo "#ffbd00";} if($pourc >= "100"){echo "#70ff00";} ?>;"></i><small style="color: #505050;"><?php if(strlen($pourc) > 5){echo substr($pourc, 0, 5);}else{echo $pourc;} ?>%</small>&nbsp&nbsp&nbsp</a>
                                                                        <?php 
                                                                        
                                                                            if($creation['status_crea'] == "SARL"){
                                                                                $bulletcolor = "success";
                                                                            }else{
                                                                                if($creation['status_crea'] == "SAS"){
                                                                                    $bulletcolor = "primary";
                                                                                }else{
                                                                                    if($creation['status_crea'] == "SASU"){
                                                                                        $bulletcolor = "warning";
                                                                                    }else{
                                                                                        if($creation['status_crea'] == "SCI"){
                                                                                            $bulletcolor = "danger";
                                                                                        }else{
                                                                                            if($creation['status_crea'] == "EIRL"){
                                                                                                $bulletcolor = "info";
                                                                                            }else{
                                                                                                if($creation['status_crea'] == "Micro-entreprise"){
                                                                                                    $bulletcolor = "black";
                                                                                                }else{
                                                                                                    if($creation['status_crea'] == "EI"){
                                                                                                    $bulletcolor = "light";
                                                                                                }
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                }
                                                                            }
                                                                        
                                                                        ?>
                                                                        <span class="bullet bullet-<?php echo $bulletcolor; ?> bullet-sm"></span></a>
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php endforeach; ?>                                            
                                        </ul>
                                        <!-- email user list end -->

                                        <!-- no result when nothing to show on list -->
                                        <div class="no-results">
                                            <i class="bx bx-error-circle font-large-2"></i>
                                            <h5>Aucune création en cour ...</h5>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--/ Email list Area -->
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
    <script src="../../../app-assets/js/scripts/pages/app-email.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>