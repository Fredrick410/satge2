<?php

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

$pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
$pdoS->bindValue(':numentreprise', $_SESSION['id_session']);
$pdoS->execute();
$entreprise = $pdoS->fetch();

$pdoS = $bdd->prepare('SELECT * FROM mission WHERE id_session = :num ORDER BY id');
$pdoS->bindValue(':num', $_SESSION['id_session']);
$pdoS->execute();
$missions = $pdoS->fetchAll();
//print("<pre>". print_r($missions,true)."</pre>");
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
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout 2-columns  navbar-sticky footer-static menu-collapsed " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise['theme_web'] == 'light') echo "semi-"; ?>dark-layout">
    <style>
        .none-validation {
            display: none;
        }
    </style>
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
                                <h3 class="card-title">UI Design</h3>
                                <button type="button" class="close close-icon">
                                    <i class="bx bx-x"></i>
                                </button>
                            </div>
                            <!-- form start -->
                            <form class="edit-kanban-item">
                                <div class="card-content">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <label>Card Title</label>
                                            <input type="text" class="form-control edit-kanban-item-title" placeholder="kanban Title">
                                        </div>
                                        <div class="form-group">
                                            <label>Due Date</label>
                                            <input type="text" class="form-control edit-kanban-item-date" placeholder="21 August, 2019">
                                        </div>
                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Label</label>
                                                    <select class="form-control text-white">
                                                        <option class="bg-primary" selected>Primary</option>
                                                        <option class="bg-danger">Danger</option>
                                                        <option class="bg-success">Success</option>
                                                        <option class="bg-info">Info</option>
                                                        <option class="bg-warning">Warning</option>
                                                        <option class="bg-secondary">Secondary</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <div class="form-group">
                                                    <label>Member</label>
                                                    <div class="d-flex align-items-center">
                                                        <div class="avatar m-0 mr-1">
                                                            <img src="../../../app-assets/images/portrait/small/avatar-s-20.jpg" height="36" width="36" alt="avtar img holder">
                                                        </div>
                                                        <div class="badge-circle badge-circle-light-secondary">
                                                            <i class="bx bx-plus"></i>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label>Attachment</label>
                                            <div class="custom-file">
                                                <input type="file" class="custom-file-input" id="emailAttach">
                                                <label class="custom-file-label" for="emailAttach">Attach file</label>
                                            </div>
                                        </div>
                                        <!-- Compose mail Quill editor -->
                                        <div class="form-group">
                                            <label>Comment</label>
                                            <div class="snow-container border rounded p-1">
                                                <div class="compose-editor"></div>
                                                <div class="d-flex justify-content-end">
                                                    <div class="compose-quill-toolbar">
                                                        <span class="ql-formats mr-0">
                                                            <button class="ql-bold"></button>
                                                            <button class="ql-italic"></button>
                                                            <button class="ql-underline"></button>
                                                            <button class="ql-link"></button>
                                                            <button class="ql-image"></button>
                                                            <button class="btn btn-sm btn-primary btn-comment ml-25">Comment</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end">
                                    <button type="reset" class="btn btn-light-danger delete-kanban-item d-flex align-items-center mr-1">
                                        <i class='bx bx-trash mr-50'></i>
                                        <span>Delete</span>
                                    </button>
                                    <button class="btn btn-primary glow update-kanban-item d-flex align-items-center">
                                        <i class='bx bx-send mr-50'></i>
                                        <span>Save</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
                        </div>
                    </div>
                    <!--/ User Chat profile right area -->
                </section>
                <!--/ Sample Project kanban -->

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
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <!-- <script src="../../../app-assets/js/scripts/pages/app-kanban.js"></script> -->
    <!-- END: Page JS-->

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


        $(document).ready(function() {
            var kanban_curr_el, kanban_curr_item_id, kanban_item_title, kanban_data, kanban_item, kanban_users;
            // Kanban Board and Item Data passed by json
            var kanban_board_data = [
                <?php
                for ($i = 0; $i < count($missions); $i++) {
                    if ($i != count($missions) - 1) {
                ?> {
                            id: "kanban-<?= $missions[$i]['id'] ?>",
                            title: "<?= htmlspecialchars($missions[$i]['name_mission']) ?>"
                        },
                    <?php
                    } else {
                        $last_id = $missions[$i]['id'];
                    ?> {
                            id: "kanban-<?= $missions[$i]['id'] ?>",
                            title: "<?= htmlspecialchars($missions[$i]['name_mission']) ?>"
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

                // click on current kanban-item
                click: function(el) {
                    // kanban-overlay and sidebar display block on click of kanban-item
                    $(".kanban-overlay").addClass("show");
                    $(".kanban-sidebar").addClass("show");

                    // Set el to var kanban_curr_el, use this variable when updating title
                    kanban_curr_el = el;

                    // Extract  the kan ban item & id and set it to respective vars
                    kanban_item_title = $(el).contents()[0].data;
                    kanban_curr_item_id = $(el).attr("data-eid");

                    // set edit title
                    $(".edit-kanban-item .edit-kanban-item-title").val(kanban_item_title);
                },

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
                        KanbanExample.addElement(boardId, {
                            title: text
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
                                '<li class="avatar pull-up my-0">' +
                                '<img class="media-object rounded-circle" src=" ' +
                                kanban_board_data[kanban_data].item[kanban_item].users[kanban_users] +
                                '" alt="Avatar" height="24" width="24">' +
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
                    // check if Image is defined or not
                    if (typeof $(board_item_el).attr("data-image") !== "undefined") {
                        board_item_image =
                            '<div class="kanban-image mb-1">' +
                            '<img class="img-fluid" src=" ' +
                            kanban_board_data[kanban_data].item[kanban_item].image +
                            '" alt="kanban-image">';
                        ("</div>");
                    }
                    // check if Badge is defined or not
                    if (typeof $(board_item_el).attr("data-badgeContent") !== "undefined") {
                        board_item_badge =
                            '<div class="kanban-badge">' +
                            '<div class="badge-circle badge-circle-sm badge-circle-light-' +
                            kanban_board_data[kanban_data].item[kanban_item].badgeColor +
                            ' font-size-small font-weight-bold">' +
                            kanban_board_data[kanban_data].item[kanban_item].badgeContent +
                            "</div>";
                        ("</div>");
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
                            '<ul class="list-unstyled users-list m-0 d-flex align-items-center">' +
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
            if (isset($last_id)) {
            ?>
                var i = <?= $last_id + 1 ?>;
            <?php
            } else {
            ?>
                var i = 1;
            <?php
            }
            ?>
            addBoardDefault.addEventListener("click", function() {
                KanbanExample.addBoards([{
                    id: "kanban-" + i, // generate random id for each new kanban
                    title: "Nom de la mission"
                }]);
                var kanbanNewBoard = KanbanExample.findBoard("kanban-" + i)

                if (kanbanNewBoard) {
                    $(".kanban-title-board").on("mouseenter", function() {
                        $(this).attr("contenteditable", "true");
                        $(this).addClass("line-ellipsis");
                    });
                    $(".kanban-title-board").on("mouseleave", function() {
                        // On recupere le nom de la mission et son id
                        var name_mission = this.innerHTML.replaceAll('<div>', '').replaceAll('</div>', '').replaceAll('<br>', '\n').trim();
                        var id_mission = $(this).closest(".kanban-board").attr("data-id").replaceAll('kanban-', '');
                        console.log(name_mission);
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
                i++;

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
                // var $edit_title = $(".edit-kanban-item .edit-kanban-item-title").val();
                // $(kanban_curr_el).txt($edit_title);
                e.preventDefault();
            });

            // Delete Kanban Item
            // -------------------
            $(".delete-kanban-item").on("click", function() {
                $delete_item = kanban_curr_item_id;
                addEventListener("click", function() {
                    KanbanExample.removeElement($delete_item);
                });
            });

            // Kanban Quill Editor
            // -------------------
            var composeMailEditor = new Quill(".snow-container .compose-editor", {
                modules: {
                    toolbar: ".compose-quill-toolbar"
                },
                placeholder: "Write a Comment... ",
                theme: "snow"
            });

            // Making Title of Board editable
            // ------------------------------
            $(".kanban-title-board").on("mouseenter", function() {
                $(this).attr("contenteditable", "true");
                $(this).addClass("line-ellipsis");
            });

            $(".kanban-title-board").on("mouseleave", function() {
                // On recupere le nom de la mission et son id
                var name_mission = this.innerHTML.replaceAll('<div>', '').replaceAll('</div>', '').replaceAll('<br>', '\n').trim();
                var id_mission = $(this).closest(".kanban-board").attr("data-id").replaceAll('kanban-', '');
                console.log(name_mission);
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
            $(".edit-kanban-item-date").pickadate();

            // Perfect Scrollbar - card-content on kanban-sidebar
            if ($(".kanban-sidebar .edit-kanban-item .card-content").length > 0) {
                new PerfectScrollbar(".card-content", {
                    wheelPropagation: false
                });
            }

            // select default bg color as selected option
            $("select").addClass($(":selected", this).attr("class"));

            // change bg color of select form-control
            $("select").change(function() {
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