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

        <h2 id="titre-contrat">Conditions Générales</h2>
        <div class="condition bg-white">

            <h5>PREAMBULE</h5>
            <p>Les prestations offertes par le prestataire peuvent être cumulatives ou alternatives dans la limite des prestations offertes par le prestataire.
Les parties conviennent de leur étendue dans les conditions particulières qui figurent en annexe.</p>
            <h5>OBJET</h5>
            <p>Le contrat dont les conditions particulières figurent en annexe a pour objet la fourniture par le prestataire au bénéficiaire d'un ensemble de
services liés au travail de bureau.<br>
Les prestations offertes au bénéficiaire par le prestataire dans le cadre d'une obligation de moyens sont les suivantes : domiciliation, mise à
disposition provisoire et ponctuelle de bureaux et/ou d’espaces de réunion, et de services annexes, aux conditions tarifaires mentionnées en
annexes.</p><br>
            <h5 class>1. DOMICILIATION</h5>
            <p>Les clauses 1.1 à 1.7 ne prennent effet qu’en cas de domiciliation fiscale ou légale de la société ou de son établissement sur le site précisé
dans les conditions particulières.</p>
            <h5>1.1. PRELIMiNAIRE :</h5>
            <p>Le contrat de domiciliation est conclu conformément aux dispositions des articles L 123-11, L123-11-3, R 123-166-1 et suivants du Code de
commerce que l’utilisateur déclare parfaitement connaître.<br>
Il permet à la société domiciliée de fixer, au regard du Tribunal de Commerce compétent, son domicile à l'adresse du centre domiciliataire
dont l'adresse est indiquée aux conditions particulières. L’utilisateur devra également se conformer aux obligations de l’ordonnance n°
2009-104 du 30 janvier 2009 qu’il déclare parfaitement connaître.</p>
            <h5>1.2. DUREE :</h5>
            <p>La date de prise d'effet du présent contrat ainsi que sa durée initiale sont précisées dans les conditions particulières. Conformément aux
dispositions de l’article R123-168 du Code de Commerce, elle ne peut être inférieure à 3 mois. Le renouvellement du présent contrat se fait
par tacite reconduction.</p>
            <h5>1.3. PREAVIS :</h5>
            <p>Au terme de la période initiale le présent contrat est résiliable à tout moment par lettre recommandée moyennant un préavis de 3 mois. Ce
préavis courra à partir du 1er mois suivant la 1ère présentation de la lettre recommandée.</p>
            <h5>1.4. PRIX :</h5>
            <p>Le prix de la présente domiciliation est fixé aux conditions particulières.<br>
Les prix des services, que l’Utilisateur reconnait avoir reçu en annexe du présent contrat, sont modifiables avec un préavis de 1 mois. Les
prix des prestations décrites dans les conditions particulières du présent contrat, en particulier le sous total (A) Domiciliation pourront être
révisés par le prestataire annuellement, avec un préavis de 1 mois. Le prestataire se réserve également la possibilité, en plus des révisions de
prix décrites précédemment, de répercuter dans ses prix les conséquences des modifications éventuelles de la législation fiscale.</p>
            <h5>1.5. OBLIGATIONS A LA CHARGE DE L'UTILISATEUR DOMICILIE :</h5>
            <p>Conformément à l’ordonnance n° 2009-104 du 30 janvier 2009 relative à la lutte contre le blanchiment de capitaux et le financement du
