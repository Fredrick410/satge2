<!--développé par Apiah Fred -->
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


// Set your timezone
date_default_timezone_set('Asia/Tokyo');

// Get prev & next month
if (isset($_GET['ym'])) {
    $ym = $_GET['ym'];
} else {
    // This month
    $ym = date('Y-m');
}

// Check format
$timestamp = strtotime($ym . '-01');
if ($timestamp === false) {
    $ym = date('Y-m');
    $timestamp = strtotime($ym . '-01');
}

// Today
$today = date('Y-m-j', time());

// For H3 title
$html_title = date('Y / m', $timestamp);

// Create prev & next month link     mktime(hour,minute,second,month,day,year)
$prev = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)-1, 1, date('Y', $timestamp)));
$next = date('Y-m', mktime(0, 0, 0, date('m', $timestamp)+1, 1, date('Y', $timestamp)));
// You can also use strtotime!
// $prev = date('Y-m', strtotime('-1 month', $timestamp));
// $next = date('Y-m', strtotime('+1 month', $timestamp));

// Number of days in the month
$day_count = date('t', $timestamp);
 
// 0:Sun 1:Mon 2:Tue ...
$str = date('w', mktime(0, 0, 0, date('m', $timestamp), 1, date('Y', $timestamp)));
//$str = date('w', $timestamp);


// Create Calendar!!
$weeks = array();
$week = '';

// Add empty cell
$week .= str_repeat('<td></td>', $str);

