<?php
require_once 'php/config.php';
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<?php
$name_page = "Mot de passe oublié";
include 'includes/menus/head-front.php';
?>

<link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/authentication.css">

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- login page start -->
                <section id="auth-login" class="row flexbox-container">
                    <div class="col-xl-8 col-11">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Récupération mot de passe</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form action="send_mail_mdp.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Entrer votre e-mail</label>
                                                        <input name="email" type="email" class="form-control" id="exampleEMail" placeholder="exemple@gmail.com" required>
                                                    </div>
                                                    <input type="submit" value="Envoyer le mail" class="btn btn-primary glow w-100 position-relative">
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Contactez
                                                        contact@auditactionplus.com en cas de probème.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- login page ends -->

            </div>
        </div>
    </div>
</body>
<?php include 'includes/menus/footer-front.php'; ?>

</html>