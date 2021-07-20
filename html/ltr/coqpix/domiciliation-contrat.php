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
         <div class="livicon-evo" onclick="retourn()" data-options=" name: arrow-left.svg; size: 30px " style="cursor: pointer; display:inline-block; top: 6px;"></div>
                <script>
                    function retourn() {
                        document.location.href="domiciliation-offre.php?id=<?= $id ?>";
                    }
                </script>
        <label class="">Retour à offre domiciliation</label>
    </div>

    <h2 id="titre-contrat">Création du contrat</h2>
    <h5 id="sous-titre-contrat">Domiciliation à <?php echo $result['titre'] ?></h5>
            
    <form class="col-12" action="generate-pdf.php" method="POST">
        <div class="row card-body bg-white" id="contrat">
            <h3>Informations Générales</h3>
            <div class="col-12">
                <!--<h6>
                  <i class="step-icon"></i>
                  <span class="fonticon-wrap">
                    <i class="livicon-evo"
                      data-options="name:user.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                  </span>
                  <span>Basic Details</span>
                </h6>-->
                <?php $today = date("d/m/y"); 
                $cd = $result['titre']; 
                $codepostal = substr($cd, -5, 5); ?>            
                <input type="text" name="date" id="date" readonly hidden value="<?= $today ?>">
                <input type="text" name="adresse" id="adresse" readonly hidden value="<?= $result['adresse'] ?>">
                <!--<input type="text" name="prix" id="prix" readonly hidden value="<?= $result[''] ?>">
                <input type="text" name="prixtotechht" id="prixtotechht" readonly hidden value="<?= $result[''] ?>">-->
                <div class="row">
                    <div class="col-6" id="contrat-gauche" >
                        <ul>
                            <li>
                                <label for="RaisonSociale">Nom de l'entreprise</label>
                                <input type="text" name="raisonsociale" id="raisonsociale" class="border-dark rounded-pill" required readonly value="<?= $crea['name_crea'] ?>">
                            </li>
                            <li>
                                <label for="FormeJuridique">Forme Juridique</label>
                                <input type="text" name="formejuridique" id="formejuridique" class="border-dark rounded-pill" required readonly value="<?= $crea['status_crea'] ?>">
                            </li>
                            <li>
                                <label for="Capital">Capital</label>
                                <input type="text" name="capital" id="capital" class="border-dark rounded-pill" required>
                            </li>
                            <li>
                                <label for="Representant">Représenté par</label>
                                <input type="text" name="representant" id="representant" class="border-dark rounded-pill" required value="<?= $crea['nom_diri'] ?> <?= $crea['prenom_diri'] ?>">
                            </li>
                            <li>
                                <label for="RepresentantQualite">En sa qualite de</label>
                                <input type="text" name="representantqualite" id="representantqualite" class="border-dark rounded-pill" required value="Dirigeant">
                            </li>             
                        </ul>
                    </div>
                    <div class="col-6" id="contrat-droite">
                        <ul>
                            <li>
                                <label for="CodePostal">Code Postal</label>
                                <input type="text" name="codepostal" id="codepostal" class="border-dark rounded-pill" required value="<?= $codepostal ?>">
                            </li>
                            <li>
                                <label for="Ville">Ville</label>
                                <input type="text" name="ville" id="ville" class="border-dark rounded-pill" required value="<?= $result['ville'] ?>">
                            </li>
                            <li>
                                <label for="Pays">Pays</label>
                                <input type="text" name="pays" id="pays" class="border-dark rounded-pill" required value="FRANCE">
                            </li>
                            <li>
                                <label for="Telephone">Téléphone</label>
                                <input type="text" name="telephone" id="telephone" class="border-dark rounded-pill" required value="<?= $crea['tel_diri'] ?>">
                            </li>
                            <li>
                                <label for="Email">Email</label>
                                <input type="text" name="email" id="email" class="border-dark rounded-pill" required value="<?= $crea['email_diri'] ?>">
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        

        <div class="row card-body bg-white" id="attestation">
            <h3>Attestation</h3>
            <div class="col-12">
                <div class="row" id="">
                    <label>
                        <ul>
                            <li>
                                Je soussigné(e) <input class="border-dark rounded-pill ml-1 px-1" value="<?= $crea['nom_diri'] ?> <?= $crea['prenom_diri'] ?>">
                            </li>
                            <li>
                                Agissant en qualité de <input class="border-dark rounded-pill ml-1 px-1" value="dirigeant">
                            </li>
                            <li>
                                Pour la société <input class="border-dark rounded-pill ml-1 px-1" value="<?= $crea['name_crea'] ?>">
                            </li>
                            <li>
                                Dont le siège social est <input class="border-dark rounded-pill ml-1 px-1 w-50" value="<?= $result['adresse'] ?>">
                            </li>
                            <li>
                                Attestation sur l'honneur :
                            <li>
                                <label for="adresse_factures"> - Que la comptabilité et les factures de la société susnommée sont conservées à l’adresse suivante :</label>
                            </li>
                            <li>
                                <input type="text" name="adresse_factures" id="adresse_factures" placeholder="entrez une adresse" class="border-dark rounded-pill" required>
                            </li>
                            <li>
                                - Que je m’engage, en cas de vérification, à mettre ces documents à la disposition de l’administration à l’adresse de domiciliation, sous peine d’encourir les sanctions prévues à l’article L74 du livre des procédures fiscales en cas d’opposition à contrôle fiscal.
                            </li>
                            <li>
                                <pre><input type="radio" id="emploie" name="salarie" value="emploie" required>  Que la société susnommée emploie des salariés et je tiens l’ensemble des documents obligatoires (Registre Unique du Personnel, double des bulletins de paie, récépissés de l’URSAFF des déclarations préalables à l’embauche, justificatif d’immatriculation au Registre du Commerce et des Sociétés ou au Répertoire des Métiers, fiches d’aptitude délivrées par les services de Santé du Travail, décompte de la durée du travail en cas d’horaires individuels de l’année en cours et de l’année précédente, contrats de travail et contrats de mise à disposition de travailleurs temporaires, liste des lieux de travail provisoires) à la disposition de la Direction Départementale du Travail et de l’Emploi à l’adresse suivante :</pre>
                            </li>
                            <li>
                                <input type="text" name="adresse_salarie" id="adresse_salarie" placeholder="entrez la/les adresse(s)" class="border-dark rounded-pill">
                            </li>
                            <li>
                                <pre><input type="radio" id="pas_emploie" name="salarie" value="pas_emploie" required>  Que la société susnommée n’emploie pas de salariés</pre>
                            </li>
                        </ul>
                    </label>
                    
                </div>
            </div>
        </div>

        <div class="row card-body bg-white" id="condition">
            <h3>Conditions Générales</h3>
            <div class="col-12">
                <div class="row" id="">
                    <ul>
                        <li>
                            <label for="Fait_a">Fait à</label>
                            <input type="text" name="Fait_a" id="Fait_a" placeholder="entrez une ville" class="border-dark rounded-pill" required>
                        </li>
                        <li>
                            <label for="Le">Le</label>
                            <input type="text" name="Le" id="Le" class="border-dark rounded-pill" required value="<?= $today ?>">
                        </li>
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
                            <input type="text" name="signature" id="signature" placeholder="prénom et nom" class="border-dark rounded-pill" required>
                            <p></p>
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