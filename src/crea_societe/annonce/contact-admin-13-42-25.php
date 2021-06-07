<?php 
session_start();
require_once ('../php/config.php');

    $pdoSta = $bdd->prepare('SELECT * FROM contact WHERE id = :num');
    $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute(); 
    $contact = $pdoSta->fetch();

    if($contact['statut'] == "atraiter"){
        $color = "#FA0202";
        $text_statut = "A TRAITER";
    }

    if($contact['statut'] == "encours"){
      $color = "#F3BA23";
      $text_statut = "EN COURS";
    }
                        
    if($contact['statut'] == "terminee"){
        $color = "#38E91C";
        $text_statut = "TERMINEE";
    }

?>
<!DOCTYPE html>
<html dir="ltr" lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords"
        content="wrappixel, admin dashboard, html css dashboard, web dashboard, bootstrap 4 admin, bootstrap 4, css3 dashboard, bootstrap 4 dashboard, Ample lite admin bootstrap 4 dashboard, frontend, responsive bootstrap 4 admin template, Ample admin lite dashboard bootstrap 4 dashboard template">
    <meta name="description"
        content="Ample Admin Lite is powerful and clean admin dashboard template, inpired from Bootstrap Framework">
    <meta name="robots" content="noindex,nofollow">
    <title>White Island | Contact Admin</title>
    <link rel="canonical" href="https://www.wrappixel.com/templates/ample-admin-lite/" />
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="plugins/images/favicon.png">
    <!-- Custom CSS -->
   <link href="css/style.min.css" rel="stylesheet">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>

<body>
<style>
    .none-validation{display: none;}
    .pointer{cursor: pointer;}
    .vertical { 
        border-left: 5px solid <?= $color ?>; 
        height: 88px; 
        margin: 0px;
        padding: 0px;
        } 
