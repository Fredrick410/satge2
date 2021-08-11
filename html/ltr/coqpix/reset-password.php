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

<body class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-password-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- reset pasword page start -->
                <section id="mail-reset" class="row flexbox-container">
                    <div class="col-md-8 col-12">
                        <div class="bg-authentication mb-0">
                            <div class="row m-0">
                                <div class="col-12 px-0">
                                    <div class="mb-0 p-2 h-100">
                                        <div class=" pb-1">
                                                <h2 class="text-center mb-2 text-purple">Récupération mot de passe</h4=2>
                                        </div>
                                                <form action="send_mail_mdp.php" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group mb-3">
                                                        <label class="text-bold-600" for="exampleInputPassword1"><div class=text-purple>Entrer votre e-mail</div></label>
                                                        <input name="email" type="email" class="form-control form-control-purple text-purple rounded-pill" id="exampleEMail" placeholder="exemple@gmail.com" required>
                                                    </div>
                                                    <div class="row mb-1">
                                                        <div class="col-3"></div>
                                                        <input type="submit" value="Envoyer le mail" class="btn btn rounded-pill btn-purple glow col-6 position-relative">
                                                    </div>
                                                </form>
                                                <div class="text-center">
                                                    <h5 class="mt-3 text-purple">Contactez
                                                        contact@auditactionplus.com en cas de probème.</h5>
                                                </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- reset password page ends -->

            </div>
        </div>
    </div>
</body>
<?php include 'includes/menus/footer-front.php'; ?>

</html>