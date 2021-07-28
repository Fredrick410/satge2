<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'comptable');
require_once 'php/verif_session_connect_admin.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "prospect" || statut = "prospect!validation"');
    $pdoSta->execute();
    $portefeuille_prospect = $pdoSta->fetchAll();
    $count_prospect = count($portefeuille_prospect);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "actif"');
    $pdoSta->execute();
    $portefeuille_actif = $pdoSta->fetchAll();
    $count_actif = count($portefeuille_actif);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "encours"');
    $pdoSta->execute();
    $portefeuille_encours = $pdoSta->fetchAll();
    $count_encours = count($portefeuille_encours);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "passif"');
    $pdoSta->execute();
    $portefeuille_passif = $pdoSta->fetchAll();
    $count_passif = count($portefeuille_passif);

    // CHART PART 

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "01");
    $pdoSta->execute();
    $portefeuille_janv = $pdoSta->fetchAll();
    $count_janv = count($portefeuille_janv);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "02");
    $pdoSta->execute();
    $portefeuille_fev = $pdoSta->fetchAll();
    $count_fev = count($portefeuille_fev);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "03");
    $pdoSta->execute();
    $portefeuille_mars = $pdoSta->fetchAll();
    $count_mars = count($portefeuille_mars);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "04");
    $pdoSta->execute();
    $portefeuille_avr = $pdoSta->fetchAll();
    $count_avr = count($portefeuille_avr);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "05");
    $pdoSta->execute();
    $portefeuille_mai = $pdoSta->fetchAll();
    $count_mai = count($portefeuille_mai);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "06");
    $pdoSta->execute();
    $portefeuille_juin = $pdoSta->fetchAll();
    $count_juin = count($portefeuille_juin);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "07");
    $pdoSta->execute();
    $portefeuille_juillet = $pdoSta->fetchAll();
    $count_juillet = count($portefeuille_juillet);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "08");
    $pdoSta->execute();
    $portefeuille_aout = $pdoSta->fetchAll();
    $count_aout = count($portefeuille_aout);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "09");
    $pdoSta->execute();
    $portefeuille_sept = $pdoSta->fetchAll();
    $count_sept = count($portefeuille_sept);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "10");
    $pdoSta->execute();
    $portefeuille_oct = $pdoSta->fetchAll();
    $count_oct = count($portefeuille_oct);

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "11");
    $pdoSta->execute();
    $portefeuille_nov = $pdoSta->fetchAll();
    $count_nov = count($portefeuille_nov);
 
    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE date_crea_m=:date_crea_m ');
    $pdoSta->bindValue(':date_crea_m', "12");
    $pdoSta->execute();
    $portefeuille_dec = $pdoSta->fetchAll();
    $count_dec = count($portefeuille_dec);

    if($count_passif == "0"){
        $ratio = "0";
    }else{
        $ratio = $count_actif / $count_passif;
    }

    $pdoSta = $bdd->prepare('SELECT dette FROM portefeuille');
    $pdoSta->execute();
    $portefeuille_all = $pdoSta->fetchAll();

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum = $pdoSta->fetch();

    //CHART PAR MOIS DETTE
    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="01" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_janv = $pdoSta->fetch();
    if($sum_janv['somme'] == ""){$somme_janv= "0";}else{$somme_janv = $sum_janv['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="02" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_fevr = $pdoSta->fetch();
    if($sum_fevr['somme'] == ""){$somme_fevr= "0";}else{$somme_fevr = $sum_fevr['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="03" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_mars = $pdoSta->fetch();
    if($sum_mars['somme'] == ""){$somme_mars= "0";}else{$somme_mars = $sum_mars['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="04" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_avri = $pdoSta->fetch();
    if($sum_avri['somme'] == ""){$somme_avri= "0";}else{$somme_avri = $sum_avri['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="05" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_mai = $pdoSta->fetch();
    if($sum_mai['somme'] == ""){$somme_mai= "0";}else{$somme_mai = $sum_mai['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="06" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_jui = $pdoSta->fetch();
    if($sum_jui['somme'] == ""){$somme_jui= "0";}else{$somme_jui = $sum_jui['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="07" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_juil = $pdoSta->fetch();
    if($sum_juil['somme'] == ""){$somme_juil= "0";}else{$somme_juil = $sum_juil['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="08" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_aout = $pdoSta->fetch();
    if($sum_aout['somme'] == ""){$somme_aout= "0";}else{$somme_aout = $sum_aout['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="09" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_sept = $pdoSta->fetch();
    if($sum_sept['somme'] == ""){$somme_sept= "0";}else{$somme_sept = $sum_sept['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="10" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_octr = $pdoSta->fetch();
    if($sum_octr['somme'] == ""){$somme_octr= "0";}else{$somme_octr = $sum_octr['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="11" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_nove = $pdoSta->fetch();
    if($sum_nove['somme'] == ""){$somme_nove= "0";}else{$somme_nove = $sum_nove['somme'];}

    $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE dte_m="12" AND statut="rejeté" || statut="En cours"');
    $pdoSta->execute();
    $sum_dece = $pdoSta->fetch();
    if($sum_dece['somme'] == ""){$somme_dece= "0";}else{$somme_dece = $sum_dece['somme'];}


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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/switch_emote.css">
    <link rel="stylesheet" href="../../../app-assets/css/pages/overflow-portefeuille.css">
    <link rel="stylesheet" href="../../../app-assets/css/pages/fixed-table.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .none-validation{display: none;}
    .icon_send{color: grey; cursor: pointer;}
    .icon_send:hover{color: blue;}
    .icon_send_c{color: grey; cursor: pointer;}
    .icon_send_c:hover{color: orange;}
    .icon_verif{position: relative; color: grey; font-size: 20px;}
    .icon_verif:hover{color: green;}
    .icon_files{position: relative; left: -10px; color: green; font-size: 20px;}
    .icon_files:hover{opacity: 0.5;}
    .icon_card{position: relative; left: -10px; color: #3c6eca; font-size: 20px;}
    .icon_card:hover{opacity: 0.5;}
    .icon_x{position: relative; left: -10px; top: 3px; color: red; font-size: 25px;}
    .icon_x:hover{opacity: 0.5;}
    .icon_size{
        font-size: 30px;
    }
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
        <div class="content-wrapper">
            <div class="form-group">
                    <div id="div_over" class="form-group none-validation">
                        <div class="file-container">
                            <div class="file-overlay" style="cursor: pointer;" onclick="overplay()"></div>
                            <div class="file-wrapper">
                                <div class="form-group">
                                    <div class="tbl-header">
                                        <table class="table" cellpadding="0" cellspacing="0" border="0">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Nom société</th>
                                                    <th scope="col">Nom dirigeant</th>
                                                    <th scope="col">Téléphone</th>
                                                    <th scope="col">Dette</th>
                                                    <th scope="col">Raison</th> 
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                    <div class="tbl-content scroller">
                                        <table class="table" cellpadding="0" cellspacing="0" border="0">
                                            <tbody>
                                                <?php foreach($portefeuille_passif as $portefeuilles_passif): ?>
                                                    <tr>
                                                        <td><a class="a_view" href="portefeuille-view.php?num=<?= $portefeuilles_passif['id'] ?>"><?= $portefeuilles_passif['name_entreprise'] ?></a></td>
                                                        <td><?= $portefeuilles_passif['nom_diri'] ?></td>
                                                        <td><?= $portefeuilles_passif['tel_diri'] ?></td>
                                                        <td style='color: <?php if($portefeuilles_passif['dette'] > 0){echo "red";}else{echo "green";} ?>;'><?= $portefeuilles_passif['dette'] ?> €</td>
                                                        <td><?= $portefeuilles_passif['raison'] ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-group <?php if($ratio <= "1.30"){echo "none-validation";} ?>">
                            <div class="alert border-success alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="d-flex align-items-center">
                                    <i class='bx bx-badge-check'></i>
                                    <span>
                                        Bravo à toutes l'équipe vous avez un ratio de <?= $ratio ?>, continuer dans votre progression 😂.
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?php if($ratio > "1" && $ratio < "1.30"){}else{echo "none-validation";} ?>">
                            <div class="alert border-warning alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="d-flex align-items-center">
                                    <i class='bx bxs-trash' ></i>
                                    <span>
                                        OwowoWOwoWOWowo ! le ratio n'est pas à la hauteur de vos capacitées, votre ratio est de <?= $ratio ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group <?php if($ratio < "1"){}else{echo "none-validation";} ?>">
                            <div class="alert border-danger alert-dismissible mb-2" role="alert">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <div class="d-flex align-items-center">
                                    <i class="bx bx-error"></i>
                                    <span>
                                        L'État est critique il faut redoubler d'efforts les amis, votre ratio est de <?= $ratio ?>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <section id="widgets-Statistics">
                        <div class="row">
                            <div class="col-12 mt-1 mb-2">
                                <h4>Statistique</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-info mx-auto my-1">
                                                <i class="bx bx-grid-small icon_size"></i>
                                            </div>
                                            <p class="text-muted mb-0 line-ellipsis">Total</p>
                                            <h2 class="mb-0"><?= $count_actif + $count_encours + $count_passif + $count_prospect ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                <i class='bx bxs-save icon_size'></i>
                                            </div>
                                            <p class="text-muted mb-0 line-ellipsis">Prospect</p>
                                            <h2 class="mb-0"><?= $count_prospect ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto my-1">
                                                <i class='bx bx-badge-check icon_size'></i>
                                            </div>
                                            <p class="text-muted mb-0 line-ellipsis">Client (Actif)</p>
                                            <h2 class="mb-0"><?= $count_actif ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto my-1">
                                                <i class='bx bx-loader-circle icon_size'></i>
                                            </div>
                                            <p class="text-muted mb-0 line-ellipsis">Client (En cours)</p>
                                            <h2 class="mb-0"><?= $count_encours ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card text-center">
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="badge-circle badge-circle-lg badge-circle-light-danger mx-auto my-1">
                                                <i class='bx bxs-error icon_size'></i>
                                            </div>
                                            <p class="text-muted mb-0 line-ellipsis">Passif</p>
                                            <h2 class="mb-0"><?= $count_passif ?></h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>               
                </div>
                <div class="form-group">
                    <div class="card">
                        <div class="row">  
                            <div class="col">
                                <div class="card-content">
                                  <div class="card-body">
                                      <div id="radial-bar-chart"></div>
                                  </div>
                                </div>
                            </div>
                            <div class="col">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="pie-chart" class="d-flex justify-content-center"></div>
                                    </div>
                                </div>          
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="card">
                        <div class="form-group">
                            <h5 style="padding-left: 20px; padding-top: 20px;">Ensemble des dettes : <?= $sum['somme'] ?> €</h5><br>
                        </div>
                        <div class="col">
                            <div class="card-content">
                                <div class="card-body">
                                    <div id="bar-chart" class="d-flex justify-content-center"></div>
                                </div>
                            </div>   
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col-12 col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Evolution du nombre </h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body">
                                        <div id="line-chart"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col text-left">
                            <a href="portefeuille-add.php"><button class="btn btn-outline-success mr-1 mb-1">Ajouter un nouveau prospect</button></a>
                        </div>
                        <div class="text-center">
                            <h5>Prospect</h5>
                            <p>Il y a 2 type de prospect :</p>
                            <small>- En blue (Les prospects sûr à 80%)</small>
                            <small>- En blanc (Les prospects a relancer)</small>
                            <br>
                            <br>
                            <br>
                            <br>
                        </div>
                        <div class="col text-right">
                            <button onclick="overplay_see()" type="button" class="btn btn-outline-danger mr-1 mb-1">Voir ancien client</button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col" style="border-right: 1px solid grey;">
                        
                        <div class="form-group">
                            <div class="table-responsive" style='overflow: hidden;'>
                                <section>
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="table-responsive">
                                                <table class="table add-rows">
                                                    <thead>
                                                        <tr>
                                                            <th>Nom société</th>
                                                            <th>Nom dirigeant</th>
                                                            <th>Téléphone</th>
                                                            <th>Estimation</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($portefeuille_prospect as $portefeuilles): ?>
                                                            <tr class="table-<?php if($portefeuilles['statut'] == "prospect!validation"){echo "primary";}else{echo "active";} ?>">
                                                                <th class="text-bold-500"><a class="a_view" href="portefeuille-view.php?num=<?= $portefeuilles['id'] ?>"><?= $portefeuilles['name_entreprise'] ?></a></th>
                                                                <th><?= $portefeuilles['nom_diri'] ?></th>
                                                                <th class="text-bold-500"><?= $portefeuilles['tel_diri'] ?></th>
                                                                <th><?= $portefeuilles['estimation'] ?> €</th>
                                                                <th><a href="php/change_portefeuille.php?num=<?= $portefeuilles['id'] ?>&type=prospect"><i class='bx bxs-user-check icon_verif' ></i></a> <a href="portefeuille-upload.php?num=<?= $portefeuilles['id'] ?>&type=prospect&name_entreprise=<?= $portefeuilles['name_entreprise'] ?>"><i class='bx bxs-send icon_send'></i></a><a href="php/delete_prospect.php?id=<?= $portefeuilles['id'] ?>"><i class='bx bxs-trash'></i></a></th>
                                                            </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group text-center" style="height: 108px;">
                            <div onclick="action_switch();" class="toggle dog-rollover">
                                <input class="bt_input" id="doggo" type="checkbox"/>
                                <label class="toggle-item" for="doggo">
                                    <div class="dog">
                                        <div class="ear"></div>
                                        <div class="ear right"></div>
                                        <div class="face">
                                            <div class="eyes"></div>
                                            <div class="mouth"></div>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            <div>
                                <label style="color: orange;">En cours</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label style="color: green;">Actif</label>
                            </div>
                        </div>
                        <div class="form-group" style="margin-bottom: 64px;">

                        </div>
                        <div id="div_encours" class="form-group">
                            <div>
                                <h5>Client (En cours)</h5>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table add-rows">
                                        <thead>
                                            <tr>
                                                <th>Nom société</th>
                                                <th>Nom dirigeant</th>
                                                <th>Téléphone</th>
                                                <th>Estimation</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($portefeuille_encours as $portefeuilles_encours): ?>
                                                <tr class="table-warning">
                                                    <th class="text-bold-500"><a class="a_view" href="portefeuille-view.php?num=<?= $portefeuilles_encours['id'] ?>"><?= $portefeuilles_encours['name_entreprise'] ?></a></th>
                                                    <th><?= $portefeuilles_encours['nom_diri'] ?></th>
                                                    <th class="text-bold-500"><?= $portefeuilles_encours['tel_diri'] ?></th>
                                                    <th><?= $portefeuilles_encours['estimation'] ?> €</th>
                                                    <th><a href="../../../src/portefeuille/lettredemission/<?= $portefeuilles_encours['lettredemission'] ?>" target="_blank"><i class='bx bx-file icon_files'></i></a> <a href="portefeuille-upload.php?num=<?= $portefeuilles_encours['id'] ?>&type=encours&name_entreprise=<?= $portefeuilles_encours['name_entreprise'] ?>"><i class='bx bxs-send icon_send'></i></a></th>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>  
                        <div id="div_actif" class="form-group none-validation">
                            <div>
                                <h5>Client (Actif)</h5>
                            </div>
                            <div class="form-group">
                                <div class="table-responsive">
                                    <table class="table add-rows">
                                        <thead>
                                            <tr>
                                                <th>Nom société</th>
                                                <th>Nom dirigeant</th>
                                                <th>Téléphone</th>
                                                <th>Dette</th>
                                                <th>Date de creation</th>
                                                <th>ACTION</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach($portefeuille_actif as $portefeuilles_actif): 
                                            
                                                $pdoSta = $bdd->prepare('SELECT sum(montant) as somme FROM prelevement WHERE id_session=:num AND (statut="En cours" OR statut="rejeté") ');
                                                $pdoSta->bindValue('num', $portefeuilles_actif['id']);
                                                $pdoSta->execute();
                                                $sum_dette = $pdoSta->fetch();
                                                if($sum_dette['somme'] == ""){
                                                    $sum_dette = "0";
                                                }else{
                                                    $sum_dette = $sum_dette['somme'];
                                                }
                                                                                    
                                            ?>
                                                <tr class="table-success">
                                                    <td class="text-bold-500"><a class="a_view" href="portefeuille-view.php?num=<?= $portefeuilles_actif['id'] ?>"><?= $portefeuilles_actif['name_entreprise'] ?></a></td>
                                                    <td><?= $portefeuilles_actif['nom_diri'] ?></td>
                                                    <td class="text-bold-500"><?= $portefeuilles_actif['tel_diri'] ?></td>
                                                    <td style="color: red;"><?= $sum_dette ?> €</td>
                                                    <td><?= $portefeuilles_actif['date_crea'] ?></td>
                                                    <td><a href="../../../src/portefeuille/lettredemission/<?= $portefeuilles_actif['lettredemission'] ?>" target="_blank"><i class='bx bx-file icon_files'></i></a>  <a href="../../../src/portefeuille/rib/<?= $portefeuilles_actif['rib'] ?>" target="_blank"><i class='bx bx-credit-card icon_card'></i></a>  <a href="portefeuille-leave.php?num=<?= $portefeuilles_actif['id'] ?>&name_entreprise=<?= $portefeuilles_actif['name_entreprise'] ?>"><i class='bx bx-x icon_x'></i></a></td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>                     
                    </div>
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
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- <script src="../../../app-assets/js/scripts/charts/chart-apex-portefeuille.js"></script> -->
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <!-- END: Page JS-->

    <script>
        function open_actif(){
            document.getElementById('bt_actif').style.display = "none";
            document.getElementById('table-prospect').style.display = "none";
            document.getElementById('table-passif').style.display = "none";
            document.getElementById('table-actif').style.display = "block";
            document.getElementById('bt_prospect').style.display = "block";
            document.getElementById('bt_passif').style.display = "block";
        }
        
        function action_switch(){
            let switchK = document.getElementById('doggo');
            if(switchK.checked){
                document.getElementById('div_encours').style.display = "none";
                document.getElementById('div_actif').style.display = "block";
            } else {
                document.getElementById('div_encours').style.display = "block";
                document.getElementById('div_actif').style.display = "none";
            }
        }

        function overplay(){
            document.getElementById('div_over').style.display = "none";
        }

        function overplay_see(){
            document.getElementById('div_over').style.display = "block";
        }

    </script>

    <script>
        $(document).ready(function () {

          var $primary = '#5A8DEE',
            $success = '#39DA8A',
            $danger = '#FF5B5C',
            $warning = '#FDAC41',
            $info = '#00CFDD',
            $label_color_light = '#E6EAEE';

          var themeColors = [$primary, $warning, $danger, $success, $info];

          // Line Chart
          // ----------------------------------
          const lineChartOptions = {
            chart: {
              height: 350,
              type: 'line',
              zoom: {
                enabled: false
              }
            },
            colors: themeColors,
            dataLabels: {
              enabled: false
            },
            stroke: {
              curve: 'straight'
            },
            series: [{
              name: "Nombre de clients",
              data: [<?= $count_janv ?>, <?= $count_fev ?>, <?= $count_mars ?>, <?= $count_avr ?>, <?= $count_mai ?>, <?= $count_juin ?>, <?= $count_juillet ?>, <?= $count_aout ?>, <?= $count_sept ?>, <?= $count_oct ?>, <?= $count_nov ?>, <?= $count_dec ?>],
            }],
            title: {
              text: 'Nombre de client ou potentielle client par mois',
              align: 'left'
            },
            grid: {
              row: {
                colors: ['#f3f3f3', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.5
              },
            },
            xaxis: {
              categories: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
            },
            yaxis: {
              tickAmount: 5,
            }
          }
          const lineChart = new ApexCharts(
            document.querySelector("#line-chart"),
            lineChartOptions
          );
          lineChart.render();

          // Pie Chart
          // -----------------------------
          const pieChartOptions = {
            chart: {
              type: 'pie',
              height: 320
            },
            colors: themeColors,
            labels: ['Prospect', 'En cours', 'Passif', 'Actif'],
            series: [<?= $count_prospect ?>, <?= $count_encours ?>, <?= $count_passif ?>, <?= $count_actif ?>],
            legend: {
              itemMargin: {
                horizontal: 2
              },
            },
            responsive: [{
              breakpoint: 576,
              options: {
                chart: {
                  width: 300
                },
                legend: {
                  position: 'bottom'
                }
              }
            }]
          }
          const pieChart = new ApexCharts(
            document.querySelector("#pie-chart"),
            pieChartOptions
          );
          pieChart.render();

          // Radial Bar Chart
          // -----------------------------
          const radialBarChartOptions = {
            chart: {
              height: 350,
              type: 'radialBar',
            },
            colors: themeColors,
            plotOptions: {
              radialBar: {
                dataLabels: {
                  name: {
                    fontSize: '22px',
                  },
                  value: {
                    fontSize: '16px',
                  },
                  total: {
                    show: true,
                    label: 'Total',
                    // color: $label_color,
                    formatter: function (w) {
                      // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
                      return <?= $count_actif + $count_encours + $count_passif + $count_prospect ?>
                    }
                  }
                }
              }
            },
            series: [<?= $count_prospect ?>, <?= $count_actif ?>, <?= $count_encours ?>, <?= $count_passif ?>],
            labels: ['Prospect', 'Actif', 'En cours', 'Passif'],
          }
          const radialBarChart = new ApexCharts(
            document.querySelector("#radial-bar-chart"),
            radialBarChartOptions
          );
          radialBarChart.render();

          // Bar Chart
          // ----------------------------------
          var barChartOptions = {
            chart: {
              height: 350,
              type: 'bar',
            },
            colors: themeColors,
            plotOptions: {
              bar: {
                horizontal: true,
              }
            },
            dataLabels: {
              enabled: false
            },
            series: [{
              name : "Dette",
              data: [<?= $somme_janv ?>, <?= $somme_fevr ?>, <?= $somme_mars ?>, <?= $somme_avri ?>, <?= $somme_mai ?>, <?= $somme_jui ?>, <?= $somme_juil ?>, <?= $somme_aout ?>, <?= $somme_sept ?>, <?= $somme_octr ?>, <?= $somme_nove ?>, <?= $somme_dece ?>]
            }],
            xaxis: {
              categories: ['Janvier', 'Fevrier', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Aout', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
              tickAmount: 5
            }
          }
          const barChart = new ApexCharts(
            document.querySelector("#bar-chart"),
            barChartOptions
          );
          barChart.render();

        });
    </script>



    
    
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>