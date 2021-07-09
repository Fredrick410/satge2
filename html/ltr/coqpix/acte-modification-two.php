<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    if(!empty($_GET['num'])){
        $pdoSta = $bdd->prepare('SELECT * FROM acte WHERE code=:id');
        $pdoSta->bindValue(':id',$_GET['num']);
        $pdoSta->execute();
        $acte = $pdoSta->fetch();

        $nameentreprise = $acte['name_entreprise'];
        $telentreprise = $acte['tel_entreprise'];
        $emailentreprise = $acte['email_entreprise'];
    }else{
        $nameentreprise = $_GET['name_entreprise'];
        $telentreprise = $_GET['t'];
        $emailentreprise = $_GET['em'];
    }

    if(isset($_POST['num_acte'])){
        $frais_av = explode('!',$acte['frais']);
        $honoraire_av = explode('!', $acte['honoraire']);
        $frais = ''.$_POST['frais'].'!'.$frais_av[1].'';
        $honoraire = ''.$_POST['honoraire'].'!'.$honoraire_av[1].'';

        $sql = $bdd->prepare('UPDATE acte SET frais=:frais, honoraire=:honoraire WHERE code=:num LIMIT 1');
        $sql->bindValue(':frais', $frais);
        $sql->bindValue(':honoraire', $honoraire);
        $sql->bindValue(':num', $_GET['num']);
        $sql->execute();

        header('Location: acte-modification-two.php?2sB2y&name_entreprise='.$acte['name_entreprise'].'&7Ukt3&t='.$acte['tel_entreprise'].'&k7J6e&em='.$acte['email_entreprise'].'&tf3M3&num='.$acte['code'].'');
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
    <title>Acte - Etape 2 <?= $nameentreprise ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/extensions/dataTables.checkboxes.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/responsive.bootstrap.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="layout">
<style>
    .none-validation{display: none;};
</style>
    <!-- BEGIN: Header-->
    <?php include('php/header_back.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_backend.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="form-group">
                    <a href="acte-modification.php"><button class="btn btn-info mr-1 mb-1">Retour</button></a>
                    <h4>Etape 2 : Sélectionnez un ou des actes à modifier</h4>
                    <span>Nom de la société : <?= $nameentreprise ?></span><br>
                    <span>Numéros de téléphone : <?= $telentreprise ?></span><br>
                    <span>E-Mail : <?= $emailentreprise ?></span>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="">
                <!-- Simple Validation start -->
                    <section class="simple-validation">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header text-center">
                                        <h4 class="card-title">Paiement & Dépot</h4>
                                    </div>
                                    <div class="card-content">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col" style="border-right: 1px solid #A3AFBD;">
                                                    <form action="" class="form-horizontal" method="POST">
                                                        <input type="hidden" name="num_acte" id="num_crea" value="<?= $_GET['num'] ?>">
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col">
                                                                <?php $value_frais = explode('!',$acte['frais']); ?>
                                                                <label for="valid-state">Frais</label>
                                                                    <input type="number" min="0" name="frais" class="form-control <?php if($acte['frais'] == "" || $value_frais[1] == "no"){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Frais en €" value="<?php $value_frais = explode('!',$acte['frais']); echo $value_frais[0]; ?>" required>
                                                                    <div class="valid-feedback">
                                                                        <i class="bx bx-radio-circle"></i>
                                                                    Frais de paiement enregisté <?= $value_frais[0]; ?> € 
                                                                    </div>
                                                                </div>
                                                                <div class="col col-lg-2">
                                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Payé</p>
                                                                        <input onchange="paiement_frais_check()" name="frais_check" type="checkbox" class="custom-control-input" id="customSwitch1" <?php if(substr($acte['frais'], -3) == "yes"){echo "checked";} ?>>
                                                                        <label class="custom-control-label" for="customSwitch1">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="row">
                                                                <div class="col">
                                                                <?php $value_honoraire = explode('!',$acte['honoraire']);  ?>
                                                                <label for="valid-state">Honoraire</label>
                                                                    <input type="number" min="0" name="honoraire" class="form-control <?php if($acte['honoraire'] == "" || $value_honoraire[1] == "no"){echo "is-invalid";}else{echo "is-valid";} ?>" id="valid-state" placeholder="Honoraire en €" value="<?php $value_honoraire = explode('!',$acte['honoraire']); echo $value_honoraire[0]; ?>" required>
                                                                    <div class="valid-feedback">
                                                                        <i class="bx bx-radio-circle"></i>
                                                                    Honoraire de paiement enregisté <?= $value_honoraire[0]; ?> € 
                                                                    </div>
                                                                </div>
                                                                <div class="col col-lg-2">
                                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1 text-center" style="position: relative; top: 20%;">
                                                                        <p class="mb-0">Payé</p>
                                                                        <input onchange="paiement_honoraire_check()" name="honoraire_check"  type="checkbox" class="custom-control-input" id="customSwitch11" <?php if(substr($acte['honoraire'], -3) == "yes"){echo "checked";} ?>>
                                                                        <label class="custom-control-label" for="customSwitch11">
                                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                                            <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <button type="submit" class="btn btn-outline-<?php if($acte['frais'] == "" || $acte['honoraire']){echo "secondary";}else{echo "success";} ?> col-12"><i class="bx bx-check"></i><span class="align-middle ml-25"><?php if($acte['frais'] == "" && $acte['honoraire'] == ""){echo "Enregister les montants";}else{echo "Modifier les montants";} ?></span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <div class="form-group text-center">
                                                            <span>Greffe & CFE</span>
                                                        </div>
                                                        <div class="form-group">
                                                            <hr>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Information : </label>&nbsp<label>La validation des dépot s'effectue à l'étape 3 (Après l'upload de l'ensemble des documents)</label>
                                                            <br>
                                                            <label style="padding: 10px;">- Dépot au greffe</label><br>
                                                            <label style="padding: 10px;">- Dépot au CFE</label><br>
                                                            <label style="padding: 10px;">- Article 3</label>
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
                    <!-- Input Validation end -->     
                </div> 
                <div class="form-group">
                    <div class="form-group">
                        <label>Selectionnez la forme de la société :</label>   
                    </div>
                    <div class="form-group">
                        <div class="card-body">
                        <form method="POST" action="php/edit_acte.php">
                            <p>Selectionnez personne Morale <code>si</code> vous avez une SARL, SAS, SASU, SCI, EURL</p>
                            <p>Selectionnez personne Physique <code>si</code> vous avez une EIRL, EI, MICRO-ENTREPRISE</p>
                            <ul class="list-unstyled mb-0">
                                <li class="d-inline-block mr-2 mb-1">
                                    <fieldset>
                                        <div class="radio radio-sm">
                                            <input type="radio" id="radiosmall" name="check" value="morale" checked>
                                            <label for="radiosmall">Personne Morale</label>
                                        </div>
                                    </fieldset>
                                </li>
                                <li class="d-inline-block mb-1">
                                    <fieldset>
                                        <div class="radio">
                                            <input type="radio" id="radiodefault" name="check" value="physique">
                                            <label for="radiodefault">Personne Physique</label>
                                        </div>
                                    </fieldset>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Selectionnez les changements :</label>
                </div>
                <div class="form-group">
                    <br>
                </div>
                <div class="form-group">
                    <ul class="list-unstyled mb-0">
                        <input type="hidden" value="<?= $_GET['num'] ?>" name="num">
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="row">
                                        <div class="col">
                                            <div class="checkbox checkbox-success">
                                                <input type="checkbox" id="colorCheckbox1" name="one">
                                                <label for="colorCheckbox1">Cession de parts / Actions</label>
                                            </div>
                                        </div>
                                        <div id="div_one" class="col none-validation">
                                            <small>Y'a t'il un passage de société à actionnaire unique vers plusieurs actionnaire ou l'inverse</small>
                                            <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                <input type="checkbox" class="custom-control-input" id="customSwitch15" name="verif_one">
                                                <label class="custom-control-label" for="customSwitch15">
                                                    <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                    <span class="switch-icon-right"><i class="bx bx-x"></i></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>                                  
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox2" name="two">
                                        <label for="colorCheckbox2">Gérant / Président</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox3" name="three">
                                        <label for="colorCheckbox3">Siege social</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox4" name="four">
                                        <label for="colorCheckbox4">Objet Social</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox5" name="five">
                                        <label for="colorCheckbox5">Forme juridique</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox6" name="six">
                                        <label for="colorCheckbox6">Dénomination</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox7" name="seven">
                                        <label for="colorCheckbox7">Capital Social</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <div class="checkbox checkbox-success">
                                        <input type="checkbox" id="colorCheckbox8" name="eight">
                                        <label for="colorCheckbox8">Veille</label>
                                    </div>
                                </fieldset>
                            </li><br>
                            <li class="d-inline-block mr-2 mb-1">
                                <fieldset>
                                    <br>
                                    <button type="submit" class="btn btn-outline-success mr-1 mb-1">Suivant</button>    
                                </fieldset>
                            </li>
                        </form>
                    </ul>
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
    <script src="../../../app-assets/vendors/js/tables/datatable/datatables.checkboxes.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js"></script>
    <script src="../../../app-assets/vendors/js/tables/datatable/responsive.bootstrap.min.js"></script>
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
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <!-- END: Page JS-->

    <script>
        function paiement_frais_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_frais_acte.php?num=<?= $_GET['num'] ?>&result=<?= $acte['frais'] ?>');
            requeteAjax.send(notification_crea);
        }
        function paiement_honoraire_check(){
            var notification_crea = document.getElementById("num_crea").value;
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open('POST', 'php/change_statut_paiement_honoraire_acte.php?num=<?= $_GET['num'] ?>&result=<?= $acte['honoraire'] ?>');
            requeteAjax.send(notification_crea);
        }

    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>

</body>
</body>
<!-- END: Body-->

</html>