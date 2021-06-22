<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id=:num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $explode_frais = explode('!', $entreprise['frais_bilan']);
    $explode_greffe = explode('!', $entreprise['greffe_bilan']);
    $explode_age = explode('!', $entreprise['age_bilan']);

    $pdoSt = $bdd->prepare('SELECT * FROM bilan WHERE id_session=:num AND date_a=:date_a');   
    $pdoSt->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
    $pdoSt->bindValue(':date_a',$_GET['time'], PDO::PARAM_INT);
    $pdoSt->execute();  
    $bilan = $pdoSt->fetchAll();
    $count_bilan = count($bilan);

     //désactivation des notifications, delete notif back
    
     $pdoSta = $bdd->prepare('DELETE FROM notif_back WHERE type_demande=:type_demande AND id_session=:num');
     $pdoSta->bindValue(':num', $_GET['num']);
     $pdoSta->bindValue(':type_demande', "bilan");
     $pdoSta->execute();

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
    <title>Bilan - <?= $entreprise['nameentreprise'] ?></title>
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
    <link rel="stylesheet" href="../../../app-assets/css/pages/dsn-upload.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
.none-validation{display: none;}
.closee{padding: 20px; font-size: 25px;}
.closee:hover{color: red;}
.cursor{cursor: pointer;}
.cursor:hover{color: black;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #f3e53c;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix2.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
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

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding-top: 0px; margin-top: 0px;">
            <input type="hidden" value="<?= $_GET['num'] ?>" id="num_crea">
            <div class="content-header row">
                <div class="content-header-left col-12 mb-2 mt-1">
                    <div class="row breadcrumbs-top">
                        <div class="col">
                            <div class="breadcrumb-wrapper col-12">
                                <ol class="breadcrumb p-0 mb-0">
                                    <li class="breadcrumb-item"><a href="dashboard-admin.php"><i class="bx bx-home-alt"></i></a>
                                    </li>
                                    <li class="breadcrumb-item"><a href="bilan-back.php">Bilan</a>
                                    </li>
                                    <li class="breadcrumb-item active"><a href="#"><?= $entreprise['nameentreprise'] ?></a>
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="col text-right">
                            <p>Vous avez la possibilité de donner accès au bilan comptable 🤣</p>
                            <p>Statut : <label style='color: <?php if($entreprise['statut_dette'] == "yes"){echo "green";}else{echo "red";} ?>;'><?php if($entreprise['statut_dette'] == "yes"){echo "Autorisé";}else{echo "Resufé";} ?></label></p>
                            <a href="php/change_statut_dette.php?num=<?= $_GET['num'] ?>&time=<?= $_GET['time'] ?>&statut=<?= $entreprise['statut_dette'] ?>"><button class='btn btn-outline-success col-5 <?php if($entreprise['statut_dette'] == "yes"){echo "none-validation";} ?>'>Autorisé le téléchargement</button></a>
                            <a href="php/change_statut_dette.php?num=<?= $_GET['num'] ?>&time=<?= $_GET['time'] ?>&statut=<?= $entreprise['statut_dette'] ?>"><button class='btn btn-outline-danger col-5 <?php if($entreprise['statut_dette'] == "no"){echo "none-validation";} ?>'>Refuser le téléchargement</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic Horizontal form layout section start -->
                <section id="basic-horizontal-layouts">
                    <div class="row match-height">
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5 class="">Ajouter un bilan</h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <form class="form form-horizontal" action="php/insert_bilan.php?num=<?= $_GET['num'] ?>&time=<?= $_GET['time'] ?>" method="POST" enctype="multipart/form-data">
                                            <div class="form-body">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <label>E-mail</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <div class="position-relative has-icon-left">
                                                            <input type="email" id="email-icon" class="form-control" name="email_bilan" value="<?= $entreprise['emailentreprise'] ?>" placeholder="E-mail" required>
                                                            <div class="form-control-position">
                                                                <i class="bx bx-mail-send"></i>
                                                            </div>
                                                            <small>L'email permettra de notifier et de valider l'envoye du bilan !</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <label>Selectionner une année</label>
                                                    </div>
                                                    <div class="col-md-8 form-group">
                                                        <div class="position-relative has-icon-left">
                                                            <fieldset class="form-group">
                                                                <select name='date_bilan' class="custom-select" style='padding-left: 35px;' id="customSelect">
                                                                    <option selected value="<?= $_GET['time'] ?>"><?= $_GET['time'] ?></option>
                                                                    <optgroup></optgroup>
                                                                    <option value="2016">2016</option>
                                                                    <option value="2017">2017</option>
                                                                    <option value="2018">2018</option>
                                                                    <option value="2019">2019</option>
                                                                    <option value="2020">2020</option>
                                                                    <option value="2021">2021</option>
                                                                </select>
                                                            </fieldset>
                                                            <div class="form-control-position">
                                                                <i class='bx bx-timer'></i>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button type="button" onclick="conf()" class="btn btn-outline-success col-12">Confirmation du mail !</button>
                                                </div>
                                                <div id="div_conf" class="form-group none-validation">
                                                    <div class="file-container">
                                                        <div class="file-overlay" onclick="overplay()"></div>
                                                        <div class="file-wrapper">
                                                            <input name="doc_files" class="file-input" id="js-file-input" type="file" onchange="this.form.submit();">
                                                            <div class="file-content">
                                                                <div class="file-infos">
                                                                    <p class="file-icon"><i class="fas fa-file-upload fa-7x"></i><span class="icon-shadow"></span><span>Cliquez pour parcourir<span class="has-drag"> ou déposez le fichier ici</span></span></p>                                                                 
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="card">
                                <div style="padding-top: 40px; padding-left: 40px;">
                                    <div class="row">
                                        <div class="col">
                                            <fieldset class="form-group col">
                                                <label for="basicInput">Impots</label>
                                                <input style="border: 1px solid <?php if($explode_frais[1] == "yes"){echo "green";}else{echo "red";} ?>;" type="text" class="form-control" id="basicInput" placeholder="" value='<?= $explode_frais[0] ?> €' readonly>
                                            </fieldset>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-right" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Payé</p>
                                                        <input onchange="paiement_frais_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor1" <?php if($explode_frais[1] == "yes"){echo "checked";} ?> >
                                                        <label class="custom-control-label" for="customSwitchcolor1"></label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Déposé</p>
                                                        <input onchange="depo_frais_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor2" <?php if($explode_frais[2] == "yes"){echo "checked";} ?>>
                                                        <label class="custom-control-label" for="customSwitchcolor2"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="row">
                                        <div class="col">
                                            <fieldset class="form-group col">
                                                <label for="basicInput">Greffe du T.C</label>
                                                <input style="border: 1px solid <?php if($explode_greffe[1] == "yes"){echo "green";}else{echo "red";} ?>;" type="text" class="form-control" id="basicInput" placeholder="" value='<?= $explode_greffe[0] ?> €' readonly> 
                                            </fieldset>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-right" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Payé</p>
                                                        <input onchange="paiement_greffe_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor3" <?php if($explode_greffe[1] == "yes"){echo "checked";} ?>>
                                                        <label class="custom-control-label" for="customSwitchcolor3"></label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Déposé</p>
                                                        <input onchange="depo_greffe_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor40" <?php if($explode_greffe[2] == "yes"){echo "checked";} ?>>
                                                        <label class="custom-control-label" for="customSwitchcolor40"></label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <fieldset class="form-group col">
                                                <label for="basicInput">A.G.O</label>
                                                <input style="border: 1px solid <?php if($explode_age[1] == "yes"){echo "green";}else{echo "red";} ?>;" type="text" class="form-control" id="basicInput" placeholder="" value='<?= $explode_age[0] ?> €' readonly>
                                            </fieldset>
                                        </div>
                                        <div class="col">
                                            <div class="row">
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-right" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Payé</p>
                                                        <input onchange="paiement_age_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor5" <?php if($explode_age[1] == "yes"){echo "checked";} ?>>
                                                        <label class="custom-control-label" for="customSwitchcolor5"></label>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1" style="position: relative; top: 13px;">
                                                        <p class="mb-0">Déposé</p>
                                                        <input onchange="depo_age_check()" type="checkbox" class="custom-control-input" id="customSwitchcolor6" <?php if($explode_age[2] == "yes"){echo "checked";} ?>>
                                                        <label class="custom-control-label" for="customSwitchcolor6"></label>
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
                <!-- // Basic Horizontal form layout section end -->

                <!-- // Basic multiple Column Form section start -->
                <section id="multiple-column-form">
                    <div class="row match-height">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header text-center">
                                    <h5 class="">Bilan de <?= $_GET['time'] ?></h4>
                                </div>
                                <div class="text-center">
                                    <fieldset class="form-group">
                                        <select id="select_annee" onchange="select_annee()" class="custom-select col-1">
                                            <option selected value="<?= $_GET['time'] ?>"><?= $_GET['time'] ?></option>
                                            <optgroup></optgroup>
                                            <option value="2016">2016</option>
                                            <option value="2017">2017</option>
                                            <option value="2018">2018</option>
                                            <option value="2019">2019</option>
                                            <option value="2020">2020</option>
                                            <option value="2021">2021</option>
                                        </select>
                                    </fieldset>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                            <div class="form-group text-center <?php if($count_bilan == "0"){echo "none-validation";} ?>">
                                                <div class="row text-center">
                                                    <?php foreach($bilan as $bilans): $type = substr($bilans['files_bilan'], -3);if ($type == "pdf") {$type = "pdf.png";}else{$type = "doc.png";} ?>
                                                        <div class="col-sm">
                                                            <div class="card border shadow-none mb-1 app-file-info">
                                                                <div class="card-content">
                                                                    <div class="app-file-content-logo card-img-top">
                                                                        <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type ?>" height="38" width="30" alt="Card image cap">
                                                                    </div>
                                                                    <div class="card-body p-50">
                                                                        <div class="app-file-details">
                                                                            <div class="app-file-name font-size-small font-weight-bold"><?= $bilans['files_bilan'] ?></div>
                                                                            <div class="app-file-size font-size-small text-muted mb-25"><?= $bilans['dte'] ?></div>
                                                                            <div class="app-file-type font-size-small text-muted"><a href="../../../src/bilan/<?= $bilans['files_bilan'] ?>" target="_blank"><i class='bx bx-show-alt cursor'></a></i>&nbsp&nbsp&nbsp<a href="../../../src/bilan/<?= $bilans['files_bilan'] ?>" download><i class='bx bxs-download cursor'></i></a>&nbsp&nbsp&nbsp<a href="php/delete_bilan.php?id=<?= $_GET['num'] ?>&num=<?= $bilans['id'] ?>&time=<?= $_GET['time'] ?>"><i class='bx bxs-trash cursor' ></i></a></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div> 
                                            <div class="form-group text-center <?php if($count_bilan > "0"){echo "none-validation";} ?>">
                                                <hr>
                                                <p class="">Aucun bilan en <?= $_GET['time'] ?> ...</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic multiple Column Form section end -->

            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
        function conf(){
            document.getElementById('div_conf').style.display = "block";
        }

        function overplay(){
            document.getElementById('div_conf').style.display = "none";
        }

    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/creation-upload.js"></script>
    <!-- END: Page JS-->

    

    <script>
        function select_annee() {
            let x = document.getElementById("select_annee").value;
            document.location.href="bilan-view.php?num=<?= $_GET['num'] ?>&time="+x; 
        }

        function paiement_frais_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['frais_bilan'] ?>&type=frais');
            requeteAjax.send(notification_crea);
        }

        function paiement_greffe_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['greffe_bilan'] ?>&type=greffe');
            requeteAjax.send(notification_crea);
        }

        function paiement_age_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['age_bilan'] ?>&type=age');
            requeteAjax.send(notification_crea);
        }

        function depo_frais_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_depo_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['frais_bilan'] ?>&type=frais');
            requeteAjax.send(notification_crea);
        }

        function depo_greffe_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_depo_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['greffe_bilan'] ?>&type=greffe');
            requeteAjax.send(notification_crea);
        }

        function depo_age_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_depo_frais_bilan.php?num=<?= $_GET['num'] ?>&result=<?= $entreprise['age_bilan'] ?>&type=age');
            requeteAjax.send(notification_crea);
        }
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>