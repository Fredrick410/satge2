<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    $pdoSta = $bdd->prepare('SELECT * FROM entreprise');
    $vrai = $pdoSta->execute();
    $entreprise = $pdoSta->fetchAll();

    $pdoStat = $bdd->prepare('SELECT * FROM acte');
    $pdoStat->execute();
    $modification = $pdoStat->fetchAll();

    if (isset($_POST["search"]))
    {
        $search = $_POST['search'];

        if($search !== ""){

            $search = htmlspecialchars($_POST['search']);
            $search = strip_tags($search);
            $search = strtolower($search);

            $requete = $bdd->prepare("SELECT id, nameentreprise, telentreprise, emailentreprise FROM entreprise WHERE nameentreprise LIKE ? OR telentreprise LIKE ? OR emailentreprise LIKE ?");
            $requete->execute(array(
                "%".$search."%", 
                "%".$search."%", 
                "%".$search."%"
            ));
            $reponse_req = $requete->fetchAll();
            $count_search = count($reponse_req);


            header('Location: acte-modification.php?search='.$search.'&8v7UV47whY='.$count_search.'&');
            exit();

        }else{

            $req = "OoOoUps ecrit quelque chose ;'(";

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
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Acte - Admin</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="layout">
<style>
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-info navbar-brand-center">
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
                            <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span></a>
                            <div class="dropdown-menu dropdown-menu pb-0">
                                <a class="dropdown-item" href="#"><i class="bx bx-user mr-50"></i> Editer Profile (SOON)</a>
                                <a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Déconnexion</a>
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
        <div class="content-wrapper text-center">
            <div class="form-group <?php if(!empty($_GET['search'])){echo "none-validation";} ?>">
                <!-- invoice list -->
                <section class="invoice-list-wrapper">
                    <div class="table-responsive">
                        <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th>Nom de l'entreprise</th>
                                    <th>Progression</th>
                                    <th>E-mail</th>
                                    <th>Date</th>
                                    <th>Key</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($modification as $modif): ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td><span class="invoice-amount"><?= $modif['name_entreprise'] ?></span></td>
                                    <td>
                                        <div class="progress progress-bar-<?php if($modif['progression'] >= 0 && $modif['progression'] <= 33){echo "danger";}elseif($modif['progression'] >= 34 && $modif['progression'] <= 66){echo "warning";}elseif($modif['progression'] >= 67 && $modif['progression'] <= 100){echo "success";} ?> mb-1 progress-sm">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="50" aria-valuemin="80" aria-valuemax="100" style="width:<?= $modif['progression'] ?>%;"></div>
                                        </div>
                                    </td>
                                    <td><span class="invoice-customer"><?= $modif['email_entreprise'] ?></span></td>
                                    <td>
                                        <small class="text-muted"><?= $modif['dte'] ?></small>
                                    </td>
                                    <td><span class="badge badge-light-info badge-pill"><?= $modif['code'] ?></span></td>
                                    <td>
                                        <div class="invoice-action">
                                            <a href="acte-modification-three-<?= $modif['forme'] ?>.php?num=<?= $modif['code'] ?><?= $modif['verif_one'] ?>" class="invoice-action-view mr-1">
                                                <i class="bx bx-show-alt"></i>
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
            <div class="form-group">
                <div id="plus" class="form-group <?php if(!empty($_GET['search'])){echo "none-validation";} ?>">
                    <small>Ajouter une modification</small>&nbsp&nbsp&nbsp&nbsp
                    <button styLe="position: relative; top: 6px;" class="btn btn-icon btn-light-info mr-1 mb-1" type="button" onclick="plus()">
                        <i class="bx bx-plus"></i>
                    </button>
                </div>
                <div id="minus" class="form-group  <?php if(empty($_GET['search'])){echo "none-validation";} ?>">
                    <small>Réduire l'onglet</small>&nbsp&nbsp&nbsp&nbsp
                    <button styLe="position: relative; top: 6px;" class="btn btn-icon btn-light-danger mr-1 mb-1" type="button" onclick="minus()">
                        <i class="bx bx-minus"></i>
                    </button>
                </div>
            </div>
            <div id="div_add" class="form-group <?php if(empty($_GET['search'])){echo "none-validation";} ?>">
                <span>Ou</span>
                <div class="content-header row">
                </div>
                <div class="content-body">
                    <div class="row">
                        <div class="col border-right text-center">
                            <div class="table-responsive">
                                <table class="table invoice-data-table dt-responsive nowrap" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Nom société</th>
                                            <th>Téléphone</th>
                                            <th>E-mail</th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($entreprise as $entreprises): ?>
                                            <tr class="<?php if(!empty($_GET['search'])){echo "none-validation";} ?>">
                                                <td></td>
                                                <td class="text-bold-500"><?= $entreprises['nameentreprise'] ?></td>
                                                <td><?= $entreprises['telentreprise'] ?></td>
                                                <td class="text-bold-500"><?= $entreprises['emailentreprise'] ?></td>
                                                <td><a href="php/insert_acte.php?name_entreprise=<?= $entreprises['nameentreprise'] ?>&tel_entreprise=<?= $entreprises['telentreprise'] ?>&email_entreprise=<?= $entreprises['emailentreprise'] ?>&num=<?= $entreprises['id'] ?>"><i class='bx bx-right-arrow-circle' style="font-size: 25px;"></i></a></td>
                                            </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group text-center">
                                <span>Nouvelle Société</span>
                            </div>
                            <form method="POST" action="php/insert_acte.php">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <fieldset class="form-group text-center">
                                                <label for="basicInput">*Nom de la socété</label>
                                                <input type="text" name="name_entreprise" class="form-control" id="basicInput" placeholder="Nom de la société" required>
                                            </fieldset>   
                                        </div>
                                        <div class="col">
                                            <fieldset class="form-group text-center">
                                                <label for="basicInput">*Téléphone</label>
                                                <input type="number" name="tel_entreprise" class="form-control" id="basicInput" placeholder="0600000000" required>
                                            </fieldset>               
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <fieldset class="form-group text-center">
                                        <input type="email" name="email_entreprise" class="form-control text-center" id="basicInput" placeholder="Entrez un e-mail">
                                    </fieldset>                            
                                </div>
                                <div class="form-group">
                                    <div class="form-group">
                                        <button type="submit" class="btn mb-1 btn-outline-success btn-lg btn-block">Enregistrer</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->
    <footer class="footer footer-static footer-dark">
    </footer>
    <!-- END: Footer-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.bootstrap4.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <!-- END: Page JS-->
    <script>
        function plus(){
            document.getElementById('div_add').style.display = "block";
            document.getElementById('plus').style.display = "none";
            document.getElementById('minus').style.display = "inline";
        }
        
        function minus(){
            document.getElementById('div_add').style.display = "none";
            document.getElementById('plus').style.display = "inline";
            document.getElementById('minus').style.display = "none";
        }
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
</body>
<!-- END: Body-->

</html>