<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect.php';

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id']);
$true = $pdoS->execute();
$entreprise = $pdoS->fetch();

// On recupere les qcms publies par coqpix ou par le client
$pdoS = $bdd->prepare('SELECT * FROM qcm WHERE publiee = "oui" AND auteur="Auditactionplus"');
$true = $pdoS->execute();
$qcms_back = $pdoS->fetchAll(PDO::FETCH_ASSOC);

$pdoS = $bdd->prepare('SELECT * FROM qcm WHERE publiee = "oui" AND auteur=(SELECT nameentreprise FROM entreprise WHERE id = :id)');
$pdoS->bindValue(':id', $_SESSION['id']);
$true = $pdoS->execute();
$qcms_front = $pdoS->fetchAll(PDO::FETCH_ASSOC);

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
    <title>RH - Recrutement</title>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/forms/wizard.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

    <style>
        .red {
            color: red;
        }

        .line {
            text-decoration: underline;
        }
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == "light") {
                                                        echo "semi-";
                                                    } ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise["theme_web"] == "light") {
                                                                                                                                                                                                        echo "semi-";
                                                                                                                                                                                                    } ?>dark-layout">

    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div id="message">

            </div>
            <!-- vertical Wizard start-->
            <section id="vertical-wizard">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Votre annonce de recrutement</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="wizard-horizontal">
                                <!-- step 1 -->
                                <h1>
                                    <span class="icon-title">
                                        <span class="d-block">Détails de l'annonce</span>
                                    </span>
                                </h1>
                                <!-- step 1 end-->
                                <!-- step 1 content -->
                                <fieldset class="pt-0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="name_annonce">Nom de l'annonce </label>
                                                    <input id="name_annonce" type="text" name="name_annonce" class="form-control" placeholder="Entrez le nom de votre annonce" required>
                                                    <small class="text-muted form-text">Entrez votre nom d'annonce s'il vous plait.</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="description_annonce">Description de l'annonce </label>
                                                    <textarea id="description_annonce" cols="30" rows="11" name="description_annonce" class="form-control" placeholder="Description de l'annonce"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label>Thème de l'annonce</label><br>
                                                    <div id="picker" class="d-flex justify-content-center">
                                                    </div>
                                                    <input type="hidden" id="color_annonce" name="color_annonce" value="#ffffff">
                                                    <small class="text-muted form-text">Selectionnez une couleur pour définir un thème à votre annonce de recrutement.</small>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="email_annonce">E-mail de contact</label>
                                                    <input id="email_annonce" type="email" name="email_annonce" class="form-control" placeholder="Entrez votre mail" required>
                                                    <small class="text-muted form-text">Veuillez saisir votre adresse e-mail.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="tel_annonce">Téléphoneeeeeeeeeeeeeee de contact</label>
                                                    <input id="tel_annonce" type="tel" name="tel_annonce" class="form-control" placeholder="+33600000000" required>
                                                    <small class="text-muted form-text">Veuillez entrer votre numéro de téléphone.</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="image">Photo du candidat</label>
                                                    <select id="image" name="image" class="form-control">
                                                        <option value="oui">Obligatoire</option>
                                                        <option value="non" selected>Facutatif</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <label>Type de contract</label>
                                                <div class="form-check form-group">

                                                    <div>
                                                        <input type="checkbox" value="CDI" class="form-check-input" name="type_contrat[]">
                                                        <label>CDI</label>

                                                    </div>
                                                    <div>
                                                        <input type="checkbox" value="CDD" class="form-check-input" name="type_contrat[]">
                                                        <label>CDD</label>

                                                    </div>
                                                    <div>
                                                        <input type="checkbox" value="Contrat d'Apprentisage" class="form-check-input" name="type_contrat[]">
                                                        <label>Contrat d'appentisage</label>

                                                    </div>
                                                    <div>
                                                        <input type="checkbox" value="Contrat d'Alternance" class="form-check-input" name="type_contrat[]">
                                                        <label>Contrat d'Alternance</label>

                                                    </div>
                                                    <div>
                                                        <input type="checkbox" value="Temps plein" class="form-check-input" name="type_contrat[]">
                                                        <label>Temps plein</label>

                                                    </div>
                                                    <div>
                                                        <input type="checkbox" value="Temps partiel" class="form-check-input" name="type_contrat[]">
                                                        <label>Temps partiel</label>

                                                    </div>

                                                </div>
                                                <small class="text-muted form-text">Veuillez cocher le ou les type(s) de contrat.</small>
                                            </div>
                                        </div>
                                    </div>

                                </fieldset>
                                <!-- step 1 content end-->
                                <!-- step 2 -->
                                <h1>
                                    <span class="icon-title">
                                        <span class="d-block">Profil des candidats</span>
                                    </span>
                                </h1>
                                <!-- step 2 end-->
                                <!-- step 2 content -->
                                <fieldset class="pt-0">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="age_annonce">Age du candidat</label>
                                                <select id="age_annonce" name="age_annonce" class="form-control">
                                                    <option value="Pas d'age limite" selected>Selectionnez un age</option>
                                                    <option value="14 - 16">14 - 16 ans</option>
                                                    <option value="16 - 18">16 - 18 ans</option>
                                                    <option value="18 - 20">18 - 25 ans</option>
                                                    <option value="20 - +">25 ans et plus</option>
                                                    <option value="Age indéterminé">Age indéterminé</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="niveau_annonce">Niveau d'étude</label>
                                                <select id="niveau_annonce" name="niveau_annonce" class="form-control">
                                                    <option value="Aucun niveau">Selectionnez un niveau d'étude</option>
                                                    <option value="Niveau 1 et 2">Niveau 1 et 2</option>
                                                    <option value="Niveau 3">Niveau 3</option>
                                                    <option value="Niveau 4 (BAC +0)">Niveau 4 (BAC +0)</option>
                                                    <option value="Niveau 5 (BAC +2)">Niveau 5 (BAC +2)</option>
                                                    <option value="Niveau 6 (BAC +3)">Niveau 6 (BAC +3)</option>
                                                    <option value="Niveau 7 (BAC +5)">Niveau 7 (BAC +5)</option>
                                                    <option value="Niveau 8 (BAC +8 et plus)">Niveau 8 (BAC +8 et plus)</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="poste_annonce">Poste du candidat</label>
                                                <input id="poste_annonce" type="text" name="poste_annonce" class="form-control" placeholder="exemple(Informaticien, comptable)">
                                            </div>
                                            <div class="form-group">
                                                <label for="pays_annonce">Pays</label>
                                                <select id="pays_annonce" class="form-control" name="pays_annonce">
                                                    <option value="France" selected>France</option>
                                                    <option value="Etranger">Etranger</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label>Durée d'embauche minimum</label>
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <select id="date_y" name="date_y" class="form-control">
                                                                    <option value="0" selected>0</option>
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="5">5</option>
                                                                    <option value="6">6</option>
                                                                    <option value="7">7</option>
                                                                    <option value="8">8</option>
                                                                    <option value="9">9</option>
                                                                    <option value="10+">10 ou plus</option>
                                                                </select>
                                                            </div>
                                                            <div class="col">
                                                                <label style="position: relative; top: 10px;">Années</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input id="date_m" type="number" name="date_m" class="form-control" value="0">
                                                            </div>
                                                            <div class="col">
                                                                <label style="position: relative; top: 10px;">Mois</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col">
                                                        <div class="row">
                                                            <div class="col">
                                                                <input id="date_d" type="number" name="date_d" class="form-control" value="0">
                                                            </div>
                                                            <div class="col">
                                                                <label style="position: relative; top: 10px;">Jours</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- step 2 content end-->
                                <!-- step 3 -->
                                <h1>
                                    <span class="icon-title">
                                        <span class="d-block">Qcm Généraux</span>
                                    </span>
                                </h1>
                                <!-- step 3 end-->
                                <!-- step 3 content -->
                                <fieldset class="pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <?php
                                                if (count($qcms_back) == 0) {
                                                ?>
                                                    <p>Aucun pour le moment</p>
                                                <?php
                                                }
                                                foreach ($qcms_back as $key => $value) {
                                                ?>
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0"><?= $value['libelle'] ?></p>
                                                        <input type="checkbox" name="qcms[]" class="custom-control-input" id="customSwitch<?= $value['id'] ?>" value="<?= $value['id'] ?>">
                                                        <label class="custom-control-label" for="customSwitch<?= $value['id'] ?>">
                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                            <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- step 3 content end -->
                                <!-- step 4 -->
                                <h1>
                                    <span class="icon-title">
                                        <span class="d-block">Nos qcm</span>
                                    </span>
                                </h1>
                                <!-- step 4 end-->
                                <!-- step 4 content -->
                                <fieldset class="pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="d-flex justify-content-start flex-wrap">
                                                <?php
                                                if (count($qcms_front) == 0) {
                                                ?>
                                                    <p>Aucun pour le moment</p>
                                                <?php
                                                }
                                                foreach ($qcms_front as $key => $value) {
                                                ?>
                                                    <div class="custom-control custom-switch custom-switch-success mr-2 mb-1">
                                                        <p class="mb-0"><?= $value['libelle'] ?></p>
                                                        <input type="checkbox" name="qcms[]" class="custom-control-input" id="customSwitch<?= $value['id'] ?>" value="<?= $value['id'] ?>">
                                                        <label class="custom-control-label" for="customSwitch<?= $value['id'] ?>">
                                                            <span class="switch-icon-left"><i class="bx bx-check"></i></span>
                                                            <span class="switch-icon-right"><i class="bx bx-check"></i></span>
                                                        </label>
                                                    </div>
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- step 4 content end-->
                                <!-- step 5 -->
                                <h1>
                                    <span class="icon-title">
                                        <span class="d-block">Fiche de poste</span>
                                    </span>
                                </h1>
                                <!-- step 5 end -->
                                <!-- step 5 content -->
                                <fieldset class="pt-0">
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group">
                                                <div class="border rounded mb-1">
                                                    <div class="col-12 form-group">
                                                        <label for="mission">Mission ou compétence</label>
                                                        <input name="mission" id="mission" type="text" class="form-control" placeholder="Faire ... ">
                                                    </div>
                                                    <div class="col-12 form-group">
                                                        <div class="col p-0">
                                                            <button id="button_send" class="btn btn-light-primary btn-sm" type="button">
                                                                <i class="bx bx-plus"></i>
                                                                <span class="invoice-repeat-btn">Ajouter la mission/compétence</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="col-form-label">Liste des missions/compétences</label>
                                                <table id="table" class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Libellé de la mission/compétence</th>
                                                            <th></th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </fieldset>
                                <!-- step 5 content end -->
                            </form>
                        </div>
                    </div>
                </div>
            </section>
            <!-- vertical Wizard end-->
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
    <script src="../../../app-assets/vendors/js/extensions/jquery.steps.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/iro.min.js"></script>
    <script src="../../../app-assets/vendors/js/forms/validation/jquery.validate.min.js"></script>
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
        function submit() {

            var lastRowId = $('#table tr:last').attr("id"); /*finds id of the last row inside table*/
            var missions = new Array();
            for (var i = 1; i <= lastRowId; i++) {
                if ($("#" + "mission" + i).html() !== undefined)
                    missions.push($("#" + "mission" + i).html());
            }

            var name_annonce = document.getElementById("name_annonce").value;
            var color_annonce = document.getElementById("color_annonce").value;
            var description_annonce = document.getElementById("description_annonce").value;
            var email_annonce = document.getElementById("email_annonce").value;
            var tel_annonce = document.getElementById("tel_annonce").value;
            var age_annonce = document.getElementById("age_annonce").value;
            var niveau_annonce = document.getElementById("niveau_annonce").value;
            var poste_annonce = document.getElementById("poste_annonce").value;
            var pays_annonce = document.getElementById("pays_annonce").value;
            var date_y = document.getElementById("date_y").value;
            var date_m = document.getElementById("date_m").value;
            var date_d = document.getElementById("date_d").value;
            var image = document.getElementById("image").value;
            var valid = 0;
            var qcms = [];
            var checkboxes = document.querySelectorAll('input[name="qcms[]"]:checked');

            if (checkboxes.length > 0) {
                for (var i = 0; i < checkboxes.length; i++) {
                    qcms.push(checkboxes[i].value);
                }
                console.log(qcms);
            }

            var type_contrat = [];
            checkboxes = document.querySelectorAll('input[name="type_contrat[]"]:checked');

            if (checkboxes.length > 0) {
                for (var i = 0; i < checkboxes.length; i++) {
                    type_contrat.push(checkboxes[i].value);
                }
                console.log(type_contrat);
            }


            if (qcms.length != 0) {
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_rh_annonce.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        missions: missions,
                        name_annonce: name_annonce,
                        color_annonce: color_annonce,
                        description_annonce: description_annonce,
                        email_annonce: email_annonce,
                        tel_annonce: tel_annonce,
                        age_annonce: age_annonce,
                        niveau_annonce: niveau_annonce,
                        poste_annonce: poste_annonce,
                        pays_annonce: pays_annonce,
                        date_y: date_y,
                        date_m: date_m,
                        date_d: date_d,
                        qcms: qcms,
                        type_contrat: type_contrat,
                        image: image
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            addAlert("Annonce ajoutée", "success");
                            window.setTimeout(function() {
                                window.location.href = data.link;
                            }, 1000);
                        } else {
                            addAlert(data.message, "error");
                        }
                    },
                    error: function(data) {
                        addAlert(data.message, "error");
                    }
                });
            } else {
                addAlert("Merci de choisir au moins un qcm", "error");
            }
        }

        var colorPicker = new iro.ColorPicker('#picker', {
            // Set the size of the color picker
            width: 200,
            color: "#ffffff"
        });
        colorPicker.on('color:change', function(color) {
            document.getElementById('color_annonce').value = color.hexString;
        });

        function htmlEntities(str) {
            return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
        }

        // On affiche les messages d'alertes
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

        $(document).ready(function() {
            if ($('#table tr:last').attr("id") === undefined)
                var id = 1;
            else {
                var id = $('#table tr:last').attr("id");
                id++;
            }
            /*Assigning id and class for tr and td tags for separation.*/
            $("#button_send").mousedown(function() {
                if (htmlEntities($("#mission").val()) != '') {
                    var newid = id++;
                    $("#table tbody").append(`<tr valign="top" id="${newid}">
            <td id="mission${newid}">${htmlEntities($("#mission").val())}</td>
            <td><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
                    document.getElementById("mission").value = "";
                    addAlert("Mission/compétence ajoutée", "success");
                } else {
                    addAlert("Champs mission/compétences vide.", "error");
                }
            });

            // function to remove article if u don't want it
            $("#table").on('click', '.remCF', function() {
                $(this).parent().parent().remove();
                addAlert("Mission/compétence supprimée", "success");
            });

            /*crating new click event for save button this will save to the database*/
        });
        //    Wizard tabs with icons setup
        // ------------------------------
        $(".wizard-horizontal").steps({
            headerTag: "h1",
            bodyTag: "fieldset",
            transitionEffect: "fade",
            titleTemplate: '<span class="step">#index#</span> #title#',
            labels: {
                finish: 'Submit'
            },
            onFinished: function(event, currentIndex) {
                submit();
            }
        });

        // live Icon color change on state change
        $(document).ready(function() {
            $(".current").find(".step-icon").addClass("bx bx-time-five");
            $(".current").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#5A8DEE'
            });
        });
        // Icon change on state
        // if click on next button icon change
        $(".actions [href='#next']").click(function() {
            $(".done").find(".step-icon").removeClass("bx bx-time-five").addClass("bx bx-check-circle");
            $(".current").find(".step-icon").removeClass("bx bx-check-circle").addClass("bx bx-time-five");
            // live icon color change on next button's on click
            $(".current").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#5A8DEE'
            });
            $(".current").prev("li").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#39DA8A'
            });
        });
        $(".actions [href='#previous']").click(function() {
            // live icon color change on next button's on click
            $(".current").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#5A8DEE'
            });
            $(".current").next("li").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#adb5bd'
            });
        });
        // if click on  submit   button icon change
        $(".actions [href='#finish']").click(function() {
            $(".done").find(".step-icon").removeClass("bx-time-five").addClass("bx bx-check-circle");
            $(".last.current.done").find(".fonticon-wrap .livicon-evo").updateLiviconEvo({
                strokeColor: '#39DA8A'
            });
        });
        // add primary btn class
        $('.actions a[role="menuitem"]').addClass("btn btn-primary");
        $('.icon-tab [role="menuitem"]').addClass("glow ");
        $('.wizard-vertical [role="menuitem"]').removeClass("btn-primary").addClass("btn-light-primary");
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>