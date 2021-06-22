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
                                            <div class="col-xl-4 col-md-12 d-flex align-items-center pl-0" >
                                                <h6 class="invoice-number mr-75">Bon N°</h6>
                                                <input name="numerosfacture" id="numeros" type="number" value='<?= $max_incrementation ?>' class="form-control pt-25 w-50" placeholder="00000" <?php if($_GET['jXN955CbHqqbQ463u5Uq'] == "Rt82u"){echo "readonly";} ?> required>
                                                <p style='position: relative; top: 7px; display: <?php if($entreprise['incrementation'] == "no"){echo "none";} ?>;'>&nbsp&nbsp&nbsp BC-<?= date('y') ?>(année)<?= substr($max_incrementation, 2) ?>(numéro) <label>&nbsp&nbsp&nbsp MODE AUTO-INCREMENTATION : <label style='color: <?php if($entreprise['incrementation'] == "yes"){echo "green";}else{echo "red";} ?>;'><?php if($entreprise['incrementation'] == "yes"){echo "On";}else{echo "Off";} ?></label></label></p>
                                                <p style='position: relative; top: 7px; display: <?php if($entreprise['incrementation'] == "no"){echo "none";} ?>;'>&nbsp&nbsp&nbsp</p>
                                            </div>
                                            <div class="col-xl-8 col-md-12 px-0 pt-xl-0 pt-1">
                                                <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">*Date : </small>
                                                        <fieldset class="d-flex ">
                                                            <input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" placeholder="jj-mm-aa">
                                                        </fieldset>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">
                                                        Date d'échéance : </small>
                                                        <fieldset class="d-flex justify-content-end">
                                                            <input name="dateecheance" id="dateecheance" type="date" class="form-control mb-50 mb-sm-0" placeholder="jj-mm-aa">
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1" style="text-align:center;padding-top:4%">
                                                <h4 class="text-primary">Bulletin de commande</h4>
                                                <input name="nomproduit" id="nomproduit" type="text" class="form-control" placeholder="Nom du bon de commande"> 
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
                                                    <select name="name_fournisseur" id="fournisseur" class="form-control invoice-item-select">
                                                    <option value="Pas de fournisseur">Sélectionnez un fournisseur</option>
                                                    <optgroup label="Liste des fournisseurs">
                                                    </optgroup>
                                                    <?php foreach($fournisseur as $fournisseurr): ?>
                                                    <option value="<?= $fournisseurr['name_fournisseur'] ?>"><?= $fournisseurr['name_fournisseur'] ?></option>
                                                    <?php endforeach; ?>
                                                    <option value="Pas de fournisseur">Autres</options>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                        <input name="facturepour" id="newfournisseur" type="text" class="form-control" placeholder="Fournisseur de la facture" required>
                                                    </div>  
                                                <label for="adress">*Adresse :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <textarea name="adresse" id="adresse" class="form-control" rows="4" placeholder="Mountain View, Californie, États-Unis"></textarea>
                                                </fieldset>
                                               
                                            </div>
											    <div class="col-lg-6 col-md-12 mt-25">
                                                
                                               	<div class="form-group">
													 <label for="email">*Code postal :</label>
															<input type="number" name="codePostal" class="required form-control" placeholder="Code Postal" onkeyup="getCp($(this))" autocomplete="off">
															<input type="hidden" name="insee_code" id="insee_code" value="" autocomplete="off"> 
														</div>
												<div class="form-group"> 
													   <label for="email">*Département :</label>
															<select name="departement" id="ville" class="form-control required" required="" disabled=""></select>
														</div>
                                                 <label for="email">Email :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email">
                                                </fieldset>
                                                <label for="email">TEL :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="tel" id="telephone" type="text" class="form-control" placeholder="Téléphone">
                                                </fieldset>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <div class="card-body pt-50">
                                        <!-- product details table-->
                                        <div class="invoice-product-details ">
                                            
                                                <div data-repeater-list="group-a">
                                                    <div data-repeater-item>
                                                        <div class="row mb-50">
                                                            <div class="col-3 col-md-4 invoice-item-title">Article</div>
                                                            <div class="col-3 invoice-item-title">Prix U</div>
                                                            <div class="col-3 invoice-item-title">Quantite</div>
                                                            <div class="col-3 col-md-2 invoice-item-title">Prix HT</div>
                                                        </div>
                                                        <div class="invoice-item d-flex border rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                                <div class="col-12 col-md-4 form-group">
                                                                    <select id="article" class="form-control invoice-item-select">
                                                                        <option value="Pas d'article">Sélectionnez un article</option>
                                                                        <optgroup label="Liste des articles">
                                                                        </optgroup>
                                                                        <?php foreach($article as $articlee): ?>
                                                                        <option value="<?= $articlee['article'] ?>"><?= $articlee['article'] ?></option>
                                                                        <?php endforeach; ?>
                                                                        <optgroup label="Autres options">
                                                                        <option value="Pas d'article">Autres</option>
                                                                        </optgroup>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <input name="cout" id="cout" type="number" class="form-control" min="1" placeholder="0" onkeyup="myFunction()" step="any">
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <input name="quantite" id="quantite" type="number" value="1" min="1" class="form-control" placeholder="0" onkeyup="myFunction()" step="any">
                                                                </div>
                                                                <div class="col-md-2 col-12 form-group">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong id="demo" class="text-primary align-middle">00.00 €</strong>
                                                                </div>
                                                                <div class="col-md-4 col-12 form-group">
                                                                    <label for="article">Nouvelle Article :</label>
                                                                    <input name="article" id="newarticle" type="text" class="form-control invoice-item-desc" placeholder="Nouvelle article">
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label for="ref">REF :</label>
                                                                    <input name="referencearticle" id="referencearticle" type="text" class="form-control invoice-item-desc" placeholder="Réference">
                                                                </div>
                                                            </div>
                                                            <div class="invoice-icon d-flex flex-column justify-content-between border-left p-25">

                                                                <div class="dropdown">
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
                                            <div class="form-group">
                                                <div class="col p-0">
                                                    <button class="btn btn-light-primary btn-sm" type="button">
                                                        <i class="bx bx-plus"></i>
                                                        <span type="button" id="button_send" class="invoice-repeat-btn">Ajouter l'article</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <table id="table" name="table" class="table table-bordered"><style>.red{color: red;} .line{text-decoration: underline;}</style>
                                                <tbody>
                                                    <tr>
                                                        <th>Bon</th>
                                                        <th>Ref</th>
                                                        <th>Nom</th>
                                                        <th>Pu</th>
                                                        <th>Qt</th>
                                                        <th>U</th>
                                                        <th>Tva(%)</th>
                                                        <th>Red(%)</th>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- invoice subtotal -->
                                        <hr>
                                        <div class="invoice-subtotal pt-50">
                                            <div class="row">
                                                <div class="col-md-6 col-12">
                                                    <div class="form-group">
                                                        <label>Modalité :</label>
                                                            <select name="modalite" class="form-control invoice-item-select">
                                                            <option value="" selected>Selectionnez une modalite</option>
                                                            <option value="CB">Carte bancaire</option>
                                                            <option value="Chèque">Chèque</option>
                                                            <option value="Espèce">Espece</option>
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
                                                    <div class="form-group">
                                                        <label>Commentaire :</label>
                                                        <input name="note" type="text" class="form-control" placeholder="Ajouter une note client">
                                                    </div>
                                                   
                                                </div>
												 <div class="col-md-6 col-12">
                                              
                                                  
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
                                                       
                                                        <li class="list-group-item border-0 pb-0"><style>.green{background: #43b546; color: white;}  .green:hover{background: #3fff45; color: white;}</style>
                                                            <input name="insert" id="button_save" type="button" value="Vérification" class="btn btn-primary btn-block subtotal-preview-btn" onclick="buttonc()"/>
                                                            <input name="insert" id="subbt" type="hidden" value="Sauvegarder" class="btn btn btn-block subtotal-preview-btn green"/>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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
    <script src="../../../app-assets/js/scripts/pages/myFunction_fournisseur.js"></script>
    <script src="../../../app-assets/js/scripts/pages/complete-facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
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