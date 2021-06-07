<?php 
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoStt = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStt->bindValue(':numentreprise',$_SESSION['id']);
    $pdoStt->execute();
    $entreprise = $pdoStt->fetch();

    $pdoS = $bdd->prepare('SELECT * FROM task WHERE id = :num');
    $pdoS->bindValue(':num',$_GET['num']);
    $pdoS->execute();
    $task = $pdoS->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM task_recent WHERE task_num = :num ORDER BY id DESC');
    $pdoSt->bindValue(':num',$_GET['num']);
    $pdoSt->execute();
    $recent = $pdoSt->fetchAll();

    $pdoSttt = $bdd->prepare('SELECT * FROM task_commentaire WHERE task_num = :num ORDER BY id DESC');
    $pdoSttt->bindValue(':num',$_GET['num']);
    $pdoSttt->execute();
    $commentaire = $pdoSttt->fetchAll();

    $pdoStttt = $bdd->prepare('SELECT * FROM task_doc WHERE task_num = :num ORDER BY id DESC');
    $pdoStttt->bindValue(':num',$_GET['num']);
    $pdoStttt->execute();
    $file = $pdoStttt->fetchAll();

    if(!empty($_FILES['doctask'])){

        $num = !empty($_SESSION['id_crea']) ? $_SESSION['id_crea'] : NULL;

    if (is_uploaded_file($_FILES['doctask']['tmp_name'])) {
    echo "File ". $_FILES['doctask']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../src/task/document/';
  
    if(!is_dir($dir)){
        echo " Le répertoire de destination n'existe pas !";
    exit;
    }
  
    $name_files = $_FILES['doctask']['name'];                         
    $date_now = '-'.date("H-i-s");
    $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
    $target_file = $_FILES['doctask']['tmp_name'];                                     
    $real_name = substr($name_files, 0, -4);
    $file_name = $dir. $real_name . $date_now . $type_files;
    $date_jm = date("d/m");
    $date_h = date("H") + 1;
    $date_min = date("i");
    $date_hmin = ''.$date_h.':'.$date_min.'';
    $late_name = $real_name . $date_now . $type_files;

    if($resultat = move_uploaded_file($target_file, $file_name)){

        $inser = $bdd->prepare('INSERT INTO task_doc (namedoc_task, date_jm, date_hmin, task_num, id_session) VALUES(?,?,?,?,?)');
        $inser->execute(array(
        htmlspecialchars($late_name),
        htmlspecialchars($date_jm),
        htmlspecialchars($date_hmin),
        htmlspecialchars($_GET['num']),
        htmlspecialchars($_SESSION['id_session'])
    ));

        $par2 = $_POST['par'];
        $type_task = "upload";
        $date_j = date("d");
        $date_m = date("m");
        $date_a = date("Y");
        $date_min = date("i");
        $img_profile = "";
        $task_num = $_GET['num'];

        $insert = $bdd->prepare('INSERT INTO task_recent (par, type_task, date_j, date_m, date_a, date_h, date_min, img_profile, task_num, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
            htmlspecialchars($par2),
            htmlspecialchars($type_task),
            htmlspecialchars($date_j),
            htmlspecialchars($date_m),
            htmlspecialchars($date_a),
            htmlspecialchars($date_h),
            htmlspecialchars($date_min),
            htmlspecialchars($img_profile),
            htmlspecialchars($task_num),
            htmlspecialchars($_SESSION['id_session'])
        ));

        header('Location: task-view.php?num='.$_GET['num'].'');
        exit();

    }

    }
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
    <title>View tache</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-chat.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout content-left-sidebar chat-application navbar-sticky footer-static " data-open="click" data-menu="vertical-menu-modern" data-col="content-left-sidebar" data-layout="<?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout"></body>
<style>

.div_task{
    background-color: rgba(0, 21, 41, 0.4); 
    color: white;
    border-radius: 10px;
}

.div_task:hover{
    background-color: rgba(0, 21, 41, 0.6);
    border-radius: 20px;
    transition-duration: 1s;
}

