<?php
require_once 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

// Si l'id de la candidature n'existe pas ou est non numerique on retourne a la liste des candidatures pour entretiens
if (isset($_GET['num']) and is_numeric($_GET['num'])) {
    $id = htmlspecialchars($_GET['num']);
    // On recupere la candidature
    $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE id = :num AND statut="Admis à entretien"');
    $pdoStt->bindValue(':num', $id, PDO::PARAM_INT);
    $pdoStt->execute();
    $candidature = $pdoStt->fetch(PDO::FETCH_ASSOC);
} else {
    // On recupere les candidatures
    $pdoStt = $bdd->prepare('SELECT * FROM rh_candidature WHERE statut="Admis à entretien"');
    $pdoStt->execute();
    $candidatures = $pdoStt->fetchAll(PDO::FETCH_ASSOC);
}

// Si la candidature n'existe pas on retourne a la liste des candidatures pour entretiens
if (isset($candidature) == 0 and isset($candidatures) == 0) {
    header('Location: rh-entretient-candidats.php');
}

//print("<pre>".print_r($candidature,true)."</pre>");

$pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
$pdoSta->bindValue(':num', $_SESSION['id_session'], PDO::PARAM_INT); //$_SESSION
$pdoSta->execute();
$entreprise = $pdoSta->fetch();
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
    <title>RH -Recrutement</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/calendars/tui-time-picker.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/calendars/tui-date-picker.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/calendars/tui-calendar.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/calendars/app-calendar.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

    <!-- BEGIN: JQUERY-->
    <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- END: JQUERY-->

    <style>
        .none-validation {
            display: none;
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
    <div class="header-navbar-shadow"></div>
    <nav class="header-navbar main-header-navbar navbar-expand-lg navbar navbar-with-menu fixed-top ">
        <div class="navbar-wrapper">
            <div class="navbar-container content">-
                <div class="navbar-collapse" id="navbar-mobile">
                    <div class="mr-auto float-left bookmark-wrapper d-flex align-items-center">
                        <ul class="nav navbar-nav">
                            <li class="nav-item mobile-menu d-xl-none mr-auto"><a class="nav-link nav-menu-main menu-toggle hidden-xs" href="#"><i class="ficon bx bx-menu"></i></a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="rh-entretient-candidats.php" data-toggle="tooltip" data-placement="top" title="Retour">
                                    <div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div>
                                </a></li>
                        </ul>
                        <ul class="nav navbar-nav bookmark-icons">
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php" data-toggle="tooltip" data-placement="top" title="CloudPix">
                                    <div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div>
                                </a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="#" data-toggle="tooltip" data-placement="top" title="Chat">
                                    <div class="livicon-evo" data-options=" name: comments.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div>
                                </a></li>
                        </ul>
                    </div>
                    <ul class="nav navbar-nav float-right">
                        <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-fr"></i><span class="selected-language">Francais</span></a>
                            <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="#" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="#" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="#" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="#" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                        </li>
                        <?php include('php/notifs_frontend.php'); ?>
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name"><?= $entreprise['nameentreprise']; ?></span><span class="user-status text-muted">En ligne</span></div><span><img class="round" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="avatar" height="40" width="40"></span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right pb-0">
                                <?php include('php/header_action.php')  ?>
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
            <div class="content-body">
                <div id="message">

                </div>
                <div>
                    <?php if (!isset($candidatures)) {
                    ?>
                        <h4>Liste des entretiens de <?php if ($candidature['sexe_candidat'] == "homme") {
                                                        echo "Mr";
                                                    } else {
                                                        echo "Mme";
                                                    } ?> <?= $candidature['nom_candidat'] ?> - <?= $candidature['name_annonce'] ?></h4>
                    <?php
                    } else {
                    ?>
                        <h4>Liste des entretiens</h4>
                    <?php
                    }
                    ?>
                </div>
                <!-- calendar Wrapper  -->
                <div class="calendar-wrapper position-relative">
                    <!-- calendar app overlay -->
                    <div class="app-content-overlay"></div>
                    <!-- calendar sidebar start -->
                    <div id="sidebar" class="sidebar">
                        <div class="sidebar-new-schedule">
                            <!-- create new schedule button -->
                            <button id="btn-new-schedule" type="button" class="btn btn-primary btn-block sidebar-new-schedule-btn">
                                Nouvel entretien
                            </button>
                        </div>
                        <!-- sidebar calendar labels -->
                        <div id="sidebar-calendars" class="sidebar-calendars">
                            <div>
                                <div class="sidebar-calendars-item">
                                    <!-- view All checkbox -->
                                    <div class="checkbox">
                                        <input type="checkbox" class="checkbox-input tui-full-calendar-checkbox-square" id="checkbox1" value="all" checked>
                                        <label for="checkbox1">Voir tout</label>
                                    </div>
                                </div>
                            </div>
                            <div id="calendarList" class="sidebar-calendars-d1"></div>
                        </div>
                        <!-- / sidebar calendar labels -->
                    </div>
                    <!-- calendar sidebar end -->
                    <!-- calendar view start  -->
                    <div class="calendar-view">
                        <div class="calendar-action d-flex align-items-center flex-wrap">
                            <!-- sidebar toggle button for small sceen -->
                            <button class="btn btn-icon sidebar-toggle-btn">
                                <i class="bx bx-menu font-large-1"></i>
                            </button>
                            <!-- dropdown button to change calendar-view -->
                            <div class="dropdown d-inline mr-75">
                                <button id="dropdownMenu-calendarType" class="btn btn-action dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i id="calendarTypeIcon" class="bx bx-calendar-alt"></i>
                                    <span id="calendarTypeName">Affichage</span>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-left" role="menu" aria-labelledby="dropdownMenu-calendarType">
                                    <li role="presentation">
                                        <a class="dropdown-menu-title dropdown-item" role="menuitem" data-action="toggle-daily">
                                            <i class="bx bx-calendar-alt mr-50"></i>
                                            <span>Jour</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title dropdown-item" role="menuitem" data-action="toggle-weekly">
                                            <i class='bx bx-calendar-event mr-50'></i>
                                            <span>Semaine</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title dropdown-item" role="menuitem" data-action="toggle-monthly">
                                            <i class="bx bx-calendar mr-50"></i>
                                            <span>Mois</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title dropdown-item" role="menuitem" data-action="toggle-weeks2">
                                            <i class='bx bx-calendar-check mr-50'></i>
                                            <span>2 semaines</span>
                                        </a>
                                    </li>
                                    <li role="presentation">
                                        <a class="dropdown-menu-title dropdown-item" role="menuitem" data-action="toggle-weeks3">
                                            <i class='bx bx-calendar-check mr-50'></i>
                                            <span>3 semaines</span>
                                        </a>
                                    </li>
                                    <li role="presentation" class="dropdown-divider"></li>
                                    <li role="presentation">
                                        <div role="menuitem" data-action="toggle-workweek" class="dropdown-item">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-workweek" checked>
                                            <span class="checkbox-title bg-primary"></span>
                                            <span>Inclure weekends</span>
                                        </div>
                                    </li>
                                    <li role="presentation">
                                        <div role="menuitem" data-action="toggle-start-day-1" class="dropdown-item">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-start-day-1">
                                            <span class="checkbox-title"></span>
                                            <span>Lundi début de semaine</span>
                                        </div>
                                    </li>
                                    <li role="presentation">
                                        <div role="menuitem" data-action="toggle-narrow-weekend" class="dropdown-item">
                                            <input type="checkbox" class="tui-full-calendar-checkbox-square" value="toggle-narrow-weekend">
                                            <span class="checkbox-title"></span>
                                            <span>Weekends réduits</span>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            <!-- calenadar next and previous navigate button -->
                            <span id="menu-navi" class="menu-navigation">
                                <button type="button" class="btn btn-action move-today mr-50 px-75" data-action="move-today">Aujourd'hui</button>
                                <button type="button" class="btn btn-icon btn-action  move-day mr-50 px-50" data-action="move-prev">
                                    <i class="bx bx-chevron-left" data-action="move-prev"></i>
                                </button>
                                <button type="button" class="btn btn-icon btn-action move-day mr-50 px-50" data-action="move-next">
                                    <i class="bx bx-chevron-right" data-action="move-next"></i>
                                </button>
                            </span>
                            <span id="renderRange" class="render-range"></span>
                        </div>
                        <!-- calendar view  -->
                        <div id="calendar" class="calendar-content"></div>
                    </div>
                    <!-- calendar view end  -->
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
    <script src="../../../app-assets/vendors/js/calendar/tui-code-snippet.min.js"></script>
    <script src="../../../app-assets/vendors/js/calendar/tui-dom.js"></script>
    <script src="../../../app-assets/vendors/js/calendar/chance.min.js"></script>
    <script src="../../../app-assets/vendors/js/calendar/tui-time-picker.min.js"></script>
    <script src="../../../app-assets/vendors/js/calendar/tui-date-picker.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/moment.min.js"></script>
    <script src="../../../app-assets/vendors/js/calendar/tui-calendar.min.js"></script>
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

        var id_candidature = <?= $candidature['id'] ?>;
        var debut_entretien = '';
        var fin_entretien = '';
        var lieu_entretien = '';
        var titre_entretien = '';

        function ScheduleInfo() {
            this.id = null;
            this.calendarId = null;

            this.title = null;
            this.start = null;
            this.end = null;
            this.category = 'time';
            this.dueDateClass = '';

            this.raw = {
                location: null
            };
        }

        // Gestion du calendrier
        'use strict';

        var entretiens = [];

        /* eslint-disable require-jsdoc, no-unused-vars */

        var CalendarList = [],
            primaryColor = "#5A8DEE",
            primaryLight = "#E2ECFF",
            secondaryColor = "#475F7B",
            secondaryLight = "#E6EAEE",
            successColor = "#39DA8A",
            successLight = "#D2FFE8",
            dangercolor = "#FF5B5C",
            dangerLight = "#FFDEDE",
            warningColor = "#FDAC41",
            warningLight = "#FFEED9",
            infoColor = "#00CFDD",
            infoLight = "#CCF5F8 ",
            lightColor = "#b3c0ce",
            veryLightBlue = "#e7edf3",
            cloudyBlue = "#b3c0ce";
        // contructor to create event
        function CalendarInfo() {
            this.id = null;
            this.name = null;
            this.checked = true;
            this.color = null;
            this.bgColor = null;
            this.borderColor = null;
        }

        function addCalendar(calendar) {
            CalendarList.push(calendar);
        }

        function findCalendar(id) {
            var found;

            CalendarList.forEach(function(calendar) {
                if (calendar.id === id) {
                    found = calendar;
                }
            });

            return found || CalendarList[0];
        }
        // sidebar calendar list
        (function() {
            var calendar;
            var id = 0;

            calendar = new CalendarInfo();
            id += 1;
            calendar.id = String(id);
            calendar.name = 'Mes Entretiens';
            calendar.color = infoColor;
            calendar.bgColor = infoLight;
            calendar.dragBgColor = infoColor;
            calendar.borderColor = infoColor;
            addCalendar(calendar);
        })();

        (function(window, Calendar) {
            // variables
            var cal, resizeThrottled;
            var useCreationPopup = true;
            var useDetailPopup = true;

            // default keys and styles of calendar
            var themeConfig = {
                'common.border': '1px solid #DFE3E7',
                'common.backgroundColor': 'white',
                'common.holiday.color': '#FF5B5C',
                'common.saturday.color': '#304156',
                'common.dayname.color': '#304156',
                'month.dayname.borderLeft': '1px solid transparent',
                'month.dayname.fontSize': '1rem',
                'week.dayGridSchedule.borderRadius': '4px',
                'week.timegridSchedule.borderRadius': '4px',
            }

            daynames = ['Dim', 'Lun', 'Mar', 'Mer', 'Jeu', 'Ven', 'Sam']
            // calendar initialize here
            cal = new Calendar('#calendar', {
                defaultView: 'month',
                useCreationPopup: useCreationPopup,
                useDetailPopup: useDetailPopup,
                calendars: CalendarList,
                theme: themeConfig,
                template: {
                    milestone: function(model) {
                        return '<span class="bx bx-flag align-middle"></span> <span style="background-color: ' + model.bgColor + '">' + model.title + '</span>';
                    },
                    allday: function(schedule) {
                        return getTimeTemplate(schedule, true);
                    },
                    time: function(schedule) {
                        return getTimeTemplate(schedule, false);
                    },
                    timegridDisplayTime: function(time) {
                        return time.hour.toLocaleString('fr-FR', {
                            minimumIntegerDigits: 2,
                            useGrouping: false
                        }) + ':' + time.minutes.toLocaleString('fr-FR', {
                            minimumIntegerDigits: 2,
                            useGrouping: false
                        });
                    },
                    timegridDisplayPrimayTime: function(time) {
                        return time.hour.toLocaleString('fr-FR', {
                            minimumIntegerDigits: 2,
                            useGrouping: false
                        }) + ':' + time.minutes.toLocaleString('fr-FR', {
                            minimumIntegerDigits: 2,
                            useGrouping: false
                        });
                    },
                    weekDayname: function(dayname) {
                        return '<span class="calendar-week-dayname-name">' + dayname.dayName + '</span><br><span class="calendar-week-dayname-date">' + dayname.date + '</span>';
                    },
                    monthDayname: function(dayname) {
                        return '<span class="calendar-week-dayname-name">' + dayname.label + '</span>';
                    }
                },
                week: {
                    daynames: daynames,
                    startDayOfWeek: 1
                },
                month: {
                    daynames: daynames,
                    startDayOfWeek: 1
                }
            });

            // calendar default on click event
            cal.on({
                'clickSchedule': function(e) {
                    $(".tui-full-calendar-popup-top-line").css("background-color", e.calendar.color);
                    $(".tui-full-calendar-calendar-dot").css("background-color", e.calendar.borderColor);
                },
                'beforeCreateSchedule': function(e) {
                    // new schedule create and save
                    saveNewSchedule(e);
                },
                'beforeUpdateSchedule': function(e) {
                    // schedule update
                    e.schedule.start = e.start;
                    e.schedule.end = e.end;
                    titre_entretien = e.schedule.title;
                    debut_entretien = moment(new Date(e.start).toISOString().slice(0, 16).replace(/-/g, "-").replace("T", " ")).add(new Date().getTimezoneOffset() * -1, 'minutes').format("YYYY-MM-DD HH:mm:ss");
                    fin_entretien = moment(new Date(e.end).toISOString().slice(0, 16).replace(/-/g, "-").replace("T", " ")).add(new Date().getTimezoneOffset() * -1, 'minutes').format("YYYY-MM-DD HH:mm:ss");
                    lieu_entretien = e.schedule.location;
                    id_entretien = e.schedule.id;
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/edit_entretien.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            titre_entretien: titre_entretien,
                            debut_entretien: debut_entretien,
                            fin_entretien: fin_entretien,
                            lieu_entretien,
                            id_entretien: id_entretien
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "success") {
                                addAlert("Entretien mis a jour", "success");
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                    cal.updateSchedule(e.schedule.id, e.schedule.calendarId, e.schedule);
                },
                'beforeDeleteSchedule': function(e) {
                    // schedule delete
                    console.log('beforeDeleteSchedule', e);
                    id_entretien = e.schedule.id;
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/delete_entretien.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_entretien: id_entretien
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "success") {
                                addAlert("Entretien annulé", "success");
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                    cal.deleteSchedule(e.schedule.id, e.schedule.calendarId);
                },
                'clickTimezonesCollapseBtn': function(timezonesCollapsed) {
                    if (timezonesCollapsed) {
                        cal.setTheme({
                            'week.daygridLeft.width': '77px',
                            'week.timegridLeft.width': '77px'
                        });
                    } else {
                        cal.setTheme({
                            'week.daygridLeft.width': '60px',
                            'week.timegridLeft.width': '60px'
                        });
                    }
                    return true;
                }
            });

            // Create Event according to their Template
            function getTimeTemplate(schedule, isAllDay) {
                var html = [];
                var start = moment(schedule.start.toUTCString());
                if (!isAllDay) {
                    html.push('<span>' + start.format('HH:mm') + '</span> ');
                }
                if (schedule.isPrivate) {
                    html.push('<span class="bx bxs-lock-alt font-size-small align-middle"></span>');
                    html.push(' Private');
                } else {
                    if (schedule.isReadOnly) {
                        html.push('<span class="bx bx-block font-size-small align-middle"></span>');
                    } else if (schedule.recurrenceRule) {
                        html.push('<span class="bx bx-repeat font-size-small align-middle"></span>');
                    } else if (schedule.attendees.length) {
                        html.push('<span class="bx bxs-user font-size-small align-middle"></span>');
                    } else if (schedule.location) {
                        html.push('<span class="bx bxs-map font-size-small align-middle"></span>');
                    }
                    html.push(' ' + schedule.title);
                }
                return html.join('');
            }

            // A listener for click the menu
            function onClickMenu(e) {
                var target = $(e.target).closest('[role="menuitem"]')[0];
                var action = getDataAction(target);
                var options = cal.getOptions();
                var viewName = '';
                // on click of dropdown button change calendar view
                switch (action) {
                    case 'toggle-daily':
                        viewName = 'day';
                        break;
                    case 'toggle-weekly':
                        viewName = 'week';
                        break;
                    case 'toggle-monthly':
                        options.month.visibleWeeksCount = 0;
                        options.month.isAlways6Week = false;
                        viewName = 'month';
                        break;
                    case 'toggle-weeks2':
                        options.month.visibleWeeksCount = 2;
                        viewName = 'month';
                        break;
                    case 'toggle-weeks3':
                        options.month.visibleWeeksCount = 3;
                        viewName = 'month';
                        break;
                    case 'toggle-narrow-weekend':
                        options.month.narrowWeekend = !options.month.narrowWeekend;
                        options.week.narrowWeekend = !options.week.narrowWeekend;
                        viewName = cal.getViewName();

                        target.querySelector('input').checked = options.month.narrowWeekend;
                        break;
                    case 'toggle-start-day-1':
                        options.month.startDayOfWeek = options.month.startDayOfWeek ? 0 : 1;
                        options.week.startDayOfWeek = options.week.startDayOfWeek ? 0 : 1;
                        viewName = cal.getViewName();

                        target.querySelector('input').checked = options.month.startDayOfWeek;
                        break;
                    case 'toggle-workweek':
                        options.month.workweek = !options.month.workweek;
                        options.week.workweek = !options.week.workweek;
                        viewName = cal.getViewName();

                        target.querySelector('input').checked = !options.month.workweek;
                        break;
                    default:
                        break;
                }
                cal.setOptions(options, true);
                cal.changeView(viewName, true);

                setDropdownCalendarType();
                setRenderRangeText();
                getEntretiens();
            }

            // on click of next and previous button view change
            function onClickNavi(e) {
                var action = getDataAction(e.target);
                switch (action) {
                    case 'move-prev':
                        cal.prev();
                        break;
                    case 'move-next':
                        cal.next();
                        break;
                    case 'move-today':
                        cal.today();
                        break;
                    default:
                        return;
                }
                setRenderRangeText();
                getEntretiens();
            }

            // Click of new schedule button's open schedule create popup
            function createNewSchedule(event) {
                var start = event.start ? new Date(event.start.getTime()) : new Date();
                var end = event.end ? new Date(event.end.getTime()) : moment().add(1, 'hours').toDate();

                if (useCreationPopup) {
                    cal.openCreationPopup({
                        start: start,
                        end: end
                    });
                }
            }
            // new schedule create
            function saveNewSchedule(scheduleData) {
                var calendar = scheduleData.calendar || findCalendar(scheduleData.calendarId);
                var schedule = {
                    id: String(chance.guid()),
                    title: scheduleData.title,
                    isAllDay: scheduleData.isAllDay,
                    start: scheduleData.start,
                    end: scheduleData.end,
                    category: scheduleData.isAllDay ? 'allday' : 'time',
                    dueDateClass: '',
                    color: calendar.color,
                    bgColor: calendar.bgColor,
                    dragBgColor: calendar.bgColor,
                    borderColor: calendar.borderColor,
                    location: scheduleData.location,
                    raw: {
                        class: scheduleData.raw['class']
                    },
                    state: scheduleData.state
                };
                if (calendar) {
                    schedule.calendarId = calendar.id;
                    schedule.color = calendar.color;
                    schedule.bgColor = calendar.bgColor;
                    schedule.borderColor = calendar.borderColor;
                }
                titre_entretien = schedule.title;
                // On convertis en YYYY-MM-DD HH:mm:ss UTC et on ajoute le decalage horaire
                debut_entretien = moment(new Date(schedule.start).toISOString().slice(0, 16).replace(/-/g, "-").replace("T", " ")).add(new Date().getTimezoneOffset() * -1, 'minutes').format("YYYY-MM-DD HH:mm:ss");
                fin_entretien = moment(new Date(schedule.end).toISOString().slice(0, 16).replace(/-/g, "-").replace("T", " ")).add(new Date().getTimezoneOffset() * -1, 'minutes').format("YYYY-MM-DD HH:mm:ss");
                lieu_entretien = schedule.location;
                $.ajax({
                    url: "../../../html/ltr/coqpix/php/insert_entretien.php", //new path, save your work first before u try
                    type: "POST",
                    data: {
                        titre_entretien: titre_entretien,
                        debut_entretien: debut_entretien,
                        fin_entretien: fin_entretien,
                        lieu_entretien,
                        id_candidature: id_candidature
                    },
                    dataType: "json",
                    success: function(data) {
                        if (data.status == "success") {
                            addAlert("Entretien ajouté", "success");
                        } else {
                            addAlert(data.message, "error");
                        }
                    }
                });

                getEntretiens();
            }

            // view all checkbox initialize
            function onChangeCalendars(e) {
                var calendarId = e.target.value;
                var checked = e.target.checked;
                var viewAll = document.querySelector('.sidebar-calendars-item input');
                var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));
                var allCheckedCalendars = true;

                if (calendarId === 'all') {
                    allCheckedCalendars = checked;

                    calendarElements.forEach(function(input) {
                        var span = input.parentNode;
                        input.checked = checked;
                        span.style.backgroundColor = checked ? span.style.borderColor : 'transparent';
                    });

                    CalendarList.forEach(function(calendar) {
                        calendar.checked = checked;
                    });
                } else {
                    findCalendar(calendarId).checked = checked;

                    allCheckedCalendars = calendarElements.every(function(input) {
                        return input.checked;
                    });

                    if (allCheckedCalendars) {
                        viewAll.checked = true;
                    } else {
                        viewAll.checked = false;
                    }
                }
                refreshScheduleVisibility();
            }
            // schedule refresh according to view
            function refreshScheduleVisibility() {
                var calendarElements = Array.prototype.slice.call(document.querySelectorAll('#calendarList input'));

                CalendarList.forEach(function(calendar) {
                    cal.toggleSchedules(calendar.id, !calendar.checked, false);
                });

                cal.render(true);

                calendarElements.forEach(function(input) {
                    var span = input.nextElementSibling;
                    span.style.backgroundColor = input.checked ? span.style.borderColor : 'transparent';
                });
            }
            // calendar type set on dropdown button
            function setDropdownCalendarType() {
                var calendarTypeName = document.getElementById('calendarTypeName');
                var calendarTypeIcon = document.getElementById('calendarTypeIcon');
                var options = cal.getOptions();
                var type = cal.getViewName();
                var iconClassName;

                if (type === 'day') {
                    type = 'Daily';
                    iconClassName = 'bx bx-calendar-alt mr-25';
                } else if (type === 'week') {
                    type = 'Weekly';
                    iconClassName = 'bx bx-calendar-event mr-25';
                } else if (options.month.visibleWeeksCount === 2) {
                    type = '2 weeks';
                    iconClassName = 'bx bx-calendar-check mr-25';
                } else if (options.month.visibleWeeksCount === 3) {
                    type = '3 weeks';
                    iconClassName = 'bx bx-calendar-check mr-25';
                } else {
                    type = 'Monthly';
                    iconClassName = 'bx bx-calendar mr-25';
                }
                calendarTypeName.innerHTML = type;
                calendarTypeIcon.className = iconClassName;
            }

            function setRenderRangeText() {
                var renderRange = document.getElementById('renderRange');
                var options = cal.getOptions();
                var viewName = cal.getViewName();
                var html = [];
                if (viewName === 'day') {
                    html.push(moment(cal.getDate().getTime()).format('DD-MM-YYYY'));
                } else if (viewName === 'month' &&
                    (!options.month.visibleWeeksCount || options.month.visibleWeeksCount > 4)) {
                    html.push(moment(cal.getDate().getTime()).format('MM-YYYY'));
                } else {
                    html.push(moment(cal.getDateRangeStart().getTime()).format('DD-MM-YYYY'));
                    html.push('-');
                    html.push(moment(cal.getDateRangeEnd().getTime()).format('DD.MM'));
                }
                renderRange.innerHTML = html.join('');
            }
            // Get schedules
            function setSchedules() {
                cal.clear();
                cal.createSchedules(entretiens);
                refreshScheduleVisibility();
            }

            <?php if (isset($candidatures)) {
            ?>

                function getEntretiens() {
                    // Recuperation des entretiens
                    entretiens.length = 0;
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/get_entretiens.php", //new path, save your work first before u try
                        type: "POST",
                        data: {
                            id_candidature: <?= $candidature['id'] ?>
                        },
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "success") {
                                data.entretiens.forEach(function(element) {
                                    var schedule = new ScheduleInfo();

                                    schedule.id = element['id_entretien'];
                                    schedule.calendarId = String(1);

                                    schedule.title = element['titre_entretien'];
                                    schedule.start = moment(element['debut_entretien']).format("YYYY-MM-DDTHH:mm:ssZZ");
                                    schedule.end = moment(element['fin_entretien']).format("YYYY-MM-DDTHH:mm:ssZZ");
                                    schedule.category = 'time';

                                    schedule.location = element['lieu_entretien'];

                                    entretiens.push(schedule);
                                });
                                setSchedules();
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                }
            <?php
            } else {
            ?>

                function getEntretiens() {
                    // Recuperation des entretiens
                    entretiens.length = 0;
                    $.ajax({
                        url: "../../../html/ltr/coqpix/php/get_entretiens.php", //new path, save your work first before u try
                        type: "POST",
                        dataType: "json",
                        success: function(data) {
                            if (data.status == "success") {
                                data.entretiens.forEach(function(element) {
                                    var schedule = new ScheduleInfo();

                                    schedule.id = element['id_entretien'];
                                    schedule.calendarId = String(1);

                                    schedule.title = element['titre_entretien'];
                                    schedule.start = moment(element['debut_entretien']).format("YYYY-MM-DDTHH:mm:ssZZ");
                                    schedule.end = moment(element['fin_entretien']).format("YYYY-MM-DDTHH:mm:ssZZ");
                                    schedule.category = 'time';

                                    schedule.location = element['lieu_entretien'];

                                    entretiens.push(schedule);
                                });
                                setSchedules();
                            } else {
                                addAlert(data.message, "error");
                            }
                        }
                    });
                }
            <?php
            }
            ?>
            // Events initialize
            function setEventListener() {
                $('.menu-navigation').on('click', onClickNavi);
                $('.dropdown-menu [role="menuitem"]').on('click', onClickMenu);
                $('.sidebar-calendars').on('change', onChangeCalendars);
                $('.sidebar-new-schedule-btn').on('click', createNewSchedule);
                window.addEventListener('resize', resizeThrottled);
            }
            // get data-action atrribute's value
            function getDataAction(target) {
                return target.dataset ? target.dataset.action : target.getAttribute('data-action');
            }
            resizeThrottled = tui.util.throttle(function() {
                cal.render();
            }, 50);
            window.cal = cal;
            setDropdownCalendarType();
            setRenderRangeText();
            getEntretiens();
            setEventListener();
        })(window, tui.Calendar);

        // set sidebar calendar list
        (function() {
            var calendarList = document.getElementById('calendarList');
            var html = [];
            CalendarList.forEach(function(calendar) {
                html.push('<div class="sidebar-calendars-item"><label>' +
                    '<input type="checkbox" class="tui-full-calendar-checkbox-round" value="' + calendar.id + '" checked>' +
                    '<span style="border-color: ' + calendar.borderColor + '; background-color: ' + calendar.borderColor + ';"></span>' +
                    '<span>' + calendar.name + '</span>' +
                    '</label></div>'
                );
            });
            calendarList.innerHTML = html.join('\n');
        })();

        $(document).ready(function() {
            <?php
            if (isset($candidatures)) {
            ?>
                $('sidebar-new-schedule').hide();
            <?php
            }
            ?>
            // calendar sidebar scrollbar
            if ($('.sidebar').length > 0) {
                var sidebar = new PerfectScrollbar(".sidebar", {
                    wheelPropagation: false
                });
            }
            // sidebar menu toggle
            $(".sidebar-toggle-btn").on("click", function() {
                $(".sidebar").toggleClass("show");
                $(".app-content-overlay").toggleClass("show");
            })
            // on click Overlay hide sidebar and overlay
            $(".app-content-overlay, .sidebar-new-schedule-btn").on("click", function() {
                $(".sidebar").removeClass("show");
                $(".app-content-overlay").removeClass("show");
            });
        })

        $(window).on("resize", function() {
            // sidebar and overlay hide if screen resize
            if ($(window).width() < 991) {
                $(".sidebar").removeClass("show");
                $(".app-content-overlay").removeClass("show");
            }
        })
    </script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>