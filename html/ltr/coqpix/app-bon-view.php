<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
// require_once 'php/verif_session_connect.php';

    $pdoStat = $bdd->prepare('SELECT * FROM bon WHERE id = :num');
    $pdoStat->bindValue(':num',$_GET['numbon'], PDO::PARAM_INT);
    $pdoStat->execute();
    $facture = $pdoStat->fetch();
    $numeros = $facture['numerosbon'];
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdo = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num AND numeros=:numeros AND typ = "bonvente"');
    $pdo->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdo->bindValue(':numeros',$numeros);
    $pdo->execute(); 
    $articles = $pdo->fetchAll();


    try{
  
    $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' ) T ";
  
    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$numeros); 
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
    $re->bindValue(':numeros',$numeros); 
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
    $req->bindValue(':numeros',$numeros); 
    $req->execute();
    $res = $req->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva = !empty($res) ? $res['MONTANT_V'] : 0;


    // TVA 20%

    try{
  
    $sqlt20 = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva = '20 %' ) V ";
  
    $reqt20 = $bdd->prepare($sqlt20);
    $reqt20->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqt20->bindValue(':numeros',$numeros); 
    $reqt20->execute();
    $rest20 = $reqt20->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva_20 = !empty($rest20) ? $rest20['MONTANT_V'] : 0;

    try{
  
    $sqlm20 = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva='20 %' ) T ";
  
    $reqm20 = $bdd->prepare($sqlm20);
    $reqm20->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqm20->bindValue(':numeros',$numeros); 
    $reqm20->execute();
    $resm20 = $reqm20->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t_20 = !empty($resm20) ? $resm20['MONTANT_T'] : 0;

    // TVA 10%

    try{
  
    $sqlt10 = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva = '10 %' ) V ";
  
    $reqt10 = $bdd->prepare($sqlt10);
    $reqt10->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqt10->bindValue(':numeros',$numeros); 
    $reqt10->execute();
    $rest10 = $reqt10->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva_10 = !empty($rest10) ? $rest10['MONTANT_V'] : 0;

    try{
  
    $sqlm10 = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva='10 %' ) T ";
  
    $reqm10 = $bdd->prepare($sqlm10);
    $reqm10->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqm10->bindValue(':numeros',$numeros); 
    $reqm10->execute();
    $resm10 = $reqm10->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t_10 = !empty($resm10) ? $resm10['MONTANT_T'] : 0;

    // TVA 5,5%

    try{
  
    $sqlt55 = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva = '5,5 %' ) V ";
  
    $reqt55 = $bdd->prepare($sqlt55);
    $reqt55->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqt55->bindValue(':numeros',$numeros); 
    $reqt55->execute();
    $rest55 = $reqt10->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva_55 = !empty($rest55) ? $rest55['MONTANT_V'] : 0;

    try{
  
    $sqlm55 = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva='5,5 %' ) T ";
  
    $reqm55 = $bdd->prepare($sqlm55);
    $reqm55->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqm55->bindValue(':numeros',$numeros); 
    $reqm55->execute();
    $resm55 = $reqm55->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t_55 = !empty($resm55) ? $resm55['MONTANT_T'] : 0;

    // TVA 2,1%

    try{
  
    $sqlt21 = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva = '2,1 %' ) V ";
  
    $reqt21 = $bdd->prepare($sqlt55);
    $reqt21->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqt21->bindValue(':numeros',$numeros); 
    $reqt21->execute();
    $rest21 = $reqt10->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_tva_21 = !empty($rest21) ? $rest21['MONTANT_V'] : 0;

    try{
  
    $sqlm21 = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='bonvente' AND tva='2,1 %' ) T ";
  
    $reqm21 = $bdd->prepare($sqlm21);
    $reqm21->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $reqm21->bindValue(':numeros',$numeros); 
    $reqm21->execute();
    $resm21 = $reqm21->fetch();
    }catch(Exception $e){
        echo "Erreur " . $e->getMessage();
    }

    $montant_t_21 = !empty($resm21) ? $resm21['MONTANT_T'] : 0;
    
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
    <title>View bon</title>
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

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-view-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card invoice-print-area">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                        <div class="row">
                                            <div class="col-xl-4 col-md-12">
                                                <span class="invoice-number mr-50">Bon N°</span><span><?= $facture['numerosbon']; ?></span>
                                            </div>
                                            <div class="col-xl-8 col-md-12">
                                                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="mr-3">
                                                        <small class="text-muted">Date :</small>
                                                        <span><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($facture['dte']));?></span>
                                                    </div>
                                                    <div>
                                                        <small class="text-muted">Date échéance:</small>
                                                        <span><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($facture['dateecheance']));?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="row my-3">
                                            <div class="col-6">
                                                <h4 class="text-primary">Bon de livraison</h4>
                                                <span><?= $facture['nomproduit']; ?></span>
                                            </div>
                                            <div class="col-6 d-flex justify-content-end">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col-6 mt-1">
                                                <h5 class="invoice-from">Bon de livraison de</h5>
                                                <div class="mb-1">
                                                    <span><?= $entreprise['nameentreprise']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $entreprise['adresseentreprise']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $entreprise['emailentreprise']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $entreprise['telentreprise']; ?></span>
                                                </div>
                                            </div>
                                            <div class="col-6 mt-1">
                                                <h5 class="invoice-to">Bon de livraison pour</h5>
                                                <div class="mb-1">
                                                    <span><?= $facture['bonpour']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $facture['adresse']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $facture['email']; ?></span>
                                                </div>
                                                <div class="mb-1">
                                                    <span><?= $facture['tel']; ?></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                    </div>
                                    <!-- product details table-->
                                    <div class="invoice-product-details table-responsive mx-md-25">
                                        <table class="table table-borderless mb-0">
                                            <thead>
                                                <tr class="border-0">
                                                    <th scope="col">Article</th>
                                                    <th scope="col">Référence</th>
                                                    <th scope="col">Prix U</th>
                                                    <th scope="col">Quantite</th>
                                                    <th scope="col">Unite de mesure</th>
                                                    <th scope="col" class="text-right">Prix HT</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($articles as $articless): ?>
                                                <tr>
                                                    <td><?= $articless['article']; ?></td>
                                                    <td><?= $articless['referencearticle']; ?></td>
                                                    <td><?= $articless['cout']; ?></td>
                                                    <td><?= $articless['quantite']; ?></td>
                                                    <td><?= $articless['umesure']; ?></td>
                                                    <td class="text-primary text-right font-weight-bold"><?= $articless['cout'] * $articless['quantite'] ?> <?= $facture['monnaie']; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    
                                    <style>.tvadis{display: none;}</style> 
                                    <?php

                                        $tva = ($montant_t-$montant_tva);

                                        if($tva == "0"){$displaytva = "tvadis"; $checktva = "checked";}else{
                                        }

                                    ?>

                                    <!-- invoice subtotal -->
                                    <div class="card-body pt-0 mx-25">
                                        <hr>
                                        <div class="row">
                                            <div class="col-4 col-sm-6 mt-75">
                                                <div class="form-group">    
                                                    <span class="invoice-title"><?php if($facture['note'] == "Pas de commentaire"){$noteresult = "";}else{$noteresult = $facture['note'];} ?><?= $noteresult ?></span>
                                                </div><br>
                                                <div class="form-group"><style>.size{font-size: 12px;}  .display{display: none;} .aucun{text-transform:none;} .greyy{color:#aeaeae;} .bluee{color: #aed8ff;}</style>  
                                                    <label></label><br><br><br><br>
                                                    <div class="<?php if(empty($displaytva)){echo "tvadis";} ?>" id="d1"><span class="invoice-title size">Autoliquidation de la TVA.</span></div> <!-- id=1 -->
                                                </div>
                                            </div>
                                            <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                <div class="invoice-subtotal">
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Total HT</span>
                                                        <span class="invoice-value"> <?= $montant_t; ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc <?php if(($montant_t - $montant_r) == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Remise sur HT</span>
                                                        <span class="invoice-value">- <?= $montant_t - $montant_r ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc <?php if(($montant_t - $montant_r) == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Total HT - Remise</span>
                                                        <span class="invoice-value"> <?= $montant_t - ($montant_t - $montant_r) ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <hr>
                                                    <div class="<?php if(empty($displaytva)){echo "";}else{echo $displaytva;} ?>">
                                                    

                                                    <style>
                                                    
                                                    .sizetva{
                                                        font-size: 13px;
                                                    }

                                                    </style>

                                                    <div class="<?php if(($montant_t_20 - $montant_tva_20) == "0"){echo "display";} ?> sizetva"><div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total 20% :</span>
                                                        <h6 class="invoice-subtotal-value mb-0 sizetva"> <?= $montant_t_20 - $montant_tva_20 ?> <?= $facture['monnaie']; ?></h6>
                                                    </div></div>  
                                                    <div class="<?php if(($montant_t_10 - $montant_tva_10) == "0"){echo "display";} ?> sizetva"><div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total 10% :</span>
                                                        <h6 class="invoice-subtotal-value mb-0 sizetva"><?= $montant_t_10 - $montant_tva_10 ?><?= $facture['monnaie']; ?></h6>
                                                    </div></div>                                   
                                                    <div class="<?php if(($montant_t_55 - $montant_tva_55) == "0"){echo "display";} ?> sizetva"><div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total 5,5% :</span>
                                                        <h6 class="invoice-subtotal-value mb-0 sizetva"><?= $montant_t_55 - $montant_tva_55 ?><?= $facture['monnaie']; ?></h6>
                                                    </div></div>
                                                    <div class="<?php if(($montant_t_21 - $montant_tva_21) == "0"){echo "display";} ?> sizetva"><div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total 2,1% :</span>
                                                        <h6 class="invoice-subtotal-value mb-0 sizetva"><?= $montant_t_21 - $montant_tva_21 ?><?= $facture['monnaie']; ?></h6>
                                                    </div></div><br>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Total TVA :</span>
                                                        <h6 class="invoice-subtotal-value mb-0 sizetva"> <?= $tva ?> <?= $facture['monnaie']; ?></h6>
                                                    </div>
                                                    <hr>
                                                    </div>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Total TTC</span>
                                                        <span class="invoice-value"> <?= $montant_t + $tva ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <hr>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Modalite de payement :</span>
                                                            <h6 class="invoice-subtotal-value mb-0"> <?= $facture['modalite'] ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <style>
                                    
                                    .sizeview{font-size: 13px;}

                                    </style>
                                    <hr>
                                    <div class="form-group text-center">
                                        <label class="aucun greyy">Siège social</label>&nbsp<span class="aucun sizeview" id="siegeview"><?= $entreprise['adresseentreprise'] ?></span>,<label class="aucun greyy">N° Siret</label>&nbsp<span class="sizeview" id="siretview"><?= $entreprise['numerossiret'] ?></span>,<label class="greyy aucun">TVA Intra</label>&nbsp<span class="sizeview" id="intraview">FR XX</span><br>
                                        <span class="aucun sizeview"><?= $entreprise['nameentreprise'] ?> ,</span><label class="greyy aucun">Tel:</label>&nbsp&nbsp<span class="sizeview" id="telview"><?= $entreprise['telentreprise'] ?></span>,&nbsp&nbsp<span class="aucun sizeview" id="emailview"><?= $entreprise['emailentreprise'] ?></span>,&nbsp&nbsp<span class="sizeview aucun" id="siteview"><?= $entreprise['link_website'] ?></span><br>
                                        <span class="aucun sizeview" id="banqueview">Ma banque</span>, <label class="aucun greyy">Iban</label>&nbsp<span class="sizeview aucun" id="ibanview"><?= $entreprise['iban_entreprise'] ?></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- invoice action  -->
                        <div class="col-xl-3 col-md-4 col-12">
                            <div class="card invoice-action-wrapper shadow-none border">
                                <div class="card-body">
                                    <div class="invoice-action-btn">
                                        <button class="btn btn-light-primary btn-block invoice-print" onClick="window.print()">
                                            <span>Enregister ou Imprimer</span>
                                        </button>
                                    </div>
                                    <div class="invoice-action-btn">        
                                      <form action="app-bon-edit.php" method="GET">
                                        <input type="hidden" name="numbon" value="<?= $facture['id']?>">
                                        <input value="Modifier le bon" type="submit" href="app-invoice-edit.html" class="btn btn-light-primary btn-block">
                                      </form>      
                                    </div>
                                    <div class="invoice-action-btn">        
                                        <form action="app-bon-list.php"><input value="Retour" type="submit" class="btn btn-success btn-block"></form>               
                                    </div>
                                    <hr>
                                    <div class="form-group"><style>.line{text-decoration: underline;}</style>
                                        <h5>Configuration :</h5>
                                    </div>
                                    <!-- TVA -->
                                    <div class="<?php if($tva == "0"){echo "";}else{echo "tvadis";} ?>">
                                    <hr>
                                    <div class="form-group">
                                        <h6 class="line">TVA :</h6>
                                    </div>
                                    <div class="form-group">
                                        <input type="checkbox" id="togg1" name="togg1" <?php if($tva == "0"){echo "checked";} ?>>&nbsp&nbsp&nbsp<label>Autoliquidation de la TVA<label>
                                    </div>
                                    </div>
                                    <hr>
                                    <!-- LOGO ENTREPRISE -->
                                    <div class="form-group">
                                        <h6 class="line">LOGO :</h6>
                                    </div>
                                    <div class="form-group">
                                        <label>Bientot<label>
                                    </div>
                                    <hr>
                                    <!-- Bas de page -->
                                    <div class="form-group">
                                        <h6 class="line">Bas de page :</h6>
                                    </div>
                                    <div class="form-group">
                                            <label>Siège Social :</label>
                                            <input name="social" id="siegeinp" type="text" class="form-control invoice-item-desc" value="<?= $entreprise['adresseentreprise'] ?>" placeholder="Mon siège social" onkeyup="siegeinp()">
                                    </div>
                                    <div class="form-group">
                                            <label>N° Siret :</label>
                                            <input name="siret" id="siret" type="text" class="form-control invoice-item-desc" value="<?= $entreprise ['numerossiret'] ?>" placeholder="N° Siret" onkeyup="siret()">
                                    </div>
                                    <div class="form-group">
                                            <label>Tva intra :</label>
                                            <input name="intra" id="intra" type="text" class="form-control invoice-item-desc" value="" placeholder="" onkeyup="intra()">
                                    </div>
                                    <div class="form-group">
                                            <label>Téléphone :</label>
                                            <input name="telephone" id="telephone" type="text" class="form-control invoice-item-desc" value="<?= $entreprise ['telentreprise'] ?>" placeholder="06.00.00.00.00"onkeyup="telephone()">
                                    </div>
                                    <div class="form-group">
                                            <label>E-mail :</label>
                                            <input name="email" id="email" type="text" class="form-control invoice-item-desc" value="<?= $entreprise ['emailentreprise'] ?>" placeholder="contact@monentreprise.fr"onkeyup="email()">
                                    </div>
                                    <div class="form-group">
                                            <label>Site web :</label>
                                            <input name="siteweb" id="siteweb" type="text" class="form-control invoice-item-desc" <?= $entreprise ['link_website'] ?> placeholder="www.monsiteinternet.fr"onkeyup="siteweb()">
                                    </div>
                                    <div class="form-group">
                                            <label>Ma banque :</label>
                                            <input name="mabanque" id="mabanque" type="text" class="form-control invoice-item-desc" value="" placeholder="Ex : Credit agricole" onkeyup="mabanque()">
                                    </div>
                                    <div class="form-group">
                                            <label>Iban :</label>
                                            <input name="iban" id="iban" type="text" class="form-control invoice-item-desc" <?= $entreprise ['iban_entreprise'] ?> placeholder="FR76 XXXXXX" onkeyup="iban()">
                                    </div>
                                    <hr>
                                    <!-- COULEUR -->
                                    <div class="form-group">
                                        <h6 class="line">Theme de couleur :</h6>
                                    </div>
                                    <div class="form-group">
                                        <label>Bientot<label>
                                    </div>
                            </div>
                        </div>
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
    <script src="../../../app-assets/js/scripts/pages/script-tva.js"></script>
    <script src="../../../app-assets/js/scripts/pages/entete-view.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>