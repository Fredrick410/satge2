<?php 
include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';

    $pdoS = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoS->bindValue(':numentreprise',$_SESSION['id']);
    $pdoS->execute();
    $entreprise = $pdoS->fetch();

    //Horaire du support - coqpix

    $date_h = date('H') + 2;
    $date_m = date('i');
    $commencement = "9";
    $fin = "16";
    $pause_start = "12";
    $pause_close = "14";

    if($date_h >= $commencement && $date_h <= $fin){

        if($date_h >= $pause_start && $date_h <= $pause_close){
            if($date_h == $pause_close){
                if($date_m !== 0){
                    $horaire = "online§Disponible";
                }
            }else{
                $horaire = "away§En pause ;) bonne appetit";
            }
        }else{
            $horaire = "online§Disponible";
        }

        if($date_h == $fin){
            if($date_m !== 0){
                $horaire = "offline§Hors ligne";
            }
        }else{
            $horaire = "online§Disponible";
        }

    }else{

        $horaire = "offline§Hors ligne";

    }

    $horaire_support = explode("§", $horaire);


?>
<!DOCTYPE html>
<html lang="fr">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Support - Coqpix</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Rubik:400,400i,500,500i,700,700i&amp;display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,500,500i,700,700i,900&amp;display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/fontawesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/scrollbar.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/style.css">
    <link id="color" rel="stylesheet" href="../../../cuba/assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="../../../cuba/assets/css/responsive.css">
  </head>
  <body>
    <style>
        .bouge {
            overflow-y: auto;
            scrollbar-color: #39DA8A #f0f0f0;
            scrollbar-width: thin;
        }
        .nav-list{border-radius: 5px; width: 80%; height: 40px;}
        .nav-list:hover{background-color: rgba(57, 218, 138, .5);}
        .nav-linked{position: relative; top: 18%;}
    </style>
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="sidebar-wrapper">
          <div>
            <div class="logo-wrapper" style="padding: 15px;"><a href="support-chat.php"><img class="img-fluid for-light" src="../../../app-assets/images/logo/chatpix4.png" alt=""></a>
            </div>
            <nav class="sidebar-main">
              <div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
              <div id="sidebar-menu">
                <ul class="sidebar-links" id="simple-bar">
                  <li class="back-btn">
                    <br>
                  </li>
                  <li class="nav-list"><a class="nav-linked" href="dashboard-analytics.php"><i data-feather="arrow-left"></i><span>Retour Coqpix</span></a></li>
                  <script>
                    function retourn() {
                        window.history.back();
                    }
                </script>
                </ul>
              </div>
              <div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
            </nav>
          </div>
        </div>
        <!-- Page Sidebar Ends-->
        <div class="form-group">
            <br><br><br>
        </div>
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col call-chat-sidebar col-sm-12">
                <div class="card">
                  <div class="card-body chat-body">
                    <div class="chat-box">
                      <!-- Chat left side Start-->
                      <div class="chat-left-aside">
                        <div class="media"><img class="rounded-circle user-image" src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="error img">
                          <div class="about">
                            <div class="name f-w-600"><?= $entreprise['nameentreprise'] ?></div>
                            <div class="status">En ligne</div>
                          </div>
                        </div>
                        <div class="people-list" id="people-list">
                          <div class="search">
                            <form class="theme-form">
                              <div class="mb-3">
                                <input class="form-control" type="text" placeholder="search"><i class="fa fa-search"></i>
                              </div>
                            </form>
                          </div>
                          <ul class="list">
                            <li class="clearfix"><img class="rounded-circle user-image" src="../../../app-assets/images/ico/chatpix3.png" alt="">
                              <div class="status-circle <?= $horaire_support[0] ?>"></div>
                              <div class="about">
                                <div class="name">Chat'Pix</div>
                                <div class="status"><?= $horaire_support[1] ?></div>
                              </div>
                            </li>
                          </ul>
                        </div>
                      </div>
                      <!-- Chat left side Ends-->
                    </div>
                  </div>
                </div>
              </div>
              <div class="col call-chat-body">
                <div class="card">
                  <div class="card-body p-0">
                    <div class="row chat-box">
                      <!-- Chat right side start-->
                      <div class="col pe-0 chat-right-aside">
                        <!-- chat start-->
                        <div class="chat">
                          <!-- chat-header start-->
                          <div class="chat-header clearfix"><img class="rounded-circle" src="../../../src/img/astro4.gif" alt="">
                            <div class="about">
                              <div class="name">Pix - Support </div>
                            </div>
                            <ul class="list-inline float-start float-sm-end chat-menu-icons">
                              <li class="list-inline-item"><a href="#" title="Pas encore disponible"><i class="icon-clip"></i></a></li>
                            </ul>
                          </div>
                          <!-- chat-header end-->
                          <div class="chat-history chat-msg-box bouge">
                            <ul>
                              <div class="chat-content">
                                <li>
                                    <div class="message my-message"><img class="rounded-circle float-start chat-user-img img-30" src="../../../cuba/assets/images/user/3.png" alt="">
                                    <div class="message-data text-end"><span class="message-data-time">10:12 am</span></div>                                                            Are we meeting today? Project has been already finished and I have results to show you.
                                    </div>
                                </li>
                                <li>
                                    <div class="message pull-right"><img class="rounded-circle float-end chat-user-img img-30" src="../../../cuba/assets/images/user/12.png" alt="">
                                    <div class="message-data"><span class="message-data-time">10:14 am</span></div>                                                            Well I am not sure. The rest of the team is not here yet. Maybe in an hour or so?
                                    </div>
                                </li>
                              </div>
                            </ul>
                          </div>
                          <!-- end chat-history-->
                          <div class="chat-message clearfix">
                            <div class="row">
                              <div class="col-xl-12 d-flex">
                                <div class="smiley-box" style="background-color: #39DA8A;">
                                  <div class="picker"><img src="../../../cuba/assets/images/smiley.png" alt=""></div>
                                </div>
                                <div class="input-group text-box">
                                  <input type="hidden" name="id" id="id_client" value="<?= $_SESSION['id_session'] ?>">
                                  <input type="hidden" name="author" id="author" value="<?= $entreprise['nameentreprise'] ?>">
                                  <input class="form-control" style="border: 1px solid #39DA8A;" type="text" id="content" name="message-to-send" placeholder="Tapez votre message ici...">
                                  <button class="input-group-text btn" style="background-color: #39DA8A;" id="btn_submit" type="button">Envoyer</button>
                                </div>
                              </div>
                            </div>
                          </div>
                          <!-- end chat-message-->
                          <!-- chat end-->
                          <!-- Chat right side ends-->
                        </div>
                      </div>          
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
      </div>
    </div>
    <!-- latest jquery-->
    <script src="../../../cuba/assets/js/jquery-3.5.1.min.js"></script>
    <!-- Bootstrap js-->
    <script src="../../../cuba/assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="../../../cuba/assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="../../../cuba/assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="../../../cuba/assets/js/scrollbar/simplebar.js"></script>
    <script src="../../../cuba/assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="../../../cuba/assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="../../../cuba/assets/js/fullscreen.js"></script>
    <script src="../../../cuba/assets/js/tooltip-init.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="../../../cuba/assets/js/script.js"></script>
    <script src="../../../app-assets/js/scripts/pages/chat_support.js"></script>
    <!-- login js-->
    <!-- Plugin used-->
        <!-- TIMEOUT -->
        <?php include('timeout.php'); ?>
  </body>
</html>