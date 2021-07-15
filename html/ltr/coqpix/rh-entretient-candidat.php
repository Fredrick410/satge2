<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

// Si l'id de la candidature n'existe pas ou est non numerique on retourne a la liste des candidatures pour entretiens
if (isset($_GET['num']) and is_numeric($_GET['num'])) {
    $id = htmlspecialchars($_GET['num']);
} else {
    header('Location: rh-entretient-candidats.php');
}

// On recupere la candidature
$pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num AND statut="success"');
$pdoStt->bindValue(':num', $id);
$pdoStt->execute();
$candidature = $pdoStt->fetch(PDO::FETCH_ASSOC);

// Si la candidatures n'existe pas on retourne a la liste des candidatures pour entretiens
if (count($candidature) != 0) {
    $explode = explode(';', $candidature['key_candidat']);
    $idannonce = $explode[2];
    $pdoStt = $bdd->prepare('SELECT * FROM fiche_poste WHERE idannonce = :num');
    $pdoStt->bindValue(':num', $idannonce);
    $pdoStt->execute();
    $missions = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
}
else{
    header('Location: rh-entretient-candidats.php');
}

//print("<pre>".print_r($candidature,true)."</pre>");

$pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
$pdoSta->bindValue(':num', $_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
$pdoSta->execute();
$entreprise = $pdoSta->fetch();

// On associe les pays dont les mots sont compose d'accent, espaces ou tirets
$pays = array(
    'bielorussie' => 'Biélorussie',
    'bosnieHerzegovine' => 'Bosnie-Herzégovine',
    'bulgarie' => 'Bulgarie',
    'grece' => 'Grèce',
    'exRepubliqueYougoslaveDeMacedoine' => 'Ex-République Yougoslave de Macédoine',
    'norvege' => 'Norvège',
    'paysBas' => 'Pays-Bas',
    'royaumeUni' => 'Royaume-Uni',
    'saintMarin' => 'Saint-Marin',
    'serbieEtMontenegro' => 'Serbie-et-Monténégro',
    'slovenie' => 'Slovénie',
    'suede' => 'Suède',
    'republiqueTcheque' => 'République Tchèque',
    'afriqueDuSud' => 'Afrique Du Sud',
    'algerie' => 'Algérie',
    'benin' => 'Bénin',
    'capVert' => 'Cap-Vert',
    'republiqueCentre-Africaine' => 'République Centre-Africaine',
    'republiqueDemocratiqueDuCongo' => 'République Démocratique Du Congo',
    'coteIvoire' => 'Côte d\'Ivoire',
    'egypte' => 'Égypte',
    'ethiopie' => 'Éthiopie',
    'erythrée' => 'Érythrée',
    'guinee' => 'Guinée',
    'guinee-Bisseau' => 'Guinée-Bisseau',
    'guineeEquatoriale' => 'Guinée Équatoriale',
    'saoTomeEtPrincipe' => 'Sao Tomé-et-Principe',
    'senegal' => 'Sénégal',
    'sierraLeone' => 'Sierra Leone',
    'antiguaEtBarbuda' => 'Antigua-et-Barbuda',
    'belize' => 'Bélize',
    'bresil' => 'Brésil',
    'costaRica' => 'Costa Rica',
    'republiqueDominicaine' => 'République Dominicaine',
    'equateur' => 'Équateur',
    'etatsUnis' => 'États-Unis',
    'haiti' => 'Haïti',
    'jamaique' => 'Jamaïque',
    'perou' => 'Pérou',
    'saintCristopheEtNieves' => 'Saint-Cristophe-et-Niévès',
    'sainteLucie' => 'Sainte-Lucie',
    'saintVincentEtLesGrenadines' => 'Saint-Vincent-et-les-Grenadines',
    'triniteEtTobago' => 'Trinité-et-Tobago',
    'arabieSaoudite' => 'Arabie Saoudite',
    'armenie' => 'Arménie',
    'azerbaidjan' => 'Azerbaïdjan',
    'bahrein' => 'Bahreïn',
    'brunei' => 'Brunéi',
    'coreeDuSud' => 'Corée Du Sud',
    'coreeDuNord' => 'Corée Du Nord',
    'emiratsArabeUnis' => 'Émirats Arabe Unis',
    'georgie' => 'Géorgie',
    'indonesie' => 'Indonésie',
    'israel' => 'Israël',
    'koweit' => 'Koweït',
    'nepal' => 'Népal',
    'ouzbekistan' => 'Ouzbékistan',
    'sriLanka' => 'Sri Lanka',
    'taiwan' => 'Taïwan',
    'thailande' => 'Thaïlande',
    'timorOriental' => 'Timor oriental',
    'turkmenistan' => 'Turkménistan',
    'vietNam' => 'Viêt Nam',
    'micronesie' => ' Micronésie',
    'nouvelleZelande' => 'Nouvelle-Zélande',
    'papouasieNouvelleGuinee' => 'Papouasie-Nouvelle-Guinée'
);


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
    <title>Résultats de l'entretien - <?php if ($candidature['sexe_candidat'] == "homme") {
                                            echo "Mr";
                                        } else {
                                            echo "Mme";
                                        } ?> <?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == "light") {
                                                        echo "semi-";
                                                    } ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise["theme_web"] == "light") {
                                                                                                                                                                                                        echo "semi-";
                                                                                                                                                                                                    } ?>dark-layout">

    <!-- BEGIN: Header-->
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" onclick="retourn()" href="#" data-toggle="tooltip" data-placement="top" title="Retour">
                                    <div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div>
                                </a></li>
                        </ul>
                        <script>
                            function retourn() {
                                window.history.back();
                            }
                        </script>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>
                            <!--NOTIFICATION-->
                            <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                                <li class="dropdown-menu-header">
                                    <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title">0 Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                                </li>
                                <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                        <!-- CONTENUE ONE -->
                                    </a>
                                    <div class="d-flex justify-content-between cursor-pointer">
                                        <div class="media d-flex align-items-center border-0">
                                            <div class="media-left pr-0">
                                                <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
                                            </div>
                                            <div class="media-body">
                                                <h6 class="media-heading"><span class="text-bold-500">Nouveaux compte</span> création du compte</h6><small class="notification-text">Aujourd'hui, 19h30</small>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                                <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                            </ul>
                        </li>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php') ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app qcm View Page -->
                <div id="message">

                </div>
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- qcm view page -->
                        <div class="col-xl-12 col-md-8 col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Résultats de l'entretien de <?php if ($candidature['sexe_candidat'] == "homme") {
                                                                                            echo "Mr";
                                                                                        } else {
                                                                                            echo "Mme";
                                                                                        } ?> <?= $candidature['nom_candidat'] ?> <?= $candidature['prenom_candidat'] ?></h4>
                                </div>
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                        <form autocomplete="off" method="POST" id="form-entretien">
                                            <!-- product details table-->
                                            <div class="invoice-product-details ">
                                                <div class="form-group">
                                                    <label for="nom_candidat">Nom du candidat</label>
                                                    <input class="form-control" type="text" name="nom_candidat" id="nom_candidat" value="<?= $candidature['nom_candidat'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="prenom_candidat">Prénom du candidat</label>
                                                    <input class="form-control" type="text" name="prenom_candidat" id="prenom_candidat" value="<?= $candidature['prenom_candidat'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email_candidat">Adresse mail du candidat</label>
                                                    <input class="form-control" type="text" name="email_candidat" id="email_candidat" value="<?= $candidature['email_candidat'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="tel" class="col-form-label">Numéro de téléphone du candidat</label>
                                                    <input class="form-control" type="tel" name="tel" id="tel" value="<?= $candidature['tel_candidat'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="dtenaissance" class="col-form-label">Date de naissance du candidat</label>
                                                    <input class="form-control" type="date" name="dtenaissance" id="dtenaissance" value="<?= $candidature['dtenaissance_candidat'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="pays" class="col-form-label">Pays du candidat</label>
                                                    <input class="form-control" type="text" name="pays" id="pays" value="<?php if (isset($pays[$candidature['pays']])) {
                                                                                                                                echo $pays[$candidature['pays']];
                                                                                                                            } else {
                                                                                                                                echo ucfirst($candidature['pays']);
                                                                                                                            } ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="langue" class="col-form-label">Langues</label>
                                                    <input class="form-control" type="text" name="langue" id="langue" value="<?= $candidature['langue'] ?>" disabled>
                                                </div>
                                                <div class="form-group">
                                                    <label for="observations" class="col-form-label">Observations</label>
                                                    <textarea class="form-control" name="observations" id="observations" rows="15">
                                                    </textarea>
                                                </div>
                                                <div class="form-group" id="fiche-poste" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="col-form-label">Missions/compétences</label>
                                                        <?php
                                                        foreach ($missions as $key => $value) {
                                                        ?>
                                                            <div class="form-group">
                                                                <label for="mission<?= $key ?>"><?= $value['libelle'] ?></label>
                                                                <input type="checkbox" id="mission<?= $key ?>" name="missions[]">
                                                            </div>
                                                        <?php
                                                        }
                                                        ?>
                                                    </div>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="startdte">Date de prise de service</label>
                                                            <input type="date" name="startdte" id="startdte" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="enddte">Date de fin de service</label>
                                                            <input type="date" name="enddte" id="enddte" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <button name="accept" id="accept" type="button" value="accept" class="btn btn-primary col-12 btconf">Embaucher le candidat</button>
                                                <button name="refuse" id="refuse" type="button" value="refuse" class="btn btn-danger col-12 btconf">Refuser le candidat</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!-- invoice action  -->
                        </div>
                    </div>
                </section>
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
    <script>
        function addAlert(message, type) {
            if (type == "success") {
                $('#message').html(
                    '<div class="alert alert-success">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            } else {
                $('#message').html(
                    '<div class="alert alert-danger">' +
                    '<button type="button" class="close" data-dismiss="alert">' +
                    '&times;</button>' + message + '</div>');
            }
        }

        function getLabel(id) {
            return $("#" + id).parent().text().trim();
        }

        $(document).ready(function() {

            $("#accept").click(function() {
                var value = document.getElementById('accept').value;
                if (value == 'accept') {
                    document.getElementById('fiche-poste').style.display = "block";
                    document.getElementById('accept').innerHTML = "Confirmer";
                    document.getElementById('accept').value = "confirm";
                } else if (value == 'confirm') {
                    var labels = document.getElementsByTagName('label');
                    var observations = document.getElementById("observations").value;
                    var startdte = document.getElementById("startdte").value;
                    var enddte = document.getElementById("enddte").value;
                    var missions = [];
                    var checkboxes = document.querySelectorAll('input[type=checkbox]:checked');
                    if (checkboxes.length > 0) {
                        for (var i = 0; i < checkboxes.length; i++) {
                            missions.push(getLabel(checkboxes[i].id));
                        }
                    }
                    console.log(missions);
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/insert_employe.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            observations: observations,
                            missions: missions,
                            startdte: startdte,
                            enddte: enddte,
                            confirm: "confirm",
                            idcandidat: <?= $id ?>
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == "success") {
                                addAlert("Candidat embauché", "success");
                                window.setTimeout(function() {
                                    window.location.href = data.link;
                                }, 1000);
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                } else {
                    addAlert("Action inexistante", 'error');
                }
            });

            $("#startdte").change(function() {
                $('#enddte').attr('min', this.value);
            });

            $("#refuse").click(function() {
                var refuse = 'refuse';
                var pays = document.getElementById("pays").value;
                var observations = document.getElementById("observations").value;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/refuser_candidat.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        refuse: refuse,
                        pays: pays,
                        observations: observations,
                        idcandidat: <?= $id ?>
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            addAlert("Candidat refusé", "success");
                            window.setTimeout(function() {
                                window.location.href = data.link;
                            }, 1000);
                        } else {
                            addAlert(data.message, "error");
                        }
                    }
                });
            });
        });
    </script>
    <!-- END: Page JS-->
    <script src="script.js"></script>
    <!-- END: Page JS-->
    <!-- partial -->
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
    <script src="./script.js"></script>

    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>