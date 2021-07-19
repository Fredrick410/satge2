<?php
error_reporting(E_ALL);
session_start();
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoSta = $bdd->prepare('SELECT * FROM rh_annonce WHERE id=:num');
$pdoSta->bindValue(':num', $_GET['num']);
$pdoSta->execute();
$annonce = $pdoSta->fetch();

if (isset($_POST['code_annonce'])) {

    $code = $_POST['code_annonce'];
    $name = $_GET['annonce'];

    $query = $bdd->prepare("SELECT * FROM rh_annonce WHERE code_annonce = :code");
    $query->bindValue(':code', $code);
    $query->execute();
    $count = $query->rowCount();

    if ($count >= 1) {
        $_SESSION['invite'] = $_GET['num'];

        header('Location: candidature-recrutement.php?' . $annonce['link'] . '$req=true');
        exit();
    } else {

        header('Location: candidature-recrutement.php?' . $annonce['link'] . '&req=false');
        exit();
    }
}

if ($annonce['code_annonce'] == "") {
    $locked = "red";
    $none_bts = "";
    $none_btd = "none-validation";
} else {
    if (empty($_SESSION['invite'])) {
        $locked = "red";
        $none_bts = "";
        $none_btd = "none-validation";
    } else {
        $locked = "green";
        $none_bts = "none-validation";
        $none_btd = "";
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
    <title>Annonce de recrutement</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-sticky 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns">
    <style>
        .none-validation {
            display: none;
        }

        ;
    </style>
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top navbar-brand-center" style="background-color: <?= $annonce['color_annonce'] ?>;">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="#">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="dropdown dropdown-user nav-item">
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <div class="dropdown-divider mb-0"></div><a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Se déconnecter</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="nav-item d-none d-lg-block"><a class="nav-link" style="cursor: pointer; font-size: 25px; color: <?= $locked ?>;" data-toggle="modal" data-target="#info"><i class='bx bxs-lock'></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->


    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper" style="padding: 0px; margin: 0px;">
            <div class="content-body">
                <div class="form-group">
                    &nbsp<button title="Permets d'avoir les permissions sur l'annonce de recrutement" type="button" class="btn btn-outline-success <?= $none_bts ?>" data-toggle="modal" data-target="#inlineForm">
                        <i class='bx bxs-lock-open'></i> Unlock
                    </button>
                    <a title="Permets d'avoir les permissions sur l'annonce de recrutement" href="php/disconnect_recrutement.php?num=<?= $_GET['num'] ?>"><button type="button" class="btn btn-outline-danger <?= $none_btd ?>" data-target="#inlineForm">
                            <i class='bx bxs-lock'></i> Lock
                        </button></a>
                    <!--login form Modal -->
                    <div class="modal fade text-left" id="inlineForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel33" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h4 class="modal-title" id="myModalLabel33">Code d'invitation </h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <i class="bx bx-x"></i>
                                    </button>
                                </div>
                                <form action="" method="POST">
                                    <div class="modal-body">
                                        <label>Nom Prenom : </label>
                                        <div class="form-group">
                                            <input type="text" name="nom_prenom" placeholder="DUPOND Jean" class="form-control">
                                        </div>
                                        <label>Code d'invitation : </label>
                                        <div class="form-group">
                                            <input type="password" name="code_annonce" placeholder="*****" class="form-control">
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light-danger" data-dismiss="modal">
                                            <i class="bx bx-x d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Fermer</span>
                                        </button>
                                        <button type="submit" class="btn" style="background-color: <?= $annonce['color_annonce'] ?>; color: white;">
                                            <i class="bx bx-check d-block d-sm-none"></i>
                                            <span class="d-none d-sm-block">Valider</span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="row">
                        <div class="col border-right">
                            <div class="form-group text-center">
                                <h5>Annonce N°<?= $annonce['id'] ?> - <?= $annonce['name_annonce'] ?> <p style="display: inline; color: <?php if ($annonce['statut'] == "actif") {
                                                                                                                                            echo "green";
                                                                                                                                        } else {
                                                                                                                                            echo 'red';
                                                                                                                                        } ?>;">(<?php if ($annonce['statut'] == "actif") {
                                                                                                                                                                                                                            echo "Actif";
                                                                                                                                                                                                                        } else {
                                                                                                                                                                                                                            echo 'En pause';
                                                                                                                                                                                                                        } ?>)</p>
                                </h5>
                            </div>
                            <div class="form-group" style="margin-left: 40px;">
                                <label>Description :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['description_annonce'] ?></p><br>
                                <label>E-mail de contact :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['email_annonce'] ?></p><br>
                                <label>Tel de contact :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['tel_annonce'] ?></p><br>
                                <label>Age requis :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['age'] ?></p><br>
                                <label>Poste à promouvoir :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['poste'] ?></p><br>
                                <label>Niveaux d'étude requis :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['niveau'] ?></p><br>
                                <label>Temps du recrutement :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['temps'] ?></p><br>
                                <label>Pays :</label> &nbsp&nbsp<p style="display: inline;"><?= $annonce['pays'] ?></p>
                                <hr>
                            </div>
                            <div class="form-group" style="margin-left: 40px;">
                                <p>L'interface recrutement de Coqpix permet aux deux partis (Candidat et Employeur) d'être plus organisé. <br>
                                    Avec cette fonctionnalité de Coqpix dits adieux aux pertes de temps suite au démarchage pour trouver votre
                                    employeur ou votre candidat.
                                </p>
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group border" style='width: 600px; height: 400px;'>
                                <img src="../../../src/img/candidature-img_one.jpg" class="img-fluid" alt="error img">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <hr>
                </div>
                <div class="form-group">
                    <div class="card-content mt-2">
                        <div class="card-body">
                            <form method="POST" action="php/insert_candidat.php?num=<?= htmlspecialchars($_GET['num']) ?>" class="wizard-horizontal">
                                <input type="hidden" name="id_session" value="<?= $annonce['id_session'] ?>">
                                <!-- Step 1 -->
                                <h6>
                                    <i class="step-icon"></i>
                                    <span class="fonticon-wrap">
                                        <i class="livicon-evo" data-options="name:morph-doc.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                    </span>
                                </h6>
                                <!-- Step 1 end-->
                                <!-- body content step 1 -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="py-50">Etape 1 - Entrez vos informations personnelles</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="firstName13">Nom de famille </label>
                                                <input name="nom_candidat" type="text" class="form-control" id="firstName13" placeholder="Nom de famille" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="lastName12">Prénom</label>
                                                <input name="prenom_candidat" type="text" class="form-control" id="lastName12" placeholder="Prénom" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="emailAddress1">Spécialité</label>
                                                <input name="specialite_candidat" type="text" class="form-control" id="emailAddress1" placeholder="Ma spécialité" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Age</label>
                                                <input name="age_candidat" type="number" class="form-control" placeholder="Exemple : 18 ans" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Adresse email</label>
                                                <input name="email_candidat" type="email" class="form-control" placeholder="bak@gmail.com" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Numéro de téléphone</label>
                                                <input name="tel_candidat" type="tel" class="form-control" placeholder="+33607258629" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Date de naissance</label>
                                                <input name="dtenaissance_candidat" type="date" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Pays</label>
                                                <select class="form-control" name="pays" id="pays">
                                                    <option value="">Selectionnez un pays</option>
                                                    <optgroup label="Europe">
                                                        <option value="allemagne">Allemagne</option>
                                                        <option value="albanie">Albanie</option>
                                                        <option value="andorre">Andorre</option>
                                                        <option value="autriche">Autriche</option>
                                                        <option value="bielorussie">Biélorussie</option>
                                                        <option value="belgique">Belgique</option>
                                                        <option value="bosnieHerzegovine">Bosnie-Herzégovine</option>
                                                        <option value="bulgarie">Bulgarie</option>
                                                        <option value="croatie">Croatie</option>
                                                        <option value="danemark">Danemark</option>
                                                        <option value="espagne">Espagne</option>
                                                        <option value="estonie">Estonie</option>
                                                        <option value="finlande">Finlande</option>
                                                        <option value="france">France</option>
                                                        <option value="grece">Grèce</option>
                                                        <option value="hongrie">Hongrie</option>
                                                        <option value="irlande">Irlande</option>
                                                        <option value="islande">Islande</option>
                                                        <option value="italie">Italie</option>
                                                        <option value="lettonie">Lettonie</option>
                                                        <option value="liechtenstein">Liechtenstein</option>
                                                        <option value="lituanie">Lituanie</option>
                                                        <option value="luxembourg">Luxembourg</option>
                                                        <option value="exRepubliqueYougoslaveDeMacedoine">Ex-République Yougoslave de Macédoine</option>
                                                        <option value="malte">Malte</option>
                                                        <option value="moldavie">Moldavie</option>
                                                        <option value="monaco">Monaco</option>
                                                        <option value="norvege">Norvège</option>
                                                        <option value="paysBas">Pays-Bas</option>
                                                        <option value="pologne">Pologne</option>
                                                        <option value="portugal">Portugal</option>
                                                        <option value="roumanie">Roumanie</option>
                                                        <option value="royaumeUni">Royaume-Uni</option>
                                                        <option value="russie">Russie</option>
                                                        <option value="saintMarin">Saint-Marin</option>
                                                        <option value="serbieEtMontenegro">Serbie-et-Monténégro</option>
                                                        <option value="slovaquie">Slovaquie</option>
                                                        <option value="slovenie">Slovénie</option>
                                                        <option value="suede">Suède</option>
                                                        <option value="suisse">Suisse</option>
                                                        <option value="republiqueTcheque">République Tchèque</option>
                                                        <option value="ukraine">Ukraine</option>
                                                        <option value="vatican">Vatican</option>
                                                    </optgroup>
                                                    <optgroup label="Afrique">
                                                        <option value="afriqueDuSud">Afrique Du Sud</option>
                                                        <option value="algerie">Algérie</option>
                                                        <option value="angola">Angola</option>
                                                        <option value="benin">Bénin</option>
                                                        <option value="botswana">Botswana</option>
                                                        <option value="burkina">Burkina</option>
                                                        <option value="burundi">Burundi</option>
                                                        <option value="cameroun">Cameroun</option>
                                                        <option value="capVert">Cap-Vert</option>
                                                        <option value="republiqueCentre-Africaine">République Centre-Africaine</option>
                                                        <option value="comores">Comores</option>
                                                        <option value="republiqueDemocratiqueDuCongo">République Démocratique Du Congo</option>
                                                        <option value="congo">Congo</option>
                                                        <option value="coteIvoire">Côte d'Ivoire</option>
                                                        <option value="djibouti">Djibouti</option>
                                                        <option value="egypte">Égypte</option>
                                                        <option value="ethiopie">Éthiopie</option>
                                                        <option value="erythrée">Érythrée</option>
                                                        <option value="gabon">Gabon</option>
                                                        <option value="gambie">Gambie</option>
                                                        <option value="ghana">Ghana</option>
                                                        <option value="guinee">Guinée</option>
                                                        <option value="guinee-Bisseau">Guinée-Bisseau</option>
                                                        <option value="guineeEquatoriale">Guinée Équatoriale</option>
                                                        <option value="kenya">Kenya</option>
                                                        <option value="lesotho">Lesotho</option>
                                                        <option value="liberia">Liberia</option>
                                                        <option value="libye">Libye</option>
                                                        <option value="madagascar">Madagascar</option>
                                                        <option value="malawi">Malawi</option>
                                                        <option value="mali">Mali</option>
                                                        <option value="maroc">Maroc</option>
                                                        <option value="maurice">Maurice</option>
                                                        <option value="mauritanie">Mauritanie</option>
                                                        <option value="mozambique">Mozambique</option>
                                                        <option value="namibie">Namibie</option>
                                                        <option value="niger">Niger</option>
                                                        <option value="nigeria">Nigeria</option>
                                                        <option value="ouganda">Ouganda</option>
                                                        <option value="rwanda">Rwanda</option>
                                                        <option value="saoTomeEtPrincipe">Sao Tomé-et-Principe</option>
                                                        <option value="senegal">Sénégal</option>
                                                        <option value="seychelles">Seychelles</option>
                                                        <option value="sierraLeone">Sierra Leone</option>
                                                        <option value="somalie">Somalie</option>
                                                        <option value="soudan">Soudan</option>
                                                        <option value="swaziland">Swaziland</option>
                                                        <option value="tanzanie">Tanzanie</option>
                                                        <option value="tchad">Tchad</option>
                                                        <option value="togo">Togo</option>
                                                        <option value="tunisie">Tunisie</option>
                                                        <option value="zambie">Zambie</option>
                                                        <option value="zimbabwe">Zimbabwe</option>
                                                    </optgroup>
                                                    <optgroup label="Amérique">
                                                        <option value="antiguaEtBarbuda">Antigua-et-Barbuda</option>
                                                        <option value="argentine">Argentine</option>
                                                        <option value="bahamas">Bahamas</option>
                                                        <option value="barbade">Barbade</option>
                                                        <option value="belize">Belize</option>
                                                        <option value="bolivie">Bolivie</option>
                                                        <option value="bresil">Brésil</option>
                                                        <option value="canada">Canada</option>
                                                        <option value="chili">Chili</option>
                                                        <option value="colombie">Colombie</option>
                                                        <option value="costaRica">Costa Rica</option>
                                                        <option value="cuba">Cuba</option>
                                                        <option value="republiqueDominicaine">République Dominicaine</option>
                                                        <option value="dominique">Dominique</option>
                                                        <option value="equateur">Équateur</option>
                                                        <option value="etatsUnis">États Unis</option>
                                                        <option value="grenade">Grenade</option>
                                                        <option value="guatemala">Guatemala</option>
                                                        <option value="guyana">Guyana</option>
                                                        <option value="haiti">Haïti</option>
                                                        <option value="honduras">Honduras</option>
                                                        <option value="jamaique">Jamaïque</option>
                                                        <option value="mexique">Mexique</option>
                                                        <option value="nicaragua">Nicaragua</option>
                                                        <option value="panama">Panama</option>
                                                        <option value="paraguay">Paraguay</option>
                                                        <option value="perou">Pérou</option>
                                                        <option value="saintCristopheEtNieves">Saint-Cristophe-et-Niévès</option>
                                                        <option value="sainteLucie">Sainte-Lucie</option>
                                                        <option value="saintVincentEtLesGrenadines">Saint-Vincent-et-les-Grenadines</option>
                                                        <option value="salvador">Salvador</option>
                                                        <option value="suriname">Suriname</option>
                                                        <option value="triniteEtTobago">Trinité-et-Tobago</option>
                                                        <option value="uruguay">Uruguay</option>
                                                        <option value="venezuela">Venezuela</option>
                                                    </optgroup>
                                                    <optgroup label="Asie">
                                                        <option value="afghanistan">Afghanistan</option>
                                                        <option value="arabieSaoudite">Arabie Saoudite</option>
                                                        <option value="armenie">Arménie</option>
                                                        <option value="azerbaidjan">Azerbaïdjan</option>
                                                        <option value="bahrein">Bahreïn</option>
                                                        <option value="bangladesh">Bangladesh</option>
                                                        <option value="bhoutan">Bhoutan</option>
                                                        <option value="birmanie">Birmanie</option>
                                                        <option value="brunei">Brunéi</option>
                                                        <option value="cambodge">Cambodge</option>
                                                        <option value="chine">Chine</option>
                                                        <option value="coreeDuSud">Corée Du Sud</option>
                                                        <option value="coreeDuNord">Corée Du Nord</option>
                                                        <option value="emiratsArabeUnis">Émirats Arabe Unis</option>
                                                        <option value="georgie">Géorgie</option>
                                                        <option value="inde">Inde</option>
                                                        <option value="indonesie">Indonésie</option>
                                                        <option value="iraq">Iraq</option>
                                                        <option value="iran">Iran</option>
                                                        <option value="israel">Israël</option>
                                                        <option value="japon">Japon</option>
                                                        <option value="jordanie">Jordanie</option>
                                                        <option value="kazakhstan">Kazakhstan</option>
                                                        <option value="kirghistan">Kirghistan</option>
                                                        <option value="koweit">Koweït</option>
                                                        <option value="laos">Laos</option>
                                                        <option value="liban">Liban</option>
                                                        <option value="malaisie">Malaisie</option>
                                                        <option value="maldives">Maldives</option>
                                                        <option value="mongolie">Mongolie</option>
                                                        <option value="nepal">Népal</option>
                                                        <option value="oman">Oman</option>
                                                        <option value="ouzbekistan">Ouzbékistan</option>
                                                        <option value="pakistan">Pakistan</option>
                                                        <option value="philippines">Philippines</option>
                                                        <option value="qatar">Qatar</option>
                                                        <option value="singapour">Singapour</option>
                                                        <option value="sriLanka">Sri Lanka</option>
                                                        <option value="syrie">Syrie</option>
                                                        <option value="tadjikistan">Tadjikistan</option>
                                                        <option value="taiwan">Taïwan</option>
                                                        <option value="thailande">Thaïlande</option>
                                                        <option value="timorOriental">Timor oriental</option>
                                                        <option value="turkmenistan">Turkménistan</option>
                                                        <option value="turquie">Turquie</option>
                                                        <option value="vietNam">Viêt Nam</option>
                                                        <option value="yemen">Yemen</option>
                                                    </optgroup>
                                                    <optgroup label="Océanie">
                                                        <option value="australie">Australie</option>
                                                        <option value="fidji">Fidji</option>
                                                        <option value="kiribati">Kiribati</option>
                                                        <option value="marshall">Marshall</option>
                                                        <option value="micronesie">Micronésie</option>
                                                        <option value="nauru">Nauru</option>
                                                        <option value="nouvelleZelande">Nouvelle-Zélande</option>
                                                        <option value="palaos">Palaos</option>
                                                        <option value="papouasieNouvelleGuinee">Papouasie-Nouvelle-Guinée</option>
                                                        <option value="salomon">Salomon</option>
                                                        <option value="samoa">Samoa</option>
                                                        <option value="tonga">Tonga</option>
                                                        <option value="tuvalu">Tuvalu</option>
                                                        <option value="vanuatu">Vanuatu</option>
                                                    </optgroup>
                                                    <optgroup label="Autres pays">
                                                        <option value="Autres">Autres</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Nom de l'annonce</label>
                                                <input name="name_annonce" type="text" class="form-control" placeholder="Nom de l'annonce" value="<?= $annonce['name_annonce'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Durée</label>
                                                <input name="time_candidat" type="texts" class="form-control" placeholder="1 mois" value="<?= $annonce['temps'] ?>" readonly>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="d-block">Sexe</label>
                                                <div class="custom-control-inline">
                                                    <div class="radio mr-1">
                                                        <input type="radio" name="sexe_candidat" id="radio1" value="homme" checked>
                                                        <label for="radio1">Homme</label>
                                                    </div>
                                                    <div class="radio">
                                                        <input type="radio" name="sexe_candidat" value="femme" id="radio2">
                                                        <label for="radio2">Femme</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- body content step 1 end-->
                                <!-- Step 2 -->
                                <h6>
                                    <i class="step-icon"></i>
                                    <span class="fonticon-wrap">
                                        <i class="livicon-evo" data-options="name:truck.svg; size: 50px; style:lines; strokeColor:#adb5bd;"></i>
                                    </span>
                                </h6>
                                <!-- Step 2 end-->
                                <!-- body content of step 2 -->
                                <fieldset>
                                    <div class="row">
                                        <div class="col-12">
                                            <h6 class="py-50">Etape 2 - Entrez vos compétances</h6>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Logiciels</label>
                                                <input name="logiciel" type="text" class="form-control" placeholder="Ex: PhotoShop, VisualStudio, Paint" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Langue</label>
                                                <input name="langue" type="text" class="form-control" placeholder="Ex: Anglais, Francais, Espagnol" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Formation&Etude</label>
                                                <input name="formationetude" type="text" class="form-control" placeholder="Ex: DUT commerce, BAC+5" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Mes intéret</label>
                                                <input name="interet" type="text" class="form-control" placeholder="Mes intérets" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Mes qualitées</label>
                                                <input name="qualite" type="text" class="form-control" placeholder="Mes qualités" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Mes defaults</label>
                                                <input name="default" type="text" class="form-control" placeholder="Mes defauts" required>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="permis_conduite">types de permis </label>
                                                <select name="permis_conduite" id="permis_conduite" class="custom-select">
                                                    <option value="" selected>Selectionnez un type de permis de conduite</option>
                                                    <option value="A">A</option>
                                                    <option value="A1">A1</option>
                                                    <option value="A2">A2</option>
                                                    <option value="B">B</option>
                                                    <option value="B1">B1</option>
                                                    <option value="B2">B2</option>
                                                    <option value="BE">BE</option>
                                                    <option value="C1">C1</option>
                                                    <option value="C2">C2</option>
                                                    <option value="CE">CE</option>
                                                    <option value="C1E">C1E</option>
                                                    <option value="D">D</option>
                                                    <option value="D1">D1</option>
                                                    <option value="D2">D2</option>
                                                    <option value="D1E">D1E</option>
                                                    <option value="DE">DE</option>
                                                    <option value="AM">AM</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- body content of step 2 end-->
                                <!-- body content of Step 3 -->
                                <div class="form-group">
                                    <button type="submit" class="btn btn-outline-success round col-12">Continue</button>
                                </div>
                                <!-- body content of Step 3 end-->
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/modal/components-modal.js"></script>
    <script src="../../../app-assets/js/scripts/forms/wizard-steps.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>