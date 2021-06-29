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

    $pdoStttt = $bdd->prepare('SELECT * FROM task_delete WHERE id_session = :num AND status_task = :status_task');
    $pdoStttt->bindValue(':num',$_SESSION['id_session']);
    $pdoStttt->bindValue(':status_task',"delete");
    $pdoStttt->execute();
    $tache = $pdoStttt->fetchAll();

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

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">
<style>
.etiq{width: 10px; height: 10px; border-radius: 90%;}
.rien{margin: 0px; padding: 0px; width: 20px; height: 20px;}
.petit{font-size: 12px; color: #719df0;}
.petit:hover{color: #1a233a}
.none-validation{display: none;}
.block-validation{display: block;}
.hoverfav:hover{color: #FDAC41;}
.checkhover:hover{color: green;}
.trashhover{color: #c22d2d;}
.trashhover:hover{color: #ff0000;}

</style>
    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>   <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
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
                                    <a href="task.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: list.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
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
                                        <span>Favorie</span>
                                    </a>
                                    <a href="task-encour.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: timer.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>En cour</span>
                                    </a>
                                    <a href="task-done.php" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: check.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Terminée</span>
                                    </a>
                                    <a href="task-delete.php" class="list-group-item border-0 active">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Supprimée</span>
                                    </a>
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
                            <form id="compose-form" class="mt-1">
                                <div class="card-content">
                                    <div class="card-body py-0 border-bottom">
                                        <div class="form-group">
                                            <!-- text area for task title -->
                                            <textarea name="title" class="form-control task-title" cols="1" rows="2" placeholder="Nom de la tache" required>
            </textarea>
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
                                                    <select class="select2-users-name form-control" id="select2-users-name">
                                                            <?php foreach($membre as $membres): ?>
                                                                <option value="<?= $membres['nom'] ?> <?= $membres['prenom'] ?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></option>
                                                            <?php endforeach; ?>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group d-flex align-items-center position-relative">
                                                <!-- date picker -->
                                                <div class="date-icon mr-50">
                                                    <button type="button" class="btn btn-icon btn-outline-secondary round">
                                                        <i class='bx bx-calendar-alt'></i>
                                                    </button>
                                                </div>
                                                <div class="date-picker">
                                                    <input type="text" value="<?php $date_50 = date("d/m/"); $date_100 = date("Y"); $date_100_2 = substr($date_100,-2); $date_all = $date_50.$date_100_2; echo $date_all; ?>" class="pickadate form-control px-0" placeholder="00/00/00">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-bottom task-description">
                                        <!--  Quill editor for task description -->
                                        <div class="snow-container border rounded p-50">
                                            <div class="compose-editor mx-75"></div>
                                            <div class="d-flex justify-content-end">
                                                <div class="compose-quill-toolbar pb-0">
                                                    <span class="ql-formats mr-0">
                                                        <button class="ql-bold"></button>
                                                        <button class="ql-link"></button>
                                                        <button class="ql-image"></button>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tag d-flex justify-content-between align-items-center pt-1">
                                            <div class="flex-grow-1 d-flex align-items-center">
                                                <i class="bx bx-tag align-middle mr-25"></i>
                                                <label>Etiquette</label><br>
                                                <select class="select2-assign-label form-control" multiple="multiple" id="select2-assign-label">
                                                    <?php foreach($etiq as $etiquette): ?>
                                                        <option value="<?= $etiquette['name_etiq'] ?>"><?= $etiquette['name_etiq'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="ml-25">
                                                <i class="bx bx-plus-circle cursor-pointer add-tags"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pb-1">
                                        <div class="d-flex align-items-center mb-1">
                                            <small class="ml-75 text-muted">Tache crée le <?php setlocale(LC_TIME, "FR"); $date_res = date('Y-m-d'); $date_now = strftime("%d %B %Y", strtotime($date_res)); echo $date_now; ?></small>
                                        </div>
                                        <!-- quill editor for comment -->
                                        <div class="snow-container border rounded p-50 ">
                                            <div class="comment-editor mx-75"></div>
                                            <div class="d-flex justify-content-end">
                                                <div class="comment-quill-toolbar pb-0">
                                                    <span class="ql-formats mr-0">

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-1 d-flex justify-content-end">
                                            <button type="button" class="btn btn-primary add-todo">Ajouter une tache</button>
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
                                            <li class="todo-item" data-name="<?= $task['assignation_task'] ?>">
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
                                                            <span class="badge badge-pill ml-50" style="background-color: <?= $list_explode_color[0] ?>;"><?= $list_explode[0]; ?></span>
                                                        </div>
                                                        <span class="badge badge-light-secondary badge-pill ml-50 <?= $size_tab ?>" data-tag="<?= $task['etiquette_task'] ?>" data-toggle="tooltip" data-placement="bottom" title="<?= $task['etiquette_task'] ?>">
                                                            <i class='bx bx-dots-horizontal-rounded font-small-1'></i>
                                                        </span>
                                                        <?php 
                                                        
                                                            $input = array("primary", "secondary", "sucess", "danger", "warning", "info", "dark");
                                                            $rand_keys = array_rand($input, 1);
                                                            $result_color_rand = $input[$rand_keys];                                                                                  
                                                        
                                                        ?>
                                                        <span class="badge badge-circle badge-light-<?= $result_color_rand; ?>"><?= substr($task['assignation_task'], 0, 2); ?></span>
                                                        <a href="php/favo_task.php?num=<?= $task['id'] ?>&page=del" class='todo-item-favorite ml-75'><i class="<?php if($task['favorite'] == "1"){echo "bx bx-star bxs-star warning hoverfav";}else{echo "bx bx-star hoverfav";} ?>"></i></a>
                                                        <a href="php/corbeille_task.php?num=<?= $task['id'] ?>&page=del" class='todo-item-delete ml-75'><i class="bx bx-badge-check checkhover"></i></a>
                                                        <a href="php/delete_task.php?num=<?= $task['id'] ?>" class='todo-item-delete ml-75'><i class="bx bxs-x-square trashhover"></i></a>
                                                    </div>
                                                </div>
                                            </li>
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
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-todo.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>