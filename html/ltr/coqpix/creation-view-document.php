<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    if($crea['doc_pieceid'] == ""){
        $doc_pieceid = "0";
    }else{
        $doc_pieceid = "1";
    }
    if($crea['doc_cerfaM0'] == ""){
        $doc_cerfaM0 = "0";
    }else{
        $doc_cerfaM0 = "1";
    }
    if($crea['doc_cerfaMBE'] == ""){
        $doc_cerfaMBE = "0";
    }else{
        $doc_cerfaMBE = "1";
    }
    if($crea['doc_justificatifss'] == ""){
        $doc_justificatifss = "0";
    }else{
        $doc_justificatifss = "1";
    }
    if($crea['doc_statuts'] == ""){
        $doc_statuts = "0";
    }else{
        $doc_statuts = "1";
    }
    if($crea['doc_nomination'] == ""){
        $doc_nomination = "0";
    }else{
        $doc_nomination = "1";
    }
    if($crea['doc_pouvoir'] == ""){
        $doc_pouvoir = "0";
    }else{
        $doc_pouvoir = "1";
    }
    if($crea['doc_attestation'] == ""){
        $doc_attestation = "0";
    }else{
        $doc_attestation = "1";
    }
    if($crea['doc_xp'] == ""){
        $doc_xp = "0";
    }else{
        $doc_xp = "1";
    }
    if($crea['doc_peirl'] == ""){
        $doc_peirl = "0";
    }else{
        $doc_peirl = "1";
    }
    if($crea['doc_depot'] == ""){
        $doc_depot = "0";
    }else{
        $doc_depot = "1";
    }
    if($crea['doc_annonce'] == ""){
        $doc_annonce = "0";
    }else{
        $doc_annonce = "1";
    }

    //insertion piece id

    if(!empty($_POST['id_doc'])){

        $num = !empty($_SESSION['id_crea']) ? $_SESSION['id_crea'] : NULL;

    if (is_uploaded_file($_FILES['pieceid']['tmp_name'])) {
    echo "File ". $_FILES['pieceid']['name'] ." téléchargé avec succès.\n";
    $dir = '../../../src/crea_societe/pieceid/';
  
    if(!is_dir($dir)){
        echo " Le répertoire de destination n'existe pas !";
    exit;
    }
  
    $name_files = $_FILES['pieceid']['name'];                         
    $date_now = '-'.date("H-i-s");
    $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
    $target_file = $_FILES['pieceid']['tmp_name'];                                     
    $real_name = substr($name_files, 0, -4);
    $file_name = $dir. $real_name . $date_now . $type_files;

    if($type_files == ".png"){

    if($resultat = move_uploaded_file($target_file, $file_name)){
        $update = $bdd->prepare('UPDATE crea_societe SET doc_pieceid = ? WHERE id = ?');
        $update->execute(array( ($real_name . $date_now . $type_files), $num  ));

        header('Location: creation-view-morale-pieceid.php?upload=1');
        exit();

    }else{
        header('Location: creation-view-morale-pieceid.php?upload=2');
        exit();
    }
}elseif($type_files == ".jpg"){
    if($resultat = move_uploaded_file($target_file, $file_name)){
        $update = $bdd->prepare('UPDATE crea_societe SET doc_pieceid = ? WHERE id = ?');
        $update->execute(array( ($real_name . $date_now . $type_files), $num  ));

        header('Location: creation-view-morale-pieceid.php?upload=1');
        exit();

    }else{
        header('Location: creation-view-morale-pieceid.php?upload=2');
        exit();
    }
}elseif($type_files == ".jpeg"){
    if($resultat = move_uploaded_file($target_file, $file_name)){
        $update = $bdd->prepare('UPDATE crea_societe SET doc_pieceid = ? WHERE id = ?');
        $update->execute(array( ($real_name . $date_now . $type_files), $num  ));

        header('Location: creation-view-morale-pieceid.php?upload=1');
        exit();

    }else{
        header('Location: creation-view-morale-pieceid.php?upload=2');
        exit();
    }
}elseif($type_files == ".pdf"){
    if($resultat = move_uploaded_file($target_file, $file_name)){
        $update = $bdd->prepare('UPDATE crea_societe SET doc_pieceid = ? WHERE id = ?');
        $update->execute(array( ($real_name . $date_now . $type_files), $num  ));

        header('Location: creation-view-morale-pieceid.php?upload=1');
        exit();

    }else{
        header('Location: creation-view-morale-pieceid.php?upload=2');
        exit();
    }
}else{
       header('Location: creation-view-morale-pieceid.php?upload=3');
       exit(); 
}

  
} else {
   echo "Erreur lors de l'upload du fichier : ";
   echo "Nom du fichier : '". $_FILES['pieceid']['tmp_name'] . "'.";
}

    }
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Création de société</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/creation-view-document.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
     
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="app-content content" >
        <div class="content-area-wrapper">
            <div class="sidebar-left" >
                <div class="sidebar" >
                    <div class="sidebar-content email-app-sidebar d-flex bouge" style="width: 360px; background-color: white;">               
                        <div class="email-app-menu">
                            <div class="sidebar-menu-list">
                                <!-- sidebar menu  -->
                                <div class="list-group list-group-messages" id="scroll-doc">
                                    <div class="form-group">
                                        <br>
                                         <div class="livicon-evo" onclick="retourn()" data-options=" name: arrow-left.svg; size: 30px " style="cursor: pointer; display:inline-block; top: 6px;"></div>

                                                <script>
                                                    function retourn() {
                                                        document.location.href="page-creation.php";
                                                    }
                                                </script>
                                        <label class="">Retour à l'accueil</label>
                                    </div>
                                        <div class="form-group">
                                            <label class="">Administration</label>
                                        </div>
                                    <?php
                                            if($doc_pieceid == "1"){ ?>
                                            <a href="creation-view-morale-pieceid.php" id="av" class="list-group-item" >
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-pieceid.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div>
                                                Pièce d'identitée <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_cerfaM0 == "1"){ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-cerfaM0.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa M0 <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_cerfaMBE == "1"){ ?>
                                            <a href="creation-view-morale-cerfaMBE.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-cerfaMBE.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Cerfa MBE <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_justificatifss == "1"){ ?>
                                            <a href="creation-view-morale-justificatifss.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-justificatifss.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Justificatif siège social <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="">Rédaction</label>
                                        </div>                                       
                                        <?php 
                                            if($doc_pouvoir == "1"){ ?>
                                            <a href="creation-view-morale-pouvoir.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-pouvoir.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Pouvoir <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } 
                                            if($doc_attestation == "1"){ ?>
                                            <a href="creation-view-morale-attestation.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-attestation.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Attestation de non condamnation <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                                        <?php } ?>
                                        <div class="form-group">
                                            <label class="">Banque et Publication</label>
                                        </div>
                                        <?php 
                                            if($doc_depot == "1"){ ?>
                                            <a href="creation-view-morale-depot.php" id="av" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/v.png">
                                            </a>
                                        <?php }else{ ?>
                                            <a href="creation-view-morale-depot.php" id="ax" class="list-group-item">
                                                <div class="fonticon-wrap d-inline mr-25">
                                                    <img src="../../../app-assets/images/pages/doc.png" id="img-doc">
                                                </div> 
                                                Dépôt de capital <img id="vx" src="../../../app-assets/images/pages/x.png">
                                            </a>
                            <?php       } ?>
                                    
                                </div>
                                <!-- sidebar menu  end-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-right bouge">
                <div class="content-overlay"></div>
                <div class="content-wrapper">
                    <div class="content-header row">
                    </div>
                    <div class="content-body">
                        <div class="app-content-overlay"></div>
                        <div class="form-group text-center border-0">
                            <br>
                            <h1>Piece d'identité</h1>
                        </div>
                        <hr>
                        <div class="form-group row align-items-start custom-line">
                            <div class="col text-center border-right ">
                                    <img src="../../../app-assets/images/ico/photoid.png" alt="Photoid" class="img-fluid h-100 p-1"> 
                            </div>
                            <div class="col">
                                <div class="form-group text-center">
                                    <h4>CONDITIONS D'ACCEPTATIONS</h4>
                                </div>
                                <div class="form-group text-justify p-2">
                                    <p>Le document demandé devra respecter l'intégralité des condictions sous peine d'un refus de création d'entreprise.</p>
                                    <p>Vous pouvez vous référencer à l'exemple fourni merci de votre compréhension.</p>
                                    <br>
                                    <div class="form-group text-center">
                                        <p>Le document devra :</p>
                                        <label> - Être fournie sous un format numérique de préférence en PDF. (PNG, JPG, JPEG)</label><br>
                                        <label> - Être fournie en intégralité (Tous les bords visibles)</label><br>
                                        <label> - Être fournie en couleur de préférence.</label><br>
                                        <label> - Être parfaitement net et visible</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <hr>
                        </div>
                        <div class="form-group text-center">
                            <div class="form-group my-2 mx-auto w-50">
                                <form name="myform" action="" method="POST" enctype="multipart/form-data">
                                    <input type="hidden" name="id_doc" value="<?= $_SESSION['id_crea'] ?>">
	                                <input class="input-file" id="my-file" onchange="this.form.submit();" type="file"  name="pieceid" size="30" accept="image/png, image/jpg, image/jpeg, application/pdf">
	                                <label for="my-file" class="input-file-trigger rounded-pill" tabindex="0">
		                                Sélectionner un fichier ...
	                                </label>
                                </form>
                            </div>
                                <p class="file-return"></p>    
                            </div>
                        </div>
                        <div class="form-group text-center <?php if(!empty($_GET['upload'])){if($_GET['upload'] == "1"){echo "block-validation";}else{echo "none-validation";}}else{echo "none-validation";} ?>">
                            <label class="green">Le téléchargement de votre carte d'identité a bien été effectué ✔️</label><br>
                            <small>Vous avez toujours la possibilité de changer le document.</small>
                        </div>
                        <div class="form-group text-center <?php if(!empty($_GET['upload'])){if($_GET['upload'] == "2"){echo "block-validation";}else{echo "none-validation";}}else{echo "none-validation";} ?>">
                            <label class="red">Le téléchargement de votre carte d'identité n'a pas était effectué ❌</label><br>
                            <small>Contacté le support via le chat à votre disposition ou bien sur contact@coqpix.com</small>
                        </div>
                        <div class="form-group text-center <?php if(!empty($_GET['upload'])){if($_GET['upload'] == "3"){echo "block-validation";}else{echo "none-validation";}}else{echo "none-validation";} ?>">
                            <label class="red">Le format du document fourni n'est pas accepté ❌</label><br>
                            <small>Contacté le support via le chat à votre disposition ou bien sur contact@coqpix.com pour plus d'information.</small>
                        </div>
                        <div class="row no-gutters mt-3">
                            <div class="col"></div>
                            <div class="col text-center">
                                <div class="form-group <?php if(substr($crea['doc_pieceid'], -3) == "pdf"){echo "block-validation";}else{echo "none-validation";} ?>">
                                    <embed src=../../../src/crea_societe/pieceid/<?= $crea['doc_pieceid'] ?> width=800 height=500 type='application/pdf'/>
                                </div>
                                <div class="form-group <?php if(substr($crea['doc_pieceid'], -3) == "png"){echo "block-validation";}else{if(substr($crea['doc_pieceid'], -3) == "jpg"){echo "block-validation";}else{if(substr($crea['doc_pieceid'], -3) == "jpeg"){echo "block-validation";}else{ echo "none-validation";}}} ?>">
                                    <label>Apercu de votre document</label>
                                    <img src="../../../src/crea_societe/pieceid/<?= $crea['doc_pieceid'] ?>" alt="Photoid" class="img-fluid">
                                </div>
                                <div class="form-group <?php if(substr($crea['doc_pieceid'], -3) == "png"){echo "none-validation";}else{if(substr($crea['doc_pieceid'], -3) == "jpg"){echo "none-validation";}else{if(substr($crea['doc_pieceid'], -3) == "jpeg"){echo "none-validation";}else{ if(substr($crea['doc_pieceid'], -3) == "jpeg"){ echo "block-validation";}else{if(substr($crea['doc_pieceid'], -3) == "pdf"){echo "none-validation";}else{if(substr($crea['doc_pieceid'], -3) == ""){echo "none-validation";}else{echo "block-validation";}}}}}} ?>">
                                    <label>Format du document non respecté</label>
                                </div>
                            </div>
                            <div class="col"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->



    <script>
    
    // ajout de la classe JS à HTML
        document.querySelector("html").classList.add('js');

        // initialisation des variables
        var fileInput = document.querySelector( ".input-file" ),
	        button = document.querySelector( ".input-file-trigger" ),
	        the_return = document.querySelector(".file-return");

        // action lorsque la "barre d'espace" ou "Entrée" est pressée
        button.addEventListener( "keydown", function( event ) {
	        if ( event.keyCode == 13 || event.keyCode == 32 ) {
		        fileInput.focus();
	        }
        });

        // action lorsque le label est cliqué
        button.addEventListener( "click", function( event ) {
	        fileInput.focus();
	return false;
        });

        // affiche un retour visuel dès que input:file change
        fileInput.addEventListener( "change", function( event ) {
	        the_return.innerHTML = this.value;
        });
    
    </script>

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>