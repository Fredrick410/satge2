<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/verif_session_connect.php';
require_once 'php/config.php';
   
    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $entreprise = $pdoStat->fetch();

    $pdoStat = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoStat->bindValue(':num',$_SESSION['id_session']); //$_SESSION 
    $pdoStat->execute();
    $membre = $pdoStat->fetchAll();

    if($_GET['secteur'] == ""){
        header("location: bulletin-view.php?req=false");
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
    <title>Bulletin de salaire</title>
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
    .icon_plus{cursor: pointer; font-size: 30px; color: #07ff84;}
    .icon_minius{cursor: pointer; font-size: 30px; color: #ff0000;}
    .icon_plus:hover{opacity: 0.5;}
    .icon_minius:hover{opacity: 0.5;}
    .icon_action{color: grey; cursor: pointer;}
    .icon_action:hover{color: blue; opacity: 0.9;}
</style>
    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-body">
                <div class="form-group">
                    <h5>Etape 2 - Selectionnez un membre</h5>
                </div>
                <form action="bulletin-three.php">
                    <input type="hidden" name="secteur" value="<?= $_GET['secteur'] ?>">
                    <div class="form-group">
                        <fieldset class="form-group">
                            <br>
                            <label>Selectionnez un membre salarié de l'espace données de coqpix</label>
                            <select name="member" class="form-control" id="basicSelect">
                                <option value="">Selectionnez un membre</option>
                                <optgroup></optgroup>
                                <?php foreach($membre as $membres): ?>
                                    <option class="" value="<?= $membres['nom'] ?> <?= $membres['prenom'] ?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </fieldset>
                    </div>
                    <div class="form-group <?php if($_GET['secteur'] !== "BTP"){echo 'none-validation';} ?>">
                            <div class="form-group">
                            <div class="form-group">
                                <h5>Cocher les indemnités que votre employé utilise</h5>
                            </div>
                            <div class="form-group">
                                <label>Indemnités de trajet: </label>
                                <input style="position: relative; top: 3px;" type="checkbox" name="indemnites_t" id="indemnites_t" onclick="indemnitest()">
                            </div>
                            <div class="form-group">
                                <label>Indemnités de transport: </label>
                                <input style="position: relative; top: 3px;" type="checkbox" name="indemnites_tr" id="indemnites_tr" onclick="indemnitestr()">
                            </div>
                        </div>
                        <div id="div_t" class="form-group none-validation">
                            <fieldset class="form-group">
                                <label>Selectionnez une zone d'indemnités de trajet</label>
                                <select name="zone_t" class="form-control" id="basicSelect">
                                    <option value="disabled">Selectionnez une zone d'indemnités de trajet</option>
                                    <optgroup></optgroup>
                                    <option value="1A">Indemnités de trajet Zone 1A</option>
                                    <option value="1B">Indemnités de trajet Zone 1B</option>
                                    <option value="2">Indemnités de trajet Zone 2</option>
                                    <option value="3">Indemnités de trajet Zone 3</option>
                                    <option value="4">Indemnités de trajet Zone 4</option>
                                    <option value="5">Indemnités de trajet Zone 5</option>
                                </select>
                            </fieldset>
                        </div>
                        <div id="div_tr" class="form-group none-validation">
                            <fieldset class="form-group">
                                <label>Selectionnez une zone d'indemnités de transport</label>
                                <select name="zone_tr" class="form-control" id="basicSelect">
                                    <option value="disabled">Selectionnez une zone d'indemnités de transport</option>
                                    <optgroup></optgroup>
                                    <option value="1A">Indemnités de transport Zone 1A</option>
                                    <option value="1B">Indemnités de transport Zone 1B</option>
                                    <option value="2">Indemnités de transport Zone 2</option>
                                    <option value="3">Indemnités de transport Zone 3</option>
                                    <option value="4">Indemnités de transport Zone 4</option>
                                    <option value="5">Indemnités de transport Zone 5</option>
                                </select>
                            </fieldset>
                        </div>
                    </div>            
                    <div class="form-group">
                        <button class="btn btn-outline-success col-12" type="submit">Continuer</button>
                    </div>
                </form>
                <div class="form-group text-center">
                    <p>Ou</p>
                </div>
                <div class="form-group">
                    <a href="membres-liste.php"><button class="btn btn-outline-info col-12" type="button">Ajouter un membre</button></a>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
    <script>
    
        function indemnitest(){

            var etat = document.getElementById('indemnites_t');

            if (etat.checked == true){
                document.getElementById("div_t").style.display = "block";
            }else{
                document.getElementById("div_t").style.display = "none";
            }

        }

        function indemnitestr(){

            var etat = document.getElementById('indemnites_tr');

            if (etat.checked == true){
                document.getElementById("div_tr").style.display = "block";
            }else{
                document.getElementById("div_tr").style.display = "none";
            }

        }

    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>