    <?php 
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id_session']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM etiquette WHERE id_session = :id_session');
    $pdoSt->bindValue(':id_session',$_SESSION['id_session']);
    $pdoSt->execute();
    $etiq = $pdoSt->fetchAll();

    $pdoSttt = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoSttt->bindValue(':num',$_SESSION['id_session']);
    $pdoSttt->execute();
    $membre = $pdoSttt->fetchAll();

    //Recuperation des missions
    $pdoS = $bdd->prepare('SELECT * FROM mission WHERE id_session = :num ORDER BY id');
    $pdoS->bindValue(':num', $_SESSION['id_session']);
    $pdoS->execute();
    $missions = $pdoS->fetchAll();

    $pdoStttt = $bdd->prepare('SELECT * FROM task WHERE id_session = :num');
    $pdoStttt->bindValue(':num',$_SESSION['id_session']);
    $pdoStttt->execute();
    $tache = $pdoStttt->fetchAll();
    $pourc = "0";

    $pdoSttt = $bdd->prepare('SELECT * FROM teams WHERE id_session= :num');
    $pdoSttt->bindValue(':num',$_SESSION['id_session']);
    $pdoSttt->execute();
    $team = $pdoSttt->fetchAll();

   // print("<pre>". print_r($team,true)."</pre>");

?>

<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Taches</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/daterange/daterangepicker.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-todo.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
   
