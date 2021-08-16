<?php 

require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/permissions_front.php';

    if (permissions()['clients'] < 2) {
        header('Location: article-list.php');
        exit();
    }

    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

    $pdoStatt = $bdd->prepare('SELECT * FROM article WHERE id_article = :num');
    $pdoStatt->bindValue(':num',$_GET['numarticle']);
    $true = $pdoStatt->execute();
    $article = $pdoStatt->fetch();

    $pdoStast = $bdd->prepare('SELECT * FROM fournisseur WHERE id_session = :num');
    $pdoStast->bindValue(':num',$_SESSION['id_session']);
    $pdoStast->execute();
    $fournisseur = $pdoStast->fetchAll();

    $pdoStt = $bdd->prepare('SELECT * FROM fournisseur WHERE id = :num');
    $pdoStt->bindValue(':num',$_GET['numfournisseur']);
    $pdoStt->execute(); 
    $fournisseurt2 = $pdoStt->fetch();

    $pdoSttr = $bdd->prepare('SELECT * FROM article INNER JOIN fournisseur ON fournisseur.id = article.id_fournisseur WHERE article.id_session = :num');
    $pdoSttr->bindValue(':num',$_SESSION['id_session']);
    $pdoSttr->execute();
    $articlee = $pdoSttr->fetchAll();
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
    <title>Editer article</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
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






    <br><br><br><br><br>
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
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="h-auto card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class='bx bxs-purchase-tag-alt'></i><span class="d-none d-sm-block">Modifier un article</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">

                                        <!-- users edit media object start -->


                                        <!-- <form action="php/insert_image_edit.php" method="POST" enctype="multipart/form-data">
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img src="../../../src/img/<?= $entreprisee['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Image du fournisseur</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <input type="file" name="FILES" accept="image/png, image/jpg, image/jpeg" required>                                                   
                                                </div><br>
                                                <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
                                            </div>
                                        </div>
                                        </form> -->


                                        <!-- users edit media object ends -->



                                        <!-- users edit account form start -->
                            <form action="php/edit_article.php" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="id_article" value="<?= $article['id_article'] ?>">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Désignation :</label>
                                                            <input name="article" type="text" class="form-control" placeholder="Désignation de l'article" value="<?= $article['article'] ?>" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Référence de l'article :</label>
                                                        <input name="referencearticle" type="text" class="form-control" placeholder="Référence de l'article" value="<?= $article['referencearticle'] ?>">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <br>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                        <input type="file" id="file" name="img" style="display:none"/>
                                                        <a onclick="file.click()" class="btn btn-outline-primary">Modifier l'image</a>
                                                            <img src="../../../app-assets/images/article/<?= $article['img']; ?>" alt="" width="150">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Unités de mesure :</label>
                                                            <input name="umesure" type="text" class="form-control" placeholder="Unités de mesure" value="<?= $article['umesure'] ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                 <hr><style>.line{text-decoration: underline;}</style>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>Fournisseur</label>
                                                        <select name="id_fournisseur" id="fournisseur" class="form-control invoice-item-select">
                                                            <option value="<?= $fournisseurt2['id'] ?>"><?= $fournisseurt2['name_fournisseur'] ?></option>
                                                            <optgroup label="--------------------------------">
                                                            <optgroup label="Liste des fournisseurs">
                                                            <?php foreach($fournisseur as $fournisseurt): ?>
                                                                <option value="<?= $fournisseurt['id'] ?>"><?= $fournisseurt['name_fournisseur'] ?></option>
                                                            <?php endforeach; ?> <!--Affiche la liste de fournisseur -->
                                                            <optgroup label="--------------------------------">
                                                            <option value="Pas de Fournisseur">Autres</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                 <hr><style>.line{text-decoration: underline;}</style>
                                                </div>
                                                <div class="col-12 col-sm-6  border">
                                                    <div class="form-group text-center">
                                                        <div class="controls">
                                                            <h4 class="line">VENTE</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6  border">
                                                    <div class="form-group text-center">
                                                        <h4 class="line">ACHAT</h4>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 border">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Prix de vente HT :</label>
                                                            <input name="prixvente" type="number" step="any" class="form-control" placeholder="Prix de vente de l'article" value="<?= $article['prixvente'] ?>">
                                                        </div>
                                                        <div class="controls"> 
                                                            <?php                             
                                                                if($article['tvavente'] == "20"){$tvavente = "Taux normal : 20 %";}if($article['tvavente'] == "10"){$tvavente = "Taux intermédiaire : 10 %";}if($article['tvavente'] == "5.5"){$tvavente = "Taux réduit : 5.5 %";}if($article['tvavente'] == "2.1"){$tvavente = "Taux particulier : 2.1 %";}if($article['tvavente'] == "0"){$tvavente = "Taux nul : 0 %";}
                                                            ?>
                                                            <label>Tva vente :</label>
                                                            <fieldset class="invoice-address form-group">
                                                            <select name="tvavente" class="form-control invoice-item-select">
                                                                <option value="<?= $article['tvavente'] ?>"><?= $tvavente ?></option>
                                                                <option></option>
                                                                <option value="20">Taux normal : 20 %</option>
                                                                <option value="10">Taux intermédiaire : 10 %</option>
                                                                <option value="5.5">Taux réduit : 5.5 %</option>
                                                                <option value="2.1">Taux particulier : 2.1 %</option>
                                                                <option value="0">Taux nul : 0 %</option>
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 border">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Quantité :</label>
                                                            <input name="stock"  type="number" value="<?= $article['stock'] ?>" class="form-control" placeholder="Quantité acheté pour le stock" onkeyup="myFunction()" step="any" >
                                                        </div>
                                                        <div class="controls">
                                                            <label>Cout d'achat HT :</label>
                                                            <input name="coutachat" type="number" step="any" class="form-control" placeholder="Cout d'achat de l'article" value="<?= $article['coutachat'] ?>">
                                                        </div>
                                                        <div class="controls">
                                                            <?php                             
                                                                if($article['tvaachat'] == "20"){$tvaachat = "Taux normal : 20 %";}if($article['tvaachat'] == "10"){$tvaachat = "Taux intermédiaire : 10 %";}if($article['tvaachat'] == "5.5"){$tvaachat = "Taux réduit : 5.5 %";}if($article['tvaachat'] == "2.1"){$tvaachat = "Taux particulier : 2.1 %";}if($article['tvaachat'] == "0"){$tvaachat = "Taux nul : 0 %";}
                                                            ?>
                                                            <label>Tva achat :</label>
                                                            <fieldset class="invoice-address form-group">
                                                            <select name="tvaachat" class="form-control invoice-item-select">
                                                                <option value="<?= $article['tvaachat'] ?>"><?= $tvaachat ?></option>
                                                                <option></option>
                                                                <option value="20">Taux normal : 20 %</option>
                                                                <option value="10">Taux intermédiaire : 10 %</option>
                                                                <option value="5.5">Taux réduit : 5.5 %</option>
                                                                <option value="2.1">Taux particulier : 2.1 %</option>
                                                                <option value="0">Taux nul : 0 %</option>
                                                            </select>
                                                        </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Modifier<i class='bx bx-right-arrow-alt'></i></button>
                                                </div>
                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
                                            </div>
                                        <!-- users edit account form ends -->
                                    </div>
                            
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
            </div>
        </div>
    </div>
    


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>