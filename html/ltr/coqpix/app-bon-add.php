<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';
require_once 'php/permissions_front.php';

    if (permissions()['ventes'] < 2) {
        header('Location: app-bon-list.php');
        exit();
    }

    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM article WHERE id_session = :num AND typ="Ventes" OR typ="Ventes et Achats"');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute();
    $article = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM client WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute();
    $client = $pdoSt->fetchAll();

  	$pdaSt = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num');
  	$pdaSt->bindValue(':num', $_SESSION['id_session']);
  	$pdaSt->execute();
  	$cliet = $pdaSt->fetch();

	  $total = $cliet['cout']*$cliet['quantite'];

    $max_num = "";
    $pdoSt = $bdd->prepare('SELECT id FROM bon');
            $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
            $pdoSt->execute();
            $num = $pdoSt->fetchAll();
            $count_num = count($num);
            $max_num = "0";
            for ($i=0; $i < $count_num ; $i++) {
                foreach($num as $n):

                    $number = $n['id'];
                    if($number > $max_num){
                        $max_num = $number;
                    }

                endforeach;
            }

            $max_num = $max_num + 1;

            $strlen_num = strlen($max_num);

            if($strlen_num == "1"){
                $max_num = '0'.$max_num;
            }elseif($strlen_num == "2"){
                $max_num = '0'.$max_num;
            }elseif($strlen_num >= "3"){
                $max_num = $max_num;
            }




    // Auto incrementation

    $max_incrementation = "";

    if($_GET['jXN955CbHqqbQ463u5Uq'] == "1" OR $_GET['jXN955CbHqqbQ463u5Uq'] == "0"){

        if($_GET['jXN955CbHqqbQ463u5Uq'] == "1"){

            $pdoSt = $bdd->prepare('SELECT numerosbon FROM bon WHERE id_session = :num');
            $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
            $pdoSt->execute();
            $incrementation = $pdoSt->fetchAll();
            $count_incrementation = count($incrementation);
            $max_incrementation = "0";

            for ($i=0; $i < $count_incrementation ; $i++) {
                foreach($incrementation as $incrementations):

                    $numeros = $incrementations['numerosbon'];
                    if($numeros > $max_incrementation){
                        $max_incrementation = $numeros;
                    }

                endforeach;
            }

            $max_incrementation = $max_incrementation + 1;

            $strlen_incrementation = strlen($max_incrementation);

            if($strlen_incrementation == "1"){
                $max_incrementation = '00'.$max_incrementation;
            }elseif($strlen_incrementation == "2"){
                $max_incrementation = '0'.$max_incrementation;
            }elseif($strlen_incrementation >= "3"){
                $max_incrementation = $max_incrementation;
            }

            $max_incrementation = date('y').$max_incrementation;

        }

    }else{
        header('Location: dashboard-analytics.php');
        exit();
    }

