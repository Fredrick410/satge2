<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'juriste');
require_once 'php/verif_session_connect_admin.php';

$SQL2 = $bdd->prepare('SELECT * FROM crea_societe WHERE doc_domiciliation NOT LIKE ""');
$SQL2->execute();
$list_doc = $SQL2->fetchAll();

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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation_Btn_Chat.css">
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
                            <div class="sidebar-menu-list" >
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
                                                    <input type="text" class="form-control" id="conv-search" placeholder="Rechercher une conversation">
                                                    <div class="form-control-position">
                                                        <i class="bx bx-search"></i>
                                                    </div>
                                                </fieldset>
                                            </div>
                                            <!-- pagination and page count -->
                                        </div>
                                    </div>
                                    <!-- / action right -->
                                    <div class="row" >
                                    <!-- email user list start -->
                                    <script>
                                                var compte=new Array();
                                    </script>
                                        <div class="email-user-list col-4" style="overflow-y:scroll;" id="list-users">
                                            <ul class="users-list-wrapper media-list" id="list">
                                               
                                                <?php 
                                                $j=0;
                                                foreach($list_doc as $doc): 
                                                    
                                                    $r_valeur = Array();
                                                ?>
                                                             
                                                    <li class="media rounded" id='<?= $doc['id']?>' style=''>
                                                        <div class="media-body">
                                                            <div class="user-details">
                                                                <div class="mail-items">
                                                                    <div class="avatar mr-75">
                                                                        <img src="../../../app-assets/images/ico/<?=$doc['img_crea']?>" alt="avtar images" width="32" height="32" class="rounded-circle">
                                                                    </div>
                                                                    <a><span class="list-group-item-text text-truncate line namecolor" ><?= $doc['name_crea'] ?></span></a>
                                                                    <input type="hidden" name="entreprise" id="entreprise" value="<?= $doc['status_crea'] ?>">
                                                                    <input type="hidden" name="img" id="img" value="<?= $doc['img_crea'] ?>">
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
                                                <h5>Aucun message</h5>
                                            </div>
                                        </div>
                                        <!-- Début conversation -->
                                        <div class="col-8">
                                            <div class="card-header border-bottom p-0">
                                                <div class="media m-75">
                                                    <a href="JavaScript:void(0);">
                                                        <div class="avatar mr-75" id="avatar">
                                                            <img src="../../../app-assets/images/ico/crea.png" alt="avtar images" width="32" height="32" class="rounded-circle">
                                                            
                                                        </div>
                                                    </a>
                                                    <div class="media-body" id="profil">
                                                        <h6 class="media-heading mb-0 pt-25"><a></a></h6>
                                                        <span id="corp" class="text-muted font-small-3"></span>
                                                        <span id="badge" class=""></span>
                                                    </div>
                                                </div>
                                            </div>

                                                <embed src=../../../src/crea_societe/domiciliation/<?= $doc['doc_domiciliation'] ?> width=100% height=85% type='application/pdf'/>
                                                                                     

                                            
                                        </div>
                                    </div>
                                    <!-- FIN conversation -->
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
    <script src="../../../app-assets/js/scripts/pages/get_conv.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_crea.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-email.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>