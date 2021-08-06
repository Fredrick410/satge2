<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoS->execute();
    $entreprise = $pdoS->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM images WHERE id = :num');
    $pdoSt->bindValue(':num',"1");
    $pdoSt->execute();
    $image = $pdoSt->fetchAll();

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
    <title>Ajouter des membres</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/page-users.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    </div>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- users edit start -->
                <section class="users-edit">
                    <div class="card">
                        <div class="card-content">
                            <div class="card-body">
                                <ul class="nav nav-tabs mb-2" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link d-flex align-items-center active" id="account-tab" data-toggle="tab" href="#account" aria-controls="account" role="tab" aria-selected="true">
                                            <i class="bx bx-user mr-25"></i><span class="d-none d-sm-block">Compte membre</span>
                                        </a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active fade show" id="account" aria-labelledby="account-tab" role="tabpanel">

                                        <!-- <form action="php/insert_images_members.php" method="POST" enctype="multipart/form-data">
                                        <div class="media mb-2">
                                            <a class="mr-2" href="#">
                                                <img src="../../../src/img/<?php foreach($image as $images): ?><?= $images['images'] ?><?php endforeach; ?>" alt="users avatar" class="users-avatar-shadow rounded-circle" height="64" width="64">
                                            </a>
                                            <div class="media-body">
                                                <h4 class="media-heading">Image du membre</h4>
                                                <input type="file" name="images" accept="image/png, image/jpg, image/jpeg"><br>
                                                <input type="hidden" name="name_entreprise" value="<?php foreach($entrepri as $entreprise): ?><?= $entreprise['nameentreprise'] ?><?php endforeach; ?>">
                                                
                                                <br>
                                                <div class="col-12 px-0 d-flex">
                                                    <input type="submit" value="Sauvegarder" class="btn btn-sm btn-primary mr-25">
                                                    <a href="php/reset_images.php" class="btn btn-sm btn-light-secondary">Réinitialiser</a>
                                                </div>
                                            </div>
                                        </div>
                                        </form> -->

                                        <!-- users edit account form start -->
                                        <form action="php/insert_membre.php" method="POST" novalidate>
                                        <input type="hidden" name="img_membre" value="astro4.gif">
                                        <input type="hidden" name="entreprise" value="<?= $entreprise['nameentreprise'] ?>">
                                            <div class="row">
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Nom :</label>
                                                            <input name="nom" type="text" class="form-control" placeholder="Nom du membre" required data-validation-required-message="Nom obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Prénom :</label>
                                                            <input name="prenom" type="text" class="form-control" placeholder="Prénom du membre" required data-validation-required-message="Prénom obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Pays :</label>
                                                            <select name="pays" class="form-control invoice-item-select">
                                                                <option></option>
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
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Langue :</label>
                                                            <input type="text" name="langue" langue class="form-control" placeholder="" required data-validation-required-message="Langue obligatoire">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12 col-sm-6">
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Téléphone :</label>
                                                            <input type="text" name="tel" class="form-control" placeholder="06.00.00.00.00" required data-validation-required-message="Numéros de télephone obligatoire ">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*E-mail :</label>
                                                            <input type="email" name="email" class="form-control" placeholder="Membre@contact.fr" required data-validation-required-message="Email obligatoire">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>Date de naissance :</label>
                                                            <input type="date" name="dtenaissance" class="form-control" placeholder="jj-mm-aa">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="controls">
                                                            <label>*Nom de l'entreprise :</label>
                                                            <input type="text" name="name_entreprise" class="form-control" value="<?= $entreprise['nameentreprise'] ?>" placeholder="Mon entreprise" required data-validation-required-message="Nom de l'entreprise obligatoire">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-12">
                                                    <div class="table-responsive">
                                                        <table class="table mt-1">
                                                            <thead>
                                                                <tr>
                                                                    <th>Module de permission</th>
                                                                    <th>Ventes</th>
                                                                    <th>Achats</th>
                                                                    <th>Projets</th>
                                                                    <th>Inventaires</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <tr>
                                                                    <td>Lire</td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_ventes" value="view" type="checkbox" id="users-checkbox5" class="checkbox-input"><label for="users-checkbox5"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_achats" value="view" type="checkbox" id="users-checkbox6" class="checkbox-input">
                                                                            <label for="users-checkbox6"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_projets" value="view" type="checkbox" id="users-checkbox7" class="checkbox-input"><label for="users-checkbox7"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_inventaires" value="view" type="checkbox" id="users-checkbox8" class="checkbox-input">
                                                                            <label for="users-checkbox8"></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Ecrire</td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_ventes" value="write" type="checkbox" id="users-checkbox9" class="checkbox-input">
                                                                            <label for="users-checkbox9"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_achats" value="write" type="checkbox" id="users-checkbox10" class="checkbox-input">
                                                                            <label for="users-checkbox10"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_projets" value="write" type="checkbox" id="users-checkbox11" class="checkbox-input"><label for="users-checkbox11"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_inventaires" value="write" type="checkbox" id="users-checkbox12" class="checkbox-input"><label for="users-checkbox12"></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>Tout</td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_ventes" value="all" type="checkbox" id="users-checkbox1" class="checkbox-input">
                                                                            <label for="users-checkbox1"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_achats" value="all" type="checkbox" id="users-checkbox2" class="checkbox-input"><label for="users-checkbox2"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_projets" value="all" type="checkbox" id="users-checkbox3" class="checkbox-input"><label for="users-checkbox3"></label>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <div class="checkbox"><input name="perms_inventaires" value="all" type="checkbox" id="users-checkbox4" class="checkbox-input">
                                                                            <label for="users-checkbox4"></label>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="col-12 d-flex flex-sm-row flex-column justify-content-end mt-1">
                                                    <input type="hidden" name="role_membres" value="Employer">
                                                    <button type="submit" class="btn btn-primary glow mb-1 mb-sm-0 mr-0 mr-sm-1">Sauvegarder</button>
                                                    <a href="membres-list.php"><button type="submit" class="btn btn-light">Annuler</button></a>
                                                </div>
                                            </div>
                                        </form>
                                        <!-- users edit account form ends -->
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
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jqBootstrapValidation.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/page-users.js"></script>
    <script src="../../../app-assets/js/scripts/navs/navs.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>