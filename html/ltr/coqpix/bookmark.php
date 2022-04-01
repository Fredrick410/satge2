
<?php
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

function get_favicon($url_site)
{

    $google_url = 'https://api.faviconkit.com/';

    $url_site = str_replace('www.', '', $url_site);

    $size = '144';


    return $google_url . $url_site . '/' . $size;
}


$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoSt = $bdd->prepare('SELECT * FROM etiquette_bookmark WHERE id_session = :num');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$etiq = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM bookmark WHERE id_session = :num');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$bookmark = $pdoSt->fetchAll();

$pdoSt = $bdd->prepare('SELECT * FROM bookmark WHERE favorite_search=:favorite_search AND id_session = :num');
$pdoSt->bindValue(':favorite_search', "yes");
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$bookmark_favo = $pdoSt->fetchAll();
// nouvelle requete pour la liste de lecture -- modif : Anass -- 13/01/2022

$pdoSt = $bdd->prepare('SELECT * FROM liste_lecture WHERE id_session = :num');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$rows = $pdoSt->fetchAll();


$pdoSt = $bdd->prepare('SELECT * FROM liste_lecture WHERE id_session = :num and statut=1');
$pdoSt->bindValue(':num', $_SESSION['id_session']);
$pdoSt->execute();
$rowsArchive = $pdoSt->fetchAll();


?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Bookmark - Coqpix</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/fontawesome.css">

    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/select2.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/bootstrap.css">
    <!-- App css-->

    <link id="color" rel="stylesheet" href="../../../cuba/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/responsive.css">
    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-knowledge-base.css">
    <!-- END: Page CSS-->
    <!-- BEGIN: Custom CSS-->

    <!-- END: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/style.css">
    <!-- link mise en forme nav gauche et haut -->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">


    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">


</head>

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

<!-- BEGIN: Main Menu-->
<?php include('php/menu_front.php'); ?>
<!-- END: Main Menu-->

