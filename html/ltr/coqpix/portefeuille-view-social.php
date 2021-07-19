<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire social');
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille_social WHERE id=:num ');
    $pdoSta->bindValue('num', $_GET['num']);
    $pdoSta->execute();
    $portefeuille_social = $pdoSta->fetch();

    $pdoSta = $bdd->prepare('SELECT * FROM prelevement_social WHERE id_session=:num');
    $pdoSta->bindValue('num', $_GET['num']);
    $pdoSta->execute();
    $prelevement_social = $pdoSta->fetchAll();
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
    <title>Portefeuille client</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/validation/form-validation.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .none-validation{display: none;}
    .icon_main{font-size: 20px; cursor: pointer;}
    .icon_main:hover{opacity: 0.5;}
    .icon_check{margin-right: 30px; color: green;}
    .icon_no{color: red;}
    .icon_trash{color: grey;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #3c91d5;">
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
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-body">
                <!-- account setting page start -->
                <section id="page-account-settings">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <!-- left menu section -->
                                <div class="col-md-3 mb-2 mb-md-0 pills-stacked">
                                    <ul class="nav nav-pills flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center active" id="account-pill-general" data-toggle="pill" href="#account-vertical-general" aria-expanded="true">
                                                <i class="bx bx-cog"></i>
                                                <span>General</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link d-flex align-items-center" id="account-pill-password" data-toggle="pill" href="#account-vertical-password" aria-expanded="false">
                                                <i class='bx bxs-file-blank' ></i>
                                                <span>Document</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- right content section -->
                                <div class="col-md-9">
                                    <div class="card">
                                        <div class="card-content">
                                            <div class="card-body">
                                                <div class="tab-content">
                                                    <div role="tabpanel" class="tab-pane active" id="account-vertical-general" aria-labelledby="account-pill-general" aria-expanded="true">
                                                        <form action="php/edit_portefeuille_social.php?num=<?= $portefeuille_social['id'] ?>&for=first" method="POST">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>*Nom de la société</label>
                                                                            <input name="name_entreprise" type="text" class="form-control" placeholder="Nom de la société" value="<?= $portefeuille_social['name_entreprise'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>*Nom du dirigeant</label>
                                                                            <input name="nom_diri" type="text" class="form-control" placeholder="Nom du dirigeant" value="<?= $portefeuille_social['nom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>*Prenom du dirigeant</label>
                                                                            <input name="prenom_diri" type="text" class="form-control" placeholder="Prenom du dirigeant" value="<?= $portefeuille_social['prenom_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>*Numéros du dirigeant</label>
                                                                            <input name="tel_diri" type="number" class="form-control" placeholder="Numéros du dirigeant" value="<?= $portefeuille_social['tel_diri'] ?>" required>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12">
                                                                    <div class="form-group">
                                                                        <div class="controls">
                                                                            <label>E-mail</label>
                                                                            <input name="email_diri" type="email" class="form-control" placeholder="Email du dirigeant" value="<?= $portefeuille_social['email_diri'] ?>">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end">
                                                                    <button type="submit" class="btn btn-primary glow mr-sm-1 mb-1">Sauvegarder</button>
                                                                    <a href="portefeuille-social.php"><button type="button" class="btn btn-light mb-1">Annuler</button></a>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                    <div class="tab-pane fade " id="account-vertical-password" role="tabpanel" aria-labelledby="account-pill-password" aria-expanded="false">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col-md-3 col-6 <?php if($portefeuille_social['rib'] == "no"){echo "none-validation";} ?>">
                                                                    <div class="form-group">
                                                                        <h5>RIB</h5>
                                                                    </div>
                                                                    <div class="card border shadow-none mb-1 app-file-inf">
                                                                        <div class="card-content">
                                                                            <div class="app-file-content-logo card-img-top">
                                                                                <div class="row">
                                                                                    <div class="col">&nbsp&nbsp&nbsp<a href="../../../src/portefeuille/rib/<?= $portefeuille_social['rib'] ?>" target="_blank"><i class="bx bxs-note app-file-edit-icon d-block float-right"></i></a><a href="../../../src/portefeuille/rib/<?= $portefeuille_social['rib'] ?>" download><i class="bx bx-download app-file-edit-icon d-block float-right"></i></a></div>
                                                                                </div>   
                                                                                <br>
                                                                                <br>

                                                                                <?php 
                                                                                
                                                                                $type_doc = 'doc.png';
                                                                                
                                                                                ?>

                                                                                <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type_doc ?>" height="38" width="30" alt="Card image cap">
                                                                            </div>
                                                                            <div class="card-body p-50">
                                                                                <div class="app-file-recent-details">
                                                                                    <div class="app-file-name font-size-small font-weight-bold"><?= $portefeuille_social['rib'] ?></div>
                                                                                    <div class="app-file-last-access font-size-small text-muted">Rib</div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>         
                                                                </div>
                                                                <div class="form-group text-center <?php if($portefeuille_social['rib'] !== "no"){echo "none-validation";} ?>">
                                                                    <p class="text-center" style="padding-left: 100px;">Aucun RIB ...</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <br>
                                                        <br>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <h6>Effectuer un prélévement (<small>Enregister les prélévements de vos clients et gérer les paiements</small>)</h5>
                                                        </div>
                                                        <div class="form-group">
                                                            <form action="php/insert_prelevement_social.php?num=<?= $_GET['num'] ?>" method="POST">
                                                                <div class="row">
                                                                    <div class="col">
                                                                        <div class="controls">
                                                                            <label>Prelevement en €</label>
                                                                            <input name="montant" type="number" class="form-control" placeholder="Prelevement en €" value="" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <div class="controls">
                                                                            <label>Description</label>
                                                                            <input name="name_prelevement" type="text" class="form-control" placeholder="Ex: Dsn, attestation sociale" value="">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select name="date_m" class="select2 form-control" style="margin-top: 22px;">
                                                                            <optgroup></optgroup>
                                                                            <option value="01" <?php if(date('m') == "01"){echo "selected";} ?>>01 (Janvier)</option>
                                                                            <option value="02" <?php if(date('m') == "02"){echo "selected";} ?>>02 (Fevrier)</option>
                                                                            <option value="03" <?php if(date('m') == "03"){echo "selected";} ?>>03 (Mars)</option>
                                                                            <option value="04" <?php if(date('m') == "04"){echo "selected";} ?>>04  (Avril)</option>
                                                                            <option value="05" <?php if(date('m') == "05"){echo "selected";} ?>>05  (Mai)</option>
                                                                            <option value="06" <?php if(date('m') == "06"){echo "selected";} ?>>06  (Juin)</option>
                                                                            <option value="07" <?php if(date('m') == "07"){echo "selected";} ?>>07  (Juillet)</option>
                                                                            <option value="08" <?php if(date('m') == "08"){echo "selected";} ?>>08  (Aout)</option>
                                                                            <option value="09" <?php if(date('m') == "09"){echo "selected";} ?>>09  (Septembre)</option>
                                                                            <option value="10" <?php if(date('m') == "10"){echo "selected";} ?>>10  (Octobre)</option>
                                                                            <option value="11" <?php if(date('m') == "11"){echo "selected";} ?>>11  (Novembre)</option>
                                                                            <option value="12" <?php if(date('m') == "12"){echo "selected";} ?>>12  (Décembre)</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select name="date_a" class="select2 form-control" style="margin-top: 22px;">
                                                                            <optgroup></optgroup>
                                                                            <option value="2019" <?php if(date('Y') == "2019"){echo "selected";} ?>>2019</option>
                                                                            <option value="2020" <?php if(date('Y') == "2020"){echo "selected";} ?>>2020</option>
                                                                            <option value="2021" <?php if(date('Y') == "2021"){echo "selected";} ?>>2021</option>
                                                                            <option value="2022" <?php if(date('Y') == "2022"){echo "selected";} ?>>2022</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <select name="statut" class="select2 form-control" style="margin-top: 22px;">
                                                                            <optgroup></optgroup>
                                                                            <option value="En cours" selected>En cours</option>
                                                                            <option value="Payé">Payé</option>
                                                                            <option value="Rejeté">Rejeté</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="col">
                                                                        <button type="submit" class="btn btn-outline-info mr-1 mb-1" style="margin-top: 22px;">Ajouter un prélèvement</button>
                                                                    </div>
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group">
                                                                        <label style="margin-left: 15px;">Date du prélèvement</label>
                                                                        <fieldset class="form-group position-relative has-icon-left" style="margin-left: 15px;">
                                                                            <input name="dte_prelevement" type="text" class="form-control pickadate" placeholder="Selectionner une date">
                                                                            <div class="form-control-position">
                                                                                <i class='bx bx-calendar'></i>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <section id="column-selectors">
                                                            <div class="row">
                                                                <div class="col-12">
                                                                    <div class="card">
                                                                        <div class="card-content">
                                                                            <div class="card-body card-dashboard">
                                                                                <div class="table-responsive">
                                                                                    <table class="table table-striped dataex-html5-selectors">
                                                                                        <thead>
                                                                                            <tr>
                                                                                                <th>Description</th>
                                                                                                <th>Montant</th>
                                                                                                <th>Date du prélèvement</th>
                                                                                                <th>Prélèvement du</th>
                                                                                                <th>Statut</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </thead>
                                                                                        <tbody>
                                                                                            <?php foreach($prelevement_social as $prelevements): ?>
                                                                                                <tr class="table-<?php if($prelevements['statut'] == "En cours"){echo "warning";}elseif($prelevements['statut'] == "Payé"){echo "success";}elseif($prelevements['statut'] == "rejeté"){echo "danger";} ?>">
                                                                                                    <td><?= $prelevements['name_prelevement'] ?></td>
                                                                                                    <td><?= $prelevements['montant'] ?> €</td>
                                                                                                    <td><?= utf8_encode(strftime("%d/%m/%Y", strtotime($prelevements['dte']))); ?></td>
                                                                                                    <td><?= $prelevements['dte_m'] ?>/<?= $prelevements['dte_a'] ?></td>
                                                                                                    <td><span class="badge badge-<?php if($prelevements['statut'] == "En cours"){echo "warning";}elseif($prelevements['statut'] == "Payé"){echo "success";}elseif($prelevements['statut'] == "rejeté"){echo "danger";} ?>"><?= $prelevements['statut'] ?></span></td>
                                                                                                    <td class="text-center"><a href='php/change_prelevement_social.php?KgUf2Ua274=<?= $_GET['num'] ?>&num=<?= $prelevements['id'] ?>&type=payé'><i class='bx bx-check-circle icon_main icon_check <?php if($prelevements['statut'] == "Payé"){echo "none-validation";} ?>'></i></a>  <a href='php/change_prelevement_social.php?KgUf2Ua274=<?= $_GET['num'] ?>&num=<?= $prelevements['id'] ?>&type=rejeté'><i class='bx bxs-no-entry icon_main icon_no <?php if($prelevements['statut'] == "Payé" || $prelevements['statut'] == "rejeté"){echo "none-validation";} ?>'></i></a>  <a href='php/change_prelevement_social.php?KgUf2Ua274=<?= $_GET['num'] ?>&num=<?= $prelevements['id'] ?>&type=trash'><i class='bx bx-trash icon_main icon_trash <?php if($prelevements['statut'] == "En cours" || $prelevements['statut'] == "rejeté"){echo "none-validation";} ?>'></i></a> </td>
                                                                                                </tr>
                                                                                            <?php endforeach; ?>
                                                                                        </tbody>
                                                                                        <tfoot>
                                                                                            <tr>
                                                                                                <th>Description</th>
                                                                                                <th>Montant</th>
                                                                                                <th>Date</th>
                                                                                                <th>Statut</th>
                                                                                                <th>Action</th>
                                                                                            </tr>
                                                                                        </tfoot>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- account setting page ends -->
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.buttons.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.html5.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.print.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/buttons.bootstrap.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/pdfmake.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/vfs_fonts.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-account-settings.js"></script>
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <script src="../../../app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>