</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout content-left-sidebar todo-application navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="<?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout">
<style>
.etiq{width: 10px; height: 10px; border-radius: 90%;}
.rien{margin: 0px; padding: 0px; width: 20px; height: 20px;}
.petit{font-size: 12px; color: #719df0;}
.petit:hover{color: #1a233a}
.petite{font-size: 12px; color: red;}
.petite:hover{color: #1a233a}
.none-validation{display: none;}
.block-validation{display: block;}
.hoverfav:hover{color: #FDAC41;}
.checkhover:hover{color: green;}
.green_task{color : green;}
.orange_task{color: orange;}
.icon_trash{position: relative; top: 3px; left: 40%; font-size: 10px; color: red; display: none;}
.icon_trash:hover{opacity: 0.5;}
.trash_etiq:hover .icon_trash{display: inline;}

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
        <div class="content-area-wrapper">
            <div class="sidebar-left">
                <div class="sidebar">
                    <div class="todo-sidebar d-flex">
                        <span class="sidebar-close-icon">
                            <i class="bx bx-x"></i>
                        </span>
                        <!-- todo app menu -->
                        <div class="todo-app-menu">
                            <div class="form-group text-center add-task">
                                <!-- new task button -->
                                <button type="button" class="btn btn-primary add-task-btn btn-block my-1">
                                    <i class="bx bx-plus"></i>
                                    <span>Nouvelle tache</span>
                                </button>
                            </div>
                            <!-- sidebar list start -->
                            <div class="sidebar-menu-list">
                                <div class="list-group">
                                    <a href="task.php" class="list-group-item border-0 active">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: list.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Toutes les taches</span>
                                    </a>
                                </div>
                                <label class="filter-label mt-2 mb-1 pt-25">Etat</label>
                                <div class="list-group">
                                    <a href="task-favorite.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: star.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Favoris</span>
                                    </a>
                                    <a href="task-encour.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: timer.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>En cours</span>
                                    </a>
                                    <a href="task-done.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: check.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Terminée</span>
                                    </a>
                                    <a href="task-delete.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Supprimée</span>
                                    </a>
                                </div>
                                <label class="filter-label mt-2 mb-1 pt-25">Etiquette &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<i id="block_add_etiquette" onclick="block_add_etiquette()" class='bx bx-plus-medical petit'></i><i id="block_leave_etiquette" onclick="block_leave_etiquette()" class='bx bxs-minus-square petite none-validation'></i></label>
                                <div class="list-group">
                                    <?php foreach($etiq as $etiquette): ?>
                                        <a href="#" class="trash_etiq list-group-item border-0 d-flex align-items-center justify-content-between">
                                            <span><?= $etiquette['name_etiq'] ?><i onclick="delete_etiq()" class='bx bx-trash icon_trash'></i></span>
                                            <span style="background-color: <?= $etiquette['color'] ?>;" class="etiq"></span>
                                        </a>
                                    <?php endforeach; ?>
                                </div>s
                                <div class="from-group">
                                    <hr>
                                </div>
                                    <div class="chat-sidebar-list-wrapper pt-2">
                                         <label>mission :</label>
                                              <div class="chat-sidebar-name">
                                            <span class="text-muted"><?= $missions[''] ?></span>
                                        </div>            
                                            </div>

                                <div class="list-group none-validation" id="etiq_div">
                                    <form action="php/insert_etiq.php" method="POST">
                                        <label class="invoice-number mr-75">Nouvelle etiquette :</label>
                                        <div class="row align-items-start custom-line">
                                            <div class="col">
                                                <input name="name_etiq" type="text" class="form-control pt-25 w-70" required>
                                            </div>
                                            <div class="col-2 pt-25">
                                                <input name="color" type="color" class="rien">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-outline-secondary"><i class='bx bx-plus-medical'></i></button>
                                        </div>

                                        

                                    </form>
                                      

                                </div>
                            </div>
                            <!-- sidebar list end -->
                        </div>
                    </div>
                    <!-- todo new task sidebar -->
                    <div class="todo-new-task-sidebar">
                        <div class="card shadow-none p-0 m-0">
                            <div class="card-header border-bottom py-75">
                                <div class="task-header d-flex justify-content-between align-items-center">
                                    <h5 class="new-task-title mb-0">Nouvelle tache</h5>
                                    <button class="mark-complete-btn btn btn-light-primary btn-sm">
                                        <i class="bx bx-check align-middle"></i>
                                        <span class="mark-complete align-middle">Valider la tache</span>
                                    </button>
                                    <span class="dropdown mr-50">
                                        <i class='bx bx-paperclip cursor-pointer mr-50'></i>
                                        <a href="#" class="dropdown-toggle" id="todo-sidebar-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                            <i class='bx bx-dots-vertical-rounded'></i>
                                        </a>
                                        <span class="dropdown-menu dropdown-menu-right" aria-labelledby="todo-sidebar-dropdown">
                                            <a href="#" class="dropdown-item">Assigner à un projet (SOON)</a>
                                        </span>
                                    </span>
                                </div>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form  id="compose-form" class="mt-1">
                                <div class="card-content">
                                    <div class="card-body py-0 border-bottom">
                                        <div class="form-group">
                                            <!-- text area for task title -->
                                            <textarea name="name_task" class="form-control task-title" cols="1" rows="2" placeholder="Nom de la tache" required id="id_tache"></textarea>
                                        </div>


                                        <div class="select-box mr-3">
                                            <div class="form-group d-flex align-items-center mr-1">
                                                <!-- users avatar -->
                                                <div class="avatar">
                                                    <img src="#" class="avatar-user-image d-none" alt="#" width="38" height="38">
                                                    <div class="avatar-content">
                                                        <i class='bx bx-user font-medium-4'></i>
                                                    </div>
                                                </div>
                                                <div class="select-box mr-2">
                                                <label>équipe</label>
                                                    <select class="js-example-basic-multiple form-control"  multiple name="name_team" id="id_team"> 
                                                         <?php foreach($team as $teams): ?> 

                                                                <option value="<?= $teams['id']?>"><?= $teams['name_team'] ?></option>
                                                            <?php endforeach; ?> 
                                                    </select>

                                                    </div>
                                            </div>
                                                   <div class="modal-body" id="name_membre">
                                                       

                                                   </div>
                                                

                                        </div>
                                        
                                        <div class="assigned d-flex justify-content-between">
                                            <div class="form-group d-flex align-items-center mr-1">
                                                <!-- users avatar -->
                                                <div class="avatar">
                                                    <img src="#" class="avatar-user-image d-none" alt="#" width="38" height="38">
                                                    <div class="avatar-content">
                                                        <i class='bx bx-user font-medium-4'></i>
                                                    </div>
                                                </div>
                                                <!-- select2  for user name  -->
                                                <div class="select-box mr-1">
                                                    <label> membres</label>
                                                    <select class="js-example-basic-multiple" multiple name="assignation_task" id="id_membre">
                                                            <?php foreach($membre as $membres): ?>
                                                               
                                                                <option value="<?= $membres['id']?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></option>
                                                            <?php endforeach; ?>
                                                        
                                                    </select>
                                                </div>
                                              </div>
                                         </div>

                                                

                                            <div class="form-group d-flex align-items-center position-relative">
                                                <!-- date picker -->
                                                <div class="date-icon mr-50">
                                                    <button type="button" class="btn btn-icon btn-outline-secondary round">
                                                        <i class='bx bx-calendar-alt'></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="date-picker">
                                                    <label>Début</label>
                                                    <input type="text" name="date_task" value="<?php  ?>" class="pickadate form-control px-0" placeholder="00/00/00" required id="id_date">
                                                </div>
                                                <div class="date-picker">
                                                    <label>Fin</label>
                                                    <input type="text" name="dateecheance_task" value="31/12/<?php $dateY = date("Y");  echo $dateY; ?>" class="pickadate form-control px-0" placeholder="00/00/00" required id="id_dateecheance">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div id="div_etiq" class="card-body border-bottom task-description">
                                        <!--  Quill editor for task description -->
                                        <div class="snow-container border rounded p-50">
                                            <div class="d-flex justify-content-end">  
                                                <textarea name="description_task" class="form-control task-title compose-quill-toolbar pb-0" cols="1" rows="2" placeholder="Description de la tache"  required id="description_taches"></textarea>
                                            </div>
                                        </div>


                                        <div class="tag d-flex justify-content-between align-items-center pt-1">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="bx bx-tag align-middle mr-25"></i>
                                                <select id="etiq_last" name="etiquette_task" class="form-control">
                                                    <?php foreach($etiq as $etiquette): ?>
                                                        <option value="<?= $etiquette['name_etiq'] ?>"><?= $etiquette['name_etiq'] ?></option>
                                                        <script>
                                                            function delete_etiq(){
                                                                document.location.href="php/delete_etiq_task.php?num=<?= $etiquette['id'] ?>"; 
                                                            }
                                                        </script>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="ml-25">
                                                <i onclick="newetiq()" class="bx bx-plus-circle cursor-pointer"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="div_color" class="card-body border-bottom task-description none-validation">
                                        <div class="form-group ">
                                            <label for="exampleInputEmail1">Nouvelle etiquette :</label>
                                            <input type="text" class="form-control" id="etiq" name="new_etiq" placeholder="Nom de l'étiquette" disabled>
                                            <br>
                                            <input id="etiq_color" type="color" name="new_color" value="#ffc874" disabled>
                                        </div>
                                    </div>
                                    <div class="card-body pb-1">
                                        <!-- quill editor for comment -->
                                        <div class="snow-container rounded p-50">
                                            <label>Commentaire :</label>
                                            <input name="commentaire_task" class="form-control task-title compose-quill-toolbar pb-0" cols="1" rows="2" placeholder="Ecrire un commentaire ..." id="id_commentaire" required>
                                        </div>
                                        <div class="mt-1 d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary add-todo">Ajouter la tache</button>
                                            <button type="button" class="btn btn-primary update-todo">Sauvegarder</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>

                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="app-content-overlay"></div>
                        <div class="todo-app-area">
                            <div class="todo-app-list-wrapper">
                                <div class="todo-app-list">
                                    <div class="todo-fixed-search d-flex justify-content-between align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none">
                                            <i class="bx bx-menu"></i>
                                        </div>
                                        <fieldset class="form-group position-relative has-icon-left m-0 flex-grow-1">
                                            <input type="text" class="form-control todo-search" id="todo-search" placeholder="Rechercher">
                                            <div class="form-control-position">
                                                <i class="bx bx-search"></i>
                                            </div>
                                        </fieldset>
                                        <div class="todo-sort dropdown mr-1">
                                            <button class="btn dropdown-toggle sorting" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-filter"></i>
                                                <span>Filtre</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                                                <a class="dropdown-item ascending" href="#">Ascendante</a>
                                                <a class="dropdown-item descending" href="#">Descendante</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="todo-task-list list-group">
                                        <!-- task list start -->
                                        <ul class="todo-task-list-wrapper list-unstyled" id="todo-task-list-drag">
                                            <?php foreach($tache as $task): ?>
                                            <li onclick="RedirectionJavascript()" class="" style="height: 45px;" data-name="<?= $task['assignation_task'] ?>">
                                                <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center">
                                                    <div class="todo-title-area d-flex">
                                                        <i class='bx bx-grid-vertical handle'></i>
                                                 
                                                        <div class="checkbox">
                                                            <input type="checkbox" class="checkbox-input" id="checkbox10">
                                                            <label for="checkbox10"></label>
                                                        </div>
                                                        <p class="todo-title mx-50 m-0 truncate"><?= $task['name_task'] ?></p>
                                                    </div>
                                                    <div class="todo-item-action d-flex align-items-center">
                                                        <?php 
                                                        
                                                            $etiquette_list = $task['etiquette_task'];
                                                            $list_explode = explode( ',', $etiquette_list);
                                                            $taille_etiq = count($list_explode) - 1;

                                                            $color_list = $task['color_etiq'];
                                                            $list_explode_color = explode( "'", $color_list);

                                                            $sizetab = count($list_explode);
                                                            if($sizetab > 1){
                                                                $size_tab = "block-validation";
                                                            }else{
                                                                $size_tab = "none-validation";
                                                            }

                                                        ?>


                                                        <div class="todo-badge-wrapper d-flex">
                                                            <span class="badge badge-pill ml-50" style="margin-right: 10px; background-color: <?= $list_explode_color[0] ?>;"><?= $list_explode[$taille_etiq]; ?></span>
                                                        </div>
                                                        <span class="badge badge-light-secondary badge-pill ml-50 <?= $size_tab ?>" data-tag="<?= $task['etiquette_task'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $task['etiquette_task'] ?>" style="margin-right: 10px;">
                                                            <i class='bx bx-dots-horizontal-rounded font-small-1'></i>
                                                        </span>
                                                        <?php 
                                                        
                                                            $input = array("primary", "secondary", "sucess", "danger", "warning", "info", "dark");
                                                            $rand_keys = array_rand($input, 1);
                                                            $result_color_rand = $input[$rand_keys];                                                                                  
                                                        
                                                        ?>
                                                        <span class="badge badge-circle badge-light-<?= $result_color_rand; ?>"><?= substr($task['assignation_task'], 0, 2); ?></span>
                                                        <a href="php/favo_task.php?num=<?= $task['id'] ?>&page=task" class='todo-item-favorite ml-75'><i class="<?php if($task['favorite'] == "1"){echo "bx bx-star bxs-star warning hoverfav";}else{echo "bx bx-star hoverfav";} ?>"></i></a>
                                                        <a href="php/status_ta sk.php?num=<?= $task['id'] ?>&page=task" class='todo-item-delete ml-75'><i class="bx bx-check-circle <?php if($task['status_task'] == "encour"){echo "orange_task";}else{echo "green_task";} ?> checkhover"></i></a>
                                                        <a href="php/corbeille_task.php?num=<?= $task['id'] ?>&page=task" class='todo-item-delete ml-75'><i class="bx bx-trash checkhover"></i></a>
                                                    </div>

                                         

                                                          </div>
                                            </li>

                                         <section id="progress-sizes">
                                            <div class="row">
                                            <div class="col-12">
                                                <div class="progress progress-bar-success mb-2 ">
                                                    <meter min="0" value=<?= $pourc?> max="100" high="180"></meter>       
                                            </div>
                                         </div>
                                            </div>
                                        </div>
                             </section> 
                                            <script>
                                                function RedirectionJavascript(){
                                                    document.location.href="task-view.php?num=<?= $task['id'] ?>";
                                                }  
                                            </script>
                                            <?php endforeach ?>
                                        </ul>
                                        <!-- task list end -->
                                        <div class="no-results">
                                            <h5>Aucun taches</h5>
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
    
    
       
   


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>

    <!-- END: Page Vendor JS-->s

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
     <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
     <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
     <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>

    <script src="../../../app-assets/js/scripts/pages/app-todo.js"></script>

    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>

    <!-- END: Page JS-->



                                           <script>
                                                    $( "#id_team" )
                                                      .change(function () {
                                                        var str = document.getElementById("id_team").value;
                                                        $.ajax({
                                                                url: "../../../html/ltr/coqpix/php/teak_traite.php", //new path, save your work first before u try
                                                                type: "POST",
                                                                data: {
                                                                    id: str
                                                                   
                                                                },
                                                                dataType: 'json',
                                                                success: function(data) {
                                                                    if (data.status == 'success') {
                                                                        var team=document.getElementById('name_membre');
                                                                        var ul=document.createElement('ul');
                                                                        team.appendChild(ul);

                                                                         data.team_membre.forEach(function(item){
                                                                             var li=document.createElement('li');

                                                                                ul.appendChild(li);
                                                                                li.innerHTML=item['name_membre'];
                                                                      
                                                                    });
                                                                    } else {
                                                                        addAlert(data.message);
                                                                    }


                                                                }


                                                            });
                                                                                               
                                                            });
                                                     
                                             </script>
     

    <script>
        
                 $(".add-todo").on("click", function(e){
                    e.preventDefault();

                var membres = $('#id_membre').select2('data');
                var $teams = $('#id_team').select2('data');
                var name_task= $('#id_task').val();
                var description_task = $('#description_taches').val();
                var date_task=$('#id_date').val();
                var dateecheance_task=$('#id_dateecheance').val();
                var etiquette_task=$('#etiq_last').val();
                var new_etiq=$('#etiq').val();
                var new_color=$('etiq_color').val(); 

                date_task = moment(date_task, 'DD/MM/YY').format('YYYY-MM-DD');
                dateecheance_task = moment(dateecheance_task, 'DD/MM/YY').format('YYYY-MM-DD');

                
                console.log($teams);
                console.log(dateecheance_task);
                if ($teams.length != 0 || membres.length != 0) {
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/insert_task.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_task: id_task,
                            name_task: $edit_title,
                            description_task: description_task,
                            date_task: date_task,
                            dateecheance_task: dateecheance_task,
                            etiquette_task: etiquette_task,
                            color_etiq: color_etiq,
                            new_color: new_color,
                            new_etiq: new_etiq,
                            membres: membres,
                            teams: teams
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status != 'success') {
                                addAlert(data.message);
                            }
                        }
                    });
                }
                 
            });

               

    </script>
    <script>

    function block_add_etiquette(){
        document.getElementById('etiq_div').style.display = "block";
        document.getElementById('block_leave_etiquette').style.display = "inline";
        document.getElementById('block_add_etiquette').style.display = "none";
    } 

    function block_leave_etiquette(){
        document.getElementById('etiq_div').style.display = "none";
        document.getElementById('block_leave_etiquette').style.display = "none";
        document.getElementById('block_add_etiquette').style.display = "inline";
    }

    function newetiq(){
        document.getElementById('div_color').style.display = "block";
        document.getElementById('etiq').disabled = false;
        document.getElementById('etiq_color').disabled = false;
        document.getElementById('div_etiq').style.display = "none";
        document.getElementById('etiq_last').disabled = true;
    }

     $(document).ready(function() {
        $('.js-example-basic-multiple').select2();
       });
     
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>