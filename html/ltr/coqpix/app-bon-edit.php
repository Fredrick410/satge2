<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
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

    $pdoSt = $bdd->prepare('SELECT * FROM article WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute();
    $article = $pdoSt->fetchAll();

    $pdoS = $bdd->prepare('SELECT * FROM bon WHERE id = :num');
    $pdoS->bindValue(':num',$_GET['numbon']);
    $pdoS->execute();
    $facture = $pdoS->fetch();


    $pdo = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num AND numeros=:numeros AND typ="bonvente"');
    $pdo->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdo->bindValue(':numeros',$_GET['numbon']);
    $pdo->execute();
    $articles = $pdo->fetchAll();

    $pdoSt = $bdd->prepare('SELECT * FROM client WHERE id_session = :num');
    $pdoSt->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdoSt->execute();
    $client = $pdoSt->fetchAll();

    $pdoStt = $bdd->prepare('SELECT * FROM prestations WHERE id_session = :num AND typ="bonvente"');
    $pdoStt->bindValue(':num', $_SESSION['id_session']); //$_SESSION
    $pdoStt->execute();
    $prestation = $pdoStt->fetchAll();

    try{

    $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' ) T ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$_GET['numbon']);
    $req->execute();
    $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t = !empty($res) ? $res['MONTANT_T'] : 0;


    try{

    $sq = "SELECT SUM(R.TOTA) as MONTANT_R FROM ( SELECT cout,quantite,remise ,(((cout * quantite) * (1 - (remise/100)))) as TOTA FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' ) R ";

    $re = $bdd->prepare($sq);
    $re->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $re->bindValue(':numeros',$_GET['numbon']);
    $re->execute();
    $rer = $re->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_r = !empty($rer) ? $rer['MONTANT_R'] : 0;

    try{

    $sql = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' ) V ";

    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$_GET['numbon']);
    $req->execute();
    $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva = !empty($res) ? $res['MONTANT_V'] : 0;



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
    <title>Editer bon</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
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
<style>
.none-validation{display: none;}
</style>
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
                                    <div class="form-group text-right">
                                    <style>.line{text-decoration: underline;} .size{font-size: 15px; color: red; position:relative; top: 2px;} .size:hover{color: blue; transition-duration: 1s;}</style>
                                    <!-- <label class="line">Pour passer le bon en facture</label>&nbsp&nbsp&nbsp&nbsp&nbsp<a href="php/dev-inv.php?id=<?= $facture['id'] ?>"><i class='bx bxs-send size'></i></a> -->
                                    </div>
                                    <div class="form-group">
                                    <hr>
                                    </div>
                                    <!-- form qui insert toute la page -->
                                <form autocomplete="off" action="php/edit_bon.php" method="POST">
                                    <input type="hidden" name="numbon" value="<?= $facture['id'] ?>">
                                        <div class="row mx-0">

                                            <div class="col-xl-6 col-md-12 d-flex align-items-center pl-0">
                                                        <h6 class="invoice-number mr-75">
                                                                        N°
														</h6>
                                                        <!-- auto incrémentation du n° avec le max_num plus haut  -->
														<input type="number" name="id" id="numeros" value='<?= $facture['id'] ?>' class="form-control pt-25 w-50" placeholder="00000" disabled>
                                                <h6 class="invoice-number mr-75">
                                                                Référence
                                                            </h6>
                                                            <input name="refbon" id="refbon" type="text" value="<?= $facture['refbon'] ?>" class="form-control pt-20 w-50" placeholder="XXX-">
                                                            <p style='position: relative; top: 7px;'>
                                                                &nbsp&nbsp&nbsp
                                                            </p>
                                                <h6 class="invoice-number mr-75">bon N°</h6>
                                                <!-- auto incrémentation du numéro qui peut aussi etre choisi -->
                                                <input name="numerosbon"  type="text" class="form-control pt-25 w-50" placeholder="00000" value="<?= $facture['numerosbon'] ?>">

                                            </div>
                                            <div class="col-xl-6 col-md-12 px-0 pt-xl-0 pt-1">
                                                <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">*Date : </small>
                                                        <fieldset class="d-flex ">
                                                            <input name="dte" id="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" placeholder="jj-mm-aa" value="<?= $facture['dte'] ?>">
                                                        </fieldset>
                                                    </div>
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">
                                                        Date d'échéance : </small>
                                                        <fieldset class="d-flex justify-content-end">
                                                            <input name="dateecheance" id="dateecheance" type="date" class="form-control mb-50 mb-sm-0" placeholder="jj-mm-aa" value="<?= $facture['dateecheance'] ?>">
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1" style="text-align:center;padding-top:4%">
                                                <h4 class="text-primary">bon</h4>
                                                <input name="nomproduit" id="nomproduit" type="text" class="form-control" placeholder="Nom du bon" value="<?= $facture['nomproduit'] ?>">
                                                <div class="form-group">
                                                            <label for="exampleFormControlTextarea1">Description</label>
                                                            <textarea class="form-control" name="descrip" id="exampleFormControlTextarea1" rows="5"><?= $facture['descrip']?></textarea>
                                                        </div>
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
                                                    <select name="bonpour" id="bonpour" class="form-control invoice-item-select">
                                                    <!-- facturepour car js prend que id=facturepour-->
                                                        <option value="<?= $facture['bonpour'] ?>"><?= $facture['bonpour'] ?></option>
                                                        <optgroup label="--------------------------------">
                                                        <?php foreach($client as $clientt): ?>
                                                        <option value="<?= $clientt['name_client'] ?>"><?= $clientt['name_client'] ?></option>
                                                        <?php endforeach; ?>
                                                        <!-- list de tous les clients prénsents dans la colonne name_client -->
                                                        <optgroup label="--------------------------------">
                                                        <option value="Pas de clients">Autres</option>
                                                    </select>
                                                </div>

                                                <label for="adress">*Adresse :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="adresse" id="adresse" class="form-control" rows="4" value="<?= $facture['adresse'] ?>">
                                                </fieldset>

                                            </div>
											 <div class="col-lg-6 col-md-12 mt-25">

                                                <label for="email">*Département :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="departement" id="departement" type="number" class="form-control" placeholder="Département" value="<?= $facture['departement'] ?>">
                                                </fieldset>
                                                 <label for="email">Email :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="email" id="email" type="email" class="form-control" placeholder="Email" value="<?= $facture['email'] ?>">
                                                </fieldset>
                                                <label for="email">TEL :</label>
                                                <fieldset class="invoice-address form-group">
                                                    <input name="tel" id="telephone" type="text" class="form-control" placeholder="Téléphone" value="<?= $facture['tel'] ?>">
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
                                                    <!-- affiche les articles deja présents -->
                                                        <?php foreach($articles as $articless): ?>
                                                        <div class="invoice-item d-flex border rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                                <div class="col-12 col-md-4 form-group">
                                                                    <label>Article :</label>
                                                                    <input name="article" type="text" class="form-control invoice-item-desc" placeholder="Article" value="<?= $articless['article'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Cout :</label>
                                                                    <input name="cout" type="number" class="form-control" placeholder="0" value="<?= $articless['cout'] ?>" readonly >
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Quantite :</label>
                                                                    <input name="quantite" type="number" class="form-control" placeholder="0" value="<?= $articless['quantite'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-2 col-12 form-group">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong class="text-primary align-middle"><?= $articless['cout'] * $articless['quantite'] ?> €</strong>
                                                                </div>
                                                                <div class="col-md-4 col-12 form-group">
                                                                    <label>Ref :</label>
                                                                    <input name="referencearticle" type="text" class="form-control invoice-item-desc" placeholder="Réference" value="<?= $articless['referencearticle'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                <label>Remise:</label>
                                                                    <input name="remise" type="number" class="form-control" placeholder="0" value="<?= $articless['remise'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                <label>Tva :</label>
                                                                    <input name="tva" type="number" class="form-control" placeholder="0" value="<?= $articless['tva'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-icon d-flex flex-column justify-content-between border-left p-25">
                                                                <div class="dropdown">
                                                                    <a href="php/delete_article_bon.php?num=<?= $articless['id'] ?>&numbon=<?= $facture['id'] ?>"><div class="livicon-evo  cursor-pointer dropdown-toggle" data-options=" name: close.svg; size: 15px "></div></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <hr>
                                                        <div class="row mb-50">
                                                            <div class="col-3 col-md-4 invoice-item-title">Article</div>
                                                            <div class="col-3 invoice-item-title">Coût</div>
                                                            <div class="col-3 invoice-item-title">Quantite</div>
                                                            <div class="col-3 col-md-2 invoice-item-title">Prix</div>
                                                        </div>
                                                        <div class="invoice-item d-flex border-black rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                                <div class="col-12 col-md-4 form-group">
                                                                    <select id="article" class="form-control invoice-item-select border-black">
                                                                        <option value="Pas d'article">Sélectionnez un article</option>
                                                                        <optgroup label="Liste des articles">
                                                                        <!-- list de tous les articles présents dans la table article -->
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
                                                                    <input name="cout" id="cout" type="number" min="1" class="form-control border-black" placeholder="0" onkeyup="myFunction()" step="any">
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <input name="quantite" id="quantite" min="1" type="number" value="1" class="form-control border-black" placeholder="0" onkeyup="myFunction()" step="any">
                                                                </div>
                                                                <div class="col-md-2 col-12 form-group">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                                    <!-- prix de quantité*prix en js -->
                                                                    <strong
                                                                    id="demo" class="text-primary align-middle">00.00 €</strong>
                                                                </div>

                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label for="ref">REF :</label>
                                                                    <input name="referencearticle" id="referencearticle" type="text" class="form-control invoice-item-desc border-black" placeholder="Réference">
                                                                </div>
                                                            </div>
                                                            <div class="invoice-icon d-flex flex-column justify-content-between border-left-black p-25">
                                                                <div class="dropdown">
                                                                    <i class="bx bx-cog cursor-pointer dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
                                                                    <div class="dropdown-menu p-1">
                                                                        <div class="row">
                                                                            <div class="col-12 form-group">
                                                                                <label for="discount">Remise(%)</label>
                                                                                <input name="remise" id="remise" value="0" type="number" class="form-control border-black" id="discount" placeholder="remise" maxlength="3" min="0" max="100">
                                                                            </div>
                                                                             <div class="col-12 form-group">
                                                                                <label for="discount">Tva(%)</label>
                                                                                <input name="tva" id="tva" value="20" type="number" class="form-control border-black" id="discount" placeholder="0" maxlength="3" min="0" max="100">
                                                                            </div>
                                                                            <div class="col-12 form-group">
                                                                                <label>Unite de mesure :</label>
                                                                                <input name="umesure" id="umesure"  type="text" class="form-control border-black" placeholder="Unite de mesure">
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
                                                        <th>bon</th>
                                                        <th>Ref</th>
                                                        <th>Nom</th>
                                                        <th>Ct</th>
                                                        <th>Qt</th>
                                                        <th>U</th>
                                                        <th>Tva(%)</th>
                                                        <th>Red(%)</th>
                                                    <tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="invoice-product-details ">

                                                <div data-repeater-list="group-a">
                                                    <div data-repeater-item>
                                                    <!-- affiche les prestations deja présents -->
                                                        <?php foreach($prestation as $prestations): ?>
                                                        <div class="invoice-item d-flex border rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                                <div class="col-12 col-md-4 form-group">
                                                                    <label>Prestation :</label>
                                                                    <input name="prestation" type="text" class="form-control invoice-item-desc" placeholder="prestation" value="<?= $prestations['prestation'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Cout :</label>
                                                                    <input name="cout" type="number" class="form-control" placeholder="0" value="<?= $prestations['cout'] ?>" readonly >
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label>Quantite :</label>
                                                                    <input name="quantite" type="number" class="form-control" placeholder="0" value="<?= $prestations['quantite'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-2 col-12 form-group">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<strong class="text-primary align-middle"><?= $prestations['cout'] * $prestations['quantite'] ?> €</strong>
                                                                </div>
                                                                <div class="col-md-4 col-12 form-group">
                                                                    <label>Ref :</label>
                                                                    <input name="referencearticle" type="text" class="form-control invoice-item-desc" placeholder="Réference" value="<?= $prestations['referencepresta'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                <label>Remise:</label>
                                                                    <input name="remise" type="number" class="form-control" placeholder="0" value="<?= $prestations['remise'] ?>" readonly>
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                <label>Tva :</label>
                                                                    <input name="tva" type="number" class="form-control" placeholder="0" value="<?= $prestations['tva'] ?>" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="invoice-icon d-flex flex-column justify-content-between border-left p-25">
                                                                <div class="dropdown">
                                                                    <a href="php/delete_article_bon.php?num=<?= $prestations['id'] ?>&numbon=<?= $facture['id'] ?>"><div class="livicon-evo  cursor-pointer dropdown-toggle" data-options=" name: close.svg; size: 15px "></div></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php endforeach; ?>
                                                        <hr>
                                                        <div class="row mb-50">
                                                            <div class="col-3 col-md-4 invoice-item-title">Prestation</div>
                                                            <div class="col-3 invoice-item-title">Coût</div>
                                                            <div class="col-3 invoice-item-title">Quantite</div>
                                                            <div class="col-3 col-md-2 invoice-item-title">Prix</div>
                                                        </div>
                                                        <div class="invoice-item d-flex border-black rounded mb-1">
                                                            <div class="invoice-item-filed row pt-1 px-1">
                                                              <div class="col-12 col-md-4 form-group">
                                                                <select name="prestation5" id="prestation5" class="form-control invoice-item-select">
                                                                  <option value="Pas de prestation">Sélectionnez une prestation</option>
                                                                  <optgroup label="Liste des prestations"></optgroup>
                                                                  <?php foreach ($prestation as $prestationn) : ?>
                                                                    <option value="<?= $prestationn['prestation'] ?>"><?= $prestationn['prestation'] ?></option>
                                                                  <?php endforeach; ?>
                                                                  <!--Affichage de tout les produits -->
                                                                  <optgroup label="Autres options">
                                                                    <option value="Pas de prestation">Autres</option>
                                                                  </optgroup>
                                                                </select>
                                                              </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <input name="cout" id="cout" type="number" min="1" class="form-control border-black" placeholder="0" onkeyup="myFunction5()" step="any">
                                                                </div>
                                                                <div class="col-md-3 col-12 form-group">
                                                                    <input name="quantite" id="quantite" min="1" type="number" value="1" class="form-control border-black" placeholder="0" onkeyup="myFunction()" step="any">
                                                                </div>
                                                                <div class="col-md-2 col-12 form-group">
                                                                    &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp
                                                                    <!-- prix de quantité*prix en js -->
                                                                    <strong
                                                                    id="demo" class="text-primary align-middle">00.00 €</strong>
                                                                </div>

                                                                <div class="col-md-3 col-12 form-group">
                                                                    <label for="ref">REF :</label>
                                                                    <input name="referencearticle" id="referencearticle" type="text" class="form-control invoice-item-desc border-black" placeholder="Réference">
                                                                </div>
                                                            </div>
                                                            <div class="invoice-icon d-flex flex-column justify-content-between border-left-black p-25">
                                                                <div class="dropdown">
                                                                    <i class="bx bx-cog cursor-pointer dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button"></i>
                                                                    <div class="dropdown-menu p-1">
                                                                        <div class="row">
                                                                            <div class="col-12 form-group">
                                                                                <label for="discount">Remise(%)</label>
                                                                                <input name="remise" id="remise" value="0" type="number" class="form-control border-black" id="discount" placeholder="remise" maxlength="3" min="0" max="100">
                                                                            </div>
                                                                             <div class="col-12 form-group">
                                                                                <label for="discount">Tva(%)</label>
                                                                                <input name="tva" id="tva" value="20" type="number" class="form-control border-black" id="discount" placeholder="0" maxlength="3" min="0" max="100">
                                                                            </div>
                                                                            <div class="col-12 form-group">
                                                                                <label>Unite de mesure :</label>
                                                                                <input name="umesure" id="umesure"  type="text" class="form-control border-black" placeholder="Unite de mesure">
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
                                                        <span type="button" id="button_send" class="invoice-repeat-btn">Ajouter la prestation</span>
                                                    </button>
                                                </div>
                                            </div>
                                            <table id="table" name="table" class="table table-bordered"><style>.red{color: red;} .line{text-decoration: underline;}</style>
                                                <tbody>
                                                    <tr>
                                                        <th>bon</th>
                                                        <th>Ref</th>
                                                        <th>Nom</th>
                                                        <th>Ct</th>
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
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label>Accompte :</label>
                                                        <input value="<?= $facture['accompte'] ?>" name="accompte" type="number" class="form-control" placeholder="Ajouter un accompte sur la facture">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>*Modalité :</label>
                                                            <select name="modalite" class="form-control invoice-item-select">
                                                            <option value="<?= $facture['modalite'] ?>" selected><?= $facture['modalite'] ?></option>
                                                            <optgroup></optgroup>
                                                            <option value="CB">Carte bancaire</option>
                                                            <option value="Chèque">Chèque</option>
                                                            <option value="Espèce">Espece</option>
                                                            <option value="Virement">Virement</option>
															<option value="Prélèvement">Prélèvement</option>
                                                         </select>
                                                    </div>
                                                    <label>*Monnaie :</label>
                                                    <div class="form-group" id="etiq">
                                                        <select name="monnaie" class="form-control invoice-item-select">
                                                            <option value="<?= $facture['monnaie'] ?>" selected><?= $facture['monnaie'] ?></option>
                                                            <option value="€">€</option>
                                                            <option value="$">$</option>
                                                            <option value="Dinar">Dinar</option>
                                                         </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>*Commentaire :</label>
                                                        <input name="note" type="text" class="form-control" placeholder="Ajouter une note client" value="<?= $facture['note'] ?>">
                                                    </div>
                                                    <label for="etiq">*Etiquette :</label>
                                                    <div class="form-group" id="etiq">
                                                        <select name="etiquette" class="form-control invoice-item-select">
                                                            <option value="<?= $facture['etiquette'] ?>" selected><?= $facture['etiquette'] ?></option>
                                                            <option value="Inconnue">Inconnue</option>
                                                            <option value="Electronique">Electronique</option>
                                                            <option value="Décoration">Décoration</option>
                                                            <option value="Ecommerce">Ecommerce</option>
                                                            <option value="Autre">Autre</option>
                                                         </select>
                                                    </div>
                                                    <label >*Status :</label>
                                                    <div class="form-group">

                                                        <select name="status_bon" class="form-control invoice-item-select">
                                                            <option value="<?= $facture['status_bon'] ?>"><?= $facture['status_bon'] ?></option>
                                                            <option value="NON PAYE">Non payé</option>
                                                            <option value="PAYE">Payé</option>
                                                         </select>
                                                    </div>
                                                </div>
                                                <div class="col-lg-5 col-md-7 offset-lg-2 col-12">
                                                    <ul class="list-group list-group-flush">
                                                        <hr>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Total HT</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $montant_t; ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Remis sur HT</span>
                                                            <h6 class="invoice-subtotal-value mb-0">- <?= $montant_t - $montant_r ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Total HT-Remise</span>
                                                            <h6 class="invoice-subtotal-value mb-0"> <?= $montant_t - ($montant_t - $montant_r) ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <hr>
                                                       <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">TVA</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $montant_t - $montant_tva ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Totale TTC</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $montant_t + ($montant_t - $montant_tva) ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <hr>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Accompte</span>
                                                            <h6 class="invoice-subtotal-value mb-0">- <?= $facture['accompte'] ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between border-0 py-0">
                                                            <span class="invoice-subtotal-title">Total TTC - Accompte</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= ($montant_t + ($montant_t - $montant_tva)) - $facture['accompte'] ?> <?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <hr>
                                                        <li class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                            <span class="invoice-subtotal-title">Modalite de payement : </span>
                                                            <h6 class="invoice-subtotal-value mb-0">(<?= $facture['modalite'] ?>)</h6>
                                                        </li>
                                                        <li class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                            <span class="invoice-subtotal-title">Monnaie : </span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $facture['monnaie']; ?></h6>
                                                        </li>
                                                        <li class="list-group-item border-0 pb-0"><style>.green{background: #43b546; color: white;}  .green:hover{background: #3fff45; color: white;}</style>
                                                        <!-- Boutons qui envoient le form global. Attention aux div en trop ou mal indentées car il ne fonctionnerait plus. -->
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
    <script src="../../../app-assets/js/scripts/pages/myFunction_facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/complete-facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>