<!-- BEGIN: Header-->
<?php $btnreturn = false;
include('php/menu_header_front.php'); ?>
<!-- END: Header-->
<div class="app-content content" style="margin-top: 50px;">
    <!-- Page Body Start-->
    <div class="page-body-wrapper" style="">
        <div class="page-body" style="margin-top: 30px">
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="email-wrap bookmark-wrap">
                    <div class="row">
                        <div>
                            <div class="col-sm-4 box-col-6">
                                <div class="email-left-aside">
                                    <div class="card text-center">
                                        <div class="card-body">
                                            <!--CONTENT CONTENT CONTENT -->
                                            <div class="container-fluid navbar-header">
                                                <ul class="nav navbar-nav flex-row">
                                                    <li class="nav-item mx-auto modern-nav-toggle">
                                                        <a href="dashboard-analytics.php"><img class="logocoq" src="../../../app-assets/images/logo/coqpix2.png" /></a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!--GAUCHE -->
                                            <div class="left-bookmark">
                                                <br>
                                                <div>
                                                    <div class="mx-auto">
                                                        <img class="w-30 rounded-circle" src="../../../cuba/assets/images/user/user.png" alt="">
                                                    </div>
                                                    <div class="mx-auto">
                                                        <h6 class="f-w-600"><?= $entreprise['nameentreprise'] ?></h6>
                                                        <p><?= $entreprise['emailentreprise'] ?></p>
                                                    </div>

                                                    <br><br>

                                                    <div class="text-center">
                                                        <button type="button"  href="" class="btn btn-primary col-lg-12 col-sm-6 col-md-6" data-toggle="modal" data-target="#modalContactForm" ><i class="me-8" data-feather="bookmark"></i>Ajouter une recherce</button>
                                                    </div>

                                                    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h4 class="modal-title w-100 font-weight-bold">J'ajoute une recherche</h4>
                                                                    <div class="text-center col-6">
                                                                        <button type="button" href="" class="btn btn-primary col-lg-12 col-sm-6 col-md-6" data-toggle="modal" data-target="#modalContactForm2" >Liste de lecture</button>
                                                                    </div>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body mx-3">
                                                                    <form action="php/insert_bookmark.php" method="POST" class="form-bookmark needs-validation" novalidate="">

                                                                        <div class="row g-2">

                                                                            <div class="mb-3 mt-0 col-md-12">
                                                                                <label>Web Url (Lien de votre recherche)</label>
                                                                                <input class="form-control" name="url_search" id="editurl" type="text" required="" autocomplete="off" value="" placeholder="www.google.com">
                                                                            </div>

                                                                            <div class="mb-3 mt-0 col-md-12">
                                                                                <label>Titre de la recherche</label>
                                                                                <input name="name_search" placeholder="Titre de la recherche" class="form-control" id="edittitle" type="text" required="" autocomplete="off" value="">
                                                                            </div>

                                                                            <div class="mb-3 mt-0 col-md-12">
                                                                                <label>Description</label>
                                                                                <textarea name="description_search" placeholder="Description de la recherche" class="form-control" id="editdesc" required="" autocomplete="off"></textarea>
                                                                            </div>

                                                                            <div class="mb-3 mt-0 col-md-12">
                                                                                <label>Theme de recherche</label>
                                                                                <select name="etiquette_search" class="form-control">
                                                                                    <option value="Inconnue">Séléctionner un thème de recherche</option>
                                                                                    <?php foreach ($etiq as $etiquette) : ?>
                                                                                        <option value="<?= $etiquette['color_etiq'] ?>"><?= $etiquette['name_etiq'] ?></option>
                                                                                    <?php endforeach; ?>
                                                                                </select>
                                                                            </div>

                                                                            <button class="btn btn-secondary" type="submit">Sauvegarder</button>
                                                                            <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler </button>
                                                                        </div>
                                                                    </form>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <br>





                                                    <div class="text-center">
                                                        <button type="button" href="" class="btn btn-primary col-lg-12 col-sm-6 col-md-6" data-toggle="modal" data-target="#modalContactForm2" >Liste de lecture</button>
                                                    </div>

                                                    <div class="modal fade" id="modalContactForm2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                         aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header text-center">
                                                                    <h4 class="modal-title w-100 font-weight-bold">Je crée une liste de lecture</h4>
                                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>

                                                                <form action="php/insert_listelecture.php" method="POST" class="form-bookmark needs-validation" novalidate="">

                                                                    <div class="modal-body mx-3">

                                                                        <div class="mb-3 mt-0 col-md-12">
                                                                            <label>Web Url (Lien de votre recherche)</label>
                                                                            <input class="form-control" name="url_search" id="editurl" type="text" required="" autocomplete="off" value="" placeholder="www.google.com">
                                                                        </div>
                                                                        <div class="mb-3 mt-0 col-md-12">
                                                                            <label>Titre de la recherche</label>
                                                                            <input name="name_search" placeholder="Titre de la recherche" class="form-control" id="edittitle" type="text" required="" autocomplete="off" value="">
                                                                        </div>



                                                                        <button class="btn btn-secondary" type="submit">Sauvegarder</button>
                                                                        <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler </button>
                                                                    </div>

                                                                </form>

                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br><br><br>
                                                <ul class="nav">
                                                    <li class="nav-item col-12" style="position:relative ; float:left">
                                                        <a class="nav-link active" id="favoris-tab-fill" data-toggle="pill" href="#favoris-fill" aria-expanded="true">
                                                            Mes Favoris
                                                        </a>
                                                    </li>

                                                    <li class="nav-item col-12 dropdown">
                                                        <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="javascript:void(0);" role="button" aria-haspopup="false"
                                                           aria-expanded="false">
                                                            Liste de lecture
                                                        </a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" id="nonlu-tab" href="#nonlu" data-toggle="pill"
                                                               aria-expanded="true">Pages non lues</a>
                                                            <a class="dropdown-item" id="lu-tab" href="#lu" data-toggle="pill"
                                                               aria-expanded="true">Pages lues</a>
                                                        </div>
                                                    </li>

                                                    <li class="nav-item col-12">
                                                        <a class="nav-link" id="recherches-tab-fill" data-toggle="pill" href="#recherches-fill" aria-expanded="false">
                                                            Mes recherches
                                                        </a>
                                                    </li>

                                                    <li class="nav-item col-12">
                                                        <a class="nav-link" id="partages-tab-fill" data-toggle="pill" href="#partages-fill" aria-expanded="false">
                                                            Partagés avec moi
                                                        </a>
                                                    </li>


                                                </ul>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>




                                            <!-- Filled Pills Start -->
                                            <section id="filled-pills">
                                                <div class="row">
                                                    <div class="col-xl-12 col-lg-12">
                                                        <div class="card bg-white shadow-none borders " style="height: 100%">

                                                            <div class="card-body">
                                                                <!-- <p class="mb-2">
                                                                    Force your <code>.nav</code> contents to extend the full available width one of two modifier classes. To
                                                                    proportionately fill all available space with your <code>.nav-items</code>, use <code>.nav-fill</code>.
                                 -->




                                                                <div class="tab-content">

                                                                    <div role="tabpanel" name="favoris" class="tab-pane show active" id="favoris-fill" aria-labelledby="favoris-tab-fill" aria-expanded="true">
                                                                        <h3>Mes favoris</h3>
                                                                        <div>sdf</div>


                                                                    </div>

                                                                    <div class="tab-pane" id="nonlu" role="tabpanel" aria-labelledby="nonlu-tab"
                                                                         aria-expanded="false">
                                                                        <p>
                                                                        <table class="table dt-responsive nowrap">
                                                                            <br><br>
                                                                            <h6>Ma liste de lecture</h6>
                                                                            <thead>
                                                                            <tr>

                                                                                <th>N°</th>
                                                                                <th>Nom</th>
                                                                                <th>Lien</th>
                                                                                <th>Actions</th>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                            for ($i=0 ; $i<count($rows);++$i){
                                                                            ?>
                                                                            <tr>
                                                                                <td>
                                                                                    <?= $i + 1 ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $rows[$i]['name_search'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $rows[$i]['url_search'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div >
                                                                                        <a href="php/valider_lecture.php?id=<?= $rows[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                                                                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0z"/>
                                                                                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8zm8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                        <a href= "php/delete_liste_lecture.php?id=<?= $rows[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                                            </svg>
                                                                                        </a>

                                                                                    </div>

                                                                                </td>
                                                                                <?php
                                                                                }
                                                                                ?>
                                                                            </tbody>
                                                                        </table>
                                                                        </p>
                                                                    </div>
                                                                    <div class="tab-pane" id="lu" role="tabpanel" aria-labelledby="lu-tab"
                                                                         aria-expanded="false">
                                                                        <?php for ($i=0 ; $i<count($rowsArchive);++$i){if ($rowsArchive[$i]['name_search']){ { ?>


                                                                            <table class="table dt-responsive nowrap">
                                                                            <br><br>
                                                                            <h6>Page Lues - Archive </h6>
                                                                            <thead>
                                                                            <tr>

                                                                                <th>N°</th>
                                                                                <th>Nom</th>
                                                                                <th>Lien</th>
                                                                                <th>Actions</th>

                                                                            </tr>
                                                                            </thead>
                                                                            <tbody>
                                                                            <?php
                                                                            for ($i=0 ; $i<count($rowsArchive);++$i){
                                                                                ?>
                                                                                <tr>
                                                                                <td>
                                                                                    <?= $i + 1 ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $rowsArchive[$i]['name_search'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <?= $rowsArchive[$i]['url_search'] ?>
                                                                                </td>
                                                                                <td>
                                                                                    <div >
                                                                                        <a href="php/valider_lecture.php?id=<?= $rows[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-slash" viewBox="0 0 16 16">
                                                                                                <path d="M13.359 11.238C15.06 9.72 16 8 16 8s-3-5.5-8-5.5a7.028 7.028 0 0 0-2.79.588l.77.771A5.944 5.944 0 0 1 8 3.5c2.12 0 3.879 1.168 5.168 2.457A13.134 13.134 0 0 1 14.828 8c-.058.087-.122.183-.195.288-.335.48-.83 1.12-1.465 1.755-.165.165-.337.328-.517.486l.708.709z"/>
                                                                                                <path d="M11.297 9.176a3.5 3.5 0 0 0-4.474-4.474l.823.823a2.5 2.5 0 0 1 2.829 2.829l.822.822zm-2.943 1.299.822.822a3.5 3.5 0 0 1-4.474-4.474l.823.823a2.5 2.5 0 0 0 2.829 2.829z"/>
                                                                                                <path d="M3.35 5.47c-.18.16-.353.322-.518.487A13.134 13.134 0 0 0 1.172 8l.195.288c.335.48.83 1.12 1.465 1.755C4.121 11.332 5.881 12.5 8 12.5c.716 0 1.39-.133 2.02-.36l.77.772A7.029 7.029 0 0 1 8 13.5C3 13.5 0 8 0 8s.939-1.721 2.641-3.238l.708.709zm10.296 8.884-12-12 .708-.708 12 12-.708.708z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                        <a href= "php/delete_liste_lecture.php?id=<?= $rows[$i]['id'] ?>" class="invoice-action-view mr-1">
                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash" viewBox="0 0 16 16">
                                                                                                <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5zm3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0V6z"/>
                                                                                                <path fill-rule="evenodd" d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1v1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4H4.118zM2.5 3V2h11v1h-11z"/>
                                                                                            </svg>
                                                                                        </a>
                                                                                    </div>

                                                                                </td>
                                                                            <?php } ?>

                                                                        <?php } ?>
                                                                            </tbody>
                                                                            </table>
                                                                        <?php }} ?>

                                                                    </div>







                                                                    <div class="tab-pane" id="recherches-fill" role="tabpanel" aria-labelledby="recherches-tab-fill" aria-expanded="false">

                                                                        <li><span class="text-dark font-weight-bolder">Theme de recherche</span><span class="pull-right"><a class="text-dark" href="#" data-bs-toggle="modal" data-bs-target="#createtag"><i data-feather="plus-circle"></i></a></span></span></li>
                                                                        <br>
                                                                        <?php foreach ($etiq as $etiquette) :
                                                                            $color=strtoupper($etiquette['color_etiq']);
                                                                            ?>
                                                                            <ul class="">
                                                                                <li class="navbar-expand" style="list-style: disc; color: <?= $etiquette['color_etiq']; ?>;">
                                                                                    <a href="php/select_label.php">
                                                                                        <label g class="title text-dark pull-left" style="font-size: 16px"> <?= $etiquette['name_etiq']?><?= $etiquette['id']?></label>
                                                                                        <a href="php/delete_etiq_bookmark.php?num=<?= $etiquette['id']?>" class="fa fa-trash pull-right" style ="display:inline; justify-content: space-between; color: red;"></a>
                                                                                        <a href="etiquette_edit_book.php?num=<?= $etiquette['id'] ?>" class="fa fa-edit pull-right" style ="display:inline; justify-content: space-between; color: blue;" ></a>
                                                                                        <a class="show trash_etiq" data-bs-toggle="pill" role="tab" aria-selected="false"></a>
                                                                                    </a>
                                                                                </li>
                                                                            </ul>
                                                                        <?php endforeach; ?>






                                                                        <div class="card-header d-flex">
                                                                            <h6>Mes recherches</h6>
                                                                        </div>

                                                                        <div class="card-body pb-0">
                                                                            <div class="details-bookmark">

                                                                                <div class="chip mr-1">
                                                                                    <div class="chip-body">
                                                                                        <span class="chip-text">Dribble</span>
                                                                                        <div class="chip-closeable">
                                                                                            <i class="bx bx-trash-alt"></i>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>

                                                                                <div class="row" id="bookmarkData">
                                                                                    <?php foreach ($bookmark as $bookmarks) : $ma = $bookmarks['etiquette_search']?>
                                                                                        <div class="col-4">
                                                                                            <a href="<?= $bookmarks['url_search'] ?>"><div class="card card-with-border bookmark-card o-hidden">
                                                                                                    <div class="details-website">
                                                                                                        <img class="img-fluid" src="<?= get_favicon($bookmarks['url_search'])  ?>" alt="" >
                                                                                                        <div class="favourite-icon favourite_0"><a href="php/favo_bookmark.php?num=<?= $bookmarks['id'] ?>&favo=<?= $bookmarks['favorite_search'] ?>"><i style="color: <?php if ($bookmarks['favorite_search'] !== "no") {echo "yellow";} ?>;" class="fa fa-star"></i></a></div>
                                                                                                        <div class="desciption-data">
                                                                                                            <div class="title-bookmark" >
                                                                                                                <div class="pull-right text-end">
                                                                                                                    <a href="#" title="<?= $bookmarks['etiquette_search'] ?>"><i class="bx bxs-purchase-tag" style="font-size: 1.2rem; margin: 3px; color:<?= $ma ?>;"></i></a>
                                                                                                                </div>
                                                                                                                <a href="https:/<?=$bookmarks['url_search']?>"><h5 class="title_0" ><?= $bookmarks['name_search'] ?></h5></a>
                                                                                                                <p class="weburl_0"><?= substr($bookmarks['url_search'], 0, 20) ?>...</p>

                                                                                                                <div class="content-general">
                                                                                                                    <p class="desc_0"><?= $bookmarks['description_search'] ?></p>
                                                                                                                    <span class="collection_0"></span><!--<.?= $bookmarks['etiquette_search'] ?>-->
                                                                                                                </div>
                                                                                                                <div class="hover-block">
                                                                                                                    <ul  style="color:blue;">
                                                                                                                        <li style="display:inline-block;vertical-align: top;width: 20%;float: left;"><a href="#"><i data-feather="link"></i></a></li>
                                                                                                                        <li style="display:inline-block;vertical-align: top;width: 20%;float: left;"><a href="#"><i data-feather="share-2"></i></a></li>
                                                                                                                        <li style="display:inline-block;vertical-align: top;width: 20%;float: left;"><a href="php/delete_bookmark.php?num=<?= $bookmarks['id'] ?>"><i data-feather="trash-2"></i></a></li>

                                                                                                                    </ul>
                                                                                                                </div>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </a>
                                                                                        </div>
                                                                                    <?php endforeach; ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="tab-pane" id="partages-fill" role="tabpanel" aria-labelledby="partages-tab-fill"
                                                                         aria-expanded="false">
                                                                        <p>
                                                                            partages
                                                                        </p>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                            </section>
                                            <!-- Filled Pills End -->











                           <!-- <nav>
                                hhhhhhhhhhhhhhhhhhhh
                                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home" aria-selected="true">Home</button>
                                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Profile</button>
                                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</button>
                                </div>
                            </nav>
                            <div class="tab-content" id="nav-tabContent">
                                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">...</div>
                                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">...</div>
                                <div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">...</div>
                            </div> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>





<!-- latest jquery-->
<script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
<!-- Bootstrap js-->
<script src="../../../cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
<!-- feather icon js-->
<script src="../../../cuba/assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../../../cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
<!-- scrollbar js-->
<script src="../../../cuba/assets/js/scrollbar/simplebar.js"></script>
<script src="../../../cuba/assets/js/scrollbar/custom.js"></script>
<!--Sidebar jquery-->
<script src="../../../cuba/assets/js/config.js"></script>
<!-- Plugins JS start-->
<script src="../../../cuba/assets/js/sidebar-menu.js"></script>
<script src="../../../cuba/assets/js/bookmark/jquery.validate.min.js"></script>
<script src="../../../cuba/assets/js/bookmark/custom.js"></script>
<script src="../../../cuba/assets/js/select2/select2.full.min.js"></script>
<script src="../../../cuba/assets/js/select2/select2-custom.js"></script>
<script src="../../../cuba/assets/js/form-validation-custom.js"></script>
<script src="../../../cuba/assets/js/tooltip-init.js"></script>
<!-- Plugins JS Ends-->


<!--- new -->
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
<script src="../../../app-assets/js/scripts/pages/page-knowledge-base.js"></script>
<!-- END: Page JS-->
<!-- TIMEOUT -->
<?php include('timeout.php'); ?>

</body>
</html>
