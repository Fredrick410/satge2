<?php 
//si l'utilisateur n'a pas fait de choix, ça le redirige vers la page précédente
$id_offre = $_POST['id_offre'];
if ($_POST['choix_offre'] == "") {
    header('Location: domiciliation-offre.php?id='.$id_offre);
}

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
    $id = $_POST['id_offre'];
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
<body class="horizontal-layout horizontal-menu navbar-sticky  content-left-sidebar email-application  footer-static  " style="background-color: #edf1ff;" data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
<div class="container-fluid">
    <br>
    <div class="form-group">
         <div class="livicon-evo" onclick="retourn()" data-options=" name: arrow-left.svg; size: 30px " style="color: #051441; cursor: pointer; display:inline-block; top: 6px;"></div>
                <script>
                    function retourn() {
                        document.location.href="domiciliation-offre.php?id=<?= $id ?>";
                    }
                </script>
        <label class="" style="color: #051441;">Retour à offre domiciliation</label>
    </div>

    <h2 id="titre-contrat">Fiche de renseignement</h2>
    <h5 id="sous-titre-contrat">Domiciliation à <?php echo $result['titre'] ?></h5>
            
    <form class="col-12" action="generate-pdf.php" target="_blank" method="POST">
        <div class="row card-body bg-white" id="contrat">
            <h3>Informations sur votre société</h3>
            <div class="col-12">
                <?php $today = date("d/m/y"); 
                $cd = $result['titre']; 
                $codepostal = substr($cd, -5, 5); ?>        
                <input type="text" name="id_crea" id="id_crea" readonly hidden value="<?= $_SESSION['id_crea'] ?>">    
                <input type="text" name="date" id="date" readonly hidden value="<?= $today ?>">
                <input type="text" name="adresse" id="adresse" readonly hidden value="<?= $crea['adresse_diri'] ?>">
                <!--<input type="text" name="prix" id="prix" readonly hidden value="<?= $result[''] ?>">
                <input type="text" name="prixtotechht" id="prixtotechht" readonly hidden value="<?= $result[''] ?>">-->
                <div class="row">
                    <div class="col-6" id="contrat-gauche" >
                        <ul>
                            <li>
                                <label for="raisonSociale">Nom de la société</label>
                                <input type="text" name="raisonsociale" id="raisonsociale" class="border-dark rounded-pill" required readonly value="<?= $crea['name_crea'] ?>">
                            </li>
                            <li>
                                <label for="adressess">Adresse du siège social</label>
                                <input type="text" name="adressess" id="adressess" class="border-dark rounded-pill" placeholder="entrez une adresse" required value="<?= $result['adresse'] ?>">
                            </li>
                            <li>
                                <label for="formeJuridique">Forme Juridique</label>
                                <input type="text" name="formejuridique" id="formejuridique" class="border-dark rounded-pill" placeholder="entrez la forme juridique" required readonly value="<?= $crea['status_crea'] ?>">
                            </li>          
                        </ul>
                    </div>
                    <div class="col-6" id="contrat-droite">
                        <ul>
                            <li>
                                <label for="capital">Capital</label>
                                <input type="text" name="capital" id="capital" class="border-dark rounded-pill" placeholder="entrez le capital" required>
                            </li>
                            <li>
                                <label for="tva">TVA intra-communautaire</label>
                                <input type="text" name="tva" id="tva" class="border-dark rounded-pill" placeholder="entrez la TVA" required>
                            </li>
                            <li>
                                <label for="activite">Activité de la société</label>
                                <input type="text" name="activite" id="activite" class="border-dark rounded-pill" placeholder="entrez l'activité" required>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="row card-body bg-white" id="contrat">
            <h3>Informations sur votre contrat</h3>
            <div class="col-12">
                <div class="row" id="">
                    <div class="col-6" id="contrat-gauche">
                        <ul>
                            <li>
                                <label for="representant">Société représenté par</label>
                                <input type="text" name="representant" id="representant" class="border-dark rounded-pill" placeholder="Nom et Prénom" required readonly value="<?= $crea['nom_diri'] ?> <?= $crea['prenom_diri'] ?>">
                            </li>
                            <li>
                                <label for="representantqualite">En sa qualité de</label>
                                <input type="text" name="representantqualite" id="representantqualite" class="border-dark rounded-pill" placeholder="entrez la fonction" required value="dirigeant">
                            </li>
                            <li>
                                <label for="nationalite">Nationalité</label>
                                <input type="text" name="nationalite" id="nationalite" class="border-dark rounded-pill" placeholder="entrez la nationalité" required value="Français">
                            </li> 
                            <li>
                                <label for="datedebut">Date de début du contrat</label>
                                <input type="text" name="datedebut" id="datedebut" class="border-dark rounded-pill" placeholder="entrez une date" required value="<?= $today ?>">
                            </li>
                            <li>
                                <label for="dureecontrat">Durée du contrat</label>
                                <input type="text" name="dureecontrat" id="dureecontrat" class="border-dark rounded-pill" placeholder="en mois" required value="">
                            </li>
                            <li>
                                <label for="servicechoisi">Service choisi</label>
                                <input type="text" name="servicechoisi" id="servicechoisi" class="border-dark rounded-pill" placeholder="entrez le service" required value="">
                            </li>
                            <li>
                                <label for="centremultiburo">Centre Multiburo</label>
                                <input type="text" name="centremultiburo" id="centremultiburo" class="border-dark rounded-pill" placeholder="entrez le centre" required value="">
                            </li>
                            <li>
                                <label for="reexpedition">Réexpédition du courrier</label>
                                <input type="text" name="reexpedition" id="reexpedition" class="border-dark rounded-pill" required value="">
                            </li>
                            <li>
                                <label for="scancourrier">Scan courrier</label>
                                <input type="text" name="scancourrier" id="scancourrier" class="border-dark rounded-pill" required value="">
                            </li>
                        </ul>
                    </div>
                    <div class="col-6" id="contrat-droite">
                        <ul>
                            <li>
                                <label for="adresseds">Adresse du signataire</label>
                                <input type="text" name="adresseds" id="adresseds" class="border-dark rounded-pill" placeholder="entrez une adresse" required value="<?= $crea['adresse_diri'] ?>">
                            </li>
                            <li>
                                <label for="telephoneds">Téléphone du signataire</label>
                                <input type="text" name="telephoneds" id="telephoneds" class="border-dark rounded-pill" required value="<?= $crea['tel_diri'] ?>">
                            </li>
                            <li>
                                <label for="emailds">Email du signataire</label>
                                <input type="text" name="emailds" id="emailds" class="border-dark rounded-pill" placeholder="entrez un email" required value="<?= $crea['email_diri'] ?>">
                            </li>
                            <li>
                                <label for="adresse_factures">Adresse de facturation</label>
                                <input type="text" name="adresse_factures" id="adresse_factures" class="border-dark rounded-pill" placeholder="entrez une adresse" required value="">
                            </li> 
                            <li>
                                <label for="envoi_factures">Envoi factures</label>
                                <input type="text" name="envoi_factures" id="envoi_factures" class="border-dark rounded-pill" required value="">
                            </li>
                            <li>
                                <label for="contactfacture">Contact facturation</label>
                                <input type="text" name="contactfacture" id="contactfacture" class="border-dark rounded-pill" required placeholder="Nom et Prénom" value="">
                            </li>
                            <li>
                                <label for="telephone">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="border-dark rounded-pill" required value="">
                            </li>
                            <li>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="border-dark rounded-pill" placeholder="entrez un email" required value="">
                            </li>
                        </ul>
                    </div>
                    
                </div>
            </div>
        </div>

        <div class="row card-body bg-white" id="condition">
            <h3>Coordonnées Bancaires</h3>
            <div class="col-12">
                <div class="row" id="">
                    <ul>
                        
                        <li>
                            <input type="checkbox" name="conditions-logo" id="conditions-logo" required>
                            <label for="conditions-logo">J'autorise Multiburo à utiliser le nom et le logo de ma société dans sa communication interne et externe.</label>
                        </li>
                        <li>
                            <input type="checkbox" name="conditions" id="conditions" required>
                            <label for="conditions">J'ai pris connaissance, et j'accepte les <a href="domiciliation-contrat-conditions.php" target="_blank">conditions générales</a> du contrat.</label>
                        </li>
                        <li>
                            <label for="Signature">Signature Numérique</label>
                            <input type="text" name="signature" id="signature" class="border-dark rounded-pill" required placeholder="prénom et nom"  onkeyup="apercu.innerHTML=this.value">
                        </li>
                        <li>
                            <label for="apercu">Aperçu</label>
                            <span id="apercu" readonly></span>
                        </li>
                    </ul>
                    <div id="btn" class="col-12 text-center mt-2">
                        <button type="submit" class="border rounded-pill">
                            Valider les informations
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </form>

    <div class="row">
        
    </div>

    <div class="row">
        
    </div>
   
    <?php require_once('php/chat_domiciliation.php')?>
</div>
    
    <!-- END: Content-->

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