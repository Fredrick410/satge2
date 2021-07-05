<?php
require_once 'php/config.php';
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<?php
$name_page = "Mot de passe oublié";
include 'includes/menus/head-front.php';

$key = htmlspecialchars($_GET['key']);
if (isset($key) && !empty($key)) {
    
    $coq_key_reset = crypt($key, "VXoJeYyNzMLya1ODvc3n1cnWJoDjG");
    $req_key_reset = $bdd->prepare('SELECT mail FROM reset_key WHERE key_reset = ?');
    $req_key_reset->execute(array($coq_key_reset));
    if (!($mail = $req_key_reset->fetch())) {
        header('Location: ../../../index.php');
    }
    
} else {
    header('Location: ../../../index.php');
}

$mdp1 = htmlspecialchars($_POST['passwordentreprise']);
$mdp2 = htmlspecialchars($_POST['passwordentreprise2']);
?><script>alert(<?=$key?>)</script><?php
// ajouter regle mdp !

if ($mdp1 == $mdp2 && $mdp1 != "") {

    $coq_new_mdp_h = crypt($mdp1, "5c725a26307c3b5170634a7e2b");
    $coq_update_mdp = $bdd->prepare('UPDATE entreprise SET passwordentreprise = ? WHERE emailentreprise = ?');
    $coq_update_mdp->execute(array($coq_new_mdp_h, $mail['mail']));

    $coq_delete_key = $bdd->prepare('DELETE FROM reset_key WHERE mail = ?');
    $coq_delete_key->execute(array($mail['mail']));

    header('Location: ../../../');

} else if ($mdp1 != "") {
    header("Location: forget-password.php?key=". $key ."&error=0");
}

?>
<body
    class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page"
    data-open="click" data-menu="vertical-menu-modern" data-col="1-column" data-layout="semi-dark-layout">
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
                                    <div
                                        class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Rénitialiser mot de passe</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <?php if (htmlspecialchars($_GET['error']) == "0") {?>
                                                    <h6 class="text-warning">Les mots de passe ne correspondent pas</h6>
                                                <?php } ?>
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Mot de
                                                            passe :</label>
                                                        <input name="passwordentreprise" type="password"
                                                            class="form-control" id="exampleInputPassword1"
                                                            placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="text-bold-600" for="exampleInputPassword1">Vérifier mot de
                                                            passe :</label>
                                                        <input name="passwordentreprise2" type="password"
                                                            class="form-control" id="exampleInputPassword1"
                                                            placeholder="Vérifier mot de passe" required>
                                                    </div>
                                                    <input type="submit" value="Se connecter"
                                                        class="btn btn-primary glow w-100 position-relative">
                                                </form>
                                                <hr>
                                                <div class="text-center"><small class="mr-25">Contactez
                                                        contact@auditactionplus.com en cas de probème.</small></div>
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