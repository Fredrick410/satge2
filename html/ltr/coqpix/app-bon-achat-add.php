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

    $pdoS = $bdd->prepare('SELECT * FROM fournisseur WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $fournisseur = $pdoS->fetchAll();

	$pdiSt = $bdd->prepare('SELECT * FROM articles INNER JOIN bon_commande ON articles.id_fac = bon_commande.id');
	$pdoSt->execute();

	$incre = $bdd->prepare('SELECT MAX(id_bon_commande) FROM bon_commande ');
	$incre->execute();
	$test = $incre->fetch();
	$maxid = $test['MAX(id_bon_commande)'] + 1;

	// Auto incrémentation de l'ID du bon
	$max_num = "";
	$pdoSt = $bdd->prepare('SELECT id_bon_commande FROM bon_commande');
		$pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
		$pdoSt->execute();
		$num = $pdoSt->fetchAll();
		$count_num = count($num);
		$max_num = "0";
		for ($i=0; $i < $count_num ; $i++) {
			foreach($num as $n):

				$number = $n['id_bon_commande'];
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

    if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u" OR $_GET['jXN955CbHqqbQ463u5Uq'] == "y44vJ"){

        if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u"){

            $pdoSt = $bdd->prepare('SELECT numerosbon FROM bon_commande WHERE id_session = :num');
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
                $max_incrementation = $max_incrementation;
            }elseif($strlen_incrementation == "2"){
                $max_incrementation = $max_incrementation;
            }elseif($strlen_incrementation >= "3"){
                $max_incrementation = $max_incrementation;
            }

            $max_incrementation = $max_incrementation;

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
    <title>Ajouter bulletin de commande</title>
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
                                    <form autocomplete="off" action="php/insert_bon_achat.php" method="POST">
                                        <div class="row mx-0">
                                            <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
												<h6 class="invoice-number mr-75">N°</h6>
												<input name="numeroboncom" id="numeros" type="number" value='<?= $maxid ?>' class="form-control pt-25 w-50" placeholder="BON-0" attribut readonly="readonly" <?php if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u"){echo "readonly";} ?> required>
											</div>
                                            <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
												<h6 class="invoice-number mr-75">
													Référence
												</h6>
												<input name="refbon" id="refbon" type="text" value='REF-' class="form-control pt-20 w-50" placeholder="XXX-">
												<p style='position: relative; top: 7px;'>
												&nbsp&nbsp&nbsp
												</p>
											</div>
                                            <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0" >
												<h6 class="invoice-number mr-75">
													Bon N°
												</h6>
												<input type="number" name="numerosbon" value='<?= $max_incrementation ?>' class="form-control pt-25 w-50" placeholder="00000" attribut readonly="readonly" required>
											</div>
                                            <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
												<div class="d-flex align-items-center">
													<small class="text-muted mr-75">*Date: </small>
													<fieldset class="d-flex ">
														<input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" placeholder="jj-mm-aa" required>
													</fieldset>
												</div>
											</div>
											<p>
												&nbsp&nbsp&nbsp &nbsp&nbsp&nbsp
											</p>
                                            <div class="col-xl-2 col-md-12 d-flex align-items-center pl-0">
												<div class="d-flex align-items-center">
													<small class="text-muted mr-75">*Date d'échéance : </small>
													<fieldset class="d-flex justify-content-end">
														<input name="dateecheance" id="dateecheance" type="date" class="form-control mr-2 mb-50 mb-sm-0" placeholder="jj-mm-aa" required>
													</fieldset>
                                                </div>
											</div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="col-lg-12 col-md-12 mt-25">
											<div class="row my-2 py-50">
												<div class="col-sm-6 col-12 order-2 order-sm-1" style="text-align:center;padding-top:4%">
													<h4 class="text-primary">Bulletin de commande</h4>
													<input name="nom_bon" id="nom_bon" type="text" class="form-control" placeholder="Nom du bon de commande">
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
														<label>*Fournisseur :</label>
														<select name="numerosfournisseur" id="fournisseur" class="form-control invoice-item-select">
                                                            <option value="Pas de fournisseur">Sélectionnez un fournisseur</option>
                                                                <optgroup label="Liste des fournisseurs"></optgroup>
                                                                <?php foreach($fournisseur as $fournisseurr): ?>
                                                                    <!-- <option value="<?= $fournisseurr['name_fournisseur'] ?>"><?= $fournisseurr['name_fournisseur'] ?></option> -->
																	<option value="<?= $fournisseurr['id'] ?>"><?= $fournisseurr['name_fournisseur'] ?></option>
                                                                <?php endforeach; ?>
                                                            <option value="Pas de fournisseur">Autres</options>
                                                        </select>
													</div>
                                                    <button type="button" class="btn btn-primary col-lg-4 col-md-12 mt-25" style="margin-left: 15px" data-toggle="modal" data-target="#popup">Créer un fournisseur</button>
                                                    <!-- <hr> -->
							    					<!-- <label for="adress">*Adresse :</label>
								    				<fieldset class="invoice-address form-group">
									    				<textarea name="adresse" id="adresse" class="form-control" placeholder="Mountain View, Californie, États-Unis"></textarea>
										    		</fieldset> -->
									            </div>
                                                <!-- <div class="col-lg-6 col-md-12 mt-25" style="padding-top: 0px;">
													<div class="form-group">
														<label for="email">*Code postal :</label>
														<input type="number" name="codePostal" class="form-control required" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
														<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off">
													</div>
                                                    <div class="form-group">
														<label for="email">*Ville :</label>
														<select name="departement" id="ville" class="form-control required"  required="" disabled=""></select>
													</div>
                                                    <label for="email">Email :</label>
												    <fieldset class="invoice-address form-group">
													    <input name="email" id="email" type="email" class="form-control" placeholder="Email">
												    </fieldset>
                                                    <label for="email">TEL :</label>
											        <fieldset class="invoice-address form-group">
												        <input name="tel" id="telephone" type="text" class="form-control" placeholder="Téléphone">
											        </fieldset>
                                                </div> -->
									        </div>
									        <hr>
                                            <div class="card-body pt-50">
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
																	Référence
																</div>
															</div>
                                                            <div class="invoice-item d-flex border rounded mb-1">
																<div class="invoice-item-filed row pt-1 px-1">
																	<div class="col-12 col-md-4 form-group">
																		<select name="nomproduit" id="article" class="form-control invoice-item-select">
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
																		<input name="cout" id="cout" type="number" class="form-control" min="1" placeholder="0" onkeyup="myFunction()" step="any">
																	</div>
																	<div class="col-md-3 col-12 form-group">
																		<input name="quantite" id="quantite" type="number" class="form-control" min="1" placeholder="0" onkeyup="myFunction()" step="any">
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
																	<input name="referencearticle" id="referencearticle" type="text" class="form-control invoice-item-desc" placeholder="Référence">
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
																					<input name="tva" id="tva" value="0" type="number" class="form-control" id="discount" placeholder="0" maxlength="3" min="0" max="100">
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
                                            <table id="table" name="table" class="table table-bordered"><style>.red{color: red;} .line{text-decoration: underline;}</style>
												<tbody>
													<tr>
														<th>Bon N°</th>
														<th>Ref</th>
														<th>Nom</th>
														<th>Prix unité</th>
													    <th>Quantité</th>
														<th>Unité</th>
														<th>TVA(%)</th>
														<th>Réduction(%)</th>
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
															<label>Modalité de paiement:</label>
															<select name="modalite" class="form-control invoice-item-select">
																<option value="Non définie" selected>Selectionnez une modalité</option>
																<option value="CB">Carte bancaire</option>
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
															<input name="note" type="text" class="form-control" placeholder="Ajouter une note pour le client">
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
                                                            <li class="list-group-item border-0 pb-0"><style>.green{background: #43b546; color: white;} .green:hover{background: #3fff45; color: white;}</style>
                                                                <input name="insert" id="button_save" type="button" value="Vérification" class="btn btn-primary btn-block subtotal-preview-btn" onclick="buttonc()"/>
                                                                <input name="insert" id="subbt" type="hidden" value="Sauvegarder" class="btn btn btn-block subtotal-preview-btn green"/>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
										<div class="card-body">
											<div class="row invoice-info">
												<!-- FORMULAIRE FOUNRISSEUR -->
												<div class="col-lg-6 col-md-12 mt-25" style=" padding-top: 0px; ">
													<!-- Pop-up -->
													<div id="popup" class="modal">
														<div class="modal-dialog modal-dialog-centered">
															<div class="modal-content">
															<section class="users-edit">
																<div class="h-auto card">
																	<div class="card-content">
																		<div class="card-body">
																			<ul class="nav nav-tabs mb-2" role="tablist">
																				<li class="nav-item">
																					<a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
																						<i class="bx bx-user mr-25"></i>
																						<span class="d-none d-sm-block">Info Fournisseur</span>
																					</a>
																				</li>
																				<li class="nav-item">
																					<a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
																						<i class="bx bx-info-circle mr-25"></i>
																						<span class="d-none d-sm-block">Info Dirigeant</span>
																					</a>
																				</li>
																			</ul>
																			<div class="tab-content">
																				<div class="tab-pane fade" id="information" aria-labelledby="information-tab" role="tabpanel">
																					<!-- Debut de la liste des popup qui permettent de créer fournisseur (information dirigeant) -->
																						<form action="php/insert_fournisseurpopupbon.php" method="POST">
																							<div class="row">
																								<div class="col-12 col-sm-6">
																									<h5 class="mb-1"><i class="bx bx-link mr-25"></i>Information dirigeant</h5>
																									<div class="form-group">
																										<label>*Nom :</label>
																										<input name="nom" class="form-control" type="text" placeholder="Nom du fournisseur" required="">
																									</div>
																									<div class="form-group">
																										<label>*Prénom :</label>
																										<input name="prenom" class="form-control" type="text" placeholder="Prénom du fournisseur" required="">
																									</div>
																									<div class="form-group">
																										<label>Adresse :</label>
																										<input name="adresse_diri" class="form-control" type="text" placeholder="Adresse du fournisseur">
																									</div>
																									<div class="form-group">
																										<label>Téléphone :</label>
																										<input name="tel_diri" class="form-control" type="text" placeholder="Téléphone du fournisseur">
																									</div>
																									<div class="form-group">
																										<label>E-mail :</label>
																										<input name="email_diri" class="form-control" type="text" placeholder="E-mail du fournisseur">
																									</div>
																								</div>
																								<div class="col-12 col-sm-6 mt-1 mt-sm-0">

																													<!-- PUBLICITER -->

																								</div>
																								<input name="" type="hidden" value="73">
																								<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																									<button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class="bx bx-right-arrow-alt"></i></button>
																								</div>
																								<label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à completer les champs obligatoires*</label>
																							</div>
																						<!-- </form> -->
																				</div>
																				<div class="tab-pane fade active show" id="account" aria-labelledby="account-tab" role="tabpanel">
																					<!-- Debut de la liste des popup qui permettent de créer un client et un article -->
																						<!-- <form action="php/insert_fournisseurpopup.php" method="POST"> -->
																							<div class="row">
																								<div class="col-12 col-sm-6">
																									<div class="form-group">
																										<div class="controls">
																											<label>*Nom de la socièté :</label>
																											<input name="name_fournisseur" type="text" class="form-control" placeholder="Nom de la société" required="">
																										</div>
																									</div>
																									<div class="form-group">
																										<div class="controls">
																											<label>Numéros SIRET :</label>
																											<input name="numsiret" type="text" class="form-control" placeholder="N° SIRET">
																										</div>
																									</div>
																									<div class="form-group">
																										<div class="form-group">
																											<div class="controls">
																												<label>TVA Intracom :</label>
																												<input name="tvaintracom" type="text" class="form-control" placeholder="">
																											</div>
																										</div>
																										<div class="controls">
																											<label>IBAN :</label>
																											<input name="iban" type="text" class="form-control" placeholder="FR-">
																										</div>
																										<br>
																										<label>*Secteur d'activité :</label>
																										<fieldset class="invoice-address form-group">
																											<select name="secteur" class="form-control invoice-item-select" required="">
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
																										<input name="tel" type="text" class="form-control" placeholder="Numéros de téléphone du fournisseur" required="">
																									</div>
																									<div class="form-group">
																										<div class="controls">
																											<label>*Email :</label>
																											<input name="email" type="text" class="form-control" placeholder="Email du fournisseur" required="">
																										</div>
																									</div>
																									<div class="form-group">
																										<label>Siteweb de la société :</label>
																										<input name="siteweb" type="text" class="form-control" placeholder="www.monfournisseur.fr">
																									</div>
																									<div class="form-group">
																										<div class="controls">
																											<label>*Adresse :</label>
																											<input name="adresse" type="text" class="form-control" placeholder="Adresse du fournisseur" required="" data-validation-required-message="L'e-mail de la societe du fournisseur est obligatoire">
																										</div>
																									</div>
																									<div class="form-group">
																										<div class="controls">
																											<label>*Pays :</label>
																												<fieldset class="invoice-address form-group">
																													<select name="pays" class="form-control invoice-item-select" required="">
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
																											<input type="number" name="codepostal5" class=" form-control" placeholder="Code Postal" onkeyup="getCp5($(this))" autocomplete="off">
																											<input type="hidden" name="insee_code5" id="insee_code5" value="" autocomplete="off">
																										</div>
																									</div>
																									<div class="col-12 col-sm-6">
																										<div class="form-group">
																											<label for="email">*Département :</label>
																											<select name="departement" id="ville5" class="form-control "></select>
																										</div>
																									</div>
																								</div>
																								<div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
																									<label>Compléter les Infos Dirigeants</label>&nbsp;&nbsp;<i class="bx bx-right-arrow-alt"></i>
																								</div>
																							</div>
																							<!-- users edit account form ends -->
																						</form>
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
																		<form action="php/insert_articlespopup_bon.php" method="POST" enctype="multipart/form-data">
																			<div class="row">
																				<div class="col-12 col-sm-6">
																					<div class="form-group">
																						<div class="controls">
																							<label>*Nom de l'article :</label>
																							<input name="article" type="text" class="form-control" placeholder="Nom de l'article" >
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
                                          <!-- selectionner si c un bien ou un service -->
                                          <div class="form-group">
                                              <label>Catégorie :</label>
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
                                                  <option value="matiere 1ere">Matiere 1ere</option>
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
																					<hr><style>.line{text-decoration: underline;}</style>
																				</div>
																				<div class="col-12">
																					<div class="form-group">
																						<label>*Fournisseur</label>
																						<select name="id_fournisseur" id="fourpour" class="form-control invoice-item-select">
																							<option value="Pas de fournisseur">Sélectionnez un fournisseur</option>
																							<?php foreach($fournisseur as $fournisseurr): ?>
																								<option value="<?= $fournisseurr['id'] ?>"><?= $fournisseurr['name_fournisseur'] ?></option>
																							<?php endforeach; ?>
																						</select>
																					</div>
																					<!-- <div class="form-group">
																						<label for="adress">*Adresse :</label>
																						<fieldset class="invoice-address form-group">
																							<textarea name="adresse" id="adresse" class="form-control" placeholder="Mountain View, Californie, États-Unis"></textarea>
																						</fieldset>
																					</div>
																					<div class="form-group">
																						<label for="email">*Code postal :</label>
																						<input type="number" name="codepostal6" class="form-control required" placeholder="Code Postal" onkeyup="getCp6($(this))" autocomplete="off">
																						<input type="hidden" name="insee_code6" id="insee_code6" value="" autocomplete="off">
																					</div>
																					<div class="form-group">
																						<label for="email">*Ville :</label>
																						<select name="departement" id="ville6" class="form-control required"  required="" disabled=""></select>
																					</div>
																					<div class="form-group">
																						<label for="email">Email :</label>
																						<fieldset class="invoice-address form-group">
																							<input name="email" id="email" type="email" class="form-control" placeholder="Email">
																						</fieldset>
																					</div>
																					<div class="form-group">
																						<label for="email">TEL :</label>
																						<fieldset class="invoice-address form-group">
																							<input name="tel" id="telephone" type="text" class="form-control" placeholder="Téléphone">
																						</fieldset>
																					</div> -->
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
																							<input name="prixvente" type="number" step="any" class="form-control" placeholder="Prix de vente de l'article">
																						</div>
																						<div class="controls">
																							<label>TVA vente :</label>
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
																							<label>Quantité :</label>
																							<input name="stock" id="stock" type="number" value="" class="form-control" placeholder="Quantité acheté pour le stock" step="any">
																						</div>
																						<div class="controls">
																							<label>Cout d'achat HT :</label>
																							<input name="coutachat" type="number" value="" class="form-control" placeholder="Cout d'achat de l'article" step="any">
																						</div>
																						<div class="controls">
																							<label>TVA achat :</label>
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
																					<input type="file" id="file" name="img" style="display:none"/>
																					<a onclick="file.click()" class="btn btn-outline-primary">Ajouter une image à l'article</a>
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
	  <script src="../../../app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
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
    <script src="../../../app-assets/js/scripts/pages/app-add_bonachat.js"></script>
	  <script src="../../../app-assets/js/scripts/pages/myFunction_facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/myFunction_fournisseur.js"></script>
  	<script src="../../../app-assets/js/scripts/pages/getcp.js"></script>
  	<script src="../../../app-assets/js/scripts/pages/getcp5.js"></script>
  	<script src="../../../app-assets/js/scripts/pages/getcp6.js"></script>
  	<script src="../../../app-assets/js/scripts/pages/masquer.js"></script>
    <script src="../../../app-assets/js/scripts/pages/complete-facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
  	<script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->
	<script src="script.js"></script>
    <!-- END: Page JS-->
<!-- partial -->
  	<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
	<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script  src="./script.js"></script>

<script>  $(function() {
    $("#sortable tbody").sortable({
      cursor: "move",
      placeholder: "sortable-placeholder",
      helper: function(e, tr)
      {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
        // Set helper cell sizes to match the original sizes
        $(this).width($originals.eq(index).width());
        });
        return $helper;
      }
    }).disableSelection();
  });

function getCp(btn){
				$('#ville').empty();
				$('#ville').attr('disabled','disabled');
				$.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) {
					var ville = "<option value=''>Selectionnez votre ville</option>";
					if(data.length>0){
						$('#ville').removeAttr('disabled');
						$.each(data, function (key, value) {
							ville+="<option value='"+value.name+"' data-insee_code='"+value.insee_code+"'>"+value.name+"</option>";
						});
						$('#ville').html(ville);
					}else{
						$('#ville').empty();
						$('#ville').attr('disabled','disabled');
					}
				});
			};

			$('#ville').change(function(event) {
				$('#insee_code').val($('option:selected', this).attr('data-insee_code'));
			});</script>

    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>
