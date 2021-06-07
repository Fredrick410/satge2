<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
// require_once 'php/verif_session_connect.php';

    $pdoStat = $bdd->prepare('SELECT * FROM facture WHERE id = :num');
    $pdoStat->bindValue(':num',$_GET['numfacture'], PDO::PARAM_INT);
    $pdoStat->execute();
    $facture = $pdoStat->fetch();
    $numeros = $facture['numerosfacture'];
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdo = $bdd->prepare('SELECT * FROM articles WHERE id_session = :num AND numeros=:numeros AND typ = "facturevente"');
    $pdo->bindValue(':num',$_SESSION['id_session']); //$_SESSION
    $pdo->bindValue(':numeros',$numeros);
    $pdo->execute(); 
    $articles = $pdo->fetchAll();


    try{
  
    $sql = "SELECT SUM(T.TOTAL) as MONTANT_T FROM ( SELECT cout,quantite ,(cout * quantite ) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) T ";
  
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
  
    $sq = "SELECT SUM(R.TOTA) as MONTANT_R FROM ( SELECT cout,quantite,remise ,(((cout * quantite) * (1 - (remise/100)))) as TOTA FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) R ";
  
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
  
    $sql = "SELECT SUM(V.TOTAL) as MONTANT_V FROM ( SELECT cout,quantite,tva ,(((cout * quantite) * (1 - (tva/100)))) as TOTAL FROM articles WHERE id_session = :num AND numeros=:numeros AND typ='facturevente' ) V ";
  
    $req = $bdd->prepare($sql);
    $req->bindValue(':num',$_SESSION['id_session']); //$_SESSION['id_session']
    $req->bindValue(':numeros',$numeros); 
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
    <title>View facture</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
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
<style>
.none-validation{display: none;}
</style>
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
                                                <span class="invoice-number mr-50">Facture N°</span>
                                                <span><?= $facture['numerosfacture']; ?></span>
                                            </div>
                                            <div class="col-xl-4 col-md-12">
                                                <span class="invoice-number mr-50">Référence: </span>
                                                <span><?= $facture['reffacture']; ?></span>
                                            </div>
                                            <div class="col-xl-8 col-md-12">
                                                <div class="d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="mr-3">
                                                        <small class="text-muted">Date :</small>
                                                        <span><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($facture['dte']));?></span>
                                                    </div>
                                                    <div class="<?php if($facture['dateecheance'] == ""){echo "none-validation";} ?>">
                                                        <small class="text-muted">Date échéance:</small>
                                                        <span><?php setlocale(LC_TIME, "fr_FR"); echo strftime("%d-%m-%G", strtotime($facture['dateecheance']));?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- logo and title -->
                                        <div class="row my-3">
                                            <div class="col-6">
                                                <h4 class="text-primary">Facture</h4>
                                                <span><?= $facture['nomproduit']; ?></span>
                                                <br><br><br>
                                                <h6 class="text-primary">Description</h6>
                                                <span><?= $facture['descrip']; ?></span>
                                            </div>
                                            
                                            <div class="col-6 d-flex justify-content-end">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- invoice address and contact -->
                                        <div class="row invoice-info">
                                            <div class="col-6 mt-1">
                                                <h6 class="invoice-from">Facture de</h6>
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
                                                <h6 class="invoice-to">Facture pour</h6>
                                                <div class="mb-1">
                                                    <span><?= $facture['facturepour']; ?></span>
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
                                                    <th scope="col">Cout</th>
                                                    <th scope="col">Quantite</th>
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
                                                    <td class="text-primary text-right font-weight-bold"><?= $articless['cout'] * $articless['quantite'] ?> <?= $facture['monnaie']; ?></td>
                                                </tr>
                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div>

                                    <!-- invoice subtotal -->
                                    <div class="card-body pt-0 mx-25">
                                        <hr>
                                        <div class="row">
                                            <div class="col-4 col-sm-6 mt-75">
                                                <div class='<?php if($facture['note'] == "Pas de commentaire"){echo "none-validation";} ?>'>
                                                    <label>Commentaire :</label><br><br>
                                                    <span class="invoice-title"><?= $facture['note'] ?></span>
                                                </div>
                                            </div>
                                            <div class="col-8 col-sm-6 d-flex justify-content-end mt-75">
                                                <div class="invoice-subtotal">
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Totale HT</span>
                                                        <span class="invoice-value"> <?= $montant_t; ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc <?php if(($montant_t - $montant_r) == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Remise sur HT</span>
                                                        <span class="invoice-value">- <?= $montant_t - $montant_r ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc <?php if(($montant_t - $montant_r) == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Totale HT - Remise</span>
                                                        <span class="invoice-value"> <?= $montant_t - ($montant_t - $montant_r) ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <hr>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">TVA</span>
                                                        <span class="invoice-value"><?= $montant_t - $montant_tva ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-title">Total TTC</span>
                                                        <span class="invoice-value"> <?= $montant_t + ($montant_t - $montant_tva) ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <hr>
                                                    <div class="invoice-calc <?php if($facture['accompte'] == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Accompte</span>
                                                        <span class="invoice-value">- <?= $facture['accompte'] ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <div class="invoice-calc <?php if($facture['accompte'] == "0"){echo "none-validation";}else{echo "d-flex";} ?> justify-content-between">
                                                        <span class="invoice-title">Total TTC - Accompte</span>
                                                        <span class="invoice-value"><?= ($montant_t + ($montant_t - $montant_tva)) - $facture['accompte'] ?> <?= $facture['monnaie']; ?></span>
                                                    </div>
                                                    <hr class='<?php if(($montant_t - $montant_r) == "0"){echo "none-validation";} ?>'>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Modalite de payement :</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $facture['modalite']; ?></h6>
                                                    </div>
                                                    <div class="invoice-calc d-flex justify-content-between">
                                                        <span class="invoice-subtotal-title">Monnaie :</span>
                                                            <h6 class="invoice-subtotal-value mb-0"><?= $facture['monnaie']; ?></h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                                        
                                      <form action="app-invoice-edit.php" method="GET">
                                        <input type="hidden" name="numfacture" value="<?= $facture['id']?>">
                                        <input value="Modifier la facture" type="submit" href="app-invoice-edit.html" class="btn btn-light-primary btn-block">
                                      </form>    
                                      
                                        </a>
                                    </div>
                                    <div class="invoice-action-btn">
                                        
                                        <form action="app-invoice-list.php"><input value="Retour" type="submit" class="btn btn-success btn-block"></form>
                                          
                                    </div>
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
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>