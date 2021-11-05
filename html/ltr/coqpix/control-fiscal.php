<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
$authorised_roles = array('admin', 'gestionnaire fiscal');
require_once 'php/verif_session_connect_admin.php';

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
    <title>Controle fiscal</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-fiscal.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/switch_emote.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns fiscal-application   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
<style>
    .icon{color: #727E8C;}
    .icon:hover{color: #00fbff; opacity: 0.5; cursor: pointer;}
    .none-validation{display: none;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #e72424;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
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
        <div class="content-wrapper">
            <div class="content-body">
                <!-- Zero configuration table -->
                <section id="basic-datatable">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-header">
                                        <div class="card-footer d-flex justify-content-start pt-0">
                                            <!-- Bouton à script-->
                                            <button class="fiscal-toggle-btn btn btn-primary glow mr-1 mb-1">
                                                <i class="bx bx-plus"></i> 
                                                <span class="d-sm-inline d-none">Nouveau Dossier</span>
                                            </button>
                                            <div class="form-group" style="height: 108px;">
                                                <div onclick="action_switch()" class="toggle dog-rollover">
                                                    <input class="bt_input" id="doggo2" type="checkbox"/>
                                                    <label class="toggle-item" for="doggo2">
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
                                                    <label style="color: orange;">En Cours</label>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<label style="color: green;">Terminé</label>
                                                </div>
                                            </div>
                                            <div class="form-group ml-auto">
                                                <a class="btn btn-primary " href="control-fiscal-corbeille.php">
                                                    <i class="bx bx-trash"></i>                                                
                                                </a>
                                            </div>
                                        </div>   
                                    </div>
                                    <div class="card-body card-dashboard">
                                        <?php
                                            function request($pdo, $champ){
                                                $champs_possible = array('statut NOT LIKE "%FINISH%" AND trash_statut LIKE ""',
                                                'statut LIKE "%FINISH%" AND trash_statut LIKE ""');

                                                if(isset($champ) AND in_array($champ,$champs_possible)){
                                                    $condition = $champ;

                                                    $pdoSt = $pdo->prepare('SELECT * FROM fiscal WHERE '.$condition.'');
                                                    $pdoSt->execute(); 
                                                    $data = $pdoSt->fetchAll();
                                                    return($data);
                                                    
                                                } 
                                            }
                                        ?>
                                                                        
                                        <!-- File Fiscal in Progress -->
                                        <div id="div_process" class="form-group">
                                            <div class="text-center">
                                                <h5>Dossier en cours</h5>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table zero-configuration">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">Nom société</th>
                                                            <th class="text-center">Objet du control</th>
                                                            <th class="text-center">Etat dossier</th>
                                                            <th class="text-center">Action</th>                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php                                                            
                                                            $donnee = request($bdd,'statut NOT LIKE "%FINISH%" AND trash_statut LIKE ""');
                                                            foreach($donnee as $donnees):
                                                                // Statut de la barre de suivi
                                                                if($donnees['statut'] == "Phase de premier rendez-vous"){
                                                                    $nb_etape_valide = 0;
                                                                }else if($donnees['statut'] == "Phase de vérification et contradictoire"){
                                                                    $nb_etape_valide = 1;
                                                                    }else if($donnees['statut'] == "Phase de proposition de rétification"){
                                                                        $nb_etape_valide = 2;
                                                                        }else if($donnees['statut'] == "Phase Contentieuse / Impôt"){
                                                                            $nb_etape_valide = 3;
                                                                            }else if($donnees['statut'] ==  "Phase Conctentieuse Administrative"){
                                                                                $nb_etape_valide = 4;
                                                                            }
                                                                // Objet du controle
                                                                if($donnees['object_control'] == "ISTVA"){
                                                                    $object_display="Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)";
                                                                }
                                                                if($donnees['object_control'] == "IRTVA"){
                                                                    $object_display="Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)";
                                                                }
                                                                if($donnees['object_control'] == "IR"){
                                                                    $object_display="Impôt sur le revenu (IR)";
                                                                }
                                                                if($donnees['object_control'] == "TVA"){
                                                                    $object_display="Taxe sur la valeur ajoutée (TVA)";
                                                                }                                                                
                                                        ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <a href="control-fiscal-view.php?num=<?= $donnees['id'] ?>">
                                                                    <?= $donnees['name_entreprise'] ?>
                                                                </a>                                                                
                                                            </td>
                                                            <td class="text-center"><?= $object_display ?></td>
                                                            <td class="text-center">
                                                                <div class="activity-progress">
                                                                    <p class="text-muted d-inline-block mb-50">Etat du dossier : <?= $donnees['statut'] ?></p>
                                                                    <p class="float-right"><?= $nb_etape_valide ?> / 5</p>
                                                                    <div class="progress progress-bar-yellow progress-sm">
                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $nb_etape_valide/5 ?>" style="width:<?= 100*$nb_etape_valide/5 ?>%"></div>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="control-fiscal-view.php?num=<?= $donnees['id'] ?>">
                                                                    <button class='bx bxs-pencil'></button>
                                                                </a>
                                                                <button class='bx bxs-trash' onclick="supr_dossier(<?= $donnees['id'] ?>)"></button>                                                                
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>                                                
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /File Fiscal in Progress -->
                                        <!-- File Fiscal Finish -->
                                        <div id="div_finish" class="form-group none-validation">
                                            <div class="text-center">
                                                <h5>Dossier Terminé</h5>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table zero-configuration">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center">
                                                                Nom société                                                                
                                                            </th>
                                                            <th class="text-center">Objet du control</th>
                                                            <th class="text-center">Date de cloture</th>
                                                            <th class="text-center">Action</th>                                                        
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $donnee2 = request($bdd,'statut LIKE "%FINISH%" AND trash_statut LIKE ""');
                                                            foreach($donnee2 as $donnees2):
                                                                // Objet du controle
                                                                if($donnees2['object_control'] == "ISTVA"){
                                                                    $object_display2="Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)";
                                                                }
                                                                if($donnees2['object_control'] == "IRTVA"){
                                                                    $object_display2="Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)";
                                                                }
                                                                if($donnees2['object_control'] == "IR"){
                                                                    $object_display2="Impôt sur le revenu (IR)";
                                                                }
                                                                if($donnees2['object_control'] == "TVA"){
                                                                    $object_display2="Taxe sur la valeur ajoutée (TVA)";
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td class="text-center">
                                                                <a href="control-fiscal-view.php?num=<?= $donnees2['id'] ?>">
                                                                    <?= $donnees2['name_entreprise'] ?>
                                                                </a>
                                                            </td>
                                                            <td class="text-center"><?= $object_display2 ?></td>
                                                            <td class="text-center"><?= strftime("%d/%m/%Y", strtotime(substr($donnees2['statut'], 7)));?></td>
                                                            <td class="text-center">
                                                                <a href="control-fiscal-view.php?num=<?= $donnees2['id'] ?>">
                                                                    <button class='bx bxs-pencil'></button>
                                                                </a>   
                                                                <button class='bx bxs-trash' onclick="supr_dossier(<?= $donnees2['id'] ?>)"></button>                                                                
                                                            </td>
                                                        </tr>
                                                        <?php endforeach; ?>
                                                    </tbody>                                                
                                                </table>
                                            </div>
                                        </div>
                                        <!-- /File Fiscal Finish -->
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!--/ Zero configuration table -->

                <div class="app-overlay "></div>

                <!-- User new fiscal file -->
                <div class="overlay">
                    <div class="compose-new-file-sidebar ">
                        <div class="card shadow-none quill-wrapper p-0">
                            <div class="card-header">
                                <h3 class="card-title" id="fiscalCompose">Création du Dossier</h3>
                                <button type="button" class="close close-icon ">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form action="php/insert_create_files_fiscal.php" id="compose-form" method="POST">
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="form-group">
                                            <label>Nom de la société</label>
                                            <input type="text" name="crea_societe" class="form-control" placeholder="Nom de l'entreprise" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Période de contrôle :</label>
                                            <div>
                                                <label for="">Date début contrôle :</label> 
                                                <input type="date" name="date_control_begin" required>
                                        
                                                <label for="">Date fin contrôle :</label> 
                                                <input type="date" name="date_control_end" value="">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <label>Objet du contrôle</label>
                                            <select name="object_control" class="form-control invoice-item-select" required>
                                                <option value="" selected disable hidden>Choisir l'objet du contrôle</option>
                                                <option value="ISTVA">Impôt sur les sociétés + Taxe sur la valeur ajoutée (IS+TVA*)</option>
                                                <option value="IRTVA">Impôt sur le revenu + Taxe sur la valeur ajoutée (IR+TVA)</option>
                                                <option value="IR">Impôt sur le revenu (IR)</option>
                                                <option value="TVA">Taxe sur la valeur ajoutée (TVA)</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end pt-0">
                                    <button type="reset" class="btn btn-light-secondary cancel-btn close-icon mr-1">
                                        <i class='bx bx-x mr-25'></i>
                                        <span class="d-sm-inline d-none">Annuler</span>
                                    </button>
                                    <button type="submit" class="btn-send btn btn-primary">
                                        <i class='bx bx-send mr-25'></i> 
                                        <span class="d-sm-inline d-none">Créer</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                </div>
                <!--/ User new fiscal file -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <script>
        
        function action_switch(){
            let switchK = document.getElementById('doggo2');
            if(switchK.checked){
                document.getElementById('div_process').style.display = "none";
                document.getElementById('div_finish').style.display = "block";
                
            } else {
                document.getElementById('div_process').style.display = "block";
                document.getElementById('div_finish').style.display = "none";
                
            }
        }

        function supr_dossier(numId){            
            var res = confirm("Êtes-vous sûr de vouloir supprimer ce dossier ?");
            if(res){
                document.location.href='php/corbeille_fiscal.php?num='+numId+'&link=files';
            }
        }

    </script>
    
    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- END Vendor JS-->

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
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-fiscal.js"></script>
    <!-- END: Page JS-->

    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>