.activityr{
    padding: 25px;
}

.colorred{
    color: red;
}

.none-validation{
    display: none;
}

.block-validation{
    display: block;
}

.retournhover{
    color: white;
}

.backretour{
    background-color: rgba(149, 149, 149, 0.6);
    transition-duration: 0.5s;
}
.backretour:hover{
    background-color: #ffa61d;
}

.h:hover .vis{
    display: block;
}

/* styles de base si JS est activé */

.js .input-file-container {
	position: relative;
	width: 20px;
}

.js .input-file-trigger {
	display: block;
	padding: 14px 45px;
	background: rgba(149, 149, 149, 0.6);
	color: #fff;
	font-size: 1em;
	transition: all .4s;
	cursor: pointer;
}

.js .input-file {
	position: absolute;
	top: 0;
	left: 0;
	width: 20px;
	padding: 14px 0;
	opacity: 0;
	cursor: pointer;
}

/* quelques styles d'interactions */
.js .input-file:hover + .input-file-trigger,
.js .input-file:focus + .input-file-trigger,
.js .input-file-trigger:hover,
.js .input-file-trigger:focus {
	background: #41e15c;
	color: white;
}

/* styles du retour visuel */
.file-return {
	margin: 0;
}

.file-return:not(:empty) {
	margin: 1em 0;
}

.js .file-return {
	font-style: italic;
	font-size: .9em;
	font-weight: bold;
}

