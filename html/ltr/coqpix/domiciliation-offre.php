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
    if($crea['doc_justificatifd'] == ""){
        $doc_justificatifd = "0";
    }else{
        $doc_justificatifd = "1";
    }
    if($crea['doc_affectation'] == ""){
        $doc_affectation = "0";
    }else{
        $doc_affectation = "1";
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

    //selection des infos selon l'id
    $id = $_GET['id'];
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE id like '$id'");
    $result = $query->fetch();

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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation-offre.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->


<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky bg-white content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
<div class="container-fluid">

    <div class="row">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
            
            <?php
                $url = $result['img'];
                $filename = "../../../src/domiciliation/page-offre/$url-3.jpg";

                if (file_exists($filename)) {
            ?>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            <?php 
                } 
            ?>
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active" data-mdb-interval="10000000000" id="img1">
    	
              	<img src="../../../src/domiciliation/page-offre/<?php echo $result['img']; ?>-1.jpg" >
      	
            </div>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../src/domiciliation/page-offre/<?php echo $result['img']; ?>-2.jpg" >
        
            </div>
            <?php
                if (file_exists($filename)) {
            ?>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../src/domiciliation/page-offre/<?php echo $result['img']; ?>-3.jpg" >
      	
            </div>
            <?php
                }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    </div>
    <div class="row">
        <div class="col-2"></div>
        <div class="col-8" id="div-descrip">
            <h1 id="titre"><?php echo $result['titre']; ?></h1>
            <pre>

<?php 
echo $result['description'];
?>

            </pre>
        </div>
        <div class="col-2"></div>
    </div>
    <div class="row">
        <div class="col-12" id="div-info">
            <ul> 
                <li>
               
                <?php
                    $carac = $result['caracteristique'];
                    $carac = str_replace("\n","</li><li>",$carac);
                    echo $carac; 
                ?>
                </li>

            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12" id="div-service-dispo">
            <form action="" method="POST">
            <h2>Les services disponibles à cette adresse</h2>

    <div id="solution-logo">
        <ul>
<?php 
if($result['type']=='1'){ //bureau disponible
?>


                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="bureau" value="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                        <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>
                   
            
<?php }?>
<?php 
if($result['type']=='2'){ //coworking disponible
?>


                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="cowork" value="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img id="blue3"  src="../../../app-assets/images/pages/coworking.png">
                                        <img id="green3" style="display:none;" src="../../../app-assets/images/pages/coworking_green.png">
                                    </label><br>
                                    <label>
                                        <p>Coworking</p>
                                    </label>
                                </li>
                   
            
<?php }?>
<?php 
if($result['type']=='3'){ //bureau et coworking disponible
?>

                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="bureau" value="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                        <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>

                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="cowork" value="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img id="blue3"  src="../../../app-assets/images/pages/coworking.png">
                                        <img id="green3" style="display:none;" src="../../../app-assets/images/pages/coworking_green.png">
                                    </label><br>
                                    <label>
                                        <p>Coworking</p>
                                    </label>
                                </li>
                   
            
<?php }?>
<?php 
if($result['type']=='4'){ //domiciliation disponible
?>


                                <li>
                                    <input type="radio" name="choix_offre" id="domicilia" value="domicilia" onclick='openGreen(), countType()' class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                        <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>
                   
            
<?php }?>
<?php 
if($result['type']=='5'){ //domiciliation et bureau disponible
?>


                                <li>
                                    <input type="radio" name="choix_offre" id="domicilia" value="domicilia" onclick='openGreen(), countType()' class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                        <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>  
                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="bureau" value="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                        <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>                 
            
<?php }?>
<?php 
if($result['type']=='6'){ //domiciliation et coworking disponible
?>


                                <li>
                                    <input type="radio" name="choix_offre" id="domicilia" value="domicilia" onclick='openGreen(), countType()' class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                        <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>  
                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="cowork" value="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img id="blue3"  src="../../../app-assets/images/pages/coworking.png">
                                        <img id="green3" style="display:none;" src="../../../app-assets/images/pages/coworking_green.png">
                                    </label><br>
                                    <label>
                                        <p>Coworking</p>
                                    </label>
                                </li>               
            
<?php }?>
<?php 
if($result['type']=='7'){ //bureau,domiciliation et coworking disponible
?>

                                <li>
                                    <input type="radio" name="choix_offre" id="domicilia" value="domicilia" onclick='openGreen(), countType()' class="solu"></input>
                                    <label for="domicilia" class="">
                                        <img id="blue1" src="../../../app-assets/images/pages/domiciliation.png">
                                        <img id="green1" style="display:none;"  src="../../../app-assets/images/pages/domiciliation_green.png">
                                    </label><br>
                                    <label>
                                        <p>Domiciliation</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="bureau" value="bureau" class="solu"></input>
                                    <label for="bureau" class="">
                                        <img id="blue2" src="../../../app-assets/images/pages/bureau.png">
                                        <img id="green2" style="display:none;" src="../../../app-assets/images/pages/bureau_green.png">
                                    </label><br>
                                    <label>
                                        <p>Bureaux privatifs</p>
                                    </label>
                                </li>
                                <li>
                                    <input type="radio" name="choix_offre" onclick='openGreen(), countType()' id="cowork" value="cowork" class="solu"></input>
                                    <label for="cowork" class="">
                                        <img id="blue3"  src="../../../app-assets/images/pages/coworking.png">
                                        <img id="green3" style="display:none;" src="../../../app-assets/images/pages/coworking_green.png">
                                    </label><br>
                                    <label>
                                        <p>Coworking</p>
                                    </label>
                                </li>
                   
            
<?php }?>
        </ul>
    </div>
    
                   


            <div class="form-group" id="div-btn-sol">
                <button type="submit" id="btn-sol" class="btn text-dark glow position-relative border rounded-pill">Soumettre</button>
            </div>
            </form>
        </div>
    </div>
    <?php require_once('php/chat_domiciliation.php')?>
</div>
    
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

<script>

    //changement image
    function openGreen() {

        var bureau = document.getElementById("bureau");
        var cowork = document.getElementById("cowork");
        var domicilia = document.getElementById("domicilia");
        
        if (domicilia.checked) {
            document.getElementById("green1").style.display = "block";
            document.getElementById("blue1").style.display = "none";
        } else {
            document.getElementById("green1").style.display = "none";
            document.getElementById("blue1").style.display = "block";
        }

        if (bureau.checked) {
            document.getElementById("green2").style.display = "block";
            document.getElementById("blue2").style.display = "none";
        } else {
            document.getElementById("green2").style.display = "none";
            document.getElementById("blue2").style.display = "block";
        }

        if (cowork.checked) {
            document.getElementById("green3").style.display = "block";
            document.getElementById("blue3").style.display = "none";
        } else {
            document.getElementById("green3").style.display = "none";
            document.getElementById("blue3").style.display = "block";
        }
    }

    //determine le type
    function countType() {
        var bureau = document.getElementById("bureau");
        var cowork = document.getElementById("cowork");
        var domicilia = document.getElementById("domicilia");

        var i = 0;

        if (bureau.checked) {
            i = i+1;
        }
        if (cowork.checked) {
            i = i+2;
        }
        if (domicilia.checked) {
            i = i+4;
        }
        console.log(i);
        return i;
    };
</script>

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

