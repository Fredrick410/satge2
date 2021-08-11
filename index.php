<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus est une application dans le domaine de la gestion d'entreprise et la comptabilité connectée">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Connexion</title>
    <link rel="shortcut icon" type="image/x-icon" href="app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/vendors/css/vendors.min.czzss">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-auth-image blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start --> 
                <section id="auth-login" class="flexbox-container row">
                    <div class="col-10">
                        <div class="">
                            <div class="row m-0"> 
                                <div class="col-1 "></div>
                                <!-- left section-login -->
                                <div class="col-12 col-md-5 px-0">
                                    <div class=" mb-0 p-2 h-100">
                                        <div class=" pb-3">
                                            <a href="html/ltr/coqpix/backend/auth-login-admin.php">
                                                <img class="logocoq" src="app-assets/images/logo/logo_connexion.png" />
                                            </a>
                                        </div>
                                        <?php if(isset($_GET["error"])) {
                                            if ($_GET["error"] == 0) { ?>
                                                <div class="text-danger mb-2">Cette combinaison email/mot de passe n'existe pas</div>
                                        <?php } } ?>
                                        <div class="">
                                            <div class="">
                                                
                                                <form action="html/ltr/coqpix/php/verif.php" method="GET">
                                                    <div class="form-group mb-3">
                                                        <label class="h3" for="exampleInputEmail1" ><div class="text-purple">E-Mail :</div></label>
                                                        <input name="emailentreprise" type="email" class="form-control form-control-purple text-purple rounded-pill" id="exampleInputEmail1" placeholder="Adresse email"  required></div>
                                                    <div class="form-group mb-1">
                                                        <label class="h3" for="exampleInputPassword1"><div class="text-purple">Mot de passe :</div></label>
                                                        <input name="passwordentreprise" type="password" class="form-control form-control-purple rounded-pill" id="exampleInputPassword1" placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center mb-3">
                                                        <div class="text-left">
                                                            <div class="checkbox checkbox-purple">
                                                                <input name="checkbox" type="checkbox" class="form-check-input" id="exampleCheck1">
                                                                <label class="text-purple" for="exampleCheck1">Rester connecté</label>
                                                            </div>
                                                        </div>
                                                        <!-- MOT DE PASSE OUBLIER -->
                                                        <div class="text-right"><a href="html/ltr/coqpix/reset-password.php" class="card-link text-purple text-decoration-underline">Mot de passe oublié</a></div>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-2"></div>
                                                        <input type="submit" value="Se connecter" class="btn rounded-pill btn-purple glow col-8 position-relative">
                                                    </div>
                                                </form>
                                                <form action="html/ltr/coqpix/creation-societe.php">
                                                    <div class="row">
                                                        <div class="col-2"></div>
                                                        <input type="submit" class="btn rounded-pill btn-purple col-8 mt-2 font-weight-bold" value="S'inscrire">
                                                    </div> 
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6"></div>
                                <!-- right section image
                                <div class="col-md-6 d-md-block d-none p-3 text-center"><style>.all{width:100%; height: 100%;}</style>
                                    <a href="html/ltr/coqpix/backend/auth-login-admin.html"><img class="img-fluid" src="app-assets/images/pages/login.png" alt="branding logo"></a>
                                </div> -->
                            </div>
                        </div>
                        <!-- livicon pour hrref admin connexion A FAIRE -->
                        <!-- <div class="form-group border">
                            <a href="html/ltr/coqpix/backend/auth-login-admin.php"><div class="livicon-evo pull-right " data-options=" name: desktop.svg; size: 30px "></div></a>
                        </div> -->
                    </div>
                    <div class="col-2 d-flex h-100 align-items-start"> 
                        <button type="button" class="mt-5 btn rounded-pill btn-outline-purple">BY AA+</button> 
                    </div> 
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="app-assets/vendors/js/vendors.min.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="app-assets/js/core/app-menu.js"></script>
    <script src="app-assets/js/core/app.js"></script>
    <script src="app-assets/js/scripts/components.js"></script>
    <script src="app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->
    
    
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

</body>
<!-- END: Body-->

</html>