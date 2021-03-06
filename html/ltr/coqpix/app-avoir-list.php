<?php 
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/permissions_front.php';

    if (permissions()['ventes'] < 1) {
        header('Location: dashboard-analytics.php');
        exit();
    }

    $pdoStat = $bdd->prepare('SELECT * FROM avoir WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']);
    $pdoStat->execute();
    $facture = $pdoStat->fetchAll();

    $pdoStatr = $bdd->prepare('SELECT * FROM avoir WHERE id_session = :num');
    $pdoStatr->bindValue(':num',$_SESSION['id_session']);
    $pdoStatr->execute();
    $facturer = $pdoStatr->fetch();
    $numeros = $facturer['numerosavoir'];

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id_session']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Liste Avoirs</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
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

    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
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
                <!-- invoice list -->
                <section class="invoice-list-wrapper">
                    <!-- create invoice button-->
                    <div class="row mt-2">
                        <?php
                            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://"; else $url = "http://";$url .= $_SERVER['HTTP_HOST'];$url .= $_SERVER['REQUEST_URI'];
                        ?>
                        <?php // Permission de niveau 2 pour créer une facture et activer le mode auto-incrémentation
                        if (permissions()['ventes'] >= 2) { ?>
                            <div class="colr">
                                <div class="invoice-create-btn">
                                    <a href="app-avoir-list-invoice.php" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"><i class="bx bx-plus"></i>Créer un avoir</a>
                                </div>
                            </div>
                            <div class="col text-right">
                                <div class="invoice-create-btn">
                                    <p>Mode auto-incrementation : <label style="color: <?php if($entreprise['incrementation'] == "yes"){echo "green";}else{echo "red";} ?>;"><?php if($entreprise['incrementation'] == "yes"){echo "ON";}else{echo "OFF";} ?></label><br>
                                    Auto-incrementation sous la forme FAC-(année)(numéro)<br>
                                    <a class="<?php if($entreprise['incrementation'] == "no"){echo "none-validation";} ?>" style='color: red;' href="php/change_incrementation.php?url=<?= $url ?>&type=<?= $entreprise['incrementation'] ?>">> Désactiver le mode</a>
                                    <a class="<?php if($entreprise['incrementation'] == "yes"){echo "none-validation";} ?>" style='color: green;' href="php/change_incrementation.php?url=<?= $url ?>&type=<?= $entreprise['incrementation'] ?>">> Activer le mode</a>
                                    </p>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- Options and filter dropdown button-->
                    <?php // Permission de niveau 3 pour supprimer un avoir
                    if (permissions()['ventes'] >= 3) { ?>
                        <div class="action-dropdown-btn d-none">
                            <div class="dropdown invoice-options">
                                <button class="btn border dropdown-toggle mr-2" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    Options
                                </button>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                    <a class="dropdown-item" href="#">Supprimer</a>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>
                                        <span class="align-middle">Numéro</span>
                                    </th>
                                    <th>Valeur</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Etiquette</th>
                                    <th>Statut</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($facture as $factures):
                            $numeros = $factures['numerosavoir'];
                                try{
  
                                $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='avoirvente' ) T ";
  
                                $req = $bdd->prepare($sql);
                                $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
                                $req->bindValue(':numeros',$numeros); 
                                $req->execute();
                                $res = $req->fetch();
                                }catch(Exception $e){
                                    echo "Erreur " . $e->getMessage();
                                }

                                $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;

                            ?>
                                <tr>
                                    <td></td>
                                    
                                    <td></td>
                                    <td>
                                        <a href="app-avoir-view.php?numavoir=<?= $factures['id'] ?>">AV-<?= $factures['numerosavoir'] ?></a>
                                    </td>
                                    <td><span class="invoice-amount"><?= $montant_t; ?> <?= $factures['monnaie'] ?></span></td>
                                    <td><small class="text-muted"><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($factures['dte'])); ?></small></td>
                                    <td><span class="invoice-customer"><?= $factures['avoirpour'] ?></span></td>
                                    <td>
                                        <span class="bullet bullet-success bullet-sm"></span>
                                        <small class="text-muted"><?= $factures['etiquette'] ?></small>
                                    </td>
                                    <td><span class="<?= $factures['status_color'] ?>"><?= $factures['status_avoir'] ?></span></td>
                                    <td>
                                        <div class="invoice-action">
                                            <?php // Permission de niveau 1 pour visualiser un avoir
                                            if (permissions()['ventes'] >= 1) { ?>
                                                <a href="app-avoir-view.php?numavoir=<?= $factures['id'] ?>" class="invoice-action-view">
                                                    <i class="bx bx-show-alt"></i>
                                                </a>
                                            <?php } // Permission de niveau 3 pour supprimer un avoir
                                            if (permissions()['ventes'] >= 3) { ?>
                                                <a href="php/delete_avoir.php?numavoir=<?= $factures['numerosavoir'] ?>&id=<?= $factures['id'] ?>" class="invoice-action-view mr-1">
                                                    <i class='bx bxs-trash'></i>
                                                </a>
                                            <?php } ?>                                
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>
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
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
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
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>