/* on complète l'information d'un contenu textuel uniquement lorsque le paragraphe n'est pas vide */
.js .file-return:not(:empty):before {
	content: "Ficher selectionné: ";
	font-style: normal;
	font-weight: normal;
}
        
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
                    <!-- app chat user profile left sidebar start -->
                    <div class="chat-user-profile">
                        <header class="chat-user-profile-header text-center border-bottom">
                            <span class="chat-profile-close">
                                <i class="bx bx-x"></i>
                            </span>
                            <div class="my-2">
                                <div class="avatar">
                                    <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="user_avatar" height="100" width="100">
                                </div>
                                <h5 class="mb-0"><?= $entreprise['nameentreprise'] ?></h5>
                                <span><?= $entreprise['descr_entreprise'] ?></span>
                            </div>
                        </header>
                        <div class="chat-user-profile-content">
                            <div class="chat-user-profile-scroll">
                                <h6>PERSONAL INFORAMTION</h6>
                                <ul class="list-unstyled mb-2">
                                    <li class="mb-25"><?= $entreprise['emailentreprise'] ?></li>
                                    <li><?= $entreprise['telentreprise'] ?></li>
                                </ul>
                                <h6 class="text-uppercase mb-1">SETTINGS</h6>
                                <ul class="list-unstyled">
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    <!-- app chat user profile left sidebar ends -->
                    <!-- app chat sidebar start -->
                    <div class="chat-sidebar card">
                        <span class="chat-sidebar-close">
                            <i class="bx bx-x"></i>
                        </span>
                        <div class="chat-sidebar-search">
                            <div class="d-flex align-items-center">
                                <div class="chat-sidebar-profile-toggle">
                                    <div class="avatar">
                                        <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="user_avatar" height="36" width="36">
                                    </div>
                                </div>
                                <fieldset class="form-group position-relative has-icon-left mx-75 mb-0">
                                    <input type="text" class="form-control round" id="chat-search" placeholder="Rechercher">
                                    <div class="form-control-position">
                                        <i class="bx bx-search-alt text-dark"></i>
                                    </div>
                                </fieldset>
                            </div>
                        </div>
                        <div class="chat-sidebar-list-wrapper pt-2">
                            <h6 class="px-2 pt-2 pb-25 mb-0">Membres</h6>
                            <ul class="chat-sidebar-list">
                                <?php 
                                
                                $membre = explode(',',$task['assignation_task']);
                                
                                ?>
                                <?php foreach($membre as $membres): ?>
                                <li>
                                    <div class="d-flex align-items-center">
                                        <?php 
                                                        
                                            $input = array("primary", "secondary", "sucess", "danger", "warning", "info", "dark");
                                            $rand_keys = array_rand($input, 1);
                                            $result_color_rand = $input[$rand_keys];                                                                                  
                                                        
                                        ?>
                                        
                                        <div class="avatar m-0 mr-50"><span class="badge badge-circle badge-light-<?= $result_color_rand; ?>"><?= substr($membres, 0, 2); ?></span>
                                            <span class="avatar-status-busy"></span>
                                        </div>
                                        <div class="chat-sidebar-name">
                                            <h6 class="mb-0"></h6><span class="text-muted"><?= $membres ?></span>
                                        </div>
                                    </div>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                        <div class="container-fluid">
                        <div class="dropdown invoice-options mx-auto primary">
                                            <!-- button add membre -->
                        </div>
                        </div>                        
                    </div>
                    <!-- app chat sidebar ends -->
                </div>
            </div>
            <div class="content-right">
                <div class="content-overlay"></div>
                <style>
                    .bouge{overflow: auto;}
                    </style>
                <div class="content-wrapper bouge">
                    <div class="content-header row">
                    </div>
                    <div id="div_1" class="content-body">
                        <div class="form-group text-center">
                            <h1><?= $task['name_task'] ?></h1>
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row justify-content-around custom-line text-center">
                                <div onclick="div_1_click()" class="col-4 div_task">
                                    <br>
                                    <br>
                                    <br>
                                    <p>Note</p><br>
                                    <p>Commentaire</p><br>
                                    <p>etc</p>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                                <div onclick="div_2_click()" class="col-4 div_task">
                                    <br>
                                    <br>
                                    <br>
                                    <p>Images</p><br>
                                    <p>Documents</p><br>
                                    <br>
                                    <br>
                                    <br>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="row align-items-start custom-line">
                                <div class="col border-bottom">
                                    <div class="form-group text-center">
                                        <h4>Actions récentes</h4>
                                    </div>
                                    <div class="form-group activityr">
                                        <?php foreach($recent as $recentt): ?>
                                            <div class="avatar m-0 mr-50"><span class="badge badge-circle badge-light-<?= $result_color_rand; ?>"><?php if($recentt['par'] == "Inconnue"){echo '<img src="../../../app-assets/images/ico/astro1.gif" width="40px" height="40px">';}else{if($recentt['par'] == ""){echo '<img src="../../../app-assets/images/ico/astro9.gif" width="40px" height="40px">';}else{echo substr($recentt['par'], 0, 2);}} ?></span>
                                                <span class="avatar-status-busy"></span>
                                            </div>
                                            <span class="text-muted"><?php if($recentt['type_task'] == "upload"){echo "OooOh un nouveau document !";}else{if($recentt['type_task'] == "commentaire"){echo "Va regarder mon commentaire s'il te plaît !";}} ?> <i class='bx bx-right-arrow-alt' style='font-size: 13px;'></i> <?= $recentt['date_j'] ?>/<?= $recentt['date_m'] ?></span><br><br>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="col border-left border-bottom">
                                    <div class="form-group text-center">
                                        <h4>Temps restant</h4>
                                    </div>
                                    <div class="form-group text-center">
                                        <div class="form-group">
                                            <label id="demo" class="border" style="font-size: 30px; padding: 20px; border-radius: 20px;"></label>
                                        </div>
                                        <div class="form-group">

                                            <?php 
                                            
                                                $date_now = $task['dateecheance_task'];
                                                setlocale(LC_TIME, "fr_FR","French");
                                                $date = strftime("%d %B %Y", strtotime($date_now));


                                            ?>


                                            Votre fin de tache est programmé pour le <?= $date; ?>
                                        </div>
                                        <div class="form-group">
                                            <hr>
                                        </div>
                                        <div class="form-group">
                                            <h5>Description de la tache</h5>
                                        </div>
                                        <div class="form-group">
                                            <small><?= $task['description_task'] ?></small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="div_2" class="content-body none-validation">
                        <div class="form-group border-bottom">
                            <div onclick="retourndiv_2()" class="retournhover border text-center backretour"><label class="retournhover" style="padding-top: 10px; padding-bottom: 10px;">Retour</label></div>
                        </div>
                        <div class="form-group">

                            <?php 
                                            
                                                $date_now_com = $task['lastcommentaire_task'];
                                                setlocale(LC_TIME, "fr_FR","French");
                                                $datelast = strftime("%d %B %Y", strtotime($date_now_com));


                            ?>
                            <span style="padding: 10px;">Dernier commentaire le <?= $datelast; ?></span>
                            <hr>
                        </div>
                        <div class="form-group text-center">
                            <h4>Ajouter un commentaire</h4>
                        </div>
                        <form class="" action="php/insert_commentaire.php?num=<?= $_GET['num'] ?>" method="POST">
                            <div class="form-group mx-sm-3 mb-2">
                                <?php
                                
                                $par = explode(',',$task['assignation_task']);
                                
                                ?>
                                <label>*Par :</label>
                                <select name="par" class="form-control invoice-item-select">
                                        <option value="Inconnue">Anonyme</option>
                                    <?php foreach($par as $parr): ?>
                                        <option value="<?= $parr ?>"><?= $parr ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group mx-sm-3 mb-2">
                                <input type="text" class="form-control" name="content" placeholder="Commentaire" required>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-primary mb-2">Ajouter un commentaire</button>
                            </div>
                        </form>
                        <div class="form-group">
                            <hr>
                        </div>
                        <div class="form-group">
                            <div class="form-group" style="padding-left: 10px;">
                                <p>Commentaire :</p>
                            </div>
                            <div class="form-group" style="padding-left: 10px;">
                                <?php foreach($commentaire as $com): ?>
                                <div class="avatar m-0 mr-50"><span class="badge badge-circle badge-light-<?= $result_color_rand; ?>"><?= substr($com['par'], 0, 2); ?></span>
                                    <span class="avatar-status-busy"></span>
                                </div>
                                <span title="<?= $com['date_hmin'] ?>" class="text-muted h"><?= $com['par'] ?> <i class='bx bx-right-arrow-alt' style='font-size: 13px;'></i><?= $com['content'] ?><label class="none-validation vis">&nbsp&nbsp&nbsp <?= $com['date_jm'] ?>&nbsp&nbsp&nbsp<?= $com['date_hmin'] ?></label></span><br><br>
                                <?php endforeach; ?>               
                            </div>
                        </div>
                    </div>
                    
                    <div id="div_3" class="content-body none-validation">
                        <div class="form-group">
                            <div class="form-group border-bottom">
                                <div onclick="retourndiv_3()" class="retournhover border text-center backretour"><label class="retournhover" style="padding-top: 10px; padding-bottom: 10px;">Retour</label></div>
                            </div>
                            <div class="form-group">
                                <h5 style="padding-left: 10px;">Vos documents :</h5>
                            </div>
                            <div class="form-group">
                                <div class="row app-file-recent-access" style="padding-left: 10px;">
                                    <?php foreach($file as $files): ?>
                                    <div class="col-md-3 col-6">
                                        <div class="card border shadow-none mb-1 app-file-inf">
                                            <div class="card-content">
                                                <div class="app-file-content-logo card-img-top">
                                                    <div class="row">
                                                        <div class="col">&nbsp&nbsp&nbsp<a href="../../../src/task/document/<?= $files['namedoc_task'] ?>" target="_blank"><i class="bx bxs-note app-file-edit-icon d-block float-right"></i></a><a href="../../../src/task/document/<?= $files['namedoc_task'] ?>" download><i class="bx bx-download app-file-edit-icon d-block float-right"></i></a></div>
                                                    </div>   
                                                    <br>
                                                    <br>

                                                    <?php 
                                                    
                                                    if(substr($files['namedoc_task'], -3) == "pdf"){
                                                        $type_doc = "pdf.png";
                                                    }elseif(substr($files['namedoc_task'], -3) == "png"){
                                                        $type_doc = "psd.png";
                                                    }else{
                                                        $type_doc = "doc.png";
                                                    }
                                                    
                                                    ?>

                                                    <img class="d-block mx-auto" src="../../../app-assets/images/icon/<?= $type_doc ?>" height="38" width="30" alt="Card image cap">
                                                </div>
                                                <div class="card-body p-50">
                                                    <div class="app-file-recent-details">
                                                        <div class="app-file-name font-size-small font-weight-bold"><?= $files['namedoc_task'] ?></div>
                                                        <div class="app-file-last-access font-size-small text-muted">Le <?= $files['date_jm'] ?> <?= $files['date_hmin'] ?></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>         
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <hr>
                            </div>
                            <div class="form-group">
                                <h5 style="padding-left: 10px;">Insertion de document</h5>
                                <small style="padding-left: 10px;">L'insertion de document est tout de même restreinte nous acceptons seulement les formats PNG, JPG, JPEG ainsi que PDF pour des questions de sécurités</small>   
                            </div>
                            <div class="form-group text-center">
                            <form name="myform" action="" method="POST" enctype="multipart/form-data">
                                <input class="input-file" id="my-file" onchange="this.form.submit();" type="file"  name="doctask">
	                            <label for="my-file" class="input-file-trigger" tabindex="0">
		                            Sélectionner un fichier ...
	                            </label>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script>
    
    // ajout de la classe JS à HTML ---------------------> Script pour le bouton
        document.querySelector("html").classList.add('js');

        // initialisation des variables
        var fileInput = document.querySelector( ".input-file" ),
	        button = document.querySelector( ".input-file-trigger" ),
	        the_return = document.querySelector(".file-return");

        // action lorsque la "barre d'espace" ou "Entrée" est pressée
        button.addEventListener( "keydown", function( event ) {
	        if ( event.keyCode == 13 || event.keyCode == 32 ) {
		        fileInput.focus();
	        }
        });

        // action lorsque le label est cliqué
        button.addEventListener( "click", function( event ) {
	        fileInput.focus();
	return false;
        });

        // affiche un retour visuel dès que input:file change
        fileInput.addEventListener( "change", function( event ) {
	        the_return.innerHTML = this.value;
        });
    
    </script>

    <script>
        function div_1_click(){
            document.getElementById("div_1").style.display = "none";
            document.getElementById("div_3").style.display = "none";
            document.getElementById("div_2").style.display = "block";
        }

        function div_2_click(){
            document.getElementById("div_1").style.display = "none";
            document.getElementById("div_2").style.display = "none";
            document.getElementById("div_3").style.display = "block";
        }

        function retourndiv_2(){
            document.getElementById("div_1").style.display = "block";
            document.getElementById("div_3").style.display = "none";
            document.getElementById("div_2").style.display = "none";
        }

        function retourndiv_3(){
            document.getElementById("div_1").style.display = "block";
            document.getElementById("div_3").style.display = "none";
            document.getElementById("div_2").style.display = "none";
        }

    </script>
    <script>
        // Set the date we're counting down to
        var countDownDate = new Date("<?= $task['dateecheance_task'] ?>").getTime();

        // Update the count down every 1 second
        var x = setInterval(function() {

        // Get today's date and time
        var now = new Date().getTime();

        // Find the distance between now and the count down date
        var distance = countDownDate - now;

        // Time calculations for days, hours, minutes and seconds
        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
            if(days == "0"){days = ""}else{days = days + "J "}
        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
            if(seconds == "0"){seconds = ""}else{seconds = seconds + "s "}

        // Display the result in the element with id="demo"
        document.getElementById("demo").innerHTML = days + hours + "h " + minutes + "m " + seconds;

        // If the count down is finished, write some text
        if (distance < 0) {
            clearInterval(x);
            document.getElementById("demo").innerHTML = "FIN DE TACHE";
        }
        }, 1000);

    </script>

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
    <script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>