<?php 
require_once 'php/verif_session_connect_admin.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStat = $bdd->prepare('SELECT * FROM task_fisca');
    $pdoStat->execute();
    $task = $pdoStat->fetchAll();

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
    <title>Tache fiscale</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-todo.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar todo-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">
<style>
    .icon_check{
        font-size: 1.2rem;
        color: #c7cfd6;
    }
    .icon_check:hover{color: green;}
    .icon_fav {
        font-size: 1.2rem;
        color: #c7cfd6;
    }
    .icon_fav:hover{color:orange;}
    .icon_trash{
        font-size: 1.2rem;
        color: #c7cfd6;
    }
    .icon_trash:hover{color:red;}
</style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: #e72424;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php"><div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix.png"></div></a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">                        
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-lg-flex d-none text-white"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
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
                            <!-- sidebar list start -->
                            <div class="sidebar-menu-list">
                                <div class="list-group">
                                    <a href="#" class="list-group-item border-0 active">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: list.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent;"></i>
                                        </span>
                                        <span> Toutes les taches</span>
                                    </a>
                                </div>
                                <label class="filter-label mt-2 mb-1 pt-25">Filtre</label>
                                <div class="list-group">
                                    <a href="task-fisca-filtre.php?filter=favo" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: star.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Favoris</span>
                                    </a>
                                    <a href="task-fisca-filtre.php?filter=valide" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: check.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>Valide</span>
                                    </a>
                                    <a href="task-fisca-filtre.php?filter=en cours" class="list-group-item border-0">
                                        <span class="fonticon-wrap mr-50">
                                            <i class="livicon-evo" data-options="name: timer.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent;"></i>
                                        </span>
                                        <span>En cours</span>
                                    </a>
                                </div>
                                <div class="form-group">
                                    <br>
                                    <br>
                                </div>
                                <div class="form-group">
                                    <h5>Ajouter une tache</h5>
                                </div>
                                <div class="form-group">
                                    <hr>
                                </div>
                                <div class="form-group">
                                    <form action="php/insert_task_back.php?type=fisca" method="POST">
                                        <div class="form-group">
                                            <label>Nom de la tache <label class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="name_task" placeholder="Nom de la tache" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tache par <label class="text-danger">*</label></label>
                                            <input class="form-control" type="text" name="pour_task" placeholder="Tache par ..." required>
                                        </div>
                                        <label>Date d'échéance <label class="text-danger">*</label></label>
                                        <fieldset class="form-group position-relative has-icon-left">
                                            <input name="dte_echeance" type="text" class="form-control pickadate" placeholder="Date d'échéance" required>
                                            <div class="form-control-position">
                                                <i class='bx bx-calendar'></i>
                                            </div>
                                        </fieldset>
                                        <button class="btn btn-success glow mr-1 mb-1" type="submit">
                                            <i class="bx bx-check"></i> Enregister
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <!-- sidebar list end -->
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
                        <div class="todo-app-area">
                            <div class="todo-app-list-wrapper">
                                <div class="todo-app-list">
                                    <div class="todo-fixed-search d-flex justify-content-between align-items-center">
                                        <div class="sidebar-toggle d-block d-lg-none">
                                            <i class="bx bx-menu"></i>
                                        </div>
                                        <fieldset class="form-group position-relative has-icon-left m-0 flex-grow-1">
                                            <input type="text" class="form-control todo-search" id="todo-search" placeholder="Rechercher une tache">
                                            <div class="form-control-position">
                                                <i class="bx bx-search"></i>
                                            </div>
                                        </fieldset>
                                        <div class="todo-sort dropdown mr-1">
                                            <button class="btn dropdown-toggle sorting" type="button" id="sortDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                <i class="bx bx-filter"></i>
                                                <span>Action</span>
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="sortDropdown">
                                                <a class="dropdown-item ascending" href="#">Ascending</a>
                                                <a class="dropdown-item descending" href="#">Descending</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="todo-task-list list-group">
                                        <!-- task list start -->
                                        <ul class="todo-task-list-wrapper list-unstyled" id="">
                                            <?php $index=98; ?>
                                            <?php foreach($task as $tasks): ?>
                                                <li class="vertical-align-center todo-item <?php if($tasks['statut_task'] == "valide"){echo "table-success";}else{echo "table-warning";} ?>" style="height: 50px; z-index: <?= $index; ?>;">
                                                    <div class="todo-title-wrapper d-flex justify-content-sm-between justify-content-end align-items-center" style="position: relative; top: 25%;">
                                                        <div class="todo-title-area d-flex">
                                                            <p class="todo-title mx-50 m-0 truncate"><?= $tasks['name_task'] ?> | Pour: <?= $tasks['pour_task'] ?> | Pour le: <?= $tasks['dte_echeance'] ?></p>
                                                        </div>
                                                        <div class="todo-item-action d-flex align-items-center">
                                                            <div class="todo-badge-wrapper d-flex"></div>
                                                            <a href="php/change_task_back.php?num=<?= $tasks['id'] ?>&type=statut_task&categorie=fisca&statut_categorie=<?= $tasks['statut_task'] ?>" class="icon_check ml-75"><i class='bx bx-badge-check'></i></a>
                                                            <a href="php/change_task_back.php?num=<?= $tasks['id'] ?>&type=favo&categorie=fisca&favo=<?= $tasks['favo_task'] ?>" class='todo-item-favorite ml-75 <?php if($tasks['favo_task'] == "yes"){echo "warning";} ?>'><i class="bx bx-star <?php if($tasks['favo_task'] == "yes"){echo "bxs-star";} ?>"></i></a>
                                                            <a href="php/change_task_back.php?num=<?= $tasks['id'] ?>&type=delete&categorie=fisca" class='todo-item-delete ml-75'><i class="bx bx-trash"></i></a>

                                                            <div class="btn-group ml-2">
                                                                <div class="dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="#C0C0C0" class="bi bi-pencil-square" viewBox="0 0 16 16">
                                                                        <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
                                                                        <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
                                                                    </svg>
                                                                </div>
                                                                <div class="dropdown-menu dropdown-menu-right pt-1 px-1" style="min-width: 250px;">
                                                                    <div class="form-group">
                                                                        <form method="POST" action="php/change_task_back.php?num=<?= $tasks['id'] ?>&type=editer_task&categorie=fisca">
                                                                            <div class="form-group">
                                                                                <label>Nom de la tache <label class="text-danger">*</label></label>
                                                                                <input class="form-control" type="text" name="name_task" value="<?= $tasks['name_task'] ?>" required>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label>Tache par <label class="text-danger">*</label></label>
                                                                                <input class="form-control" type="text" name="pour_task" value="<?= $tasks['pour_task'] ?>" required>
                                                                            </div>
                                                                            <label>Date d'échéance <label class="text-danger">*</label></label>
                                                                            <fieldset class="form-group position-relative has-icon-left">
                                                                                <input name="dte_echeance" type="text" class="form-control pickadate" value="<?= $tasks['dte_echeance'] ?>" required>
                                                                                <div class="form-control-position">
                                                                                    <i class='bx bx-calendar'></i>
                                                                                </div>
                                                                            </fieldset>
                                                                            <button class="btn btn-success glow" type="submit" name="editer_task_fisca">
                                                                                Enregister
                                                                            </button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- Fin édition de la tâche -->
<<<<<<< HEAD
=======

>>>>>>> indah
                                                        </div>
                                                    </div>
                                                </li>
                                            <?php $index = $index - 1; endforeach; ?>
                                        </ul>
                                        <!-- task list end -->
                                        <div class="no-results">
                                            <h5>Aucune tache ...</h5>
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
    <!-- END: Content-->

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/daterangepicker.js"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-todo.js"></script>
    <script src="../../../app-assets/js/scripts/pickers/dateTime/pick-a-datetime.js"></script>
    <!-- END: Page JS-->
        <!-- TIMEOUT -->
        <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>
