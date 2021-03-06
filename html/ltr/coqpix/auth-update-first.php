<?php

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id'], PDO::PARAM_INT);
    
    $vrai = $pdoSta->execute();
    
    $entreprise = $pdoSta->fetch();

    $color = "";
    $erreur = "";

    if(isset($_POST['bt'])){

    $dir = "../../../src/img/"; // ex : $dir = "../image/logo";
    $target_file = $dir.basename($_FILES['FILES']['name']);
    $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
    if(move_uploaded_file($_FILES['FILES']['tmp_name'], $target_file)){

    $update = $bdd->prepare('UPDATE entreprise SET img_entreprise = ? WHERE id = ?');
    $update->execute(array(

            ($_FILES['FILES']['name']),
            ($_SESSION['id'])
            
    ));

            header('Location: auth-update-first.php');
            exit();

    }else{

       $erreur = "Format incorrecte";
       $color = "badge badge-light-danger badge-pill";

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
    <title>Première connexion</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/authentication.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern semi-dark-layout 2-columns  navbar-sticky footer-static menu-collapsed " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="semi-dark-layout">

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="h-auto card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Info Société</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center" id="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="false">
                                            <i class="bx bx-info-circle mr-25"></i><span class="d-none d-sm-block">Info Dirigeant</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">
                                        <!-- users edit media object start -->
                                        <form action="" method="POST" enctype="multipart/form-data">
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo entreprise" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Image de l'entreprise</h4>
                                                <div class="col-12 px-0 d-flex">
                                                    <input type="file" name="FILES" accept="image/png, image/jpg, image/jpeg" required>                                                   
                                                </div><label class="<?php echo $color; ?>"><?php echo $erreur; ?></label><br>
                                                <button type="submit" name="bt" class="btn btn-sm btn-primary mr-25">Sauvegarder</button>
                                            </div>
                                        </div>
                                        </form>
                                        <!-- users edit media object ends -->
                                        <!-- users edit account form start -->
                            <form action="php/edit_new_account.php" method="GET">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Nom de la société :</label>
                                                            <input name="nameentreprise" type="text" class="form-control" placeholder="Nom de la société" value="<?= $entreprise['nameentreprise'] ?>" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Numéros Siret :</label>
                                                            <input name="numerossiret" type="number" class="form-control" placeholder="N°Siret" value="000000000" required data-validation-required-message="Le nom d'entreprise est imcomplet">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Pays de la société :</label>
                                                            <div class="col-12 col-md-6 form-group">
                                                            <select name="pays_entreprise" class="form-control invoice-item-select">
                                                                <option></option>
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
                                                                <option value="senegal">Séngal</option>
                                                                <option value="seychelles">Seychelles</option>
                                                                <option value="sierra">Sierra</option>
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
                                                    </div>
                                                        <div class="controls">
                                                            <label>*Adresse siège social :</label>
                                                            <input name="adresseentreprise" type="text" class="form-control" placeholder="Adresse , ville , departement" required data-validation-required-message="L'adresse de la societe est obligatoire">
                                                        </div><br>
                                                        <label>Secteur d'activité :</label>
                                                        <fieldset class="invoice-address form-group">
                                                            <select name="descr_entreprise" class="form-control invoice-item-select">
                                                                <option value="Agroalimentaire">Agroalimentaire</option>
                                                                <option value="Bois / Papier / Carton / Imprimerie">Bois / Papier / Carton / Imprimerie</option>
                                                                <option value="Chimie / Parachimie">Chimie / Parachimie</option>
                                                                <option value="Électronique / Électricité">Électronique / Électricité</option>
                                                                <option value="Industrie pharmaceutique">Industrie pharmaceutique</option>
                                                                <option value="Machines et équipements / Automobile">Machines et équipements / Automobile</option>
                                                                <option value="Plastique / Caoutchouc">Plastique / Caoutchouc</option>
                                                                <option value="Textile / Habillement / Chaussure">Textile / Habillement / Chaussure</option>
                                                                <option value="Banque / Assurance">Banque / Assurance</option>
                                                                <option value="BTP / Matériaux de construction">BTP / Matériaux de construction</option>
                                                                <option value="Commerce / Négoce / Distribution">Commerce / Négoce / Distribution</option>
                                                                <option value="Édition / Communication / Multimédia">Édition / Communication / Multimédia</option>
                                                                <option value="Études et conseils">Études et conseils</option>
                                                                <option value="Informatique / Télécoms">Informatique / Télécoms</option>
                                                                <option value="Métallurgie / Travail du métal">Métallurgie / Travail du métal</option>
                                                                <option value="Transports / Logistique">Transports / Logistique</option>
                                                                <option value="Services aux entreprises">Services aux entreprises</option>
                                                                <option value="Autres">Autres</option>
                                                            </select>
                                                        </fieldset>
                                                        <div class="form-group">
                                                            <label>*Date de cloture :</label>
                                                            <input name="datedecloture" type="date" class="form-control" placeholder="" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <label>*Numéros de téléphone :</label>
                                                        <input name="telentreprise" type="number" class="form-control" placeholder="Numéros de téléphone de la société" required data-validation-required-message="Le numéros de la société est obligatoire">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Siteweb de la société :</label>
                                                        <input name="link_website" type="text" class="form-control" placeholder="www.monentreprise.fr">
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Email Societe (identifiant de connexion) :</label>
                                                            <input name="emailentreprise" type="email" class="form-control" placeholder="E-mail de la societe" value="<?= $_SESSION['email']; ?>" required data-validation-required-message="L'e-mail de la societe obligatoire" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Début d'activitée :</label>
                                                            <input name="datecreation" type="date" class="form-control" placeholder="jj-mm-aaaa" value="<?= $entreprise['datecreation'] ?>" maxlength="10" required data-validation-required-message="date de création importante">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>IBAN :</label>
                                                        <input name="iban_entreprise" type="text" class="form-control" placeholder="FR-" value="FR-">
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <aid="information-tab" data-toggle="tab" href="#information" aria-controls="information" role="tab" aria-selected="true"><label>Compléter les Infos Dirigeants</label></a>
                                                </div>
                                            </div>
                                        <!-- users edit account form ends -->
                                    </div>
                                    <div class="tab-pane fade show" id="information" aria-labelledby="information-tab" role="tabpanel">
                                        <!-- users edit Info form start -->
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <h5 class="mb-1"><i class="bx bx-link mr-25"></i>Information dirigeant</h5>
                                                    <div class="form-group">
                                                        <label>*Nom :</label>
                                                        <input name="nom_diri" class="form-control" type="text" placeholder="Nom du dirigeant" value="<?= $entreprise['nom_diri'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>*Prénom :</label>
                                                        <input name="prenom_diri" class="form-control" type="text" placeholder="Prénom du dirigeant" value="<?= $entreprise['prenom_diri'] ?>" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>Adresse :</label>
                                                        <input name="adresse_diri" class="form-control" type="text" placeholder="Adresse du dirigeant">
                                                    </div>
                                                    <div class="form-group">
                                                        <label>*Téléphone :</label>
                                                        <input name="tel_diri" class="form-control" type="text" placeholder="Téléphone du dirigeant" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <label>E-mail :</label>
                                                        <input name="email_diri" class="form-control" type="text" placeholder="E-mail du dirigeant">
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6 mt-1 mt-sm-0">

                                                                    <!-- PUBLICITER -->
                                                    
                                                </div>

                                                <input name="numentreprise" type="hidden" value="<?= $_SESSION['id']; ?>">

                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Continuer<i class='bx bx-right-arrow-alt'></i></button>
                                                </div>
                                                <label class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">Penser à compléter les champs obligatoires*</label>
                                            </div>
                            </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- users edit ends -->
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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
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