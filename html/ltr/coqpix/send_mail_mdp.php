<?php
require_once 'php/config.php';
include "php/regex.php";
$pdoSt = $bdd->prepare('SELECT COUNT(*) as nb FROM entreprise WHERE emailentreprise = :mail');
$pdoSt->bindValue(":mail", $_POST['email']);
$pdoSt->execute();
$verif = (($pdoSt->fetch())['nb'] > 0 );


if ($verif){
    
    $key = generate_alpha_key(10);
    send_reset_mail(htmlspecialchars($_POST['mail']), $key);
    $coq_key_reset = crypt($key, "VXoJeYyNzMLya1ODvc3n1cnWJoDjG");
    $insert_key_reset = $bdd->prepare('INSERT INTO reset_key(mail,key_reset) VALUES(?,?)');
    $insert_key_reset->execute((array(htmlspecialchars($_POST['email']), $coq_key_reset)));
    
}

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
                                                <div class="text-center text-bold">
                                                    <?php if ($verif) {
                                                        ?> Mail envoyé ! Pensez a vérifier vos spams 
                                                        <br/> localhost/coqpix/html/ltr/coqpix/forget-password.php?key=<?=$key?><?php
                                                    } else {
                                                        ?> Ce mail ne correpond à aucun compte Coqpix <?php
                                                    } ?>
                                                </div>
                                                <hr>
                                                <div class = "text-center">
                                                    <a href="../../../index.php"><button class="btn btn-primary btn-lg">Retour à l'accueil</button></a>
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