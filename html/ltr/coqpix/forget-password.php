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
if (isset($_POST['passwordentreprise']) && isset($_POST['passwordentreprise2'])) {
    $mdp1 = htmlspecialchars($_POST['passwordentreprise']);
    $mdp2 = htmlspecialchars($_POST['passwordentreprise2']);

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
}

?>
<body
    class="vertical-layout vertical-menu-modern semi-dark-layout 1-column  navbar-sticky footer-static bg-password-image  blank-page blank-page"
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
                        <div class=" bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- left section-login -->
                                <div class="col-12 px-0">
                                    <div
                                        class=" mb-0 p-2 h-100 ">
                                        <div class=" pb-1">
                                                <h2 class="text-center mb-2 text-purple">Changer mon mot de passe</h2>
                                        </div>
                                        <div class=" pb-1">
                                                <h5 class="text-center mb-2 text-purple">Pour changer votre mot de passe veuillez compléter les informations ci-dessous</h5>
                                        </div>
                                                <?php 
                                                    if (isset($_GET['error']) && htmlspecialchars($_GET['error']) == "0") {?>
                                                    <h6 class="text-danger">Les mots de passe ne correspondent pas</h6>
                                                <?php } ?>
                                            <div class="row">
                                                <div class="col-3"></div>
                                                <div class="col-6">
                                                <form action="" method="POST" enctype="multipart/form-data">
                                                    <div class="form-group">
                                                        <label class="text-bold-600 text-purple" for="exampleInputPassword1">Saisissez votre mot de
                                                            passe :</label>
                                                        <input name="passwordentreprise" type="password"
                                                            class="form-control form-control-purple text-purple rounded-pill" id="exampleInputPassword1"
                                                            placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group mb-3">
                                                        <label class="text-bold-600 text-purple" for="exampleInputPassword1">Resaisissez votre mot de
                                                            passe :</label>
                                                        <input name="passwordentreprise2" type="password"
                                                            class="form-control form-control-purple text-purple rounded-pill" id="exampleInputPassword1"
                                                            placeholder="Vérifier mot de passe" required>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-2"></div>
                                                        <input type="submit" value="Enregistrer" class="btn btn rounded-pill btn-purple glow col-8 position-relative">
                                                    </div>
                                                </form>
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