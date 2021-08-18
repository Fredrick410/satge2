<?php
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

// Convert a date or timestamp into French.
function dateToFrench($date, $format)
{
    $english_days = array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
    $french_days = array('Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi', 'Dimanche');
    $english_months = array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
    $french_months = array('Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre');
    return str_replace($english_months, $french_months, str_replace($english_days, $french_days, date($format, strtotime($date))));
}

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

//Recuperation des missions
$pdoS = $bdd->prepare('SELECT * FROM mission WHERE id_session = :num ORDER BY id');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$missions = $pdoS->fetchAll();

//Pour chaque mission on recupere les taches associees.
foreach ($missions as $mission) {
    $pdoS = $bdd->prepare('SELECT * FROM task WHERE id_mission = :num ORDER BY id');
    $pdoS->bindValue(':num', $mission['id']);
    $pdoS->execute();
    $tasks[] = $pdoS->fetchAll();
}

foreach ($tasks as $task) {
    foreach ($task as $tache) {
        $pdoS = $bdd->prepare('SELECT COUNT(*) as nb_comment FROM task_commentaire WHERE task_num = :num');
        $pdoS->bindValue(':num', $tache['id']);
        $pdoS->execute();
        $task_comment_number[] = $pdoS->fetch();
    }
    if (isset($task_comment_number)) {
        $mission_task_comment_number[] = $task_comment_number;
        unset($task_comment_number);
    }
}

foreach ($tasks as $task) {
    foreach ($task as $tache) {
        $pdoS = $bdd->prepare('SELECT COUNT(*) as nb_doc FROM task_doc WHERE task_num = :num');
        $pdoS->bindValue(':num', $tache['id']);
        $pdoS->execute();
        $task_doc_number[] = $pdoS->fetch();
    }
    if (isset($task_doc_number)) {
        $mission_task_doc_number[] = $task_doc_number;
        unset($task_doc_number);
    }
}
//print("<pre>". print_r($mission_task_membres,true)."</pre>");


foreach ($tasks as $task) {
    foreach ($task as $tache) {
        $pdoS = $bdd->prepare('SELECT * FROM tasks_teams INNER JOIN teams ON(tasks_teams.id_team = teams.id)  WHERE id_task = :num');
        $pdoS->bindValue(':num', $tache['id']);
        $pdoS->execute();
        $task_teams[] = $pdoS->fetchAll();
    }
    if (isset($task_teams)) {
        $mission_task_teams[] = $task_teams;
        unset($task_teams);
    }
}

foreach ($tasks as $task) {
    foreach ($task as $tache) {
        $pdoS = $bdd->prepare('SELECT * FROM tasks_membres INNER JOIN membres ON(tasks_membres.id_membre = membres.id)  WHERE id_task = :num');
        $pdoS->bindValue(':num', $tache['id']);
        $pdoS->execute();
        $task_membres[] = $pdoS->fetchAll();
    }
    if (isset($task_membres)) {
        $mission_task_membres[] = $task_membres;
        unset($task_membres);
    }
}
//print("<pre>". print_r($mission_task_membres,true)."</pre>");


//On recupere la liste des membres de cette entreprise
$pdoSttt = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
$pdoSttt->bindValue(':num', $_SESSION['id_session']);
$pdoSttt->execute();
$membres = $pdoSttt->fetchAll();
//print("<pre>". print_r($tasks,true)."</pre>");

//On recupere la liste des equipes de cette entreprise
$pdoS = $bdd->prepare('SELECT * FROM teams WHERE id_session = :num');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$teams = $pdoS->fetchAll();

//Recuperation de la liste des etiquettes crees par cette entreprise
$pdoSt = $bdd->prepare('SELECT * FROM etiquette WHERE id_session = :id_session');
$pdoSt->bindValue(':id_session', $_SESSION['id_session']);
$pdoSt->execute();
$etiq = $pdoSt->fetchAll();
?>

