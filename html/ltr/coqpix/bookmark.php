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

  <style>
    .page-body {
      background-color: #f8f8f8;
      margin-left: 0px;
    }

    .icon_trash {
      position: relative;
      
      left: 92%;
      font-size: 15px;
      color: red;
      display: none;
    }

    .icon_edit {
      position: relative;
      
      left: 70%;
      font-size: 15px;
      color: blue;
      display: none;
    }
    
    .icon_trash:hover {
      opacity: 0.5;
    }

    .trash_etiq:hover .icon_trash {
      display: inline;
    }

    .navbar-nav {
      align-items: center;
      border: 1px;
      padding-left: 20px;

      border-radius: 90% /3%;
    }

    .media {
      padding-top: 50px;
    }

    .bookmark-tabcontent .details-bookmark.list-bookmark .bookmark-card img {
      width: 80px;
    }

    .bookmark-tabcontent .details-bookmark .bookmark-card img {
      width: 80px;
    }
  </style>

  <div class="app-content content" style="margin-top: 50px;">
    <!-- Page Body Start-->
    <div class="page-body-wrapper" style="">
      <div class="page-body" style="margin-top: 30px">
        <!-- Container-fluid starts-->
        <div class="container-fluid">
          <div class="email-wrap bookmark-wrap">
            <div class="row">
              <!-- partie gauche-->
              <div class="col-sm-4 box-col-6">
                <div class="email-left-aside">
                  <div class="card text-center">
                    <div class="card-body">
                      <div class="container-fluid navbar-header">
                        <ul class="nav navbar-nav flex-row">
                          <li class="nav-item mx-auto modern-nav-toggle">
                            <a href="dashboard-analytics.php"><img class="logocoq" src="../../../app-assets/images/logo/coqpix2.png" /></a>
                          </li>
                        </ul>
                      </div>
                      <!--<div class="email-app-sidebar left-bookmark">-->
                      <div class="left-bookmark">
                        <br><br>
                        <div>
                          <div class="mx-auto">
                            <img class="w-30 rounded-circle" src="../../../cuba/assets/images/user/user.png" alt="">
                          </div>
                          <div class="mx-auto">
                            <h6 class="f-w-600"><?= $entreprise['nameentreprise'] ?></h6>
                            <p><?= $entreprise['emailentreprise'] ?></p>
                          </div>
                        </div>
                        <br>
                        <button type="button" class="btn btn-primary w-70" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="me-8" data-feather="bookmark"></i>Ajouter une recherche</button>
                        <br><br>
                        <ul class="nav flex-column text-left">
                          <li class="nav-item">
                            <br>
                            <div class="modal fade modal-bookmark" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                              <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                  <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Ajouter une recherche</h5>
                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                                  </div>
                                  <div class="modal-body">
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
                                    </form>
                                  </div>
                                  <!--end popup-->

                                </div>
                              </div>
                            </div>
                          </li>
                          <li class="nav-item"><span class="main-title text-dark font-weight-bolder"> Tous</span></li>
                          <br>
                          <li><a class="show" id="pills-list-tab" data-bs-toggle="pill" href="#pills-list" role="tab" aria-controls="pills-list" aria-selected="false"><span class="title text-dark">Ma liste de lecture</span></a></li>
                          <li><a id="pills-created-tab" data-bs-toggle="pill" href="#pills-created" role="tab" aria-controls="pills-created" aria-selected="true"><span class="title text-dark"> Mes recherches</span></a></li>
                          <li><a class="show" id="pills-favourites-tab" data-bs-toggle="pill" href="#pills-favourites" role="tab" aria-controls="pills-favourites" aria-selected="false"><span class="title text-dark"> Mes favoris</span></a></li>
                          <li><a class="show" id="pills-shared-tab" data-bs-toggle="pill" href="#pills-shared" role="tab" aria-controls="pills-shared" aria-selected="false"><span class="title text-dark"> Partagé avec moi<span class="badge badge-light-primary badge-pill badge-round">SOON</span></span></a></li>
                          <br><br>
                          <li><span class="text-dark font-weight-bolder">Theme de recherche</span><span class="pull-right"><a class="text-dark" href="#" data-bs-toggle="modal" data-bs-target="#createtag"><i data-feather="plus-circle"></i></a></span></span></li>
                          <br>
                          <?php foreach ($etiq as $etiquette) : ?>
                            <ul class="mx-3">  
                              <li class="navbar-expand" style="list-style: disc; color: <?= $etiquette['color_etiq']; ?>;">
                              <a href="">
                                <label class="title text-dark pull-left" style="font-size: 16px"> <?= $etiquette['name_etiq']?><?= $etiquette['id']?></label> 
                                  <a href="php/delete_etiq_bookmark.php?num=<?= $etiquette['id']?>" class="fa fa-trash pull-right" style ="display:inline; justify-content: space-between; color: red;"></a>
                                  <a href="etiquette_edit_book.php?num=<?= $etiquette['id'] ?>" class="fa fa-edit pull-right" style ="display:inline; justify-content: space-between; color: blue;" ></a>
                                  <a class="show trash_etiq" data-bs-toggle="pill" role="tab" aria-selected="false"></a>
                              </a>
                              </li>
                            </ul>
                          <?php endforeach; ?>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <!--card-right-->
              <div class="col-md-8 box-col-8">
                <div class="email-right-aside bookmark-tabcontent">
                  <div class="card email-body radius-left">
                    <div class="ps-0">
                      <div class="tab-content">

                        <!--Ma liste de lecture-->
                        <div class="fade tab-pane" id="pills-list" role="tabpanel" aria-labelledby="pills-list-tab">
                          <div class="card mb-0">
                            <div class="card-header d-flex">
                              <h6 class="mb-0">Ma liste de lecture(SOON)</h6>
                              <ul>
                                <li><a class="grid-bookmark-view" href="#"><i data-feather="grid"></i></a></li>
                                <li><a class="list-layout-view" href="#"><i data-feather="list"></i></a></li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="details-bookmark text-center"><span>No Bookmarks Found.</span></div>
                            </div>
                          </div>
                        </div>

                        <!-- Mes recherches -->
                        <div class="tab-pane fade active show" id="pills-created" role="tabpanel" aria-labelledby="pills-created-tab">
                          <div class="card">
                            <div class="card-header d-flex">
                              <h6>Mes recherches</h6>
                              <ul>
                                <li><a class="grid-bookmark-view" href="#"><i data-feather="grid"></i></a></li>
                                <li><a class="list-layout-view" href="#"><i data-feather="list"></i></a></li>
                              </ul>
                            </div>
                            <div class="card-body pb-0">
                              <div class="details-bookmark">
                                <div class="row" id="bookmarkData">
                                  <?php foreach ($bookmark as $bookmarks) : $ma = $bookmarks['etiquette_search']?>
                                    <div class="col-xl-3 col-md-4 xl-50">
                                      <a href="<?= $bookmarks['url_search'] ?>"><div class="card card-with-border bookmark-card o-hidden">
                                        <div class="details-website">
                                          <img class="img-fluid" src="<?= get_favicon($bookmarks['url_search'])  ?>" alt="" >
                                          <div class="favourite-icon favourite_0"><a href="php/favo_bookmark.php?num=<?= $bookmarks['id'] ?>&favo=<?= $bookmarks['favorite_search'] ?>"><i style="color: <?php if ($bookmarks['favorite_search'] !== "no") {echo "yellow";} ?>;" class="fa fa-star"></i></a></div>
                                          <div class="desciption-data">
                                            <div class="title-bookmark" >
                                              <h6 class="title_0"><?= $bookmarks['name_search'] ?></h6>
                                              <p class="weburl_0"><?= substr($bookmarks['url_search'], 0, 30) ?></p>
                                              <div class="">
                                                <!--<p class="collection_0 text-dark"><.?= $bookmarks['etiquette_search'] ?></p>-->
                                                <p class="text-dark desc_0"><?= $bookmarks['description_search'] ?></p>
                                              </div>
                                              <div class="content-general">
                                                <p class="desc_0"><?= $bookmarks['description_search'] ?></p>
                                                <span class="collection_0"></span><!--<.?= $bookmarks['etiquette_search'] ?>-->
                                              </div>
                                              <div class="hover-block">
                                                <ul  style="color:blue;">
                                                  <li><a href="#"><i data-feather="link"></i></a></li>
                                                  <li><a href="#"><i data-feather="share-2"></i></a></li>
                                                  <li><a href="php/delete_bookmark.php?num=<?= $bookmarks['id'] ?>"><i data-feather="trash-2"></i></a></li>
                                                  <li  class="pull-right text-end"><a href="#" title="<?= $bookmarks['etiquette_search'] ?>"><i class="bx bxs-purchase-tag" style="font-size: 1.2rem; margin: 3px; color:<?= $ma ?>;"></i></a></li>
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
                        </div>

                        <!--Mes favoris-->
                        <div class="fade tab-pane" id="pills-favourites" role="tabpanel" aria-labelledby="pills-favourites-tab">
                          <div class="card mb-0">
                            <div class="card-header d-flex">
                              <h6 class="mb-0">Mes favoris</h6>
                              <ul>
                                <li><a class="grid-bookmark-view" href="#"><i data-feather="grid"></i></a></li>
                                <li><a class="list-layout-view" href="#"><i data-feather="list"></i></a></li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="details-bookmark">
                                <div class="row" id="favouriteData">
                                  <?php foreach ($bookmark_favo as $bookmarks_favo) : $ma = $bookmarks_favo['etiquette_search'] ?>
                                    <div class="col-xl-3 col-md-4 xl-50">
                                      <div class="card card-with-border bookmark-card o-hidden">
                                        <div class="details-website">
                                          <img class="img-fluid" src="<?= get_favicon($bookmarks_favo['url_search'])  ?>" alt="" height="80" width="80">
                                          <div class="favourite-icon favourite_0"><a href="php/favo_bookmark.php?num=<?= $bookmarks_favo['id'] ?>&favo=<?= $bookmarks_favo['favorite_search'] ?>"><i style="color: <?php if ($bookmarks_favo['favorite_search'] !== "no") {
                                                                                                                                                                                                                  } ?>;" class="fa fa-star"></i></a></div>
                                          <div class="desciption-data">
                                            <div class="title-bookmark">
                                              <h6  class="title_0"><?= $bookmarks_favo['name_search'] ?></h6>
                                              <p class="weburl_0"><?= substr($bookmarks_favo['url_search'], 0, 30) ?>...</p>
                                              <div class="hover-block">
                                                <ul>
                                                  <li><a href="#"><i data-feather="link"></i></a></li>
                                                  <li><a href="#"><i data-feather="share-2"></i></a></li>
                                                  <li><a href="php/delete_bookmark.php?num=<?= $bookmarks_favo['id'] ?>"><i data-feather="trash-2"></i></a></li>
                                                  <li  class="pull-right text-end"><a href="#" title="<?= $bookmarks['etiquette_search'] ?>"><i class="bx bxs-purchase-tag" style="font-size: 1.2rem; margin: 3px; color: <?= $ma ?>;"></i></a></li>
                                                </ul>
                                              </div>
                                              <div class="content-general">
                                                <p class="desc_0"><?= $bookmarks_favo['description_search'] ?></p><span class="collection_0"><?= $bookmarks_favo['etiquette_search'] ?></span>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                    </div>
                                  <?php endforeach; ?>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>

                        <!--partager avec moi-->
                        <div class="fade tab-pane" id="pills-shared" role="tabpanel" aria-labelledby="pills-shared-tab">
                          <div class="card mb-0">
                            <div class="card-header d-flex">
                              <h6 class="mb-0">Partagé Avec Moi (SOON)</h6>
                              <ul>
                                <li><a class="grid-bookmark-view" href="#"><i data-feather="grid"></i></a></li>
                                <li><a class="list-layout-view" href="#"><i data-feather="list"></i></a></li>
                              </ul>
                            </div>
                            <div class="card-body">
                              <div class="details-bookmark text-center"><span>No Bookmarks Found.</span></div>
                            </div>
                          </div>
                        </div>
                        <?php foreach ($etiq as $etiquette) : ?>
                          <div class="fade tab-pane" id="pills-notification" role="tabpanel" aria-labelledby="pills-notification-tab">
                            <div class="card mb-0">
                              <div class="card-header d-flex">
                                <h6 class="mb-0"><?= $etiquette['name_etiq'] ?></h6>
                                <ul>
                                  <li><a class="grid-bookmark-view" href="#"><i data-feather="grid"></i></a></li>
                                  <li><a class="list-layout-view" href="#"><i data-feather="list"></i></a></li>
                                </ul>
                              </div>
                              <div class="card-body">
                                <div class="details-bookmark text-center"><span>No Bookmarks Found.</span></div>
                              </div>
                            </div>
                          </div>
                        <?php endforeach; ?>

                        <!--popup theme de recherche-->
                        <div class="modal fade modal-bookmark" id="createtag" tabindex="-1" role="dialog" aria-hidden="true">
                          <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title">Créer un theme de recherche</h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
                              </div>
                              <div class="modal-body">
                                <form action="php/insert_bookmark_etiq.php" method="POST" class="form-bookmark needs-validation">
                                  <div class="row g-2">
                                    <div class="mb-3 mt-0 col-md-12">
                                      <label>Nom du theme</label>
                                      <input class="form-control" type="text" name="name_etiq" required autocomplete="off">
                                    </div>
                                    <div class="mb-3 mt-0 col-md-12">
                                      <label>Couleur du theme</label>
                                      <input class="form-color d-block" type="color" name="color_etiq" value="#337aff">
                                    </div>
                                  </div>
                                  <button class="btn btn-secondary" type="submit">Sauvegarder</button>
                                  <button class="btn btn-primary" type="button" data-bs-dismiss="modal">Annuler</button>
                                </form>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!--end popup theme de recherche -->

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- Container-fluid Ends-->
      </div>
      <!-- footer start-->
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