terrorisme, le représentant légal de la société domiciliée remet ce jour au prestataire :<br>
&nbsp;&nbsp;&nbsp; - une pièce d’identité du représentant légal de la société ou signataire du contrat identité<br>
&nbsp;&nbsp;&nbsp; - un pouvoir du représentant légal (si différent du signataire du contrat)<br>
&nbsp;&nbsp;&nbsp; - un justificatif de domicile du représentant légal (datant de moins de 3 mois)<br>
&nbsp;&nbsp;&nbsp; - un justificatif des coordonnées téléphoniques (datant de moins de 3 mois)<br>
&nbsp;&nbsp;&nbsp; - l’identité du bénéficiaire effectif tel que défini à l’article L.561-2-2 du Code monétaire et financier<br>
&nbsp;&nbsp;&nbsp; - une copie du Relevé d’Identité Bancaire (RIB) de la société (ou du gérant si la société n’a pas encore été créée)<br>
&nbsp;&nbsp;&nbsp; - une copie certifiée conforme et à jour des statuts de ladite société<br>
&nbsp;&nbsp;&nbsp; - une procuration postale signée<br>
&nbsp;&nbsp;&nbsp; - une attestation signée du lieu de conservation des pièces comptables et sociales<br>
Il s'engage à remettre au prestataire dans les deux mois au plus tard des présentes : un extrait Kbis.<br>
A date anniversaire du contrat et/ou à chaque modification, l’utilisateur s'engage à remettre au prestataire un nouveau Kbis (datant de moins
de trois mois). Sans réception de ce nouvel extrait K-Bis, le prestataire se réserve la possibilité de le commander et de le facturer à
l’utilisateur.<br>
De même, il est dans les obligations de l’utilisateur d’informer immédiatement le prestataire de toute modification liée aux conditions de
fonctionnement de son entreprise (activité, mandat social, siège social, lieu de situation de ses pièces sociales et comptables, adresse de
réexpédition du courrier, identification des personnes habilitées à venir chercher le courrier, etc.). L’utilisateur s’engage à utiliser
effectivement et exclusivement les locaux mis à sa disposition, soit comme siège de l’entreprise, soit, si le siège est situé à une autre adresse
en France ou à l’étranger, comme agence, succursale ou représentation.<br>
L’utilisateur donne mandat au prestataire de recevoir en son nom toute notification.<br>
Le représentant légal de la société domiciliée autorise d'ores et déjà et de façon définitive au prestataire à remettre les différents documents
plus hauts cités aux organismes autorisés par la loi à en requérir copie.</p>
            <h5>1.6. PRESTATION DE SERVICES :</h5>
            <p>Selon le centre où il se trouve, l’utilisateur a accès aux services tels que : permanence téléphonique, prise de messages, service courrier,
secrétariat, reprographie, télécopie, restauration, parking, etc. Cependant, si l’utilisateur met en place une action commerciale impliquant une
opération publicitaire pouvant entraîner une surcharge importante du courrier ou du nombre d’appels reçus par le prestataire, l’utilisateur doit
préalablement en informer le prestataire afin d’obtenir son accord, la faisabilité et le coût de cette action.</p>
            <h5>1.7. OBLIGATIONS DU PRESTATAIRE :</h5>
            <p>Le prestataire met à la disposition de l’utilisateur des locaux permettant une réunion régulière des organes chargés de la direction, de
l’administration ou de la surveillance de l’entreprise et l’installation des services nécessaires à la tenue, à la conservation et à la consultation
des livres, registres et documents prescrits par les lois et règlements.
Ces locaux seront facturés selon leur utilisation et selon le tarif en vigueur au jour de l’utilisation.</p>
            <h5>1.8. FIN DE CONTRAT :</h5>
            <p>A l’expiration du présent contrat, le prestataire informera le Greffe du Tribunal de Commerce compétent de la fin de ce contrat.<br>
La société domiciliée autorise le prestataire dès à présent à informer le Registre du Tribunal de Commerce compétent de ce que la société
utilisatrice n'aura plus son siège social ou son établissement dans les locaux du prestataire. Dès la fin du contrat l'Utilisateur s'engage
expressément à accomplir toutes les formalités nécessaires au transfert juridique, administratif, commercial, téléphonique et postal, à une
autre adresse, de l'activité du commerce, du siège social ou de l'établissement exploité dans les lieux occupés. Dans les deux mois de son
départ effectif des lieux, l'utilisateur devra avoir communiqué au prestataire un Kbis justifiant de sa nouvelle adresse et de son nouveau siège
social.<br>
A défaut, le prestataire pourra s'adresser au juge des référés compétent pour obtenir, sous astreinte, que la société utilisatrice soit contrainte
de changer son siège social et cesse l’usage de tous services accessoires. De convention expresse le prestataire est autorisé à conserver le
dépôt de garantie prévu à l'entrée dans les lieux jusqu'à justification du transfert d'adresse ou de siège social.</p><br>
            <h5>2. ASSURANCES :</h5>
            <p>Il appartient à l’utilisateur, sous sa seule responsabilité, de souscrire une assurance de responsabilité civile professionnelle dont il devra