<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Mission</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/jkanban/jkanban.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/pickers/pickadate/pickadate.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/forms/select/select2.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/file-uploaders/dropzone.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-kanban.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/file-uploaders/dropzone.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
    <style>
        .no-comments {
            list-style: none;
        }

        .none-validation {
            display: none;
        }

        <?php
        foreach ($etiq as $etiquette) {
        ?>.kanban-container .kanban-board .kanban-item[data-border="<?= $etiquette['color'] ?>"]:before {
            background-color: <?= $etiquette['color'] ?>;
        }

        <?php
        }
        ?>
    </style>

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout 2-columns  navbar-sticky footer-static menu-collapsed " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout">
    <!-- BEGIN: Header-->
    <?php $btnreturn = false;
    include('php/menu_header_front.php'); ?>
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
                <div id="message">

                </div>
                <!-- Basic Kanban App -->
                <div class="kanban-overlay"></div>
                <section id="kanban-wrapper">
                    <div class="row">
                        <div class="col-12">
                            <button type="button" class="btn btn-primary mb-1" id="add-kanban">
                                <i class='bx bx-add-to-queue mr-50'></i> Ajouter une mission
                            </button>
                            <div id="kanban-app"></div>
                        </div>
                    </div>

                    <!-- User new mail right area -->
                    <div class="kanban-sidebar">
                        <div class="card shadow-none quill-wrapper">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom px-2 py-1">
                                <h3 class="card-title">Modifier une tâche</h3>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form class="edit-kanban-item">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Libellé de la tâche</label>
                                            <input type="text" class="form-control edit-kanban-item-title" id="name_task" placeholder="Ex: Test">
                                        </div>
                                        <div class="form-group">
                                            <label>Description de la tâche</label>
                                            <textarea name="description_task" id="description_task" cols="30" rows="10" wrap="hard"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label>Date de début</label>
                                            <input type="text" class="form-control edit-kanban-item-date" id="date_task" placeholder="Ex: Mercredi 21 Août 2019">
                                        </div>
                                        <div class="form-group">
                                            <label>Date de fin</label>
                                            <input type="text" class="form-control edit-kanban-item-date" id="dateecheance_task" placeholder="Ex: Mercredi 21 Août 2019">
                                        </div>
                                        <div id="div_etiq">
                                            <label style="color: #bac0c7;">Etiquette</label>
                                            <div class="flex-grow-1 d-flex align-items-center form-group">
                                                <i class="bx bx-tag align-middle mr-25"></i>
                                                <select id="etiquette_task" class="form-control">
                                                    <?php foreach ($etiq as $etiquette) : ?>
                                                        <option value="<?= $etiquette['color'] ?>"><?= $etiquette['name_etiq'] ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                                <i onclick="newetiq()" class="bx bx-plus-circle cursor-pointer"></i>
                                            </div>
                                        </div>
                                        <div id="div_color" class="form-group" style="display: none;">
                                            <label for="etiq">Nouvelle etiquette :</label>
                                            <input type="text" class="form-control" id="etiq" name="new_etiq" placeholder="Nom de l'étiquette" disabled>
                                            <input class="form-control" id="etiq_color" type="color" name="new_color" value="#ffc874" class="form-control" disabled>
                                        </div>
                                        <div class="form-group">
                                            <label for="membres">Membres</label>
                                            <?php
                                            if (isset($membres) and count($membres) != 0) {
                                            ?>
                                                <select class="form-control js-example-basic-multiple" id="membres" multiple>
                                                    <?php
                                                    foreach ($membres as $membre) {
                                                    ?>
                                                        <option value="<?= $membre['id'] ?>"><?= $membre['nom'] . " " . $membre['prenom'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            <?php
                                            } else {
                                            ?>
                                                Aucun membre
                                            <?php
                                            }
                                            ?>
                                        </div>
                                        <div class="form-group">
                                            <label for="equipe">Equipe</label>
                                            <?php
                                            if (isset($teams) and count($teams) != 0) {
                                            ?>
                                                <select class="form-control js-example-basic-multiple" id="teams" multiple>
                                                    <?php
                                                    foreach ($teams as $team) {
                                                    ?>
                                                        <option value="<?= $team['id'] ?>"><?= $team['name_team'] ?></option>
                                                    <?php
                                                    }
                                                    ?>
                                                </select>
                                            <?php
                                            } else {
                                            ?>
                                                <br>Aucune équipe
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                    <input type="hidden" id="tache">
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light-danger delete-kanban-item d-flex align-items-center mr-1">
                                        <i class='bx bx-trash mr-50'></i>
                                        <span>Supprimer</span>
                                    </button>
                                    <button class="btn btn-primary glow update-kanban-item d-flex align-items-center">
                                        <i class='bx bx-send mr-50'></i>
                                        <span>Sauvegarder</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->
                </section>
                <!--/ Sample Project kanban -->

                <div class="modal fade" id="comment" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Commentaires</h5>
                                <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <ul id="posts-list">

                                </ul>
                                <!-- Compose mail Quill editor -->
                                <div class="form-group">
                                    <label>Ajouter un commentaire</label>
                                    <div class="snow-container border rounded p-1">
                                        <div class="compose-editor"></div>
                                        <input type="hidden" id="id_tache">
                                        <div class="d-flex justify-content-end">
                                            <div class="compose-quill-toolbar">
                                                <span class="ql-formats mr-0">
                                                    <button class="ql-bold"></button>
                                                    <button class="ql-italic"></button>
                                                    <button class="ql-underline"></button>
                                                    <button class="ql-link"></button>
                                                    <button id="submit_comment" class="btn btn-sm btn-primary btn-comment ml-25">Commenter</button>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" id="create">Créer</button>
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block cancel">Annuler</span>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="attachement" tabindex="-1" role="dialog" style="display: none;" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Pièces jointes</h5>
                                <button type="button" class="close cancel" data-dismiss="modal" aria-label="Close">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <div id="dpz-multiple-files" class="dropzone">
                                        <div class="dz-message">Télécharger un fichier</div>
                                        <input type="hidden" id="id_task">
                                        <div class="fallback">
                                            <div class="custom-file">
                                                <label class="custom-file-label" for="emailAttach">Joindre un fichier</label>
                                                <input name="fichier" class="custom-file-input" id="fichier" type="file" multiple />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">
                                    <i class="bx bx-x d-block d-sm-none"></i>
                                    <span class="d-none d-sm-block cancel">Fermer</span>
                                </button>
                            </div>
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
    <script src="../../../app-assets/vendors/js/jkanban/jkanban.min.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/pickadate/picker.date.js"></script>
    <script src="../../../app-assets/vendors/js/pickers/daterange/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/"></script>
    <script src="../../../app-assets/vendors/js/forms/select/select2.full.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dropzone.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/forms/select/form-select2.js"></script>
    <!-- END: Page JS-->

    <script>
        // Fonction de creation des commentaires
        function createComment(data) {
            var html = '<li><article id="' + data.id + '" class="hentry">' +
                '<footer class="post-info">' +
                '<abbr class="published" title="' + data.date + '">' +
                parseDisplayDate(data.date) +
                '</abbr>' +
                '<address class="vcard author">' +
                'By <a class="url fn" href="#">' + data.comment_author + '</a>' +
                '</address>' +
                '</footer>' +
                '<div class="entry-content">' +
                '<p>' + data.comment + '</p>' +
                '</div>' +
                '</article></li>';

            return html;
        }

        function parseDisplayDate(date) {
            date = (date instanceof Date ? date : new Date(Date.parse(date)));
            var display = date.getDate() + ' ' + ['Janvier', 'Février', 'Mars',
                    'Avril', 'Mai', 'Juin', 'Juillet',
                    'Août', 'Septembre', 'Octobre',
                    'Novembre', 'Décembre'
                ][date.getMonth()] + ' ' +
                date.getFullYear();
            return display;
        }

        function newetiq() {
            document.getElementById('div_color').style.display = "block";
            document.getElementById('etiq').disabled = false;
            document.getElementById('etiq_color').disabled = false;
            $('#div_etiq').hide();
            document.getElementById('etiquette_task').disabled = true;
        }
    </script>

    <script>
        var kanban_curr_el, kanban_curr_item_id, kanban_curr_item_title, kanban_curr_item_due_date, kanban_data, kanban_item, kanban_users;

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

        Dropzone.autoDiscover = false;

        /********************************************
         *               Add multiple files         *
         ********************************************/
        var myDropzone = new Dropzone("#dpz-multiple-files", {
            url: "php/insert_files_tache.php",
            paramName: "fichier", // The name that will be used to transfer the file
            maxFilesize: 5, // MB
            clickable: true,
            addRemoveLinks: true,
            dictRemoveFile: "Supprimer",
            removedfile: function(file) {
                var fileuploaded = file.previewElement.querySelector("[data-dz-name]");
                var name = fileuploaded.innerHTML;
                var id_task = document.getElementById('id_task').value;
                $.ajax({
                    type: 'POST',
                    url: 'php/delete_file_tache.php',
                    data: {
                        id_task: id_task,
                        namedoc_task: name
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status != 'success') {
                            addAlert(data.message);
                        } else if (data.message == null) {
                            var nb_attachment = $(kanban_curr_el).contents()[1].innerHTML;
                            nb_attachment--;
                            $(kanban_curr_el).contents()[1].innerHTML = nb_attachment;
                        }
                        file.previewElement.remove();
                    }
                });
            },
            maxThumbnailFilesize: 1, // MB
            acceptedFiles: 'image/jpg,image/jpeg,image/png,application/pdf',
            init: function() {

                // Using a closure.
                var _this = this;

                this.on("sending", function(file, xhr, formData) {
                    var id_task = document.getElementById('id_task').value;
                    formData.append("id_task", id_task);
                });

                this.on("success", function(file, responseText) {
                    var a = document.createElement('a');
                    a.setAttribute('href', "../../../src/task/document/" + responseText.trim());
                    a.setAttribute('target', "_blank");
                    a.setAttribute('class', "btn btn-outline-primary");
                    a.innerHTML = "Visualiser";
                    file.previewTemplate.appendChild(a);
                    var fileuploded = file.previewElement.querySelector("[data-dz-name]");
                    fileuploded.innerHTML = responseText.trim();
                    var nb_attachment = $(kanban_curr_el).contents()[1].innerHTML;
                    nb_attachment++;
                    $(kanban_curr_el).contents()[1].innerHTML = nb_attachment;
                });
            }
        });

        $(document).ready(function() {
            $('.js-example-basic-multiple').select2();
            // Kanban Board and Item Data passed by json
            var kanban_board_data = [
                <?php
                $last_id_task = 1;
                for ($i = 0; $i < count($missions); $i++) {
                    if ($i != count($missions) - 1) {
                ?> {
                            id: "kanban-<?= $missions[$i]['id'] ?>",
                            title: "<?= htmlspecialchars($missions[$i]['name_mission']) ?>",
                            item: [
                                <?php
                                if (isset($tasks[$i]) and count($tasks[$i]) != 0) {
                                    for ($j = 0; $j < count($tasks[$i]); $j++) {
                                        if ($j != count($tasks[$i]) - 1) {
                                ?> {
                                                id: "kanban-item-<?= $tasks[$i][$j]['id'] ?>",
                                                title: "<?= $tasks[$i][$j]['name_task'] ?>",
                                                dueDate: "<?= dateToFrench($tasks[$i][$j]['dateecheance_task'], 'd-m-Y') ?>",
                                                border: "<?= $tasks[$i][$j]['color_etiq'] ?>",
                                                users: [
                                                    <?php
                                                    if (isset($mission_task_membres[$i][$j]) and isset($mission_task_teams[$i][$j])) {
                                                        $list_acronyme = [];
                                                        for ($k = 0; $k < count($mission_task_membres[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_membres[$i][$j][$k]['nom'] . ' ' . $mission_task_membres[$i][$j][$k]['prenom'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for ($k = 0; $k < count($mission_task_teams[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_teams[$i][$j][$k]['name_team'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for($k = 0; $k < count($list_acronyme); $k++) {
                                                            if ($k != count($list_acronyme) - 1) {
                                                    ?> '<?= $list_acronyme[$k] ?>',
                                                            <?php
                                                            } else {
                                                            ?> '<?= $list_acronyme[$k] ?>'
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                ],
                                                comment: <?= $mission_task_comment_number[$i][$j]['nb_comment'] ?>,
                                                attachment: <?= $mission_task_doc_number[$i][$j]['nb_doc'] ?>,
                                                drop: function(el, target, source, sibling) {
                                                    var id_mission = target.parentElement.getAttribute('data-id').replaceAll('kanban-', '');
                                                    var id_task = el.dataset.eid.replaceAll('kanban-item-', '');
                                                    $.ajax({
                                                        url: "../../../html/ltr/coqpix/php/edit_tache.php", //new path, save your work first before u try
                                                        type: "POST",
                                                        data: {
                                                            id_mission: id_mission,
                                                            id_task: id_task
                                                        },
                                                        dataType: 'json',
                                                        success: function(data) {
                                                            if (data.status != 'success') {
                                                                addAlert(data.message);
                                                            }
                                                        }
                                                    });
                                                }
                                            },
                                        <?php
                                        } else {
                                        ?> {
                                                id: "kanban-item-<?= $tasks[$i][$j]['id'] ?>",
                                                title: "<?= $tasks[$i][$j]['name_task'] ?>",
                                                dueDate: "<?= dateToFrench($tasks[$i][$j]['dateecheance_task'], 'd-m-Y') ?>",
                                                border: "<?= $tasks[$i][$j]['color_etiq'] ?>",
                                                users: [
                                                    <?php
                                                    if (isset($mission_task_membres[$i][$j]) and isset($mission_task_teams[$i][$j])) {
                                                        $list_acronyme = [];
                                                        for ($k = 0; $k < count($mission_task_membres[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_membres[$i][$j][$k]['nom'] . ' ' . $mission_task_membres[$i][$j][$k]['prenom'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for ($k = 0; $k < count($mission_task_teams[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_teams[$i][$j][$k]['name_team'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for($k = 0; $k < count($list_acronyme); $k++) {
                                                            if ($k != count($list_acronyme) - 1) {
                                                    ?> '<?= $list_acronyme[$k] ?>',
                                                            <?php
                                                            } else {
                                                            ?> '<?= $list_acronyme[$k] ?>'
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                ],
                                                comment: <?= $mission_task_comment_number[$i][$j]['nb_comment'] ?>,
                                                attachment: <?= $mission_task_doc_number[$i][$j]['nb_doc'] ?>,
                                                drop: function(el, target, source, sibling) {
                                                    var id_mission = target.parentElement.getAttribute('data-id').replaceAll('kanban-', '');
                                                    var id_task = el.dataset.eid.replaceAll('kanban-item-', '');
                                                    $.ajax({
                                                        url: "../../../html/ltr/coqpix/php/edit_tache.php", //new path, save your work first before u try
                                                        type: "POST",
                                                        data: {
                                                            id_mission: id_mission,
                                                            id_task: id_task
                                                        },
                                                        dataType: 'json',
                                                        success: function(data) {
                                                            if (data.status != 'success') {
                                                                addAlert(data.message);
                                                            }
                                                        }
                                                    });
                                                }
                                            }
                                        <?php
                                        }
                                        if ($last_id_task < $tasks[$i][$j]['id']) {
                                            $last_id_task = $tasks[$i][$j]['id'];
                                        }
                                        ?>
                                <?php
                                    }
                                }
                                ?>
                            ]
                        },
                    <?php
                    } else {
                        $last_id_mission = $missions[$i]['id'];
                    ?> {
                            id: "kanban-<?= $missions[$i]['id'] ?>",
                            title: "<?= htmlspecialchars($missions[$i]['name_mission']) ?>",
                            item: [
                                <?php
                                if (isset($tasks[$i]) and count($tasks[$i]) != 0) {
                                    for ($j = 0; $j < count($tasks[$i]); $j++) {
                                        if ($j != count($tasks[$i]) - 1) {
                                ?> {
                                                id: "kanban-item-<?= $tasks[$i][$j]['id'] ?>",
                                                title: "<?= $tasks[$i][$j]['name_task'] ?>",
                                                dueDate: "<?= dateToFrench($tasks[$i][$j]['dateecheance_task'], 'd-m-Y') ?>",
                                                border: "<?= $tasks[$i][$j]['color_etiq'] ?>",
                                                users: [
                                                    <?php
                                                    if (isset($mission_task_membres[$i][$j]) and isset($mission_task_teams[$i][$j])) {
                                                        $list_acronyme = [];
                                                        for ($k = 0; $k < count($mission_task_membres[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_membres[$i][$j][$k]['nom'] . ' ' . $mission_task_membres[$i][$j][$k]['prenom'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for ($k = 0; $k < count($mission_task_teams[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_teams[$i][$j][$k]['name_team'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for($k = 0; $k < count($list_acronyme); $k++) {
                                                            if ($k != count($list_acronyme) - 1) {
                                                    ?> '<?= $list_acronyme[$k] ?>',
                                                            <?php
                                                            } else {
                                                            ?> '<?= $list_acronyme[$k] ?>'
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                ],
                                                comment: <?= $mission_task_comment_number[$i][$j]['nb_comment'] ?>,
                                                attachment: <?= $mission_task_doc_number[$i][$j]['nb_doc'] ?>,
                                                drop: function(el, target, source, sibling) {
                                                    var id_mission = target.parentElement.getAttribute('data-id').replaceAll('kanban-', '');
                                                    var id_task = el.dataset.eid.replaceAll('kanban-item-', '');
                                                    $.ajax({
                                                        url: "../../../html/ltr/coqpix/php/edit_tache.php", //new path, save your work first before u try
                                                        type: "POST",
                                                        data: {
                                                            id_mission: id_mission,
                                                            id_task: id_task
                                                        },
                                                        dataType: 'json',
                                                        success: function(data) {
                                                            if (data.status != 'success') {
                                                                addAlert(data.message);
                                                            }
                                                        }
                                                    });
                                                }
                                            },
                                        <?php
                                        } else {
                                        ?> {
                                                id: "kanban-item-<?= $tasks[$i][$j]['id'] ?>",
                                                title: "<?= $tasks[$i][$j]['name_task'] ?>",
                                                dueDate: "<?= dateToFrench($tasks[$i][$j]['dateecheance_task'], 'd-m-Y') ?>",
                                                border: "<?= $tasks[$i][$j]['color_etiq'] ?>",
                                                users: [
                                                    <?php
                                                    if (isset($mission_task_membres[$i][$j]) and isset($mission_task_teams[$i][$j])) {
                                                        $list_acronyme = [];
                                                        for ($k = 0; $k < count($mission_task_membres[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_membres[$i][$j][$k]['nom'] . ' ' . $mission_task_membres[$i][$j][$k]['prenom'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for ($k = 0; $k < count($mission_task_teams[$i][$j]); $k++) {
                                                            $acronyme = "";
                                                            $a = str_word_count($mission_task_teams[$i][$j][$k]['name_team'], 1);
                                                            foreach ($a as $value) {
                                                                $acronyme .= strtoupper(substr($value, 0, 1));
                                                            }
                                                            $list_acronyme[] = $acronyme;
                                                        }
                                                        for($k = 0; $k < count($list_acronyme); $k++) {
                                                            if ($k != count($list_acronyme) - 1) {
                                                    ?> '<?= $list_acronyme[$k] ?>',
                                                            <?php
                                                            } else {
                                                            ?> '<?= $list_acronyme[$k] ?>'
                                                    <?php
                                                            }
                                                        }
                                                    }
                                                    ?>
                                                ],
                                                comment: <?= $mission_task_comment_number[$i][$j]['nb_comment'] ?>,
                                                attachment: <?= $mission_task_doc_number[$i][$j]['nb_doc'] ?>,
                                                drop: function(el, target, source, sibling) {
                                                    var id_mission = target.parentElement.getAttribute('data-id').replaceAll('kanban-', '');
                                                    var id_task = el.dataset.eid.replaceAll('kanban-item-', '');
                                                    $.ajax({
                                                        url: "../../../html/ltr/coqpix/php/edit_tache.php", //new path, save your work first before u try
                                                        type: "POST",
                                                        data: {
                                                            id_mission: id_mission,
                                                            id_task: id_task
                                                        },
                                                        dataType: 'json',
                                                        success: function(data) {
                                                            if (data.status != 'success') {
                                                                addAlert(data.message);
                                                            }
                                                        }
                                                    });
                                                }
                                            }
                                        <?php
                                        }
                                        if ($last_id_task < $tasks[$i][$j]['id']) {
                                            $last_id_task = $tasks[$i][$j]['id'];
                                        }
                                        ?>
                                <?php
                                    }
                                }
                                ?>
                            ]
                        }
                <?php
                    }
                }
                ?>
            ];

            // Kanban Board
            var KanbanExample = new jKanban({
                element: "#kanban-wrapper", // selector of the kanban container
                buttonContent: "+ Add New Item", // text or html content of the board button

                buttonClick: function(el, boardId) {
                    // create a form to add add new element
                    var formItem = document.createElement("form");
                    formItem.setAttribute("class", "itemform");
                    formItem.innerHTML =
                        '<div class="form-group">' +
                        '<textarea class="form-control add-new-item" rows="2" autofocus required></textarea>' +
                        "</div>" +
                        '<div class="form-group">' +
                        '<button type="submit" class="btn btn-primary btn-sm mr-50">Submit</button>' +
                        '<button type="button" id="CancelBtn" class="btn btn-sm btn-danger">Cancel</button>' +
                        "</div>";

                    // add new item on submit click
                    KanbanExample.addForm(boardId, formItem);
                    formItem.addEventListener("submit", function(e) {
                        e.preventDefault();
                        var text = e.target[0].value;
                        var id_mission = boardId.replaceAll('kanban-', '');
                        $.ajax({
                            url: "../../../html/ltr/coqpix/php/insert_tache.php", //new path, save your work first before u try
                            type: "POST",
                            data: {
                                name_task: text,
                                id_mission: id_mission
                            },
                            dataType: 'json',
                            success: function(data) {
                                if (data.status != 'success') {
                                    addAlert(data.message);
                                } else {
                                    KanbanExample.addElement(boardId, {
                                        id: data.id,
                                        title: text
                                    });
                                }
                            }
                        });
                        formItem.parentNode.removeChild(formItem);
                    });
                    $(document).on("click", "#CancelBtn", function() {
                        $(this).closest(formItem).remove();
                    })
                },
                addItemButton: true, // add a button to board for easy item creation
                boards: kanban_board_data // data passed from defined variable
            });

            // Add html for Custom Data-attribute to Kanban item
            var board_item_id, board_item_el;
            // Kanban board loop
            for (kanban_data in kanban_board_data) {
                // Kanban board items loop
                for (kanban_item in kanban_board_data[kanban_data].item) {
                    var board_item_details = kanban_board_data[kanban_data].item[kanban_item]; // set item details
                    board_item_id = $(board_item_details).attr("id"); // set 'id' attribute of kanban-item

                    (board_item_el = KanbanExample.findElement(board_item_id)), // find element of kanban-item by ID
                    (board_item_users = board_item_dueDate = board_item_comment = board_item_attachment = board_item_image = board_item_badge =
                        " ");

                    // check if users are defined or not and loop it for getting value from user's array
                    if (typeof $(board_item_el).attr("data-users") !== "undefined") {
                        for (kanban_users in kanban_board_data[kanban_data].item[kanban_item].users) {
                            board_item_users +=
                                '<li class="kanban-badge">' +
                                '<div class="badge-circle badge-circle-sm font-size-small font-weight-bold" style="background-color: #' +
                                Math.floor(Math.random() * 16777215).toString(16) +
                                ' ;">' +
                                kanban_board_data[kanban_data].item[kanban_item].users[kanban_users] +
                                "</div>" +
                                "</li>";
                        }
                    }
                    // check if dueDate is defined or not
                    if (typeof $(board_item_el).attr("data-dueDate") !== "undefined") {
                        board_item_dueDate =
                            '<div class="kanban-due-date d-flex align-items-center mr-50">' +
                            '<i class="bx bx-time-five font-size-small mr-25"></i>' +
                            '<span class="font-size-small">' +
                            $(board_item_el).attr("data-dueDate") +
                            "</span>" +
                            "</div>";
                    }
                    // check if comment is defined or not
                    if (typeof $(board_item_el).attr("data-comment") !== "undefined") {
                        board_item_comment =
                            '<div class="kanban-comment d-flex align-items-center mr-50">' +
                            '<i class="bx bx-message font-size-small mr-25"></i>' +
                            '<span class="font-size-small">' +
                            $(board_item_el).attr("data-comment") +
                            "</span>" +
                            "</div>";
                    }
                    // check if attachment is defined or not
                    if (typeof $(board_item_el).attr("data-attachment") !== "undefined") {
                        board_item_attachment =
                            '<div class="kanban-attachment d-flex align-items-center">' +
                            '<i class="bx bx-link-alt font-size-small mr-25"></i>' +
                            '<span class="font-size-small">' +
                            $(board_item_el).attr("data-attachment") +
                            "</span>" +
                            "</div>";
                    }

                    // add custom 'kanban-footer'
                    if (
                        typeof(
                            $(board_item_el).attr("data-dueDate") ||
                            $(board_item_el).attr("data-comment") ||
                            $(board_item_el).attr("data-users") ||
                            $(board_item_el).attr("data-attachment")
                        ) !== "undefined"
                    ) {
                        $(board_item_el).append(
                            '<div class="kanban-footer d-flex justify-content-between mt-1">' +
                            '<div class="kanban-footer-left d-flex">' +
                            board_item_dueDate +
                            board_item_comment +
                            board_item_attachment +
                            "</div>" +
                            '<div class="kanban-footer-right">' +
                            '<div class="kanban-users">' +
                            board_item_badge +
                            '<ul class="list-unstyled m-0 d-flex align-items-center">' +
                            board_item_users +
                            "</ul>" +
                            "</div>" +
                            "</div>" +
                            "</div>"
                        );
                    }
                    // add Image prepend to 'kanban-Item'
                    if (typeof $(board_item_el).attr("data-image") !== "undefined") {
                        $(board_item_el).prepend(board_item_image);
                    }
                }
            }

            // Add new kanban board
            //---------------------
            var addBoardDefault = document.getElementById("add-kanban");
            <?php
            if (isset($last_id_mission)) {
            ?>
                var i = <?= $last_id_mission + 1 ?>;
            <?php
            } else {
            ?>
                var i = 1;
            <?php
            }
            ?>
            addBoardDefault.addEventListener("click", function() {
                name_mission = "Nom de la mission";
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_mission.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        name_mission: name_mission
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status == 'success') {
                            i = data.id;
                            KanbanExample.addBoards([{
                                id: "kanban-" + i, // generate random id for each new kanban
                                title: "Nom de la mission"
                            }]);

                            var kanbanNewBoard = KanbanExample.findBoard("kanban-" + i);

                            if (kanbanNewBoard) {
                                $(".kanban-title-board").on("mouseenter", function() {
                                    $(this).attr("contenteditable", "true");
                                    $(this).addClass("line-ellipsis");
                                });
                                $(".kanban-title-board").on("mouseleave", function() {
                                    // On recupere le nom de la mission et son id
                                    var name_mission = this.innerHTML.replaceAll('<div>', '').replaceAll('</div>', '').replaceAll('<br>', '\n').trim();
                                    var id_mission = $(this).closest(".kanban-board").attr("data-id").replaceAll('kanban-', '');
                                    $.ajax({
                                        url: "../../../html/ltr/coqpix/php/insert_mission.php", //new path, save your work first before u try
                                        type: "POST",
                                        data: {
                                            name_mission: name_mission,
                                            id_mission: id_mission
                                        },
                                        dataType: 'json',
                                        success: function(data) {
                                            if (data.status != 'success') {
                                                addAlert(data.message);
                                            }
                                        }
                                    });
                                });
                                kanbanNewBoardData =
                                    '<div class="dropdown">' +
                                    '<div class="dropdown-toggle cursor-pointer" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></div>' +
                                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"> ' +
                                    '<a class="dropdown-item" href="#"><i class="bx bx-link mr-50"></i>Copy Link</a>' +
                                    '<a class="dropdown-item kanban-delete" id="kanban-delete" href="#"><i class="bx bx-trash mr-50"></i>Delete</a>' +
                                    "</div>" + "</div>";
                                var kanbanNewDropdown = $(kanbanNewBoard).find("header");
                                $(kanbanNewDropdown).append(kanbanNewBoardData);
                            }
                        } else {
                            addAlert(data.message);
                        }
                    }
                });
            });

            // Delete kanban board
            //---------------------
            $(document).on("click", ".kanban-delete", function(e) {
                var $id = $(this)
                    .closest(".kanban-board")
                    .attr("data-id");
                addEventListener("click", () => {
                    KanbanExample.removeBoard($id);
                    var id_mission = $id.replaceAll('kanban-', '');
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/delete_mission.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_mission: id_mission
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status != 'success') {
                                addAlert(data.message);
                            }
                        }
                    });
                });
            });

            // Kanban board dropdown
            // ---------------------

            var kanban_dropdown = document.createElement("div");
            kanban_dropdown.setAttribute("class", "dropdown");

            dropdown();

            function dropdown() {
                kanban_dropdown.innerHTML =
                    '<div class="dropdown-toggle cursor-pointer" role="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="bx bx-dots-vertical-rounded"></i></div>' +
                    '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton"> ' +
                    '<a class="dropdown-item" href="#"><i class="bx bx-link-alt mr-50"></i>Copy Link</a>' +
                    '<a class="dropdown-item kanban-delete" id="kanban-delete" href="#"><i class="bx bx-trash mr-50"></i>Delete</a>' +
                    "</div>";
                if (!$(".kanban-board-header div").hasClass("dropdown")) {
                    $(".kanban-board-header").append(kanban_dropdown);
                }
            }

            // Kanban-overlay and sidebar hide
            // --------------------------------------------
            $(
                ".kanban-sidebar .delete-kanban-item, .kanban-sidebar .close-icon, .kanban-sidebar .update-kanban-item, .kanban-overlay"
            ).on("click", function() {
                $(".kanban-overlay").removeClass("show");
                $(".kanban-sidebar").removeClass("show");
            });

            // Updating Data Values to Fields
            // -------------------------------
            $(".update-kanban-item").on("click", function(e) {
                e.preventDefault();
                var id_task = $("#tache").val();
                var $edit_title = $("#name_task").val();
                var description_task = $('#description_task').val();
                var date_task = $('#date_task').siblings('input[type=hidden]').val();
                var dateecheance_task = $('#dateecheance_task').siblings('input[type=hidden]').val();
                var etiquette_task = $("#etiquette_task").val();
                var new_etiq = $("#etiq").val();
                var new_etiq_color = $("#etiq_color").val();
                var selected_membres = [];
                var selected_teams = [];
                var membres = $('#membres').select2('data');
                var teams = $('#teams').select2('data');
                if (membres != null) {
                    membres.forEach((element) => {
                        selected_membres.push(element.id);
                    });
                }
                if (teams != null) {
                    teams.forEach((element) => {
                        selected_teams.push(element.id);
                    });
                }
                if (selected_membres.length != 0 || selected_teams.length != 0) {
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/edit_tache.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_task: id_task,
                            name_task: $edit_title,
                            description_task: description_task,
                            date_task: date_task,
                            dateecheance_task: dateecheance_task,
                            etiquette_task: etiquette_task,
                            new_etiq: new_etiq,
                            new_etiq_color: new_etiq_color,
                            selected_membres: selected_membres,
                            selected_teams: selected_teams
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status != 'success') {
                                addAlert(data.message);
                            } else {
                                $(kanban_curr_item_due_date).contents()[0].data = $('#dateecheance_task').val();
                                $(kanban_curr_el).txt = $edit_title;
                                $("#etiquette_task").val("");
                                $("#etiq").val("");
                                $("#etiq_color").val("#000000");
                                $('#div_color').hide();
                                $('#etiq').prop('disabled', true);
                                $('#etiq_color').prop('disabled', true);
                                $('#div_etiq').show();
                                $('#etiquette_task').prop('disabled', false);
                                $("#etiquette_task").append(new Option(new_etiq, new_etiq_color));
                                if (typeof(data.color) !== "undefined") {
                                    $("head > style").append('.kanban-container .kanban-board .kanban-item[data-border="' + data.color + '"]:before {background-color:' + data.color + ';}');
                                    $("[data-eid='kanban-item-" + id_task + "']").attr('data-border', data.color);
                                } else {
                                    $("[data-eid='kanban-item-" + id_task + "']").attr('data-border', etiquette_task);
                                }
                            }
                        }
                    });
                }
            });

            // Delete Kanban Item
            // -------------------
            $(".delete-kanban-item").on("click", function() {
                $delete_item = kanban_curr_item_id;
                addEventListener("click", function() {
                    KanbanExample.removeElement($delete_item);
                    var id_task = $delete_item.replaceAll('kanban-item-', '');
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/delete_tache.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_task: id_task
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status != 'success') {
                                addAlert(data.message);
                            }
                        }
                    });
                });
            });



            // Kanban Quill Editor
            // -------------------
            var composeCommentEditor = new Quill(".snow-container .compose-editor", {
                modules: {
                    toolbar: ".compose-quill-toolbar"
                },
                placeholder: "Ecrire un commentaire... ",
                theme: "snow"
            });

            $('#submit_comment').on('click', function(e) {
                e.preventDefault();
                var comment = composeCommentEditor.root.innerHTML;
                var id_task = document.getElementById('id_task').value;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_comment.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        content: comment,
                        num: id_task
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status != 'success') {
                            addAlert(data.message);
                        }
                    }
                });
            });

            // Making Title of Board editable
            // ------------------------------
            $(".kanban-title-board").on("mouseenter", function() {
                $(this).attr("contenteditable", "true");
                $(this).addClass("line-ellipsis");
            });

            // Show task popup
            // ------------------------------
            $(".kanban-item").on("click", function(el) {
                if ($(el.target.parentElement).hasClass('kanban-drag')) {
                    // kanban-overlay and sidebar display block on click of kanban-item
                    $(".kanban-overlay").addClass("show");
                    $(".kanban-sidebar").addClass("show");
                    // Set el to var kanban_curr_el, use this variable when updating title
                    kanban_curr_el = $(el.target);
                    kanban_curr_item_due_date = $(el.target).find(".kanban-due-date").contents()[1];
                    // Extract  the kan ban item & id and set it to respective vars
                    kanban_curr_item_title = $(el.target).contents()[0].data;
                    kanban_curr_item_id = $(el.target).attr("data-eid");
                    var id_task = kanban_curr_item_id.replaceAll('kanban-item-', '');
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/get_tache.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_task: id_task
                        },
                        dataType: 'json',
                        success: function(data) {
                            if (data.status == 'success') {
                                $("#tache").val(id_task);
                                $("#description_task").val(data.task.description_task);

                                var date_task = $('#date_task').pickadate('picker');
                                moment.locale('fr');
                                date_task.set('select', moment(data.task.date_task, 'YYYY-MM-DD').format("DD-MM-YYYY"));

                                var dateecheance_task = $('#dateecheance_task').pickadate('picker');
                                dateecheance_task.set('select', moment(data.task.dateecheance_task, 'YYYY-MM-DD').format("DD-MM-YYYY"));

                                $("#etiquette_task").val(data.task.color_etiq);
                                $("#color_etiq").val(data.task.color_etiq);
                                var selected_membres = [];
                                var selected_teams = [];
                                if (data.membres.length != 0) {
                                    data.membres.forEach(element => {
                                        selected_membres.push(element['id_membre']);
                                    });
                                }
                                $("#membres").val(selected_membres);
                                $('#membres').trigger('change');
                                if (data.teams) {
                                    data.teams.forEach(element => {
                                        selected_teams.push(element['id_team']);
                                    });
                                }
                                $("#teams").val(selected_teams);
                                $('#teams').trigger('change');

                                // set edit title
                                $("#name_task").val(kanban_curr_item_title);
                            } else {
                                addAlert(data.message);
                            }
                        }
                    });
                }
            });

            // Show comment popup
            // ------------------------------
            $(".kanban-comment").on("click", function() {
                var id_task = $(this).closest(".kanban-item").attr("data-eid").replaceAll('kanban-item-', '');
                kanban_curr_el = $(this);
                $("#id_task").removeAttr('value');

                $.ajax({
                    url: "../../../html/ltr/coqpix/php/get_comments_task.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        id_task: id_task
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status != 'success') {
                            addAlert(data.message);
                        } else {
                            if (data.comments.length == 0) {
                                //<li class = "no-comments" > Soyez le premier à commenter < /li>
                            }
                            $.each(data.comments, function(key, value) {
                                var commentHtml = createComment(data);
                                var commentEl = $(commentHtml);
                                commentEl.hide();
                                var postsList = $('#posts-list');
                                postsList.addClass('has-comments');
                                postsList.prepend(commentEl);
                                commentEl.slideDown();
                            });
                            $('#comment').modal('show');
                        }
                    }
                });
            });

            // Show attachment popup
            // ------------------------------
            $(".kanban-attachment").on("click", function() {
                var id_task = $(this).closest(".kanban-item").attr("data-eid").replaceAll('kanban-item-', '');
                kanban_curr_el = $(this);
                $("#id_task").removeAttr('value');
                myDropzone.removeAllFiles(true);

                $.ajax({
                    url: "../../../html/ltr/coqpix/php/get_attachments_task.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        id_task: id_task
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status != 'success') {
                            addAlert(data.message);
                        } else {
                            $.each(data.docs, function(key, value) {
                                var mockFile = {
                                    name: value.name,
                                    size: value.size,
                                    status: 'success'
                                };
                                myDropzone.options.addedfile.call(myDropzone, mockFile);
                                myDropzone.files.push(mockFile);
                                var a = document.createElement('a');
                                a.setAttribute('href', "../../../src/task/document/" + mockFile.name);
                                a.setAttribute('target', "_blank");
                                a.setAttribute('class', "btn btn-outline-primary");
                                a.innerHTML = "Download";
                                myDropzone.files[myDropzone.files.length - 1].previewTemplate.appendChild(a);
                            });
                            $("#id_task").val(id_task);
                            $('#attachement').modal('show');
                        }
                    }
                });
            });

            $(".kanban-title-board").on("mouseleave", function() {
                // On recupere le nom de la mission et son id
                var name_mission = this.innerHTML.replaceAll('<div>', '').replaceAll('</div>', '').replaceAll('<br>', '\n').trim();
                var id_mission = $(this).closest(".kanban-board").attr("data-id").replaceAll('kanban-', '');
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_mission.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        name_mission: name_mission,
                        id_mission: id_mission
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.status != 'success') {
                            addAlert(data.message);
                        }
                    }
                });
            });

            // kanban Item - Pick-a-Date
            $(".edit-kanban-item-date").pickadate({
                /*selectYears: true,
                selectMonths: true,*/
                labelMonthNext: 'Mois suivant',
                labelMonthPrev: 'Mois précédent',
                labelMonthSelect: 'Selectionner le mois',
                labelYearSelect: 'Selectionner une année',
                monthsFull: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
                monthsShort: ['Jan', 'Fev', 'Mar', 'Avr', 'Mai', 'Jui', 'Juil', 'Aou', 'Sep', 'Oct', 'Nov', 'Dec'],
                weekdaysFull: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
                weekdaysShort: ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam'],
                weekdaysLetter: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
                today: 'Aujourd\'hui',
                clear: 'Réinitialiser',
                close: 'Fermer',
                format: 'dd-mm-yyyy',
                formatSubmit: 'yyyy-mm-dd',
                hiddenSuffix: ''
            });

            // Perfect Scrollbar - card-content on kanban-sidebar
            if ($(".kanban-sidebar .edit-kanban-item .card-content").length > 0) {
                new PerfectScrollbar(".card-content", {
                    wheelPropagation: false
                });
            }

            // select default bg color as selected option
            $("#color").addClass($(":selected", this).attr("class"));

            // change bg color of select form-control
            $("#color").change(function() {
                $(this)
                    .removeClass($(this).attr("class"))
                    .addClass($(":selected", this).attr("class") + " form-control text-white");
            });
        });
    </script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>