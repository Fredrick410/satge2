<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
// include 'php/verif_session_connect.php';
require_once 'php/config.php';

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id_session']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM fournisseur WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']);
    $pdoSt->execute();
    $fournisseur = $pdoSt->fetch();

    $pdoSttr = $bdd->prepare('SELECT * FROM bon_commande INNER JOIN fournisseur ON fournisseur.id = bon_commande.numerosfournisseur WHERE bon_commande.id_session = :num and bon_commande.commande = "Commande en cours de traitement" or bon_commande.commande = "Commande refusé"');
    $pdoSttr->bindValue(':num',$_SESSION['id_session']);
    $pdoSttr->execute();
    $bons_four = $pdoSttr->fetchAll();

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
    <title>Liste Bulletin de Commande</title>
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
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
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
                                <a href="app-bon-achat-add.php?jXN955CbHqqbQ463u5Uq=<?php if($entreprise['incrementation'] == "yes"){echo "Rt82u";}else{echo "y44vJ";} ?>" class="btn btn-primary glow invoice-create" role="button" aria-pressed="true"><i class="bx bx-plus"></i>Créer un bon de commande</a>
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
                                    <th><span class="align-middle">Numéro Bon</span></th>
                                    <th>Valeur</th>
                                    <th>Date</th>
                                    <th>Fournisseur</th>
                                    <th>Article</th>
                                    <th>Quantité</th>
                                    <th title="Article commandé :
En cours de traitement
Commande Validé/Livraison en cours
Commande annulé"                    >Commandé</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($bons_four as $bons):
                                $numeros = $bons['id_bon_commande'];

                                try{
                                    // Somme du prix HT
                                $sql = "SELECT SUM(ROUND(T.TOTAL, 2)) as MONTANT_T FROM (SELECT cout * quantite as TOTAL FROM articles WHERE numeros=:numeros AND typ='bonachat') T";

                                $req = $bdd->prepare($sql);
                                $req->bindValue(':numeros',$numeros, PDO::PARAM_INT);
                                $req->execute();
                                $res = $req->fetch();
                                }catch(Exception $e){
                                    echo "Erreur " . $e->getMessage();
                                }

                                $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;

                                $count = "SELECT COUNT(article) as countarticle FROM articles WHERE numeros=(SELECT id_bon_commande FROM bon_commande WHERE id_bon_commande=:numeros)";

                                $reqss = $bdd->prepare($count);
                                $reqss->bindValue(':numeros',$numeros, PDO::PARAM_INT);
                                $reqss->execute();
                                $resqq = $reqss->fetch();
                            ?>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        <a href="app-bon-achat-view.php?numbon=<?= $bons['id_bon_commande'] ?>&numfournisseur=<?= $bons['id'] ?>">BC-<?= $bons['id_bon_commande'] ?></a>
                                    </td>
                                    <td><?= $montant_t; ?> <?= $bons['monnaie'] ?></td>
                                    <td><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d/%m/%Y", strtotime($bons['dte'])); ?></td>
                                    <td><a href="fournisseur-edit.php?numfour=<?= $bons['numerosfournisseur'] ?>"><?= $bons['name_fournisseur'] ?></a></td>
                                    <td title="Article commandé - Nombre total d'articles">
                                      Nombres d'articles:
                                      <?= $resqq['countarticle'] ?><!-- indiquer le nb d'article present dans la commande -->
                                      </br>
                                      <?php
                                      $pdo = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num AND numeros=:numeros AND typ="bonachat"');
                                      $pdo->bindValue(':num',$_SESSION['id_session']);
                                      $pdo->bindValue(':numeros',$numeros);
                                      $pdo->execute();
                                      $articles = $pdo->fetchAll();?>
                                      <!-- afficher seulement les 2 premiers articles puis mettre des "..." s'il y a plus d'articles -->
                                      <table>
                                        <?php
                                        if (count($articles)<=2) {
                                          foreach($articles as $articless): ?>
                                            <tr>
                                              <td><?= $articless['article']; ?></td>
                                            </tr>
                                          <?php endforeach;
                                        }else {
                                          for ($i=0; $i < 2; $i++) {?>
                                            <tr>
                                              <td><?= $articles[$i]['article']; ?></td>
                                            </tr>
                                        <?php  } ?>
                                          <tr>
                                            <td>...</td>
                                          </tr>
                                        <?php  } ?>
                                      </table>
                                    </td>
                                  <td>
                                    <!-- afficher la quantite qui correspond a chaque article -->
                                    <table>
                                      <?php
                                      if (count($articles)<=2) {
                                        foreach($articles as $articless): ?>
                                          <tr>
                                            <td><?= $articless['quantite']; ?></td>
                                          </tr>
                                        <?php endforeach;
                                      }else {
                                        for ($i=0; $i < 2; $i++) {?>
                                          <tr>
                                            <td><?= $articles[$i]['quantite']; ?></td>
                                          </tr>
                                      <?php  } ?>
                                        <tr>
                                          <td>...</td>
                                        </tr>
                                      <?php  } ?>
                                    </table>
                                  </td>
                                    <td><?php //status de la commande pour CSS
                                    if($bons['commande']=='Commande en cours de traitement'){
                                      $stts ='badge badge-light-warning badge-pill';
                                    }elseif ($bons['commande']=='Commande refusé') {
                                      $stts ='badge badge-light-danger badge-pill';
                                    }?>
                                    <span class="<?= $stts ?>"><?= $bons['commande'] ?></span></td>
                                    <td>
                                        <div class="invoice-action"><br>
                                            <a href="app-bon-achat-view.php?numbon=<?= $bons['id_bon_commande'] ?>&numfournisseur=<?= $bons['id'] ?>" class="invoice-action-view mr-1" title="Voir le bon de commande">
                                                <i class="bx bx-show-alt"></i>
                                            </a>
                                            <a href="app-bon-achat-edit.php?numbon=<?= $bons['id_bon_commande'] ?>&numfournisseur=<?= $bons['id'] ?>" class="invoice-action-edit cursor-pointer" title="Editer le bon de commande">
                                                <i class="bx bx-edit"></i>
                                            </a>&nbsp&nbsp&nbsp&nbsp
                                            <a href="php/delete_bon_achat.php?numbon=<?= $bons['numerosbon'] ?>&id=<?= $bons['id_bon_commande'] ?>" class="invoice-action-view mr-1" title="Supprimer le bon de commande">
                                                <i class='bx bxs-trash'></i>
                                            </a>
                                            <?php /*boutton à afficher seulement si on a les permissions */
                                            $q = $bdd -> prepare('SELECT * from admin where perm_comptable = 1 and id = :id');
                                            $q ->bindValue('id',$_SESSION['id_session']);
                                            $q -> execute();
                                            $auth = $q->fetch();
                                            if (isset($auth) and !empty($auth) and $bons['commande'] === "Commande en cours de traitement"): ?>
                                              <!-- valider le bon -->
                                              <a href="php/validate_bon_achat.php?id=<?= $bons['id_bon_commande'] ?>&typ=confirm" class="invoice-action-view mr-1" title="Valider le bon de commande">
                                                  <i class='bx bxs-check-circle'></i>
                                              </a>
                                              <!-- refuser le bon -->
                                              <a href="php/refute_bon_achat.php?id=<?= $bons['id_bon_commande'] ?>" class="invoice-action-view mr-1" title="Annuler le bon de commande">
                                                  <i class='bx bxs-x-circle'></i>
                                              </a>
                                            <?php endif; ?>
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