justifier au prestataire à la première demande.<br>
L'utilisateur a l'obligation d’assurer auprès d’une compagnie d’assurance notoirement solvable :<br>
A ) Les biens lui appartenant ou qui lui sont confiés lorsqu’ils sont à l’intérieur des locaux objets de la présente convention, contre les risques
d’incendie, d’explosion, de foudre, de dégât des eaux, de dommages électriques, de tempêtes, ouragan, grêle, neige, de vol, d’attentats, de
bris de machine.<br>
B) Sa responsabilité civile (y compris suite à incendie, explosion et dégât des eaux) tant vis-à-vis du prestataire que du propriétaire ou des
occupants de l’immeuble et/ou des tiers et/ou des voisins.</p>
            <h5>2.1. RESPONSABILITE ET RECOURS :</h5>
            <p>L’utilisateur renonce expressément à tout recours en responsabilité contre le prestataire :<br>
a) en cas de vol, cambriolage ou tout acte criminel ou délictueux dont l'Utilisateur, ses préposés ou les tiers pourraient être victimes dans les
locaux mis à sa disposition ou les dépendances de l'immeuble.<br>
b) au cas où les locaux viendraient à être détruits en totalité ou en partie, pour quelques causes que ce soient, le présent contrat étant alors
résilié de plein droit et sans indemnité pour l'Utilisateur. Dans ce cas, le prestataire fera ses meilleurs efforts pour rétablir ses services à ses
clients, éventuellement à une adresse provisoire.<br>
c) en cas de troubles apportés à la jouissance de l'utilisateur par la faute de tiers, quelle que soit leur qualité, l'utilisateur devant agir
directement contre eux sans pouvoir mettre en cause le prestataire.<br>
d) en cas de perte, vol ou dégradation de plis ou d’objets remis au prestataire pour compte de l’Utilisateur, ce dernier autorisant le prestataire
à recevoir ces objets. Pour des raisons de sécurité, la valeur unitaire de ces colis ne pourra excéder 500 €. Il appartient à l’utilisateur de
prévoir la présence d’un membre de son équipe lors de la réception des colis. Le prestataire facturera la garde de ces objets au tarif en
vigueur, au-delà d’une journée de livraison.</p><br>
            <h5>3. OBLIGATIONS DE L'UTILISATEUR</h5>
            <h5>3.1. PAIEMENT :</h5>
            <p>Le règlement des factures de prestation s'effectue à réception de facture, et suivant le mode de règlement prévu aux conditions particulières.
A défaut de paiement des factures de prestations d'occupation, ou de prestations de services (téléphone, photocopies ou autres prestations)
au plus tard cinq jours ouvrés après l'émission de la facture, et 48 heures après l'envoi d'une lettre recommandée, le prestataire se réserve la
faculté de suspendre immédiatement ses prestations de services sans préjudice des dispositions contenues dans la clause résolutoire ciaprès et d'entreprendre toutes actions judiciaires.
En outre, un intérêt de retard de 1% par mois sera porté sur la facture suivante, et avec un minimum de 15 Euros, pour tout règlement n'étant
pas parvenu 5 jours ouvrés après la date de la facture. Conformément au décret n°2012-1115 du 2 octobre 2012, une indemnité forfaitaire de
40 € sera également facturée pour tout règlement n’étant pas parvenu 5 jours ouvrés après la date de la facture.</p>
            <h5>3.2. SUSPENSION DES PRESTATIONS :</h5>
            <p>La suspension de l'ensemble des prestations n'entraîne pas la résiliation du contrat, et particulièrement pas de la domiciliation qui ne peuvent