</style>
    <!-- ============================================================== -->
    <!-- Preloader - style you can find in spinners.css -->
    <!-- ============================================================== -->
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Main wrapper - style you can find in pages.scss -->
    <!-- ============================================================== -->
    <div id="main-wrapper" data-layout="vertical" data-navbarbg="skin5" data-sidebartype="full"
        data-sidebar-position="absolute" data-header-position="absolute" data-boxed-layout="full">
        <!-- ============================================================== -->
        <!-- Topbar header - style you can find in pages.scss -->
        <!-- ============================================================== -->
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin6">
                    <!-- ============================================================== -->
                    <!-- Logo -->
                    <!-- ============================================================== -->
                    <a class="navbar-brand" href="dashboard.php">
                        <!-- Logo icon -->
                        <b class="logo-icon">
                            <!-- Dark Logo icon -->
                            <img src="plugins/images/logo-icon.png" alt="homepage" />
                        </b>
                        <!--End Logo icon -->
                        <!-- Logo text -->
                        <span class="logo-text">
                            <!-- dark Logo text -->
                            <img src="plugins/images/logo-text.png" alt="homepage" />
                        </span>
                    </a>
                    <!-- ============================================================== -->
                    <!-- End Logo -->
                    <!-- ============================================================== -->
                    <!-- ============================================================== -->
                    <!-- toggle and nav items -->
                    <!-- ============================================================== -->
                    <a class="nav-toggler waves-effect waves-light text-dark d-block d-md-none"
                        href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                </div>
                <!-- ============================================================== -->
                <!-- End Logo -->
                <!-- ============================================================== -->
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                    <ul class="navbar-nav d-none d-md-block d-lg-none">
                        <li class="nav-item">
                            <a class="nav-toggler nav-link waves-effect waves-light text-white"
                                href="javascript:void(0)"><i class="ti-menu ti-close"></i></a>
                        </li>
                    </ul>
                    <!-- ============================================================== -->
                    <!-- Right side toggle and nav items -->
                    <!-- ============================================================== -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">

                        <!-- ============================================================== -->
                        <!-- Search -->
                        <!-- ============================================================== -->
                        <li class=" in">
                            <form role="search" class="app-search d-none d-md-block mr-3">
                                <input type="text" placeholder="Search..." class="form-control mt-0">
                                <a href="" class="active">
                                    <i class="fa fa-search"></i>
                                </a>
                            </form>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                        <li>
                            <a class="profile-pic" href="#">
                                <img src="plugins/images/users/varun.jpg" alt="user-img" width="36"
                                    class="img-circle"><span class="text-white font-medium">Steave</span></a>
                        </li>
                        <!-- ============================================================== -->
                        <!-- User profile and search -->
                        <!-- ============================================================== -->
                    </ul>
                </div>
            </nav>
        </header>
        <!-- ============================================================== -->
        <!-- End Topbar header -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <aside class="left-sidebar" data-sidebarbg="skin6">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <!-- User Profile-->
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="dashboard.php" aria-expanded="false"><i class="fas fa-clock fa-fw"
                                    aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="profile.php" aria-expanded="false">
                                <i class="fa fa-user" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                        </li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="contact.php" aria-expanded="false"><i class="fa fa-table"
                                    aria-hidden="true"></i><span class="hide-menu">Contact</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="news-admin.php" aria-expanded="false"><i class="fa fa-font"
                                    aria-hidden="true"></i><span class="hide-menu">News</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="rules-admin.php" aria-expanded="false"><i class="fa fa-globe"
                                    aria-hidden="true"></i><span class="hide-menu">Rules</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="shop-admin.php" aria-expanded="false"><i class="fa fa-columns"
                                    aria-hidden="true"></i><span class="hide-menu">Boutique</span></a></li>
                        <li class="sidebar-item"> <a class="sidebar-link waves-effect waves-dark sidebar-link"
                                href="404.html" aria-expanded="false"><i class="fa fa-info-circle"
                                    aria-hidden="true"></i><span class="hide-menu">404</span></a></li>
                        </li>
                    </ul>

                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>
        <!-- ============================================================== -->
        <!-- End Left Sidebar - style you can find in sidebar.scss  -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Page wrapper  -->
        <!-- ============================================================== -->
        <div class="page-wrapper" style="min-height: 250px;">
            <!-- ============================================================== -->
            <!-- Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <div class="page-breadcrumb bg-white">
                <div class="row align-items-center">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title text-uppercase font-medium font-14">Help - Ticket N°<?= $contact['id'] ?> - <label style="color: <?= $color; ?>;"><?= $text_statut ?> <?php if($contact['other'] == "important"){echo "⚠️";} ?></label></h4>
                    </div>
                    <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                        <div class="d-md-flex">
                            <ol class="breadcrumb ml-auto">
                                <li><a href="#">Dashboard</a></li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- ============================================================== -->
            <!-- End Bread crumb and right sidebar toggle -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Container fluid  -->
            <!-- ============================================================== -->
            <div class="container-fluid">
                <!-- ============================================================== -->
                <!-- Start Page Content -->
                <!-- ============================================================== -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="vertical">                        
                        <div class="white-box Larger shadow">
                        <h3 class="box-title"> Contact - Pseudo</h3>
                        </div></div>
                        <br>
                        <div class="white-box Larger shadow"><center><b><p style="font-size: 20px;">Informations :</p></b></center> <br><hr>Name :<br><hr>Subject :<br><hr>Email :<br><hr>Message :<br><br><br><br></div>
                        <div class="container">
                            <div class="row Larger shadow">
                                <div class="col-3 border bg-basic"><p><center><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAABP0lEQVRIS+WVwU3DUAyGfysSV7oBMAEdoUwATEDZIKiulHIhvdAn1RHZAJgANoAN6AjpBuGGVIHRk5IqRKTKS5pyIKcXKf4//46fTej4oY71sVtAwDyA6j2IDhs5U01AdGlEXvP4Hw4C5gTAQSPxPEg1MVF0VAXQVuJZsBFZJ1528L8A7wDszzwtl3UrJSLV81kUPQfMIYCbIqQ1gICrmUgc+n7vw/Peym3tCpgC8AHsZ1k+GpGhPQfMCwDHbUo0NSLh9Xjc/1K19U6MSD8TfwBw8Vtb13agQOoRndzO5wsL2VutkjCO0wmzr8Bd1Z2pDbACRYh9n4xGZ0r0tOlCOgGKEHv+VH0hoLdVQA4h1bTOIHR24Dqf/hSQFvrdNfH8+6URWe+T8jQdALD93XQnLAEMKxdO05Q3xe12J3fh4Bvs1JgZqav3fgAAAABJRU5ErkJggg=="/></centerW</p></div>
                                <div class="col-3 border bg-basic"><p><center><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAAsUlEQVRIS2NkoDFgpLH5DAQtqCgtTWD4/38+VocwMiZ2dHcvwOdIvBZUlZYa/Pv//zw+A5gYGQ3bursv4FKDYkFFScl/agRZR08P3Fz6WkAN16ObgTUOyA0q5KCBWTQCLIB5Gz3YsImTFUSjFhBMRaNBNAKCiJQCkJSM9oGBgYGfFMMZGBgedvT0KBBbmjowMDCAqkJ5Ii15yMDAkNDR03OAKAuINJQoZQQrfaJMwaMIAKetnhnZcBk+AAAAAElFTkSuQmCC"/><center></p></div>
                                <div class="col-3 border bg-basic"><p><center><img class="pointer" onclick="addreponse()" id="add" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA60lEQVRIS2NkoDFgpLH5DHALKkpKGhgYGOrJtLCxo6cHpB8DIFvwn0zDwdo6enqwhsaoBfBQHT5BVFFSAkos8FRF9UiGWgBPVaMWYKQiWgURPFJJsWAhx58/BQ0TJnwgtgipqKhQYPjz5z5y0YEtkj8yMDIWdHR3LyDWYJA6qOHzGRgYHPBZcJGJkTGhrbv7AsxwmJdJsQyXBQuwBQm5xTis6KC4wmkoKBD4wcIygYGBIR7Zl1SzAB6UpaUJDP//gyzixxpEpIYxNvVVpaUG//7/ByUOfar7AGYhLMg6enoSQGIUxwEhn9PcAgChsZEZolrY1AAAAABJRU5ErkJggg=="/><img onclick="leavereponse()" id="leave" class="pointer none-validation" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAB4AAAAeCAYAAAA7MK6iAAAApklEQVRIie3W0Q3CIBSF4X8ERukmZRQ3kE3KJrpJu8nxRRKS0ooKqJWbnOePQyAAfaIRGMEoOD+ZUWBeBSeB3syUvQDBIJgLoCGzYMhpWhKN8e3mAl8BDfF7bWuhIevWAtsAtinYNYBdh78avmamLJy6gqk5Diy4ZOY4h6vDPwV/7JFIPou1Yb9CG8BLsm1leNHeZ09wqrG9m00j2NxxVyD2Ifh3cwOl1ZrZTdNViwAAAABJRU5ErkJggg=="/></center></p></div>
                                <div class="col-3 border bg-basic"><p><center><img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAYAAADgdz34AAAA70lEQVRIS+2VzQnCQBCF34AF2IFJBWoHacUKvOxhj3obYQJ2YCuWECswJVhAYCSBQAj7F2ERwT3PzvfmMT+EzI8y50cQYI2poHoDUeEUotqC6MAid5/QGKAFsAlWqdpyXZefAjTFQhbxCo1VkBcwqrfGOEEh5ePfpC76A6KNktUia22Brns6VaxWJTP3s+J9sTY9KXAkYO3KoMCLgCuLnBcPmjWmAbCN+gdAgeYisnfFeivw+e4D+mbiq4BkiwA8WGS3yCJX8GhbyopYtCrmO+mnAcPlYpEqpX37mKRtOrFoSBw6kXPwIkCq6mlcdsAbVk5jGfwJyVcAAAAASUVORK5CYII="/></center></p></div>
                            </div>
                       </div>
                       <br>
                       <form id="formulaire" class ="white-box none-validation" action="php/insert-response-admin">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="inputPseudo">Pseudo</label>
                            <input type="email" class="form-control" name="pseudo" id="inputPseudo" placeholder="Votre pseudo" value="Benzer" readonly required>
                            </div>
                            <div class="form-group col-md-6">
                            <label for="inputGrade">Grade</label>
                            <input type="text" class="form-control" name="grade" id="inputGrade" placeholder="Votre grade" value="Gérant-Staff" readonly required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="inputReponse">Réponse</label>
                            <input type="text" class="form-control" name="reponse" id="inputReponse" placeholder="Votre réponse" required>
                        </div>
                        <div class="form-group">
                            <label for="inputDiscord">Discord</label>
                            <input type="text" class="form-control" name="discord" id="inputDiscord" placeholder="Votre discord" required> 
                        </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                            <input onclick="verif()" class="form-check-input" type="checkbox" id="chk">
                                J'approuve ma réponse
                            </label>
                            </div>
                        </div>
                        <button id="bt_val" type="submit" class="btn btn-primary none-validation">Envoyer</button>
                        </form>
                    </div>
                </div>
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
            <!-- ============================================================== -->
            <!-- End Container fluid  -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <!-- <footer class="footer text-center"> 2020 © Ample Admin brought to you by <a
                    href="https://www.wrappixel.com/">wrappixel.com</a>
            </footer> -->
            <!-- ============================================================== -->
            <!-- End footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- End Page wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="plugins/bower_components/popper.js/dist/umd/popper.min.js"></script>
    <script src="bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="js/app-style-switcher.js"></script>
    <!--Wave Effects -->
    <script src="js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="js/sidebarmenu.js"></script>
    <!--Custom JavaScript -->
    <script src="js/custom.js"></script>


    <script>
        function addreponse(){

            document.getElementById("formulaire").style.display = "block";
            document.getElementById("leave").style.display = "block";
            document.getElementById("add").style.display = "none";


        }

        function leavereponse(){

            document.getElementById("formulaire").style.display = "none";
            document.getElementById("leave").style.display = "none";
            document.getElementById("add").style.display = "block";


        }

        function verif(){

            var inp = document.getElementById("bt_val");

            if (chk.checked == 1){
                document.getElementById("bt_val").style.display = "block";
                inp.disabled = false;
            }else{
                document.getElementById("bt_val").style.display = "none";
                inp.disabled = true;
            }
        }
    </script>
</body>

</html>