for ( $day = 1; $day <= $day_count; $day++, $str++) {
     
    $date = $ym . '-' . $day;
     
    if ($today == $date) {
        $week .= '<td class="today">' . $day;
    } else {
        $week .= '<td>' . $day;
    }
    $week .= '</td>';
     
    // End of the week OR End of the month
    if ($str % 7 == 6 || $day == $day_count) {

        if ($day == $day_count) {
            // Add empty cell
            $week .= str_repeat('<td></td>', 6 - ($str % 7));
        }

        $weeks[] = '<tr>' . $week . '</tr>';

        // Prepare for new week
        $week = '';
    }

}
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<html class="loading" lang="en" data-textdirection="ltr">

  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Rh-Stage</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Noto+Sans" rel="stylesheet">
    <style>
        .container {
            font-family: 'Noto Sans', sans-serif;
            margin-top: 80px;
        }
        h3 {
            margin-bottom: 30px;
        }
        th {
            height: 30px;
            text-align: center;
        }
        td {
            height: 100px;
        }
        .today {
            background: orange;
        }
        th:nth-of-type(1), td:nth-of-type(1) {
            color: red;
        }
        th:nth-of-type(7), td:nth-of-type(7) {
            color: blue;
        }
    </style>
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-todo.mincss">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="vertical-layout vertical-menu-modern <?php if ($entreprise['theme_web'] == "light") {echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if ($entreprise["theme_web"] == "light") {
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
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="rh-home.php" data-toggle="tooltip" data-placement="top" title="Retour"><div class="livicon-evo" data-options=" name: share-alt.svg; style: lines; size: 40px; strokeWidth: 2; rotate: -90"></div></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="file-manager.php", data-toggle="tooltip" data-placement="top" title="CloudPix"><div class="livicon-evo" data-options=" name: cloud-upload.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link" href="helpdesk-chat-user.php",data-toggle="tooltip" data-placement="top" title="Chat'Pix"><div class="livicon-evo" data-options=" name: comments.svg; style: filled; size: 40px; strokeColorAction: #8a99b5; colorsOnHover: darker "></div></a></li>
                        </ul>  
                    </div>
                        <ul class="nav navbar-nav float-right">
                            <li class="dropdown dropdown-language nav-item"><a class="dropdown-toggle nav-link" id="dropdown-flag" href="javascript:void(0);" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="flag-icon flag-icon-us"></i><span class="selected-language">English</span></a>
                                <div class="dropdown-menu" aria-labelledby="dropdown-flag"><a class="dropdown-item" href="javascript:void(0);" data-language="en"><i class="flag-icon flag-icon-us mr-50"></i> English</a><a class="dropdown-item" href="javascript:void(0);" data-language="fr"><i class="flag-icon flag-icon-fr mr-50"></i> French</a><a class="dropdown-item" href="javascript:void(0);" data-language="de"><i class="flag-icon flag-icon-de mr-50"></i> German</a><a class="dropdown-item" href="javascript:void(0);" data-language="pt"><i class="flag-icon flag-icon-pt mr-50"></i> Portuguese</a></div>
                            </li>
                            <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li></li>
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a></a>
                                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                            <li class="dropdown-menu-header">
                                <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span
                                class="notification-title">0 Notifications</span></div>
                            </li>
                            <li class="dropdown-menu-footer">
                                <div class="dropdown-footer px-1 py-75 d-flex justify-content-center"><span class="notification-title">Aucune
                                        Notification</span></div>
                            </li>
                        </ul>
               
                            <li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="bx bx-chat"></i><span class="badge badge-pill badge-danger badge-up"></span></a>
                            <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                                <div class="user-nav d-sm-flex d-none"><span class="user-name">MOUFEKKIR Karim</span><span class="user-status text-muted">Audit action plus</span></div><span><img class="round" src="../../../src/img/astro1.gif" alt="avatar" height="40" width="40"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right pb-0">
                                    <style>.none-validation{display: none;}</style>
                            <a class="dropdown-item" href="page-user-profile.php">
                                <i class="bx bx-user mr-50"></i>
                                Profil
                            </a>
                            <div class="dropdown-divider mb-0">

                            </div>
                            <a class="dropdown-item" href="php/disconnect.php">
                                <i class="bx bx-power-off mr-50"></i>
                                Se déconnecter
                            </a>
                            <div class="dropdown-divider mb-0"></div>
                                 <a class="dropdown-item" href="php/change_theme.php?num=62&theme=light&path=/coqpix/html/ltr/coqpix/rh-gestion-p.php">
                                <i class="bx bxs-moon mr-50 "></i>
                                <i class="bx bx-moon mr-50 none-validation"></i>
                                Apparence</a> 
                             </div>
                            </li>
                        </ul>
          </div>
        </div>
      </div>
    </nav>
    <!-- END: Header-->
    
<!-- BEGIN: Main Menu-->
    <div class="main-menu menu-fixed menu-dark menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header">
        <ul class="nav navbar-nav flex-row">
            <style>
            
            .logocoq{
                width:70%;
                height: 100%;
            }
            
            </style>
            <li class="nav-item mr-auto modern-nav-toggle text-center">
                <img class="logocoq" src="../../../app-assets/images/logo/coqpix1.png" />
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation" data-icon-style="lines">
            <li class=" nav-item"><a href="#"><div class="livicon-evo" data-options=" name: rocket.svg; style:filled; size: 30px "></div>&nbsp&nbsp&nbsp<span class="menu-title" data-i18n="Dashboard">Coqpit</span></a>
                <ul class="menu-content">
                    <li><a href="dashboard-analytics.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="eCommerce">Analytique</span></a>
                    </li>
                    <li><a href="page-coming-soon.html#dashboard-ecommerce.html"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Analytics">eCommerce</span>&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                    </li>
                    <li><a href="file-manager.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Cloudpix">CloudPix</span></a>
                    </li>
                    <li><a href="#"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Chat">Chat'Pix</span></a>
                    </li>
                </ul>
            </li>
            <li class=" navigation-header"><span>Fonctions</span>
            </li>

            <!-- VENTES -->
                            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="coins"></i><span class="menu-title" data-i18n="Ventes">Ventes</span></a>
                    <ul class="menu-content">
                        <li><a href="app-devis-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Devis">Devis</span></a>
                        </li>
                        <li><a href="app-invoice-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Facture">Factures</span></a>
                        </li>
                        <li><a href="app-avoir-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Avoir">Avoirs</span></a>
                        </li>
                        <li><a href="app-bon-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bon de livraison">Bons de livraison</span></a>
                        </li>
                    </ul>
                </li>
            
            <!-- ACHATS -->
                            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="us-dollar"></i><span class="menu-title" data-i18n="Achats">Achats</span></a>
                    <ul class="menu-content">
                        <li><a href="app-invoice-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Factures">Factures</span></a>
                        </li>
                        <li><a href="app-bon-achat-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Bulletin de commande">Bulletins de commande</span></a>
                        </li>
                        <li><a href="app-note-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Note de frais">Note de frais</span></a>
                        </li>
                    </ul>
                </li>
            
            <!-- PROJETS -->
                            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="users"></i><span class="menu-title" data-i18n="Projet">Projets</span></a>
                    <ul class="menu-content">
                        <li><a href="page-coming-soon.html#mission.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Mission">Missions &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></span></a>
                        </li>
                        <li><a href="teams-list.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Equipes">Teams</a>
                        </li>
                        <li><a href="task.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Taches">Taches</span></a>
                        </li>
                    </ul>
                </li>
            
            <!-- INVENTAIRE -->
                            <li class=" nav-item"><a href="inventaire-list.php"><i class="menu-livicon" data-icon="box-add"></i><span class="menu-title" data-i18n="Stockage">Inventaire</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a></li>
                        
            <!-- BUSINESS -->
            <li class=" nav-item"><a href="opportunite.php"><i class="menu-livicon" data-icon="trophy"></i><span class="menu-title" data-i18n="Buisness">Business</span><span class="badge badge-light-warning badge-pill badge-round float-right">VIP</span></a>
            </li>

            <!-- FORMATIONS -->
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="briefcase"></i><span class="menu-title" data-i18n="Formation">Formations</span></a>
                <ul class="menu-content">
                    <li><a href="page-coming-soon.html#academy.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="Academy">Pix'Academy</span>&nbsp&nbsp<span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
                    </li>
                    <li><a href="#maforma.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="MA FORMA">Ma Forma</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                    </li>
                </ul>
            </li>
            
            <!-- RH -->
            <li class=" nav-item"><a href="rh-home.php"><i class="menu-livicon" data-icon="diagram"></i><span class="menu-title" data-i18n="Stockage">RH</span><span class="badge badge-light-warning badge-pill badge-round float-right">VIP</span></a>
            </li>

            <!-- Veille -->
            <li class=" nav-item"><a href="#"><i class="menu-livicon" data-icon="sky-dish"></i><span class="menu-title" data-i18n="Veille">Veille</span></a>
                <ul class="menu-content">
                    <li><a href="bookmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="bookmarks">BookMarks</span></a>
                    </li>
                    <li><a href="#benchmark.php"><i class="bx bx-right-arrow-alt"></i><span class="menu-item" data-i18n="benchmark">BenchMark</span>&nbsp&nbsp<span class="badge badge-light-danger badge-pill badge-round float-right">PRO</span></a>
                    </li>
                </ul>
            </li>

            <li class=" navigation-header"><span>Données</span>
            </li>

            <!-- CLIENTS -->
                            <li class=" nav-item"><a href="client.php"><i class="menu-livicon" data-icon="user"></i><span class="menu-title" data-i18n="Clients">Clients</span></a></li>
            
            <!-- FOURNISSEURS -->
                            <li class=" nav-item"><a href="fournisseur-list.php"><i class="menu-livicon" data-icon="truck"></i><span class="menu-title" data-i18n="Fournisseurs">Fournisseurs</span></a></li>
            
            <!-- ARTICLES -->
                            <li class=" nav-item"><a href="article-list.php"><i class="menu-livicon" data-icon="tag"></i><span class="menu-title" data-i18n="Articles">Articles</span></a></li>
            
            <!-- MEMBRES -->
                            <li class=" nav-item"><a href="membres-liste.php"><i class="menu-livicon" data-icon="grid"></i><span class="menu-title" data-i18n="Membres">Membres</span></a></li>
            
            <li class=" navigation-header"><span>Déclarations</span>
            </li>
            <li class=" nav-item"><a href="social.php"><i class="menu-livicon" data-icon="umbrella"></i><span class="menu-title" data-i18n="Charts">Sociales</span></span></a>
            </li>
            <li class=" nav-item"><a href="fiscale.php"><i class="menu-livicon" data-icon="piggybank"></i><span class="menu-title" data-i18n="Google Maps">Fiscales</span></a>
            </li>
            <li class=" nav-item"><a href="bilan.php?5PAx4zf27P=2021&S3q4EvFDk4QZ95b4v3gz"><i class="menu-livicon" data-icon="notebook"></i><span class="menu-title" data-i18n="Bilans">Bilans</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#balance.php"><i class="menu-livicon" data-icon="balance"></i><span class="menu-title" data-i18n="Balances">Balances</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" navigation-header"><span>Divers</span>
            </li>
            <li class=" nav-item"><a href="#shop.php"><i class="menu-livicon" data-icon="shoppingcart"></i><span class="menu-title" data-i18n="shoppingcart">Shop'ix</span><span class="badge badge-light-info badge-pill badge-round float-right">PROMO</span></a>
            </li>
            <li class=" nav-item"><a href="outils.php"><i class="menu-livicon" data-icon="heart"></i><span class="menu-title" data-i18n="Google Maps">Outils</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#financement.php"><i class="menu-livicon" data-icon="credit-card-in"></i><span class="menu-title" data-i18n="Google Maps">Financement</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" nav-item"><a href="page-coming-soon.html#assurance.php"><i class="menu-livicon" data-icon="car"></i><span class="menu-title" data-i18n="Google Maps">Assurance</span><span class="badge badge-light-primary badge-pill badge-round float-right">SOON</span></a>
            </li>
            <li class=" nav-item"><a href="news.php"><i class="menu-livicon" data-icon="bell"></i><span class="menu-title" data-i18n="Google Maps">News</span></a>
            </li>
            <li class=" nav-item"><a href="faq.php"><i class="menu-livicon" data-icon="info"></i><span class="menu-title" data-i18n="Google Maps">FAQ</span></a>
            </li>
        </ul>
    </div>
</div>
<!-- END: Main Menu--> 

<!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
            <div class="content-wrapper">
               <div class="content-header row">
            </div>
                   <div class="content-body"><!-- calendar Wrapper  -->
                   <div class="calendar-wrapper position-relative">
                   <!-- calendar app overlay -->
                   <div class="app-content-overlay"></div>
                   <!-- calendar sidebar start -->
                   <div id="sidebar" class="sidebar">
                   <div class="sidebar-new-schedule">
                   <!-- create new schedule button -->
                   <button id="btn-new-schedule" type="button" class="btn btn-primary"> New schedule</button>
            </div>
        </div   
    </div> 


    <div class="container">
        <h3><a href="?ym=<?php echo $prev; ?>">&lt;</a> <?php echo $html_title; ?> <a href="?ym=<?php echo $next; ?>">&gt;</a></h3>
        <table class="table table-bordered">
            <tr>
                <th>S</th>
                <th>M</th>
                <th>T</th>
                <th>W</th>
                <th>T</th>
                <th>F</th>
                <th>S</th>
            </tr>
            <?php
                foreach ($weeks as $week) {
                    echo $week;
                }
            ?>
        </table>
    </div>







 
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