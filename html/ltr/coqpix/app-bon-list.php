<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
// include 'php/verif_session_connect.php';
require_once 'php/config.php';

    $pdoStat = $bdd->prepare('SELECT * FROM bon WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']);
    $pdoStat->execute();
    $bon = $pdoStat->fetchAll();

    $pdoStatr = $bdd->prepare('SELECT * FROM bon WHERE id_session = :num');
    $pdoStatr->bindValue(':num',$_SESSION['id_session']);
    $pdoStatr->execute();
    $facturer = $pdoStatr->fetch();
    $numeros = $facturer['numerosbon'];

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id_session']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();

    $pdoStatr = $bdd->prepare('SELECT refbon,numerosbon FROM bon WHERE id_session = :num');
    $pdoStatr->bindValue(':num',$_SESSION['id_session']);
    $pdoStatr->execute();
    $fu = $pdoStatr->fetch();
    $nom = $fu['refbon'];
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
    <title>Liste bon</title>
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
                    <div class="row">
                        <?php
                            if(isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') $url = "https://"; else $url = "http://";$url .= $_SERVER['HTTP_HOST'];$url .= $_SERVER['REQUEST_URI'];
                        ?>
                        <div class="col">
                            <div class="invoice-create-btn mb-1">
                                <a href="app-bon-add.php?jXN955CbHqqbQ463u5Uq=<?php if($entreprise['incrementation'] == "yes"){echo "1";}else{echo "1";} ?>" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"><i class="bx bx-plus"></i>Créer un bon</a>
                            </div>
                        </div>

                    </div>

                    <!-- Options and filter dropdown button-->
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
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>
                                       Numéro bon
                                    </th>
                                    <th>
                                        <span class="align-middle">Référence</span>
                                    </th>
                                    <th>Valeur</th>
                                    <th>Date</th>
                                    <th>Client</th>
                                    <th>Etiquette</th>
                                    <th>Statut</th>
                                    <th>Action</th>

                                </tr>
                            </thead>
                            <tbody>

                            <!-- Afficher les prix  -->
                            <?php foreach ($bon as $bons):
                                $ref = $bons['numerosbon'];
                                $numeros = $bons['id'];
                                try{

                                $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE numeros=:numeros AND typ='bonvente' ) T";

                                $req = $bdd->prepare($sql);
                                $req->bindValue(':numeros',$numeros, PDO::PARAM_INT);
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
                                    <!-- affichage dans le tableau des données -->
                                    <td>BON-<?= $bons['id'] ?></td>
                                    <td>
                                    <!-- pour voir le bon  -->
                                        <a href="app-bon-view.php?numbon=<?= $bons['id'] ?>"><?= $bons['refbon'],$ref ?></a>
                                    </td>
                                    <td><span class="invoice-amount">&nbsp&nbsp<?= $montant_t; ?> <?= $bons['monnaie'] ?></span></td>
                                    <td><small class="text-muted"><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($bons['dte'])); ?></small></td>
                                    <td><span class="invoice-customer"><?= $bons['bonpour'] ?></span></td>
                                    <td>
                                        <span class="bullet bullet-success bullet-sm"></span>
                                        <small class="text-muted"><?= $bons['etiquette'] ?></small>
                                    </td>
                                    <!-- paye en vert non paye en rouge -->
                                    <td><span class="<?= $bons['status_color'] ?>"><?= $bons['status_bon'] ?></span></td>
                                    <td>
                                        <div class="invoice-action"><br>
                                            <a href="app-bon-view.php?numbon=<?= $bons['id'] ?>" class="invoice-action-view mr-1">
                                                <i class="bx bx-show-alt"></i>
                                            </a>
                                            <!-- pour edit le bon -->
                                            <a href="app-bon-edit.php?numbon=<?= $bons['id'] ?>" class="invoice-action-edit cursor-pointer">
                                                <i class="bx bx-edit"></i>
                                            </a>&nbsp&nbsp&nbsp&nbsp<br>
                                            <!-- <a href="php/envoie_dev.php?id=<?= $bons['id'] ?>"
                                            class="invoice-action-edit cursor-pointer">
                                                <i class='bx bxs-send'></i>
                                            </a>&nbsp&nbsp&nbsp&nbsp -->
                                            <!-- pour delete -->
                                            <a href="php/delete_bon.php?numbon=<?= $bons['numerosbon'] ?>&id=<?= $bons['id'] ?>" class="invoice-action-view mr-1">
                                                <i class='bx bxs-trash'></i>
                                            </a>
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