intervenir que par le jeu de la clause résolutoire. En cas de suspension du droit d'occupation et autres prestations, les effets, documents et
autres objets de l'utilisateur seront entreposés par le prestataire aux frais et risques de l'Utilisateur, et tenus à sa disposition.</p>
            <h5>3.3. CLAUSE RESOLUTOIRE :</h5>
            <p>Il est expressément convenu qu'à défaut de paiement d'une seule facture de prestation de domiciliation ou de remboursement de frais,
charges et prestations diverses, tels qu'ils peuvent être prévus aux conditions particulières du présent contrat ou en annexe au présent contrat
et qui en constituent l'accessoire ou du paiement d'un rappel de majoration du coût de la prestation de domiciliation, ainsi qu'en cas
d'inexécution d'une seule des conditions du présent contrat et après l'envoi d'une lettre recommandée avec accusé de réception ou d'un
commandement ou d'une sommation restés 10 jours calendaires infructueux, les présentes seront résiliées de plein droit, si bon semble au
prestataire. Dans ce cas également, le dépôt de garantie restera acquis au prestataire, à titre de clause pénale irréductible sans préjudice de
son droit au paiement des indemnités de prestation de domiciliation échues ou à paiement des indemnités de prestation de domiciliation
échues ou à échoir, y compris le mois commencé au moment de la sortie des lieux et sous réserve de tous autres dus, droits et actions.<br>
En outre, le prestataire informera deux mois après la mise en demeure, commandement ou sommation, le registre du commerce compétent
de ce que la société Utilisatrice n'aura plus son siège dans les lieux loués. Enfin, le prestataire cessera, dans le même délai, la distribution du
courrier destiné à l'utilisateur, qui sera retourné avec la mention "n'habite plus à l'adresse indiquée".</p>
            <h5>3.4. DEPOT DE GARANTIE :</h5>
            <p>L'utilisateur versera au plus tard à la date d’effet des présentes au prestataire un dépôt dont le montant est de 3 mois du sous-total A
Domiciliation des conditions particulières.<br>
En aucun cas l'utilisateur ne pourrait exiger que le prestataire impute les sommes versées à titre de dépôt au paiement de ses factures.<br>
Ce dépôt de garantie, non productif d'intérêts ne sera remboursé à l'utilisateur qu'après expiration du présent contrat, déduction faite de toutes
sommes dues au prestataire, et après présentation de l'extrait du Registre du Commerce et des Sociétés portant mention du transfert de siège
social, s'il y a lieu, ainsi que du quitus fiscal délivré par le centre des Impôts de l'utilisateur. Ce dépôt de garantie sera révisé à chaque révision
de prix et selon le même taux.</p>
            <h5>3.5. PERSONNEL DU PRESTATAIRE :</h5>
            <p>L'utilisateur s’interdit d’embaucher, pendant la durée du présent contrat et/ou 1 an après sa résiliation, tout salarié du prestataire ou de ses
filiales.<br>
Dans le cas où l’utilisateur ne respecterait pas cette obligation, il s’engage à dédommager le prestataire en lui versant une indemnité
forfaitaire et transactionnelle, égale à 6 mois de salaire brut du salarié embauché. Cette indemnité correspond au coût pour le prestataire du
recrutement et à la formation d’un nouveau collaborateur ayant la même fonction.</p>
            <h5>3.6. COMMUNICATION :</h5>
            <p>L'utilisateur autorise le prestataire à utiliser la raison sociale et les marques de l'utilisateur comme référence client dans tout type de
communication externe ou interne que le prestataire jugera bon de réaliser.</p>
            <h5>3.7. ATTRIBUTION DE JURIDICTION :</h5>
            <p>De convention expresse, il est convenu que seules les juridictions parisiennes seront compétentes en ce qui concerne les différends pouvant
