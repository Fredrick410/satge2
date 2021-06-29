<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';
   
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

	$pdiSt = $bdd->prepare('SELECT * FROM articles INNER JOIN facture ON articles.id_fac = facture.id');
	$pdoSt->execute();

	$pdaSt = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num');
	$pdaSt->bindValue(':num', $_SESSION['id_session']);
	$pdaSt->execute();
	$cliet = $pdaSt->fetch();

	$total = $cliet['cout']*$cliet['quantite'];

	$incre = $bdd->prepare('SELECT MAX(id) FROM facture ');
	$incre->execute();
	$test = $incre->fetch();
	$maxid = $test['MAX(id)'] + 1;
	

	
   
	// Auto incrémentation de l'ID de la facture
    $max_num = "";
    $pdoSt = $bdd->prepare('SELECT id FROM facture');
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

            $pdoSt = $bdd->prepare('SELECT numerosfacture FROM facture WHERE id_session = :num');
            $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
            $pdoSt->execute(); 
            $incrementation = $pdoSt->fetchAll();
            $count_incrementation = count($incrementation);
            $max_incrementation = "0";

            for ($i=0; $i < $count_incrementation ; $i++) { 
                foreach($incrementation as $incrementations):

                    $numeros = $incrementations['numerosfacture'];
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
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Ajouter facture</title>
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
    <?php $btnreturn = true;
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
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                <form autocomplete="off"  method="POST" action="php/insert_facture.php">
                                        <div class="row mx-0" > 
													<!-- Contenue du haut de l'ajout de facture DEBUT -->
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
														<h6 class="invoice-number mr-75">
															N°
														
														</h6>
														<input  type="text" name="numeroarticle" id="numeros"  value='<?= $maxid ?>' class="form-control pt-25 w-50" placeholder="FAC-0" attribut readonly="readonly">
													</div>			
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
														<h6 class="invoice-number mr-75">
															Référence
														</h6>
														<input name="reffacture" id="reffacture" type="text" value='REF-' class="form-control pt-20 w-50" placeholder="XXX-">
														<p style='position: relative; top: 7px;'>
															&nbsp&nbsp&nbsp 
														</p>
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
														<h6 class="invoice-number mr-75">
															Facture N°
														</h6>
														<input type="number" name="numerosfacture" value='<?= $max_incrementation ?>' class="form-control pt-25 w-50" placeholder="00000">
														<p style='position: relative; top: 7px; display: <?php if($entreprise['incrementation'] == "no"){echo "none";} ?>;'>
															&nbsp&nbsp&nbsp FAC-
															<?= date('y') ?>
															(année)
															<?= substr($max_incrementation, 2) ?>
															(numéro) 
															<label>&nbsp&nbsp&nbsp MODE AUTO-INCREMENTATION : <label style='color: <?php if($entreprise['incrementation'] == "yes"){echo "green";}else{echo "red";} ?>;'><?php if($entreprise['incrementation'] == "yes"){echo "On";}else{echo "Off";} ?></label></label>
														</p>
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
														<div class="d-flex align-items-center">
															<small class="text-muted mr-75">
																Date: 
															</small>
															<fieldset class="d-flex ">
																<input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" value="<?php echo date("d/m/Y");?>">
															</fieldset>
														</div>
													</div>
													<div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
														<div class="d-flex align-items-center">
															<small class="text-muted mr-75">
																Date d'échéance : 
															</small>
															<fieldset class="d-flex justify-content-end">
																<input name="dateecheance" id="dateecheance" type="date" class="form-control mb-50 mb-sm-0" placeholder="jj-mm-aa">
															</fieldset>
														</div>
													</div>
												<!-- Contenue du haut de l'ajout de facture FIN -->
												<!-- logo and title -->
												<div class="col-lg-12 col-md-12 mt-25">
													<div class="row my-2 py-50">
														<div class="col-sm-6 col-12 order-2 order-sm-1" style="text-align:center;padding-top:4%">
															<h4 class="text-primary">Facture</h4>
															<input name="nomproduit" id="nomproduit" type="text" class="form-control" placeholder="Nom de la facture">
															<ul class="list-group list-group-flush">
																<div class="form-group">
																	<label for="exampleFormControlTextarea1">Description</label>
																	<textarea class="form-control" name="descrip" id="exampleFormControlTextarea1" rows="5"></textarea>
																</div>
															</ul>
														</div>
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
																<select name="facturepour" id="facturepour" class="form-control invoice-item-select">
																	<option value="Pas de clients">Sélectionnez un client</option>
																	<?php foreach($client as $clientt): ?>
																	<option value="<?= $clientt['name_client'] ?>"><?= $clientt['name_client'] ?></option>
																	<?php endforeach; ?>
																</select>
															</div>
															<button type="button" class="btn btn-primary col-lg-4 col-md-12 mt-25" style="margin-left: 15px" data-toggle="modal" data-target="#popup">Créer un client particulier</button>
															<button type="button" class="btn btn-primary col-lg-4 col-md-12 mt-25" style="margin-left: 15px" data-toggle="modal" data-target="#popup2" id="#2">Créer un client professionnel</button>
															<hr>
															<label for="adresse">*Adresse :</label>
															<fieldset class="invoice-address form-group">
																<textarea name="adressefirst" id="adresse" class="form-control" rows="4" placeholder="Mountain View, Californie, États-Unis"></textarea>
															</fieldset>
														</div>
														<div class="col-lg-6 col-md-12 mt-25" style="padding-top: 0px;">
															<div class="form-group">
																<label for="email">*Code postal :</label>
																<input type="number" name="codePostal1" class=" form-control" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
																<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
															</div>
															
															<div class="form-group">
																<label for="email">*Département :</label>
																<select name="departementfirst" id="ville" class="form-control " ></select>
															</div>													
															<label for="email">Email :</label>
															<fieldset class="invoice-address form-group">
																<input name="emailfirst" id="email" type="email" class="form-control">
															</fieldset>
															<label for="email">TEL :</label>
															<fieldset class="invoice-address form-group">
																<input name="telfirst" id="telephone" type="text" class="form-control" >
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
																<textarea name="adressetwo" id="adresse" class="form-control" rows="4" placeholder="Mountain View, Californie, États-Unis"></textarea>
															</fieldset>
														</div>
														<div class="col-lg-6 col-md-12 mt-25" style="padding-top: 0px;">
															<div class="form-group">
																<label for="email">Code postal :</label>
																<input type="number" name="codePostal2" class=" form-control" placeholder="Code Postal" onkeyup="getCp2($(this))" autocomplete="off">
																<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
															</div>
															
															<div class="form-group">
																<label for="email">Département :</label>
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
																		<div class="col-1 invoice-item-title">
																			Prix HT
																		</div>
																	</div>
																	<div class="invoice-item d-flex border rounded mb-1">
																		<div class="invoice-item-filed row pt-1 px-1">
																			<div class="col-12 col-md-4 form-group">
																				<select id="article" class="form-control invoice-item-select">
																					<option value="Pas d'article">Sélectionnez un article</option>
																					<optgroup label="Liste des articles"></optgroup>
																					<?php foreach($article as $articlee): ?>
																					<option value="<?= $articlee['article'] ?>"><?= $articlee['article'] ?></option>
																					<?php endforeach; ?>  <!--Affichage de tout les produits -->
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
																				<strong id="demo" class="text-primary align-middle">00.00 €</strong>
																			</div>
																			<div class="col-md-4 col-12 form-group">
																				<button type="button" class="btn btn-primary" style="margin-top: 25px" data-toggle="modal" data-target="#popup3">Nouvel article</button>
																				<!-- popup article déplacé -->
																			</div>
																		</div>
																		<div class="col-md-3 col-12 form-group" style="margin-top: 15px;">
																			<!-- 
																			<label for="ref">REF :</label>
																			-->
																			<input name="referencearticle"  id="referencearticle" type="text" class="form-control" placeholder="Référence">
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
																				Facture
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
																			<input name="accompte" type="number" value="0" class="form-control" placeholder="Ajouter un accompte sur la facture">
																		</div>
																		<div class="form-group">
																			<label>Modalité de paiement:</label>
																			<select name="modalite" class="form-control invoice-item-select">
																				<option value="Non définie" selected>Selectionnez une modalite</option>
																				<option value="CB">CB</option>
																				<option value="Chèque">Chèque</option>
																				<option value="Espèce">Espece</option>
																				<option value="Virement">Virement</option>
																				<option value="Prélèvement">Prélèvement</option>
																			</select>
																		</div>
																		<label>Monnaie :</label>
																		<div class="form-group" id="etiq">
																			<select name="monnaie" class="form-control invoice-item-select">
																				<option value="€" selected>€</option>
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
																				<option value="Décoration">Décoration</option>
																				<option value="Ecommerce">Ecommerce</option>
																				<option value="Autre">Autre</option>
																			</select>
																		</div>
																		<label >Statut :</label>
																		<div class="form-group">
																			<select name="statut" class="form-control invoice-item-select">
																				<option value="NON PAYE" selected>Non payé</option>
																				<option value="PAYE">Payé</option>
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
																				<input name="insert" id="button_save" type="button" value="Vérification" class="btn btn-primary btn-block subtotal-preview-btn" onclick="buttonc()"/>
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


																									<!-- Debut de la liste des popup qui permettent de créer un client et un article -->
																									<form action="php/insert_popup_clp.php" method="POST">
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
																														<input name="prenom" type="text" class="form-control" placeholder="Prénom du particulier" >
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
																													<label>*Secteur d'activité :</label>
																													<fieldset class="invoice-address form-group">
																														<select name="secteur" class="form-control invoice-item-select" >
																															<option></option>
																															<option value="Agroalimentaire">Agroalimentaire</option>
																															<option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
																															<option value="Chimie / Parachimie">Chimie / Parachimie</option>
																															<option value="Électronique / Électricité">Électronique / Électricité</option>
																															<option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
																															<option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
																															<option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
																															<option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
																															<option value="Banque / Assurance">Banque / Assurance</option>
																															<option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
																															<option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
																															<option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
																															<option value="Études et conseils">Études et conseils</option>
																															<option value="Informatique / Télécoms">Informatique / Télécoms</option>
																															<option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
																															<option value="Transports / Logistique">Transports / Logistique</option>
																															<option value="Services aux entreprises">Services aux entreprises</option>
																															<option value="Autres">Autres</option>
																														</select>
																													</fieldset>
																												</div>
																											</div>
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<label>*Numéros de téléphone :</label>
																													<input name="tel" type="text" class="form-control" placeholder="Numéros de téléphone du particulier" >
																												</div>
																												<div class="form-group">
																													<div class="controls">
																														<label>*Email :</label>
																														<input name="email" type="text" class="form-control" placeholder="Email du particulier" >
																													</div>
																												</div>
																												<div class="form-group">
																													<label>Siteweb de la société :</label>
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
																																	<option value="bielorussie">Biélorussie</option>
																																	<option value="belgique">Belgique</option>
																																	<option value="bosnieHerzegovine">Bosnie-Herzégovine</option>
																																	<option value="bulgarie">Bulgarie</option>
																																	<option value="croatie">Croatie</option>
																																	<option value="danemark">Danemark</option>
																																	<option value="espagne">Espagne</option>
																																	<option value="estonie">Estonie</option>
																																	<option value="finlande">Finlande</option>
																																	<option value="france">France</option>
																																	<option value="grece">Grèce</option>
																																	<option value="hongrie">Hongrie</option>
																																	<option value="irlande">Irlande</option>
																																	<option value="islande">Islande</option>
																																	<option value="italie">Italie</option>
																																	<option value="lettonie">Lettonie</option>
																																	<option value="liechtenstein">Liechtenstein</option>
																																	<option value="lituanie">Lituanie</option>
																																	<option value="luxembourg">Luxembourg</option>
																																	<option value="exRepubliqueYougoslaveDeMacedoine">Ex-République Yougoslave de Macédoine</option>
																																	<option value="malte">Malte</option>
																																	<option value="moldavie">Moldavie</option>
																																	<option value="monaco">Monaco</option>
																																	<option value="norvege">Norvège</option>
																																	<option value="paysBas">Pays-Bas</option>
																																	<option value="pologne">Pologne</option>
																																	<option value="portugal">Portugal</option>
																																	<option value="roumanie">Roumanie</option>
																																	<option value="royaumeUni">Royaume-Uni</option>
																																	<option value="russie">Russie</option>
																																	<option value="saintMarin">Saint-Marin</option>
																																	<option value="serbieEtMontenegro">Serbie-et-Monténégro</option>
																																	<option value="slovaquie">Slovaquie</option>
																																	<option value="slovenie">Slovénie</option>
																																	<option value="suede">Suède</option>
																																	<option value="suisse">Suisse</option>
																																	<option value="republiqueTcheque">République Tchèque</option>
																																	<option value="ukraine">Ukraine</option>
																																	<option value="vatican">Vatican</option>
																																</optgroup>
																																<optgroup label="Afrique">
																																	<option value="afriqueDuSud">Afrique Du Sud</option>
																																	<option value="algerie">Algérie</option>
																																	<option value="angola">Angola</option>
																																	<option value="benin">Bénin</option>
																																	<option value="botswana">Botswana</option>
																																	<option value="burkina">Burkina</option>
																																	<option value="burundi">Burundi</option>
																																	<option value="cameroun">Cameroun</option>
																																	<option value="capVert">Cap-Vert</option>
																																	<option value="republiqueCentre-Africaine">République Centre-Africaine</option>
																																	<option value="comores">Comores</option>
																																	<option value="republiqueDemocratiqueDuCongo">République Démocratique Du Congo</option>
																																	<option value="congo">Congo</option>
																																	<option value="coteIvoire">Côte d'Ivoire</option>
																																	<option value="djibouti">Djibouti</option>
																																	<option value="egypte">Égypte</option>
																																	<option value="ethiopie">Éthiopie</option>
																																	<option value="erythrée">Érythrée</option>
																																	<option value="gabon">Gabon</option>
																																	<option value="gambie">Gambie</option>
																																	<option value="ghana">Ghana</option>
																																	<option value="guinee">Guinée</option>
																																	<option value="guinee-Bisseau">Guinée-Bisseau</option>
																																	<option value="guineeEquatoriale">Guinée Équatoriale</option>
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
																																	<option value="saoTomeEtPrincipe">Sao Tomé-et-Principe</option>
																																	<option value="senegal">Séngal</option>
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
																																<optgroup label="Amérique">
																																	<option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
																																	<option value="argentine">Argentine</option>
																																	<option value="bahamas">Bahamas</option>
																																	<option value="barbade">Barbade</option>
																																	<option value="belize">Belize</option>
																																	<option value="bolivie">Bolivie</option>
																																	<option value="bresil">Brésil</option>
																																	<option value="canada">Canada</option>
																																	<option value="chili">Chili</option>
																																	<option value="colombie">Colombie</option>
																																	<option value="costaRica">Costa Rica</option>
																																	<option value="cuba">Cuba</option>
																																	<option value="republiqueDominicaine">République Dominicaine</option>
																																	<option value="dominique">Dominique</option>
																																	<option value="equateur">Équateur</option>
																																	<option value="etatsUnis">États Unis</option>
																																	<option value="grenade">Grenade</option>
																																	<option value="guatemala">Guatemala</option>
																																	<option value="guyana">Guyana</option>
																																	<option value="haiti">Haïti</option>
																																	<option value="honduras">Honduras</option>
																																	<option value="jamaique">Jamaïque</option>
																																	<option value="mexique">Mexique</option>
																																	<option value="nicaragua">Nicaragua</option>
																																	<option value="panama">Panama</option>
																																	<option value="paraguay">Paraguay</option>
																																	<option value="perou">Pérou</option>
																																	<option value="saintCristopheEtNieves">Saint-Cristophe-et-Niévès</option>
																																	<option value="sainteLucie">Sainte-Lucie</option>
																																	<option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
																																	<option value="salvador">Salvador</option>
																																	<option value="suriname">Suriname</option>
																																	<option value="triniteEtTobago">Trinité-et-Tobago</option>
																																	<option value="uruguay">Uruguay</option>
																																	<option value="venezuela">Venezuela</option>
																																</optgroup>
																																<optgroup label="Asie">
																																	<option value="afghanistan">Afghanistan</option>
																																	<option value="arabieSaoudite">Arabie Saoudite</option>
																																	<option value="armenie">Arménie</option>
																																	<option value="azerbaidjan">Azerbaïdjan</option>
																																	<option value="bahrein">Bahreïn</option>
																																	<option value="bangladesh">Bangladesh</option>
																																	<option value="bhoutan">Bhoutan</option>
																																	<option value="birmanie">Birmanie</option>
																																	<option value="brunei">Brunéi</option>
																																	<option value="cambodge">Cambodge</option>
																																	<option value="chine">Chine</option>
																																	<option value="coreeDuSud">Corée Du Sud</option>
																																	<option value="coreeDuNord">Corée Du Nord</option>
																																	<option value="emiratsArabeUnis">Émirats Arabe Unis</option>
																																	<option value="georgie">Géorgie</option>
																																	<option value="inde">Inde</option>
																																	<option value="indonesie">Indonésie</option>
																																	<option value="iraq">Iraq</option>
																																	<option value="iran">Iran</option>
																																	<option value="israel">Israël</option>
																																	<option value="japon">Japon</option>
																																	<option value="jordanie">Jordanie</option>
																																	<option value="kazakhstan">Kazakhstan</option>
																																	<option value="kirghistan">Kirghistan</option>
																																	<option value="koweit">Koweït</option>
																																	<option value="laos">Laos</option>
																																	<option value="liban">Liban</option>
																																	<option value="malaisie">Malaisie</option>
																																	<option value="maldives">Maldives</option>
																																	<option value="mongolie">Mongolie</option>
																																	<option value="nepal">Népal</option>
																																	<option value="oman">Oman</option>
																																	<option value="ouzbekistan">Ouzbékistan</option>
																																	<option value="pakistan">Pakistan</option>
																																	<option value="philippines">Philippines</option>
																																	<option value="qatar">Qatar</option>
																																	<option value="singapour">Singapour</option>
																																	<option value="sriLanka">Sri Lanka</option>
																																	<option value="syrie">Syrie</option>
																																	<option value="tadjikistan">Tadjikistan</option>
																																	<option value="taiwan">Taïwan</option>
																																	<option value="thailande">Thaïlande</option>
																																	<option value="timorOriental">Timor oriental</option>
																																	<option value="turkmenistan">Turkménistan</option>
																																	<option value="turquie">Turquie</option>
																																	<option value="vietNam">Viêt Nam</option>
																																	<option value="yemen">Yemen</option>
																																</optgroup>
																																<optgroup label="Océanie">
																																	<option value="australie">Australie</option>
																																	<option value="fidji">Fidji</option>
																																	<option value="kiribati">Kiribati</option>
																																	<option value="marshall">Marshall</option>
																																	<option value="micronesie">Micronésie</option>
																																	<option value="nauru">Nauru</option>
																																	<option value="nouvelleZelande">Nouvelle-Zélande</option>
																																	<option value="palaos">Palaos</option>
																																	<option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guinée</option>
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
																													<input type="number" name="codePostal3" class=" form-control" placeholder="Code Postal" onkeyup="getCp3($(this))" autocomplete="off">
																													<input type="hidden" name="insee_code3" id="insee_code3" value="" autocomplete="off">
																												</div>
																											</div>
																											<div class="col-12 col-sm-6">
																												<div class="form-group">
																													<label for="email">*Département :</label>
																													<select name="departement" id="ville3" class="form-control " ></select>
																												</div>
																											</div>
																											<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																												<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																											</div>
																											<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
																										
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
																								<form action="php/insert_popup_cls.php" method="POST">
																									<input type="hidden" name="cat" value="Professionnel">
																									<div class="row">
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<div class="controls">
																													<label>*Nom de la société :</label>
																													<input name="name_client" type="text" class="form-control" placeholder="Nom de la société" >
																												</div>
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>Numéros Siret :</label>
																													<input name="numsiret" type="text" class="form-control" placeholder="N°Siret">
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
																												<label>*Secteur d'activité :</label>
																												<fieldset class="invoice-address form-group">
																													<select name="secteur" class="form-control invoice-item-select" >
																														<option></option>
																														<option value="Agroalimentaire">Agroalimentaire</option>
																														<option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
																														<option value="Chimie / Parachimie">Chimie / Parachimie</option>
																														<option value="Électronique / Électricité">Électronique / Électricité</option>
																														<option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
																														<option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
																														<option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
																														<option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
																														<option value="Banque / Assurance">Banque / Assurance</option>
																														<option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
																														<option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
																														<option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
																														<option value="Études et conseils">Études et conseils</option>
																														<option value="Informatique / Télécoms">Informatique / Télécoms</option>
																														<option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
																														<option value="Transports / Logistique">Transports / Logistique</option>
																														<option value="Services aux entreprises">Services aux entreprises</option>
																														<option value="Autres">Autres</option>
																													</select>
																												</fieldset>
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label>Numéro de téléphone :</label>
																												<input name="tel" type="text" class="form-control" placeholder="Numéros de téléphone de la société" >
																											</div>
																											<div class="form-group">
																												<div class="controls">
																													<label>*Email :</label>
																													<input name="email" type="text" class="form-control" placeholder="Email de la société" >
																												</div>
																											</div>
																											<div class="form-group">
																												<label>Siteweb de la société :</label>
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
																																<option value="bielorussie">Biélorussie</option>
																																<option value="belgique">Belgique</option>
																																<option value="bosnieHerzegovine">Bosnie-Herzégovine</option>
																																<option value="bulgarie">Bulgarie</option>
																																<option value="croatie">Croatie</option>
																																<option value="danemark">Danemark</option>
																																<option value="espagne">Espagne</option>
																																<option value="estonie">Estonie</option>
																																<option value="finlande">Finlande</option>
																																<option value="france" selected>France</option>
																																<option value="grece">Grèce</option>
																																<option value="hongrie">Hongrie</option>
																																<option value="irlande">Irlande</option>
																																<option value="islande">Islande</option>
																																<option value="italie">Italie</option>
																																<option value="lettonie">Lettonie</option>
																																<option value="liechtenstein">Liechtenstein</option>
																																<option value="lituanie">Lituanie</option>
																																<option value="luxembourg">Luxembourg</option>
																																<option value="exRepubliqueYougoslaveDeMacedoine">Ex-République Yougoslave de Macédoine</option>
																																<option value="malte">Malte</option>
																																<option value="moldavie">Moldavie</option>
																																<option value="monaco">Monaco</option>
																																<option value="norvege">Norvège</option>
																																<option value="paysBas">Pays-Bas</option>
																																<option value="pologne">Pologne</option>
																																<option value="portugal">Portugal</option>
																																<option value="roumanie">Roumanie</option>
																																<option value="royaumeUni">Royaume-Uni</option>
																																<option value="russie">Russie</option>
																																<option value="saintMarin">Saint-Marin</option>
																																<option value="serbieEtMontenegro">Serbie-et-Monténégro</option>
																																<option value="slovaquie">Slovaquie</option>
																																<option value="slovenie">Slovénie</option>
																																<option value="suede">Suède</option>
																																<option value="suisse">Suisse</option>
																																<option value="republiqueTcheque">République Tchèque</option>
																																<option value="ukraine">Ukraine</option>
																																<option value="vatican">Vatican</option>
																															</optgroup>
																															<optgroup label="Afrique">
																																<option value="afriqueDuSud">Afrique Du Sud</option>
																																<option value="algerie">Algérie</option>
																																<option value="angola">Angola</option>
																																<option value="benin">Bénin</option>
																																<option value="botswana">Botswana</option>
																																<option value="burkina">Burkina</option>
																																<option value="burundi">Burundi</option>
																																<option value="cameroun">Cameroun</option>
																																<option value="capVert">Cap-Vert</option>
																																<option value="republiqueCentre-Africaine">République Centre-Africaine</option>
																																<option value="comores">Comores</option>
																																<option value="republiqueDemocratiqueDuCongo">République Démocratique Du Congo</option>
																																<option value="congo">Congo</option>
																																<option value="coteIvoire">Côte d'Ivoire</option>
																																<option value="djibouti">Djibouti</option>
																																<option value="egypte">Égypte</option>
																																<option value="ethiopie">Éthiopie</option>
																																<option value="erythrée">Érythrée</option>
																																<option value="gabon">Gabon</option>
																																<option value="gambie">Gambie</option>
																																<option value="ghana">Ghana</option>
																																<option value="guinee">Guinée</option>
																																<option value="guinee-Bisseau">Guinée-Bisseau</option>
																																<option value="guineeEquatoriale">Guinée Équatoriale</option>
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
																																<option value="saoTomeEtPrincipe">Sao Tomé-et-Principe</option>
																																<option value="senegal">Séngal</option>
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
																															<optgroup label="Amérique">
																																<option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
																																<option value="argentine">Argentine</option>
																																<option value="bahamas">Bahamas</option>
																																<option value="barbade">Barbade</option>
																																<option value="belize">Belize</option>
																																<option value="bolivie">Bolivie</option>
																																<option value="bresil">Brésil</option>
																																<option value="canada">Canada</option>
																																<option value="chili">Chili</option>
																																<option value="colombie">Colombie</option>
																																<option value="costaRica">Costa Rica</option>
																																<option value="cuba">Cuba</option>
																																<option value="republiqueDominicaine">République Dominicaine</option>
																																<option value="dominique">Dominique</option>
																																<option value="equateur">Équateur</option>
																																<option value="etatsUnis">États Unis</option>
																																<option value="grenade">Grenade</option>
																																<option value="guatemala">Guatemala</option>
																																<option value="guyana">Guyana</option>
																																<option value="haiti">Haïti</option>
																																<option value="honduras">Honduras</option>
																																<option value="jamaique">Jamaïque</option>
																																<option value="mexique">Mexique</option>
																																<option value="nicaragua">Nicaragua</option>
																																<option value="panama">Panama</option>
																																<option value="paraguay">Paraguay</option>
																																<option value="perou">Pérou</option>
																																<option value="saintCristopheEtNieves">Saint-Cristophe-et-Niévès</option>
																																<option value="sainteLucie">Sainte-Lucie</option>
																																<option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
																																<option value="salvador">Salvador</option>
																																<option value="suriname">Suriname</option>
																																<option value="triniteEtTobago">Trinité-et-Tobago</option>
																																<option value="uruguay">Uruguay</option>
																																<option value="venezuela">Venezuela</option>
																															</optgroup>
																															<optgroup label="Asie">
																																<option value="afghanistan">Afghanistan</option>
																																<option value="arabieSaoudite">Arabie Saoudite</option>
																																<option value="armenie">Arménie</option>
																																<option value="azerbaidjan">Azerbaïdjan</option>
																																<option value="bahrein">Bahreïn</option>
																																<option value="bangladesh">Bangladesh</option>
																																<option value="bhoutan">Bhoutan</option>
																																<option value="birmanie">Birmanie</option>
																																<option value="brunei">Brunéi</option>
																																<option value="cambodge">Cambodge</option>
																																<option value="chine">Chine</option>
																																<option value="coreeDuSud">Corée Du Sud</option>
																																<option value="coreeDuNord">Corée Du Nord</option>
																																<option value="emiratsArabeUnis">Émirats Arabe Unis</option>
																																<option value="georgie">Géorgie</option>
																																<option value="inde">Inde</option>
																																<option value="indonesie">Indonésie</option>
																																<option value="iraq">Iraq</option>
																																<option value="iran">Iran</option>
																																<option value="israel">Israël</option>
																																<option value="japon">Japon</option>
																																<option value="jordanie">Jordanie</option>
																																<option value="kazakhstan">Kazakhstan</option>
																																<option value="kirghistan">Kirghistan</option>
																																<option value="koweit">Koweït</option>
																																<option value="laos">Laos</option>
																																<option value="liban">Liban</option>
																																<option value="malaisie">Malaisie</option>
																																<option value="maldives">Maldives</option>
																																<option value="mongolie">Mongolie</option>
																																<option value="nepal">Népal</option>
																																<option value="oman">Oman</option>
																																<option value="ouzbekistan">Ouzbékistan</option>
																																<option value="pakistan">Pakistan</option>
																																<option value="philippines">Philippines</option>
																																<option value="qatar">Qatar</option>
																																<option value="singapour">Singapour</option>
																																<option value="sriLanka">Sri Lanka</option>
																																<option value="syrie">Syrie</option>
																																<option value="tadjikistan">Tadjikistan</option>
																																<option value="taiwan">Taïwan</option>
																																<option value="thailande">Thaïlande</option>
																																<option value="timorOriental">Timor oriental</option>
																																<option value="turkmenistan">Turkménistan</option>
																																<option value="turquie">Turquie</option>
																																<option value="vietNam">Viêt Nam</option>
																																<option value="yemen">Yemen</option>
																															</optgroup>
																															<optgroup label="Océanie">
																																<option value="australie">Australie</option>
																																<option value="fidji">Fidji</option>
																																<option value="kiribati">Kiribati</option>
																																<option value="marshall">Marshall</option>
																																<option value="micronesie">Micronésie</option>
																																<option value="nauru">Nauru</option>
																																<option value="nouvelleZelande">Nouvelle-Zélande</option>
																																<option value="palaos">Palaos</option>
																																<option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guinée</option>
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
																												<input name="prenom" type="text" class="form-control" placeholder="Prénom du dirigeant" >
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label for="email">*Code postal :</label>
																												<input type="number" name="codePostal4" class=" form-control" placeholder="Code Postal" onkeyup="getCp4($(this))" autocomplete="off">
																												<input type="hidden" name="insee_code4" id="insee_code4" value="" autocomplete="off">
																											</div>
																										</div>
																										<div class="col-12 col-sm-6">
																											<div class="form-group">
																												<label for="email">*Département :</label>
																												<select name="departement" id="ville4" class="form-control " ></select>
																											</div>
																										</div>
																										<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																											<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																										</div>
																										<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
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
											<!-- POPUP ARTICLE -->
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
																											
																												<form action="php/insert_articlespopup_facture.php" method="POST">
																													<div class="row">
																														<div class="col-12 col-sm-6">
																															<div class="form-group">
																																<div class="controls">
																																	<label>*Désignation :</label>
																																	<input name="article" type="text" class="form-control" placeholder="Désignation de l'article" >
																																</div>
																															</div>
																															<div class="form-group">
																																<div class="controls">
																																	<label>Unités de mesure :</label>
																																	<input name="umesure" type="text" class="form-control" placeholder="Unités de mesure">
																																</div>
																															</div>
																														</div>
																														<div class="col-12 col-sm-6">
																															<div class="form-group">
																																<label>Référence de l'article :</label>
																																<input name="referencearticle" type="text" class="form-control" placeholder="Référence de l'article">
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
																																	<input name="prixvente" type="number" step="any" class="form-control" placeholder="Prix de vente de l'article">
																																</div>
																																<div class="controls">
																																	<label>Tva vente :</label>
																																	<fieldset class="invoice-address form-group">
																																		<select name="tvavente" class="form-control invoice-item-select">
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
																																	<label>Cout d'achat HT :</label>
																																	<input name="coutachat" type="number" step="any" class="form-control" placeholder="Cout d'achat de l'article">
																																</div>
																																<div class="controls">
																																	<label>Tva achat :</label>
																																	<fieldset class="invoice-address form-group">
																																		<select name="tvaachat" class="form-control invoice-item-select">
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
																															<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
																														</div>
																														<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
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
    <script src="../../../app-assets/js/scripts/pages/app-add_facture.js"></script>
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