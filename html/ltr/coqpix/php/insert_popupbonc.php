<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $insert = $bdd->prepare('INSERT INTO client (name_client, prenom, numsiret, tvaintracom, pays, adresse, departement, secteur, tel, siteweb, email, iban, nom_diri, email_diri, tel_diri, cat, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_client']),
        htmlspecialchars($_POST['prenom']),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($_POST['pays']),
        htmlspecialchars($_POST['adresse']),
        htmlspecialchars($_POST['departement']),
        htmlspecialchars($_POST['secteur']),
        htmlspecialchars($_POST['tel']),
        htmlspecialchars($_POST['siteweb']),
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['iban']),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($_POST['cat']),
        htmlspecialchars($_SESSION['id_session'])
    ));

    header('Location: ../app-bon-add.php?jXN955CbHqqbQ463u5Uq=1');
    exit();
?>

<script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/forms/repeater/jquery.repeater.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <script src="../../../app-assets/js/scripts/pages/app-add_facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/myFunction_facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/getcp.js"></script>
    <script src="../../../app-assets/js/scripts/pages/complete-facture.js"></script>
    <script src="../../../app-assets/js/scripts/pages/buttonc.js"></script>
    <!-- END: Page JS-->
 <script src="script.js"></script>
    <!-- END: Page JS-->
<!-- partial -->
  <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script><script  src="./script.js"></script>