?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix cr??e By audit action plus - d??velopp?? par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Ajouter bon</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        #tkt{
            display:none;
        }
    </style>
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
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> cr??ation du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
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
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
										<!-- form qui insert toute la page -->
                                <form autocomplete="off" action="php/insert_bon.php" method="POST">
                                        <div class="row mx-0" >

													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
																	<h6 class="invoice-number mr-75">
																		N??

																	</h6>
																	<!-- auto incr??mentation du n?? avec le max_num plus haut  -->
																	<input  type="text" name="numeroarticle" id="numeros"  value='<?= $max_num ?>' class="form-control pt-25 w-50" placeholder="FAC-0" attribut readonly="readonly">
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
														<h6 class="invoice-number mr-75">
															R??f??rence
														</h6>
														<input name="refbon" id="refbon" type="text" value='REF-' class="form-control pt-20 w-50" placeholder="XXX-">
														<p style='position: relative; top: 7px;'>
															&nbsp&nbsp&nbsp
														</p>
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
														<h6 class="invoice-number mr-75">
														Bon N??
														</h6>
														<!-- auto incr??mentation du num??ro qui peut aussi etre choisi -->
														<input type="number" name="numerosbon" value='<?= $max_incrementation ?>' class="form-control pt-25 w-50" placeholder="00000">

													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
														<div class="d-flex align-items-center">
															<small class="text-muted mr-75">
																Date:
															</small>
															<fieldset class="d-flex ">
																<input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" value="<?php echo date("d/m/Y");?>" required>
															</fieldset>
														</div>
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
														<div class="d-flex align-items-center">
															<small class="text-muted mr-75">
																Date d'??ch??ance :
															</small>
															<fieldset class="d-flex justify-content-end">
																<input name="dateecheance" id="dateecheance" type="date" class="form-control mb-50 mb-sm-0" placeholder="jj-mm-aa" required>
															</fieldset>
														</div>
													</div>

												<!-- logo and title -->
												<div class="col-lg-12 col-md-12 mt-25">
													<div class="row my-2 py-50">
														<div class="col-sm-6 col-12 order-2 order-sm-1" style="text-align:center;padding-top:4%">
															<h4 class="text-primary">Bon</h4>
															<input name="nomproduit" id="nomproduit" type="text" class="form-control" placeholder="Nom du bon">
															<ul class="list-group list-group-flush">
																<div class="form-group">
																	<label for="exampleFormControlTextarea1">Description</label>
																	<textarea class="form-control" name="descrip" id="exampleFormControlTextarea1" rows="5"></textarea>
																</div>
															</ul>
														</div>
														<!-- LOGO -->
														<div class="col-sm-6 col-12 order-1 order-sm-1 d-flex justify-content-end">
															<img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
														</div>
													</div>
													<hr>
													<!-- invoice Paymenntress and contact -->
													<div class="row invoice-info">
														<div class="col-lg-6 col-md-12 mt-25">
															<div class="form-group">
																<label>*Client</label>
																<select name="bonpour" id="facturepour" class="form-control invoice-item-select"> <!-- facturepour car js prend que id=facturepour-->
																	<option value="Pas de clients">S??lectionnez un client</option>
																	<!-- list de tous les clients pr??nsents dans la colonne name_client -->
																	<?php foreach($client as $clientt): ?>
																	<option value="<?= $clientt['name_client'] ?>"><?= $clientt['name_client'] ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<?php // Permission de niveau 2 pour cr??er un client
                        									if (permissions()['clients'] >= 2) { ?>
																<button type="button" class="btn btn-primary col-lg-4 col-md-12 mt-25" style="margin-left: 15px" data-toggle="modal" data-target="#popup">Cr??er un client particulier</button>
																<button type="button" class="btn btn-primary col-lg-4 col-md-12 mt-25" style="margin-left: 15px" data-toggle="modal" data-target="#popup2" id="#2">Cr??er un client professionnel</button>
															<?php } ?>
															<hr>
															<label for="adress">*Adresse :</label>
															<fieldset class="invoice-address form-group">
																<textarea name="adressefirst" id="adresse" class="form-control" rows="4" placeholder="Mountain View, Californie, ??tats-Unis"></textarea>
															</fieldset>
														</div>
														<div class="col-lg-6 col-md-12 mt-25" style="padding-top: 0px;">
															<div class="form-group">
																<label for="email">*Code postal :</label>
																<input type="number" name="codePostal" class=" form-control" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
																<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
															</div>
															<div class="form-group">
																<label for="email">*D??partement :</label>
																<select name="departementfirst" id="ville" class="form-control " required></select>
															</div>
															<label for="email">Email :</label>
															<fieldset class="invoice-address form-group">
																<input name="emailfirst" id="email" type="email" class="form-control" placeholder="Email" >
															</fieldset>
															<label for="email">TEL :</label>
															<fieldset class="invoice-address form-group">
																<input name="telfirst" id="telephone" type="text" class="form-control" placeholder="T??l??phone">
															</fieldset>
														</div>
													</div>
													<hr>

													<input type="button" value="+ Ajouter une adresse de livraison (facultatif)" onclick="masquer_div('a_masquer');" class="btn btn-outline-primary col-lg-12 col-md-12 mt-25"/>
																		<!-- adresse livraison -->
													<div id="a_masquer" class="row invoice-info" style="display:none;">
														<div class="col-lg-6 col-md-12 mt-25">

															<label for="adresse">Adresse de livraison (facultative) :</label>
															<fieldset class="invoice-address form-group">
																<textarea name="adressetwo" id="adresse" class="form-control" rows="4" placeholder="Mountain View, Californie, ??tats-Unis"></textarea>
															</fieldset>
														</div>
														<div class="col-lg-6 col-md-12 mt-25" style="padding-top: 0px;">
															<div class="form-group">
																<label for="email">Code postal :</label>
																<input type="number" name="codePostal2" class=" form-control" placeholder="Code Postal" onkeyup="getCp2($(this))" autocomplete="off">
																<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
															</div>

															<div class="form-group">
																<label for="email">D??partement :</label>
																<select name="departementtwo" id="ville2" class="form-control " ></select>
															</div>

														</div>
													</div>
													<br>
												</div>

													<div class="card-body pt-50 col-lg-12  ">
														<!-- product details table-->
														<div class="invoice-product-details ">
															<div data-repeater-list="group-a">
																<div data-repeater-item>
																	<div class="row mb-50">
																		<div class="col-3 col-md-3 invoice-item-title">
																			Article
																		</div>
																		<div class="col-2 invoice-item-title">
																			Prix Unitaire
																		</div>
																		<div class="col-2 invoice-item-title">
																			Quantite
																		</div>
																		<div class="col-2 invoice-item-title">
																			Prix HT
																		</div>
                                    <div class="col-1 invoice-item-title">
  																		R??f??rence
  																	</div>
																	</div>
																	<div class="invoice-item d-flex border rounded mb-1">
																		<div class="invoice-item-filed row pt-1 px-1">
																			<div class="col-12 col-md-4 form-group">
																				<select id="article" class="form-control invoice-item-select">
																					<option value="Pas d'article">S??lectionnez un article</option>
																					<optgroup label="Liste des articles"></optgroup>
																					<!-- list de tous les articles pr??sents dans la table article -->
																					<?php foreach($article as $articlee): ?>
																					<option value="<?= $articlee['article'] ?>"><?= $articlee['article'] ?></option>
																					<?php endforeach; ?>
																					<optgroup label="Autres options">
																						<option value="Pas d'article">Autres</option>
																					</optgroup>
																				</select>
																			</div>
																			<div class="col-md-3 col-12 form-group">
																				<input name="cout" id="cout" type="number" class="form-control" placeholder="0" onkeyup="myFunction()" step="any">
																			</div>
																			<div class="col-md-3 col-12 form-group">
																				<input name="quantite" id="quantite" type="number" value="" class="form-control" placeholder="" onkeyup="myFunction()" step="any">
																			</div>
																			<div class="col-md-2 col-12 form-group">
																				&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
																				<!-- prix de quantit??*prix en js -->
																				<strong id="demo" class="text-primary align-middle">00.00 ???</strong>
																			</div>
																			<?php // Permission de niveau 2 pour cr??er un article
                        													if (permissions()['articles'] >= 2) { ?>
																				<div class="col-md-4 col-12 form-group">
																					<button type="button" class="btn btn-primary" style="margin-top: 25px" data-toggle="modal" data-target="#popup3">Nouvel article</button>
																					<!-- popup article d??plac?? -->
																				</div>
																			<?php } ?>
																		</div>
																		<div class="col-md-3 col-12 form-group" style="margin-top: 15px;">
																			<!--
																			<label for="ref">REF :</label>
																			-->
																			<input name="referencearticle"  id="referencearticle" type="text" class="form-control" placeholder="R??f??rence">
																		</div>
																		<div class="invoice-icon d-flex flex-column justify-content-between border-left p-25">
																			<div class="dropdown" style="margin-top: 15px;">
																				<i class="bx bx-cog cursor-pointer dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
																				<div class="dropdown-menu p-1">
																					<div class="row">
																						<div class="col-12 form-group">
																							<label for="discount">Remise(%)</label>
																							<input name="remise" id="remise" value="0" type="number" class="form-control" id="discount" placeholder="remise" maxlength="3" min="0" max="100">
																						</div>
																						<div class="col-12 form-group">
																							<label for="discount">Tva(%)</label>
																							<input name="tva" id="tva" value="20" type="number" class="form-control" id="discount" placeholder="0" maxlength="3" min="0" max="100">
																						</div>
																						<div class="col-12 form-group">
																							<label>Unite de mesure :</label>
																							<input name="umesure" id="umesure"  type="text" class="form-control" placeholder="Unite de mesure">
																						</div>

																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													</div>

															<div class="form-group">
																	<div class="col p-0">
																		<button class="btn btn-light-primary btn-sm" type="button">
																			<i class="bx bx-plus"></i>
																			<span type="button" name="insert" id="button_send" class="invoice-repeat-btn">Ajouter l'article</span>
																		</button>
																	</div>
																</div>
																<table id="table" name="table" class="table table-bordered">
																	<style>
																		.red
																		{
																			color: red;
																		}

																		.line
																		{
																			text-decoration: underline;
																		}
																	</style>
																	<tbody>
																		<tr>
																			<th>
																				bon
																			</th>
																			<th>
																				Ref
																			</th>
																			<th>
																				Nom
																			</th>
																			<th>
																				Pu
																			</th>
																			<th>
																				Qt
																			</th>
																			<th>
																				U
																			</th>
																			<th>
																				Tva(%)
																			</th>
																			<th>
																				Red(%)
																			</th>
																			<tr>
																	</tbody>
																</table>
															</div>

														<!-- invoice subtotal -->
																<hr>

													<div class="card-body">
															<div class="invoice-subtotal pt-50">
																<div class="row">
																	<div class="col-lg-12 col-12"></div>
																	<div class="col-md-6 col-12">
																		<div class="form-group">
																			<label>Accompte :</label>
																			<input name="accompte" type="number" value="0" class="form-control" placeholder="Ajouter un accompte sur le bon">
																		</div>
																		<div class="form-group">
																			<label>Modalit?? de paiement:</label>
																			<select name="modalite" class="form-control invoice-item-select">
																				<option value="Non d??finie" selected>Selectionnez une modalite</option>
																				<option value="CB">CB</option>
																				<option value="Ch??que">Ch??que</option>
																				<option value="Esp??ce">Espece</option>
																				<option value="Virement">Virement</option>
																				<option value="Pr??l??vement">Pr??l??vement</option>
																			</select>
																		</div>
																		<label>Monnaie :</label>
																		<div class="form-group" id="etiq">
																			<select name="monnaie" class="form-control invoice-item-select">
																				<option value="???" selected>???</option>
																				<option value="$">$</option>
																				<option value="Dinar">Dinar</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-md-6 col-12">
																		<div class="form-group">
																			<label>Commentaire :</label>
																			<input name="note" type="text" class="form-control" placeholder="Ajouter une note client">
																		</div>
																		<label for="etiq">Etiquette :</label>
																		<div class="form-group" id="etiq">
																			<select name="etiquette" class="form-control invoice-item-select">
																				<option value="Inconnue" selected>Inconnue</option>
																				<option value="Electronique">Electronique</option>
																				<option value="D??coration">D??coration</option>
																				<option value="Ecommerce">Ecommerce</option>
																				<option value="Autre">Autre</option>
																			</select>
																		</div>
																		<label >Statut :</label>
																		<div class="form-group">
																			<select name="statut" class="form-control invoice-item-select">
																				<option value="NON PAYE" selected>Non pay??</option>
																				<option value="PAYE">Pay??</option>
																			</select>
																		</div>
																	</div>
																	<div class="col-lg-12 col-12">
																		<ul class="list-group list-group-flush">
																			<li class="list-group-item border-0 pb-0">
																				<style>
																					.green
																					{
																						background: #43b546;
																						color: white;
																					}

																					.green:hover
																					{
																						background: #3fff45;
																						color: white;
																					}
																				</style>
																				<!-- Boutons qui envoient le form global. Attention aux div en trop ou mal indent??es car il ne fonctionnerait plus. -->
																				<input name="insert" id="button_save" type="button" value="V??rification" class="btn btn-primary btn-block subtotal-preview-btn" onclick="buttonc()"/>
																				<input name="insert" id="subbt" type="hidden" value="Sauvegarder" class="btn btn btn-block subtotal-preview-btn green"/>
																			</li>
																		</ul>
																	</div>
																</div>
															</div>
														</div>
													</div>
                                    	</div>
                                </form>
								<!-- POPUPS en html des cr??ation de clients ainsi que d'article -->
								<!-- DEBUT DES FORMS -->
											<!-- logo and title -->
											<div class="card-body">
												<div class="row invoice-info">
													<!-- FORMULAIRE PARTICULIER -->
																<div class="col-lg-6 col-md-12 mt-25" style=" padding-top: 0px; ">
																	<!-- Pop-up -->
																	<div id="popup" class="modal">
																		<div class="modal-dialog modal-dialog-centered">
																			<div class="modal-content">
																				<div class="h-auto card">
																					<div class="card-content">
																						<div class="card-body">
																							<ul class="nav nav-tabs mb-2" role="tablist">
																								<li class="nav-item">
																									<a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
																										<i class="bx bx-user mr-25"></i>
																										<span class="d-none d-sm-block">Info Particulier</span>
																									</a>
																								</li>
																							</ul>
																							<div class="tab-content">
																								<div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
																									<!-- users edit media object start -->
																									<!--
																									<form action="php/insert_image_edit.php" method="POST" enctype="multipart/form-data">
																										<div class="media mb-2">
																											<a class="mr-2" href="#"><img src="../../../src/img/<?= $entreprisee['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64"></a>
																											<div class="media-body">
																												<h4 class="media-heading">Image du fournisseur</h4>
																												<div class="col-12 px-0 d-flex">
																													<input type="file" name="FILES" accept="image/png, image/jpg, image/jpeg" >
																												</div>
																												<br>
																												<input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
																											</div>
																										</div>
																									</form>
																									-->
																									<!-- users edit media object ends -->
																									<!-- users edit account form start -->
																									<form action="php/insert_popupbonc.php" method="POST">
																										<input type="hidden" name="cat" value="Particulier">
																										<div class="row">
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<div class="controls">
																														<label>*Nom :</label>
																														<input name="name_client" type="text" class="form-control" placeholder="Nom du particulier" >
																													</div>
																												</div>
																												<div class="form-group">
																													<div class="controls">
																														<label>*prenom :</label>
																														<input name="prenom" type="text" class="form-control" placeholder="Pr??nom du particulier" >
																													</div>
																												</div>
																												<div class="form-group">
																													<div class="form-group">
																														<div class="controls">
																															<label>*Adresse :</label>
																															<input name="adresse" type="text" class="form-control" placeholder="Adresse du particulier">
																														</div>
																													</div>
																													<div class="controls">
																														<label>Iban :</label>
																														<input placeholder="FR-" name="iban" type="text" class="form-control">
																													</div>
																													<br>
																													<label>*Secteur d'activit?? :</label>
																													<fieldset class="invoice-address form-group">
																														<select name="secteur" class="form-control invoice-item-select" >
																															<option></option>
																															<option value="Agroalimentaire">Agroalimentaire</option>
																															<option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
																															<option value="Chimie / Parachimie">Chimie / Parachimie</option>
																															<option value="??lectronique / ??lectricit??">??lectronique / ??lectricit??</option>
																															<option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
																															<option value="Machines et ??quipements / Automobile">Machines et ??quipements / Automobile</option>
																															<option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
																															<option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
																															<option value="Banque / Assurance">Banque / Assurance</option>
																															<option value="BTP / Mat??riaux de construction">BTP / Mat??riaux de construction</option>
																															<option value="Commerce / N??goce / Distribution">Commerce / N??goce / Distribution</option>
																															<option value="??dition / Communication / Multim??dia">??dition / Communication / Multim??dia</option>
																															<option value="??tudes et conseils">??tudes et conseils</option>
																															<option value="Informatique / T??l??coms">Informatique / T??l??coms</option>
																															<option value="M??tallurgie / Travail du m??tal">M??tallurgie / Travail du m??tal</option>
																															<option value="Transports / Logistique">Transports / Logistique</option>
																															<option value="Services aux entreprises">Services aux entreprises</option>
																															<option value="Autres">Autres</option>
																														</select>
																													</fieldset>
																												</div>
																											</div>
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<label>*Num??ros de t??l??phone :</label>
																													<input name="tel" type="text" class="form-control" placeholder="Num??ros de t??l??phone du particulier" >
																												</div>
																												<div class="form-group">
																													<div class="controls">
																														<label>*Email :</label>
																														<input name="email" type="text" class="form-control" placeholder="Email du particulier" >
																													</div>
																												</div>
																												<div class="form-group">
																													<label>Siteweb de la soci??t?? :</label>
																													<input name="siteweb" type="text" class="form-control" placeholder="www.monclientparticulier.fr">
																												</div>
																												<div class="form-group">
																													<div class="controls">
																														<label>*Pays :</label>
																														<fieldset class="invoice-address form-group">
																															<select name="pays" class="form-control invoice-item-select" >
																																<option></option>
																																<optgroup label="Europe">
																																	<option value="allemagne">Allemagne</option>
																																	<option value="albanie">Albanie</option>
																																	<option value="andorre">Andorre</option>
																																	<option value="autriche">Autriche</option>
																																	<option value="bielorussie">Bi??lorussie</option>
																																	<option value="belgique">Belgique</option>
																																	<option value="bosnieHerzegovine">Bosnie-Herz??govine</option>
																																	<option value="bulgarie">Bulgarie</option>
																																	<option value="croatie">Croatie</option>
																																	<option value="danemark">Danemark</option>
																																	<option value="espagne">Espagne</option>
																																	<option value="estonie">Estonie</option>
																																	<option value="finlande">Finlande</option>
																																	<option value="france">France</option>
																																	<option value="grece">Gr??ce</option>
																																	<option value="hongrie">Hongrie</option>
																																	<option value="irlande">Irlande</option>
																																	<option value="islande">Islande</option>
																																	<option value="italie">Italie</option>
																																	<option value="lettonie">Lettonie</option>
																																	<option value="liechtenstein">Liechtenstein</option>
																																	<option value="lituanie">Lituanie</option>
																																	<option value="luxembourg">Luxembourg</option>
																																	<option value="exRepubliqueYougoslaveDeMacedoine">Ex-R??publique Yougoslave de Mac??doine</option>
																																	<option value="malte">Malte</option>
																																	<option value="moldavie">Moldavie</option>
																																	<option value="monaco">Monaco</option>
																																	<option value="norvege">Norv??ge</option>
																																	<option value="paysBas">Pays-Bas</option>
																																	<option value="pologne">Pologne</option>
																																	<option value="portugal">Portugal</option>
																																	<option value="roumanie">Roumanie</option>
																																	<option value="royaumeUni">Royaume-Uni</option>
																																	<option value="russie">Russie</option>
																																	<option value="saintMarin">Saint-Marin</option>
																																	<option value="serbieEtMontenegro">Serbie-et-Mont??n??gro</option>
																																	<option value="slovaquie">Slovaquie</option>
																																	<option value="slovenie">Slov??nie</option>
																																	<option value="suede">Su??de</option>
																																	<option value="suisse">Suisse</option>
																																	<option value="republiqueTcheque">R??publique Tch??que</option>
																																	<option value="ukraine">Ukraine</option>
																																	<option value="vatican">Vatican</option>
																																</optgroup>
																																<optgroup label="Afrique">
																																	<option value="afriqueDuSud">Afrique Du Sud</option>
																																	<option value="algerie">Alg??rie</option>
																																	<option value="angola">Angola</option>
																																	<option value="benin">B??nin</option>
																																	<option value="botswana">Botswana</option>
																																	<option value="burkina">Burkina</option>
																																	<option value="burundi">Burundi</option>
																																	<option value="cameroun">Cameroun</option>
																																	<option value="capVert">Cap-Vert</option>
																																	<option value="republiqueCentre-Africaine">R??publique Centre-Africaine</option>
																																	<option value="comores">Comores</option>
																																	<option value="republiqueDemocratiqueDuCongo">R??publique D??mocratique Du Congo</option>
																																	<option value="congo">Congo</option>
																																	<option value="coteIvoire">C??te d'Ivoire</option>
																																	<option value="djibouti">Djibouti</option>
																																	<option value="egypte">??gypte</option>
																																	<option value="ethiopie">??thiopie</option>
																																	<option value="erythr??e">??rythr??e</option>
																																	<option value="gabon">Gabon</option>
																																	<option value="gambie">Gambie</option>
																																	<option value="ghana">Ghana</option>
																																	<option value="guinee">Guin??e</option>
																																	<option value="guinee-Bisseau">Guin??e-Bisseau</option>
																																	<option value="guineeEquatoriale">Guin??e ??quatoriale</option>
																																	<option value="kenya">Kenya</option>
																																	<option value="lesotho">Lesotho</option>
																																	<option value="liberia">Liberia</option>
																																	<option value="libye">Libye</option>
																																	<option value="madagascar">Madagascar</option>
																																	<option value="malawi">Malawi</option>
																																	<option value="mali">Mali</option>
																																	<option value="maroc">Maroc</option>
																																	<option value="maurice">Maurice</option>
																																	<option value="mauritanie">Mauritanie</option>
																																	<option value="mozambique">Mozambique</option>
																																	<option value="namibie">Namibie</option>
																																	<option value="niger">Niger</option>
																																	<option value="nigeria">Nigeria</option>
																																	<option value="ouganda">Ouganda</option>
																																	<option value="rwanda">Rwanda</option>
																																	<option value="saoTomeEtPrincipe">Sao Tom??-et-Principe</option>
																																	<option value="senegal">S??ngal</option>
																																	<option value="seychelles">Seychelles</option>
																																	<option value="sierra">Sierra</option>
																																	<option value="somalie">Somalie</option>
																																	<option value="soudan">Soudan</option>
																																	<option value="swaziland">Swaziland</option>
																																	<option value="tanzanie">Tanzanie</option>
																																	<option value="tchad">Tchad</option>
																																	<option value="togo">Togo</option>
																																	<option value="tunisie">Tunisie</option>
																																	<option value="zambie">Zambie</option>
																																	<option value="zimbabwe">Zimbabwe</option>
																																</optgroup>
																																<optgroup label="Am??rique">
																																	<option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
																																	<option value="argentine">Argentine</option>
																																	<option value="bahamas">Bahamas</option>
																																	<option value="barbade">Barbade</option>
																																	<option value="belize">Belize</option>
																																	<option value="bolivie">Bolivie</option>
																																	<option value="bresil">Br??sil</option>
																																	<option value="canada">Canada</option>
																																	<option value="chili">Chili</option>
																																	<option value="colombie">Colombie</option>
																																	<option value="costaRica">Costa Rica</option>
																																	<option value="cuba">Cuba</option>
																																	<option value="republiqueDominicaine">R??publique Dominicaine</option>
																																	<option value="dominique">Dominique</option>
																																	<option value="equateur">??quateur</option>
																																	<option value="etatsUnis">??tats Unis</option>
																																	<option value="grenade">Grenade</option>
																																	<option value="guatemala">Guatemala</option>
																																	<option value="guyana">Guyana</option>
																																	<option value="haiti">Ha??ti</option>
																																	<option value="honduras">Honduras</option>
																																	<option value="jamaique">Jama??que</option>
																																	<option value="mexique">Mexique</option>
																																	<option value="nicaragua">Nicaragua</option>
																																	<option value="panama">Panama</option>
																																	<option value="paraguay">Paraguay</option>
																																	<option value="perou">P??rou</option>
																																	<option value="saintCristopheEtNieves">Saint-Cristophe-et-Ni??v??s</option>
																																	<option value="sainteLucie">Sainte-Lucie</option>
																																	<option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
																																	<option value="salvador">Salvador</option>
																																	<option value="suriname">Suriname</option>
																																	<option value="triniteEtTobago">Trinit??-et-Tobago</option>
																																	<option value="uruguay">Uruguay</option>
																																	<option value="venezuela">Venezuela</option>
																																</optgroup>
																																<optgroup label="Asie">
																																	<option value="afghanistan">Afghanistan</option>
																																	<option value="arabieSaoudite">Arabie Saoudite</option>
																																	<option value="armenie">Arm??nie</option>
																																	<option value="azerbaidjan">Azerba??djan</option>
																																	<option value="bahrein">Bahre??n</option>
																																	<option value="bangladesh">Bangladesh</option>
																																	<option value="bhoutan">Bhoutan</option>
																																	<option value="birmanie">Birmanie</option>
																																	<option value="brunei">Brun??i</option>
																																	<option value="cambodge">Cambodge</option>
																																	<option value="chine">Chine</option>
																																	<option value="coreeDuSud">Cor??e Du Sud</option>
																																	<option value="coreeDuNord">Cor??e Du Nord</option>
																																	<option value="emiratsArabeUnis">??mirats Arabe Unis</option>
																																	<option value="georgie">G??orgie</option>
																																	<option value="inde">Inde</option>
																																	<option value="indonesie">Indon??sie</option>
																																	<option value="iraq">Iraq</option>
																																	<option value="iran">Iran</option>
																																	<option value="israel">Isra??l</option>
																																	<option value="japon">Japon</option>
																																	<option value="jordanie">Jordanie</option>
																																	<option value="kazakhstan">Kazakhstan</option>
																																	<option value="kirghistan">Kirghistan</option>
																																	<option value="koweit">Kowe??t</option>
																																	<option value="laos">Laos</option>
																																	<option value="liban">Liban</option>
																																	<option value="malaisie">Malaisie</option>
																																	<option value="maldives">Maldives</option>
																																	<option value="mongolie">Mongolie</option>
																																	<option value="nepal">N??pal</option>
																																	<option value="oman">Oman</option>
																																	<option value="ouzbekistan">Ouzb??kistan</option>
																																	<option value="pakistan">Pakistan</option>
																																	<option value="philippines">Philippines</option>
																																	<option value="qatar">Qatar</option>
																																	<option value="singapour">Singapour</option>
																																	<option value="sriLanka">Sri Lanka</option>
																																	<option value="syrie">Syrie</option>
																																	<option value="tadjikistan">Tadjikistan</option>
																																	<option value="taiwan">Ta??wan</option>
																																	<option value="thailande">Tha??lande</option>
																																	<option value="timorOriental">Timor oriental</option>
																																	<option value="turkmenistan">Turkm??nistan</option>
																																	<option value="turquie">Turquie</option>
																																	<option value="vietNam">Vi??t Nam</option>
																																	<option value="yemen">Yemen</option>
																																</optgroup>
																																<optgroup label="Oc??anie">
																																	<option value="australie">Australie</option>
																																	<option value="fidji">Fidji</option>
																																	<option value="kiribati">Kiribati</option>
																																	<option value="marshall">Marshall</option>
																																	<option value="micronesie">Micron??sie</option>
																																	<option value="nauru">Nauru</option>
																																	<option value="nouvelleZelande">Nouvelle-Z??lande</option>
																																	<option value="palaos">Palaos</option>
																																	<option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guin??e</option>
																																	<option value="salomon">Salomon</option>
																																	<option value="samoa">Samoa</option>
																																	<option value="tonga">Tonga</option>
																																	<option value="tuvalu">Tuvalu</option>
																																	<option value="vanuatu">Vanuatu</option>
																																</optgroup>
																																<optgroup label="Autres pays">
																																	<option value="Autres">Autres</option>
																																</optgroup>
																															</select>
																														</fieldset>
																													</div>
																												</div>
																											</div>
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<label for="email">*Code postal :</label>
																													<input type="number" name="codePostal" class=" form-control" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
																													<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
																												</div>
																											</div>
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<label for="email">*D??partement :</label>
																													<select name="departement" id="ville" class="form-control " ></select>
																												</div>
																											</div>
																											<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																												<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																											</div>
																											<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser ?? completer les champs obligatoires*</label>

																										<!-- users edit account form ends -->
																										</div>
																									</form>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>

														<!-- FORM PRO -->
														<div class="col-lg-6 col-md-12 mt-25" style=" padding-top: 0px;">
															<div class="form-group">
																<div id="popup2" class="modal">
																	<div class="modal-dialog modal-dialog-centered">
																		<div class="modal-content">
																			<div class="h-auto card">
																				<div class="card-content">
																					<div class="card-body">
																						<ul class="nav nav-tabs mb-2" role="tablist">
																							<li class="nav-item">
																								<a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
																									<i class="bx bx-user mr-25"></i>
																									<span class="d-none d-sm-block">Info Profesionnel</span>
																								</a>
																							</li>
																						</ul>
																						<div class="tab-content">
																							<div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
																								<!-- users edit media object start -->
																								<!--
																								<form action="php/insert_image_edit.php" method="POST" enctype="multipart/form-data">
																									<div class="media mb-2">
																										<a class="mr-2" href="#"><img src="../../../src/img/<?= $entreprisee['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64"></a>
																										<div class="media-body">
																											<h4 class="media-heading">Image du fournisseur</h4>
																											<div class="col-12 px-0 d-flex">
																												<input type="file" name="FILES" accept="image/png, image/jpg, image/jpeg" >
																											</div>
																											<br>
																											<input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary">
																										</div>
																									</div>
																								</form>
																								-->
																								<!-- users edit media object ends -->
																								<!-- users edit account form start -->
																								<form action="php/insert_popupboncs.php" method="POST">
																									<input type="hidden" name="cat" value="Professionnel">
																									<div class="row">
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<div class="controls">
																													<label>*Nom de la soci??t?? :</label>
																													<input name="name_client" type="text" class="form-control" placeholder="Nom de la soci??t??" >
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>Num??ros Siret :</label>
																													<input name="numsiret" type="text" class="form-control" placeholder="N??Siret">
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="form-group">
																													<div class="controls">
																														<label>TVA Intracom :</label>
																														<input name="tvaintracom" type="text" class="form-control" placeholder="">
																													</div>
																												</div>
																												<div class="form-group">
																													<div class="controls">
																														<label>Iban :</label>
																														<input placeholder="FR-" name="iban" type="text" class="form-control">
																													</div>
																												</div>
																												<label>*Secteur d'activit?? :</label>
																												<fieldset class="invoice-address form-group">
																													<select name="secteur" class="form-control invoice-item-select" >
																														<option></option>
																														<option value="Agroalimentaire">Agroalimentaire</option>
																														<option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
																														<option value="Chimie / Parachimie">Chimie / Parachimie</option>
																														<option value="??lectronique / ??lectricit??">??lectronique / ??lectricit??</option>
																														<option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
																														<option value="Machines et ??quipements / Automobile">Machines et ??quipements / Automobile</option>
																														<option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
																														<option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
																														<option value="Banque / Assurance">Banque / Assurance</option>
																														<option value="BTP / Mat??riaux de construction">BTP / Mat??riaux de construction</option>
																														<option value="Commerce / N??goce / Distribution">Commerce / N??goce / Distribution</option>
																														<option value="??dition / Communication / Multim??dia">??dition / Communication / Multim??dia</option>
																														<option value="??tudes et conseils">??tudes et conseils</option>
																														<option value="Informatique / T??l??coms">Informatique / T??l??coms</option>
																														<option value="M??tallurgie / Travail du m??tal">M??tallurgie / Travail du m??tal</option>
																														<option value="Transports / Logistique">Transports / Logistique</option>
																														<option value="Services aux entreprises">Services aux entreprises</option>
																														<option value="Autres">Autres</option>
																													</select>
																												</fieldset>
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label>Num??ro de t??l??phone :</label>
																												<input name="tel" type="text" class="form-control" placeholder="Num??ros de t??l??phone de la soci??t??" >
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>*Email :</label>
																													<input name="email" type="text" class="form-control" placeholder="Email de la soci??t??" >
																												</div>
																											</div>
																											<div class="form-group">
																												<label>Siteweb de la soci??t?? :</label>
																												<input name="siteweb" type="text" class="form-control" placeholder="www.monclientsociete.fr">
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>*Adresse :</label>
																													<input name="adresse" type="text" class="form-control" placeholder="Adresse du siege client"  data-validation--message="L'e-mail de la societe obligatoire">
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>*Pays :</label>
																													<fieldset class="invoice-address form-group">
																														<select name="pays" class="form-control invoice-item-select" >
																															<option></option>
																															<optgroup label="Europe">
																																<option value="allemagne">Allemagne</option>
																																<option value="albanie">Albanie</option>
																																<option value="andorre">Andorre</option>
																																<option value="autriche">Autriche</option>
																																<option value="bielorussie">Bi??lorussie</option>
																																<option value="belgique">Belgique</option>
																																<option value="bosnieHerzegovine">Bosnie-Herz??govine</option>
																																<option value="bulgarie">Bulgarie</option>
																																<option value="croatie">Croatie</option>
																																<option value="danemark">Danemark</option>
																																<option value="espagne">Espagne</option>
																																<option value="estonie">Estonie</option>
																																<option value="finlande">Finlande</option>
																																<option value="france" selected>France</option>
																																<option value="grece">Gr??ce</option>
																																<option value="hongrie">Hongrie</option>
																																<option value="irlande">Irlande</option>
																																<option value="islande">Islande</option>
																																<option value="italie">Italie</option>
																																<option value="lettonie">Lettonie</option>
																																<option value="liechtenstein">Liechtenstein</option>
																																<option value="lituanie">Lituanie</option>
																																<option value="luxembourg">Luxembourg</option>
																																<option value="exRepubliqueYougoslaveDeMacedoine">Ex-R??publique Yougoslave de Mac??doine</option>
																																<option value="malte">Malte</option>
																																<option value="moldavie">Moldavie</option>
																																<option value="monaco">Monaco</option>
																																<option value="norvege">Norv??ge</option>
																																<option value="paysBas">Pays-Bas</option>
																																<option value="pologne">Pologne</option>
																																<option value="portugal">Portugal</option>
																																<option value="roumanie">Roumanie</option>
																																<option value="royaumeUni">Royaume-Uni</option>
																																<option value="russie">Russie</option>
																																<option value="saintMarin">Saint-Marin</option>
																																<option value="serbieEtMontenegro">Serbie-et-Mont??n??gro</option>
																																<option value="slovaquie">Slovaquie</option>
																																<option value="slovenie">Slov??nie</option>
																																<option value="suede">Su??de</option>
																																<option value="suisse">Suisse</option>
																																<option value="republiqueTcheque">R??publique Tch??que</option>
																																<option value="ukraine">Ukraine</option>
																																<option value="vatican">Vatican</option>
																															</optgroup>
																															<optgroup label="Afrique">
																																<option value="afriqueDuSud">Afrique Du Sud</option>
																																<option value="algerie">Alg??rie</option>
																																<option value="angola">Angola</option>
																																<option value="benin">B??nin</option>
																																<option value="botswana">Botswana</option>
																																<option value="burkina">Burkina</option>
																																<option value="burundi">Burundi</option>
																																<option value="cameroun">Cameroun</option>
																																<option value="capVert">Cap-Vert</option>
																																<option value="republiqueCentre-Africaine">R??publique Centre-Africaine</option>
																																<option value="comores">Comores</option>
																																<option value="republiqueDemocratiqueDuCongo">R??publique D??mocratique Du Congo</option>
																																<option value="congo">Congo</option>
																																<option value="coteIvoire">C??te d'Ivoire</option>
																																<option value="djibouti">Djibouti</option>
																																<option value="egypte">??gypte</option>
																																<option value="ethiopie">??thiopie</option>
																																<option value="erythr??e">??rythr??e</option>
																																<option value="gabon">Gabon</option>
																																<option value="gambie">Gambie</option>
																																<option value="ghana">Ghana</option>
																																<option value="guinee">Guin??e</option>
																																<option value="guinee-Bisseau">Guin??e-Bisseau</option>
																																<option value="guineeEquatoriale">Guin??e ??quatoriale</option>
																																<option value="kenya">Kenya</option>
																																<option value="lesotho">Lesotho</option>
																																<option value="liberia">Liberia</option>
																																<option value="libye">Libye</option>
																																<option value="madagascar">Madagascar</option>
																																<option value="malawi">Malawi</option>
																																<option value="mali">Mali</option>
																																<option value="maroc">Maroc</option>
																																<option value="maurice">Maurice</option>
																																<option value="mauritanie">Mauritanie</option>
																																<option value="mozambique">Mozambique</option>
																																<option value="namibie">Namibie</option>
																																<option value="niger">Niger</option>
																																<option value="nigeria">Nigeria</option>
																																<option value="ouganda">Ouganda</option>
																																<option value="rwanda">Rwanda</option>
																																<option value="saoTomeEtPrincipe">Sao Tom??-et-Principe</option>
																																<option value="senegal">S??ngal</option>
																																<option value="seychelles">Seychelles</option>
																																<option value="sierra">Sierra</option>
																																<option value="somalie">Somalie</option>
																																<option value="soudan">Soudan</option>
																																<option value="swaziland">Swaziland</option>
																																<option value="tanzanie">Tanzanie</option>
																																<option value="tchad">Tchad</option>
																																<option value="togo">Togo</option>
																																<option value="tunisie">Tunisie</option>
																																<option value="zambie">Zambie</option>
																																<option value="zimbabwe">Zimbabwe</option>
																															</optgroup>
																															<optgroup label="Am??rique">
																																<option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
																																<option value="argentine">Argentine</option>
																																<option value="bahamas">Bahamas</option>
																																<option value="barbade">Barbade</option>
																																<option value="belize">Belize</option>
																																<option value="bolivie">Bolivie</option>
																																<option value="bresil">Br??sil</option>
																																<option value="canada">Canada</option>
																																<option value="chili">Chili</option>
																																<option value="colombie">Colombie</option>
																																<option value="costaRica">Costa Rica</option>
																																<option value="cuba">Cuba</option>
																																<option value="republiqueDominicaine">R??publique Dominicaine</option>
																																<option value="dominique">Dominique</option>
																																<option value="equateur">??quateur</option>
																																<option value="etatsUnis">??tats Unis</option>
																																<option value="grenade">Grenade</option>
																																<option value="guatemala">Guatemala</option>
																																<option value="guyana">Guyana</option>
																																<option value="haiti">Ha??ti</option>
																																<option value="honduras">Honduras</option>
																																<option value="jamaique">Jama??que</option>
																																<option value="mexique">Mexique</option>
																																<option value="nicaragua">Nicaragua</option>
																																<option value="panama">Panama</option>
																																<option value="paraguay">Paraguay</option>
																																<option value="perou">P??rou</option>
																																<option value="saintCristopheEtNieves">Saint-Cristophe-et-Ni??v??s</option>
																																<option value="sainteLucie">Sainte-Lucie</option>
																																<option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
																																<option value="salvador">Salvador</option>
																																<option value="suriname">Suriname</option>
																																<option value="triniteEtTobago">Trinit??-et-Tobago</option>
																																<option value="uruguay">Uruguay</option>
																																<option value="venezuela">Venezuela</option>
																															</optgroup>
																															<optgroup label="Asie">
																																<option value="afghanistan">Afghanistan</option>
																																<option value="arabieSaoudite">Arabie Saoudite</option>
																																<option value="armenie">Arm??nie</option>
																																<option value="azerbaidjan">Azerba??djan</option>
																																<option value="bahrein">Bahre??n</option>
																																<option value="bangladesh">Bangladesh</option>
																																<option value="bhoutan">Bhoutan</option>
																																<option value="birmanie">Birmanie</option>
																																<option value="brunei">Brun??i</option>
																																<option value="cambodge">Cambodge</option>
																																<option value="chine">Chine</option>
																																<option value="coreeDuSud">Cor??e Du Sud</option>
																																<option value="coreeDuNord">Cor??e Du Nord</option>
																																<option value="emiratsArabeUnis">??mirats Arabe Unis</option>
																																<option value="georgie">G??orgie</option>
																																<option value="inde">Inde</option>
																																<option value="indonesie">Indon??sie</option>
																																<option value="iraq">Iraq</option>
																																<option value="iran">Iran</option>
																																<option value="israel">Isra??l</option>
																																<option value="japon">Japon</option>
																																<option value="jordanie">Jordanie</option>
																																<option value="kazakhstan">Kazakhstan</option>
																																<option value="kirghistan">Kirghistan</option>
																																<option value="koweit">Kowe??t</option>
																																<option value="laos">Laos</option>
																																<option value="liban">Liban</option>
																																<option value="malaisie">Malaisie</option>
																																<option value="maldives">Maldives</option>
																																<option value="mongolie">Mongolie</option>
																																<option value="nepal">N??pal</option>
																																<option value="oman">Oman</option>
																																<option value="ouzbekistan">Ouzb??kistan</option>
																																<option value="pakistan">Pakistan</option>
																																<option value="philippines">Philippines</option>
																																<option value="qatar">Qatar</option>
																																<option value="singapour">Singapour</option>
																																<option value="sriLanka">Sri Lanka</option>
																																<option value="syrie">Syrie</option>
																																<option value="tadjikistan">Tadjikistan</option>
																																<option value="taiwan">Ta??wan</option>
																																<option value="thailande">Tha??lande</option>
																																<option value="timorOriental">Timor oriental</option>
																																<option value="turkmenistan">Turkm??nistan</option>
																																<option value="turquie">Turquie</option>
																																<option value="vietNam">Vi??t Nam</option>
																																<option value="yemen">Yemen</option>
																															</optgroup>
																															<optgroup label="Oc??anie">
																																<option value="australie">Australie</option>
																																<option value="fidji">Fidji</option>
																																<option value="kiribati">Kiribati</option>
																																<option value="marshall">Marshall</option>
																																<option value="micronesie">Micron??sie</option>
																																<option value="nauru">Nauru</option>
																																<option value="nouvelleZelande">Nouvelle-Z??lande</option>
																																<option value="palaos">Palaos</option>
																																<option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guin??e</option>
																																<option value="salomon">Salomon</option>
																																<option value="samoa">Samoa</option>
																																<option value="tonga">Tonga</option>
																																<option value="tuvalu">Tuvalu</option>
																																<option value="vanuatu">Vanuatu</option>
																															</optgroup>
																															<optgroup label="Autres pays">
																																<option value="Autres">Autres</option>
																															</optgroup>
																														</select>
																													</fieldset>
																												</div>
																											</div>
																										</div>
																										<div class="col-12">
																											<hr>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<div class="controls">
																													<label>*Nom du dirigeant :</label>
																													<input name="nom_diri" type="text" class="form-control" placeholder="Nom du dirigeant" >
																												</div>
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label>*Prenom du dirigeant :</label>
																												<input name="prenom" type="text" class="form-control" placeholder="Pr??nom du dirigeant" >
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label for="email">*Code postal :</label>
																												<input type="number" name="codePostal" class=" form-control" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
																												<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label for="email">*D??partement :</label>
																												<select name="departement" id="ville" class="form-control " ></select>
																											</div>
																										</div>
																										<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																											<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																										</div>
																										<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser ?? completer les champs obligatoires*</label>
																									</div>
																									<!-- users edit account form ends -->

																								</form>
																							</div>
																						</div>
																					</div>
																				</div>
																			</div>
																		</div>
																	</div>
																</div>
															</div>
														</div>
													<!-- FIN FORM PRO -->
												</div>
											</div>
											<!-- FIN DES 2 FORMS -->
											<div id="popup3" class="modal">
																					<div class="modal-dialog modal-dialog-centered">
																						<div class="modal-content">
																							<div class="h-auto card">
																								<div class="card-content">
																									<div class="card-body">
																										<ul class="nav nav-tabs mb-2" role="tablist">
																											<li class="nav-item">
																												<a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
																													<i class='bx bxs-purchase-tag-alt'></i>
																													<span class="d-none d-sm-block">Ajouter un article</span>
																												</a>
																											</li>
																										</ul>
																										<div class="tab-content">
																											<div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">

																												<form action="php/insert_articlespopup_bon.php" method="POST">
																													<div class="row">
																														<div class="col-12 col-sm-6">
																															<div class="form-group">
																																<div class="controls">
																																	<label>*D??signation :</label>
																																	<input name="article" type="text" class="form-control" placeholder="D??signation de l'article" >
																																</div>
																															</div>
																															<div class="form-group">
																																<div class="controls">
																																	<label>Unit??s de mesure :</label>
																																	<input name="umesure" type="text" class="form-control" placeholder="Unit??s de mesure">
																																</div>
																															</div>
																														</div>
																														<div class="col-12 col-sm-6">
																															<div class="form-group">
																																<label>R??f??rence de l'article :</label>
																																<input name="referencearticle" type="text" class="form-control" placeholder="R??f??rence de l'article">
																															</div>
                                                              <!-- selectionner si c un bien ou un service -->
                                                              <div class="form-group">
                                                                  <label>Cat??gorie :</label>
                                                                  <select class="form-control" name="categorie">
                                                                    <option value="bien">Bien</option>
                                                                    <option value="service">Service</option>
                                                                  </select>
                                                              </div>
                                                              <div class="form-group">
                                                                <label>Type :</label>
                                                                  <!-- selectionner si le type du bien -->
                                                                  <select class="form-control" name="sstyp">
                                                                    <optgroup label="Bien">
                                                                      <option value="marchandise">Marchandise</option>
                                                                      <option value="produit fini">Produits fini</option>
                                                                      <option value="produit semi fini">Produits semi fini</option>
                                                                      <option value="Matiere 1ere">Matiere 1ere</option>
                                                                      <option value="fourniture">Fournitures</option>
                                                                      <option value="consommable">Consommable</option>
                                                                     </optgroup>
                                                                    <optgroup label="Service">
                                                                      <option value="prestation">Prestation</option>
                                                                      <option value="travaux">Travaux</option>
                                                                      <option value="etudes">Etudes</option>
                                                                    </optgroup>
                                                                  </select>
                                                              </div>
																														</div>
																														<div class="col-12">
																															<hr>
																															<style>
																																.line
																																{
																																	text-decoration: underline;
																																}
																															</style>
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
																																	<input name="prixvente" type="number" class="form-control" placeholder="Prix de vente de l'article">
																																</div>
																																<div class="controls">
																																	<label>Tva vente :</label>
																																	<fieldset class="invoice-address form-group">
																																		<select name="tvavente" class="form-control invoice-item-select">
																																			<option value="20">Taux normal : 20 %</option>
																																			<option value="10">Taux interm??diaire : 10 %</option>
																																			<option value="5.5">Taux r??duit : 5.5 %</option>
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
																																	<label>Cout d'achat HT :</label>
																																	<input name="coutachat" type="number" class="form-control" placeholder="Cout d'achat de l'article">
																																</div>
																																<div class="controls">
																																	<label>Tva achat :</label>
																																	<fieldset class="invoice-address form-group">
																																		<select name="tvaachat" class="form-control invoice-item-select">
																																			<option value="20">Taux normal : 20 %</option>
																																			<option value="10">Taux interm??diaire : 10 %</option>
																																			<option value="5.5">Taux r??duit : 5.5 %</option>
																																			<option value="2.1">Taux particulier : 2.1 %</option>
																																			<option value="0">Taux nul : 0 %</option>
																																		</select>
																																	</fieldset>
																																</div>
																															</div>
																														</div>
																														<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																															<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																														</div>
																														<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser ?? completer les champs obligatoires*</label>
																													</div>
																													<!-- users edit account form ends -->
																												</form>

																										</div>
																									</div>
																								</div>
																							</div>
																						</div>
																					</div>
																				</div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
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
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
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
    <script src="../../../app-assets/js/scripts/pages/app-add_bon.js"></script>
    <script src="../../../app-assets/js/scripts/pages/myFunction_facture.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/getcp.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/getcp2.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/getcp3.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/getcp4.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/masquer.js"></script>
    <script src="../../../app-assets/js/scripts/pages/complete-facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
    <!-- END: Page JS-->
 	  <script src="script.js"></script>
    <!-- END: Page JS-->
<!-- partial -->
  	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script  src="./script.js"></script>


</body>
<!-- END: Body-->

</html>
