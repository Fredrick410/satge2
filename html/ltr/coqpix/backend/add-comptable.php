<?php

session_start();

if(!empty($_SESSION['id_admin']))
{
   //l'utilisateur est connecté
}
else
{  
   sleep(2);
   header('Location: auth-login-admin.php');
   exit;
}

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Ajouter comptable</title>
    <link rel="apple-touch-icon" href="../../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../../app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- reset password start -->
                <section class="row flexbox-container">
                    <div class="col-xl-7 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right d-flex justify-content-center mb-0 p-2 h-100">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Un nouveau comptable !!! Youpiiii</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form class="mb-2" method="POST" action="../php/insert_comptable.php">
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Nom : </label>
                                                        <input name="nom" type="text" class="form-control" id="exampleInputPassword1" placeholder="Nom du comptable" required></div>
                                                        <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Prénom : </label>
                                                        <input name="prenom" type="text" class="form-control" id="exampleInputPassword1" placeholder="Prénom du comptable" required></div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">E-mail(Identifiant de connexion) : </label>
                                                        <input name="email" type="email" class="form-control" id="exampleInputPassword1" placeholder="E-mail" required></div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600" for="exampleInputPassword2">Mot de passe (Mot de passe de connexion) :</label>
                                                        <input name="password" type="password" class="form-control" id="exampleInputPassword2" placeholder="Mot de passe"></div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100">Ajouter le comptable<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- right section image -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="../../../../app-assets/images/pages/reset-password.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- reset password ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="../../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../../app-assets/js/core/app.js"></script>
    <script src="../../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>