surgir relativement à ce contrat. Dans tous les cas, la loi française, seule, sera applicable.</p><br>
            <h5>4. PROTECTION DES DONNEES PERSONNELLES</h5>
            <p>NOTA : Dans le présent article, les termes « nous » et « nos » signifient le prestataire tel que défini ci-dessus ; les termes « vous » et « vos »
signifient l’utilisateur tel que défini ci-dessus.<br>
Pour toute question ou démarche relatives à vos données personnelles, nous vous invitons à contacter notre responsable de traitement des
données (MULTIBURO SA) et notre délégué à la protection des données (M. Emmanuel CHAIZE) dont les coordonnées figurent sur notre site
www.multiburo.com rubrique Politique de confidentialité.<br>
Si vous êtes une entreprise, nous vous demandons, en conformité avec l’article 14 du Règlement Européen tel que défini ci-après, de bien
vouloir transmettre à vos collaborateurs bénéficiant de l’offre Multiburo la présente politique de confidentialité, également disponible sur
www.multiburo.com.<br><br>
Conformément à la loi Informatique et Liberté du 6 janvier 1978 modifiée et au règlement européen 2016/679 du 27 avril 2016 (ci-après, « le
Règlement Européen »), nous vous fournissons ci-après les informations requises au titre de l’article 13 du Règlement Européen.<br>
Dans le cadre de l’exécution du présent contrat de prestation de services et mise à disposition de bureau(x), nous sommes amenés à récolter
des données à caractère personnel vous concernant ou concernant vos collaborateurs bénéficiant de notre offre, et ce afin de pouvoir mener
à bien nos missions contractuelles. Ces données concernent principalement les nom, prénom, adresse, adresse e-mail, numéros de
téléphone et les données de vidéosurveillance.<br>
Ce traitement de données personnelles réalisé au titre de la signature du présent contrat est fait conformément à l’article 6 du Règlement
Européen ; ce traitement est nécessaire à l’exécution dudit contrat et a pour finalité la mise en oeuvre des prestations que vous nous confiez
en nous permettant d’avoir dans notre documentation administrative et informatique vos coordonnées de contact et d’identification et celles
de vos collaborateurs venant travailler dans nos centres d’affaires. Ces données nous permettent également de personnaliser l’ensemble
des services prévus dans l’offre Multiburo à laquelle vous contractez (badge d’accès au(x) centre(s), connexion internet, téléphonie, scan to
mail, etc.).<br>
Les destinataires ou catégories de destinataires des données à caractère personnel collectées au titre du présent contrat sont les
collaborateurs du groupe Multiburo.<br>
Les données visées au paragraphe précédent sont conservées pendant toute la durée de votre relation contractuelle avec le groupe Multiburo
; à l’expiration de cette relation contractuelle, ces données sont conservées pour une durée supplémentaire de dix années pour nos archives
et obligations légales et administratives.<br>
À tout moment, vous disposez du droit de demander au responsable de traitement, à savoir MULTIBURO SA, l’accès à vos données à
caractère personnel, la rectification ou l’effacement de celles-ci ou une limitation de leur traitement, ou le droit de vous opposer au traitement,
ou encore la portabilité de vos données. Ces droits sont exercés dans les cadres et limites du Règlement Européen.<br>
Nous précisons que nous pouvons ultérieurement être amenés à utiliser vos données à des fins de présentation de nos autres ou nouveaux
services, d’envoi de notre newsletter, d’invitation à des évènements ou de toute autre communication susceptible de vous intéresser. Vous
disposez dans ce cadre des droits énoncés au paragraphe précédent, et tout particulièrement d’un DROIT D’OPPOSITION.<br>
Le Règlement Européen vous permet d’introduire une réclamation auprès de l’autorité de contrôle compétente en la matière, qui est en
France la CNIL à PARIS.</p>
            <h5></h5>
            <p></p>


        </div>

    <?php require_once('php/chat_domiciliation.php')?>
    </div>
    
    <!-- END: Content-->

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
