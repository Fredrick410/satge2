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

    if($crea['status_crea'] == "EURL"){
        $linkview = "morale";
    }else{        
        if($crea['status_crea'] == "SARL"){
            $linkview = "morale";
        }else{
            if($crea['status_crea'] == "SAS"){
                $linkview = "morale";
            }else{
                if($crea['status_crea'] == "SASU"){
                    $linkview = "morale";
                }else{
                    if($crea['status_crea'] == "SCI"){
                        $linkview = "morale";
                    }else{
                        if($crea['status_crea'] == "EIRL"){
                            $linkview = "physique";
                        }else{
                            if($crea['status_crea'] == "Micro-entreprise"){
                                $linkview = "physique";
                            }else{
                                $linkview = "physique";
                            }
                        }
                    }
                }
            }
        }
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
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

    <h2 id="titre-contrat">Domiciliation d'entreprise : fiche de renseignement</h2>
    <h5 id="sous-titre-contrat">Domiciliation à <?php echo $result['titre'] ?></h5>
            
    <form class="col-12" action="generate-pdf.php" target="_blank" method="POST">
        <div class="row card-body bg-white" id="contrat">
            <h3>Informations sur votre société</h3>
            <div class="col-12">
                <?php $today = date("d/m/y"); 
                $cd = $result['titre']; 
                $codepostal = substr($cd, -5, 5); ?>        
                <input type="text" name="id_crea" id="id_crea" readonly hidden value="<?= $_SESSION['id_crea'] ?>">
                <input type="text" name="status_crea" id="status_crea" readonly hidden value="<?= $linkview ?>">
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
                                <label for="datedebut">Date de début du contrat</label>
                                <input type="text" name="datedebut" id="datedebut" class="border-dark rounded-pill" placeholder="entrez une date" required value="<?= $today ?>">
                            </li>
                            <li>
                                <label for="servicechoisi">Service choisi</label>
                                <input type="text" name="servicechoisi" id="servicechoisi" class="border-dark rounded-pill" placeholder="entrez le service" required value="Domiciliation Adresse">
                            </li>
                        </ul>
                    </div>
                    <div class="col-6" id="contrat-droite">
                        <ul>
                            <li>
                                <label for="dureecontrat">Durée du contrat</label>
                                <input type="text" name="dureecontrat" id="dureecontrat" class="border-dark rounded-pill" placeholder="en mois" required value="">
                            </li>
                            <li>
                                <label for="centremultiburo">Centre Multiburo</label>
                                <input type="text" name="centremultiburo" id="centremultiburo" class="border-dark rounded-pill" placeholder="entrez le centre" required value="">
                            </li>
                        </ul>
                    </div>
                    <div class="col-12">
                        <ul>
                            <li>
                                <label>Réexpédition du courrier</label>
                            </li>
                        </ul>
                        <div class="row px-3">
                            <div class="col-3" id="contrat-gauche">
                                <input type="radio" name="reexpedition" id="reexpedition" required value="Non"><label for="reexpedition" style="text-transform: lowercase; margin-left: 20px;">Non</label>
                            </div>
                            <div class="col-3" id="contrat-droite">
                                <input type="radio" name="reexpedition" id="reexpedition" required value="1 fois par semaine (9,50 €)"><label for="reexpedition" style="text-transform: lowercase; margin-left: 20px;">1 fois/sem (9,50 €)</label>
                            </div>
                            <div class="col-3" id="contrat-droite">
                                <input type="radio" name="reexpedition" id="reexpedition" required value="2 fois par semaine (14 €)"><label for="reexpedition" style="text-transform: lowercase; margin-left: 20px;">2 fois/sem (14 €)</label>
                            </div>
                            <div class="col-3" id="contrat-droite">
                                <input type="radio" name="reexpedition" id="reexpedition" required value="Tous les jours (33 €)"><label for="reexpedition" style="text-transform: lowercase; margin-left: 20px;">Tous les jours (33 €)</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <ul>
                            <li>
                                <label>Scan courrier</label>
                            </li>
                        </ul>
                        <div class="row px-3">
                            <div class="col-6" id="contrat-gauche">
                                <input type="radio" name="scancourrier" id="scancourrier" required value="Oui"><label for="scancourrier" style="text-transform: lowercase; margin-left: 30px;">Oui</label><br>
                                <input type="radio" name="scancourrier" id="scancourrier" required value="Non"><label for="scancourrier" style="text-transform: lowercase; margin-left: 30px;">Non</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 px-2" id="">
                        <div class="row px-3">
                            <label for="adresse_factures">Adresse de facturation</label>
                            <input type="text" name="adresse_factures" id="adresse_factures" class="border-dark rounded-pill" placeholder="entrez une adresse" required value="">
                        </div>
                    </div><br><br>
                    <div class="col-12">
                        <ul>
                            <li>
                                <label>Envoi factures</label>
                            </li>
                        </ul>
                        <div class="row px-3">
                            <div class="col-6" id="contrat-gauche">
                                <input type="radio" name="choixenvoi" id="choixenvoi" required value="mail"><label for="choixenvoi" style="text-transform: lowercase; margin-left: 20px;">Par mail :</label><input type="text" name="envoi_factures" id="envoi_factures" class="border-dark rounded-pill" style="margin-bottom: 10px;" placeholder="entrez un email" value=""><br>
                                <input type="radio" name="choixenvoi" id="choixenvoi" required value="courrier"><label for="choixenvoi" style="text-transform: lowercase; margin-left: 20px;">Par courrier :</label><input type="text" name="envoi_factures1" id="envoi_factures1" class="border-dark rounded-pill" placeholder="entrez une adresse" value="">
                            </div>
                        </div>
                    </div>
                    <div class="col-6" id="contrat-gauche">
                        <ul>
                            <li>
                                <label for="representant">Société représenté par</label>
                                <input type="text" name="representant" id="representant" class="border-dark rounded-pill" placeholder="Nom et Prénom" required readonly value="<?= $crea['nom_diri'] ?> <?= $crea['prenom_diri'] ?>">
                            </li>
                            <li>
                                <label for="nationalite">Nationalité</label>
                                <input type="text" name="nationalite" id="nationalite" class="border-dark rounded-pill" placeholder="entrez la nationalité" required value="Français">
                            </li>
                            <li>
                                <label id="tel1" for="telephoneds">Téléphone du signataire</label>
                                <input onchange='processds(event)' type="text" name="telephoneds_temp" id="telephoneds_temp" class="border-dark rounded-pill" required value="<?= $crea['tel_diri'] ?>">
                                <input type="text" name="telephoneds" id="telephoneds" hidden required value="<?= $crea['tel_diri'] ?>">
                            </li>
                            <li>
                                <label for="contactfacture">Contact facturation</label>
                                <input type="text" name="contactfacture" id="contactfacture" class="border-dark rounded-pill" required placeholder="Nom et Prénom" value="">
                            </li>
                            <li>
                                <label for="email">Email</label>
                                <input type="text" name="email" id="email" class="border-dark rounded-pill" placeholder="entrez un email" required value="">
                            </li>
                        </ul>
                    </div>
                    <div class="col-6" id="contrat-droite">
                        <ul>
                            <li>
                                <label for="representantqualite">En sa qualité de</label>
                                <input type="text" name="representantqualite" id="representantqualite" class="border-dark rounded-pill" placeholder="entrez la fonction" required value="Dirigeant">
                            </li>
                            <li>
                                <label for="adresseds">Adresse du signataire</label>
                                <input type="text" name="adresseds" id="adresseds" class="border-dark rounded-pill" placeholder="entrez une adresse" required value="<?= $crea['adresse_diri'] ?>">
                            </li>
                            <li>
                                <label for="emailds">Email du signataire</label>
                                <input type="text" name="emailds" id="emailds" class="border-dark rounded-pill" placeholder="entrez un email" required value="<?= $crea['email_diri'] ?>">
                            </li>
                            <li>
                                <label id="tel2" for="telephone">Téléphone</label>
                                <input onchange='process(event)' type="text" name="telephone_temp" id="telephone_temp" class="border-dark rounded-pill" required>
                                <input type="text" name="telephone" id="telephone" hidden required>
                            </li>
                        </ul>
                    </div>
                    
                    
                </div>
            </div>
        </div>

        <div class="row card-body bg-white" id="contrat">
            <h3>Coordonnées Bancaires</h3>
            <div class="col-12">
                <div class="row px-3" id="">
                    <div class="col-12">
                        <label>Mode de règlement</label>
                    </div>
                    <div class="row px-2">
                        <div class="col-12" id="contrat-gauche">
                            <input type="radio" name="reglement" id="reglement" value="Virement bancaire (Hors Europe)"><label for="reglement" style="text-transform: lowercase; margin-left: 20px;">Virement bancaire (Hors Europe)</label><br>
                            <input type="radio" name="reglement" id="reglement" value="Prélèvement automatique (Union Européene)"><label for="reglement" style="text-transform: lowercase; margin-left: 20px;">Prélèvement automatique (Union Européene)</label>
                        </div>
                    </div>
                </div>
                <div class="row" id="">
                    <div class="col-12">
                        <ul>
                            <li>
                                <label for="nombanque">Nom de la banque</label>
                                <input type="text" name="nombanque" id="nombanque" class="border-dark rounded-pill w-50" placeholder="entrez le nom de la banque" value="">
                            </li>
                            <li>
                                <label for="adressebanque">Adresse de la banque</label>
                                <input type="text" name="adressebanque" id="adressebanque" class="border-dark rounded-pill w-50" placeholder="entrez l'adresse de la banque" value="">
                            </li>
                            <li>
                                <label for="iban">IBAN</label>
                                <input type="text" name="iban" id="iban" class="border-dark rounded-pill w-50" placeholder="entrez un IBAN" pattern="^FR\d{12}[0-9A-Z]{11}\d{2}$" value="">
                            </li>
                            <li>
                                <label for="bic">BIC</label>
                                <input type="text" name="bic" id="bic" class="border-dark rounded-pill w-50" placeholder="entrez un BIC" pattern="^[A-Z]{4}[F]{1}[R]{1}[A-Z0-9]{2}[A-Z0-9]{0,3}$" value="">
                            </li>
                        </ul>
                    </div>
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


    <!-- script telephone -->
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script>
        //telephone du signataire
        const phonedsInputField = document.querySelector("#telephoneds_temp");
        const phonedsInput = window.intlTelInput(phonedsInputField, {
            preferredCountries: ["fr"],
            utilsScript: 
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        function processds(event) {
            event.preventDefault();

            const phonedsNumber = phonedsInput.getNumber();

           
            document.getElementById("telephoneds").value=`${phonedsNumber}`;
        }

        //telephone entreprise
        const phoneInputField = document.querySelector("#telephone_temp");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["fr"],
            utilsScript: 
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        function process(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

           
            document.getElementById("telephone").value=`${phoneNumber}`;
        }
  
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