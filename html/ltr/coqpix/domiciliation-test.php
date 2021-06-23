<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea']);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();

    if($crea['doc_pieceid'] == ""){
        $doc_pieceid = "0";
    }else{
        $doc_pieceid = "1";
    }
    if($crea['doc_cerfaM0'] == ""){
        $doc_cerfaM0 = "0";
    }else{
        $doc_cerfaM0 = "1";
    }
    if($crea['doc_justificatifd'] == ""){
        $doc_justificatifd = "0";
    }else{
        $doc_justificatifd = "1";
    }
    if($crea['doc_affectation'] == ""){
        $doc_affectation = "0";
    }else{
        $doc_affectation = "1";
    }
    if($crea['doc_pouvoir'] == ""){
        $doc_pouvoir = "0";
    }else{
        $doc_pouvoir = "1";
    }
    if($crea['doc_attestation'] == ""){
        $doc_attestation = "0";
    }else{
        $doc_attestation = "1";
    }
    if($crea['doc_xp'] == ""){
        $doc_xp = "0";
    }else{
        $doc_xp = "1";
    }
    if($crea['doc_peirl'] == ""){
        $doc_peirl = "0";
    }else{
        $doc_peirl = "1";
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
    <title>Création de société</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<style>

@font-face{
    font-family: "mukta malar bold";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Bold.ttf");
}

@font-face{
    font-family: "mukta malar medium";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Medium.ttf");
}

@font-face{
    font-family: "mukta malar light";
    src: url("../../../app-assets/css/Mukta_Malar/MuktaMalar-Light.ttf");
}

#titre{
    font-family: mukta malar medium;
    color: white;
    margin: 20% 0 0 10%;
    font-size: 60px;
    width: 80%;
}

#titre p{
    line-height: 70px;
}

#sous-titre{
    font-family: mukta malar medium;
    color: white;
    margin: 20px 0 0 10%;
    font-size: 17px;
}

#sous-titre p{
    width: 70%;
}

.container-fluid {
    padding-top: 68px;
}

#div-titre-gauche{
    background-color: #051441;
    border-radius: 0 400px 400px 0;
    
}

#div-titre-droite h1{
    color: #051441;
    font-family: mukta malar medium;
}

#solution{
    margin: 10% 0 0 10%;
}

#solution-logo{
    margin-top: 50px;
}

#solution-logo ul{
    
}

#solution-logo ul li{
    list-style: none;
    display: inline-block;
    margin: 10px;
}

#solution-logo ul li p{
    margin: 10px;
    text-align: center;
    font-family: mukta malar medium;
    color: #051441;
}

#localisation{
    margin-top: 50px;
}
    
</style>

<!-- BEGIN: Body-->
<body class="horizontal-layout horizontal-menu navbar-sticky bg-white content-left-sidebar email-application  footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="content-left-sidebar">

    <!-- BEGIN: Header-->
    
    <?php require_once("php/header-crea.php") ?>
    <!-- END: Header-->

    <!-- BEGIN: Content-->
    <div class="container-fluid">
        <div class="row" style="height: 800px;">
            <div class="col-6 p-0" id="div-titre-gauche" >
                <div id="titre"><p>Grâce à COQPIX et nos partenaires.<br> Domiciliez-vous <span style="color: #29fe8c;">rapidement</span> et <span style="color: #29fe8c;">facilement</span> </p></div>
                <div id="sous-titre"><p>Bureaux privatifs modulables, Spots de coworking, salles de réunion, domiciliation d'entreprise...<br> Que vous soyez entrepreneur, start-up, PME ou grande entreprise, trouvez la solution de travail flexible qui vous convient.</p></div>
            </div>
            <div class="col-6" id="div-titre-droite">
                <div id="solution" class="col-8">
                    <div>
                        <h1>Nos solutions</h1>
                        <div id="solution-logo">
                            <ul>
                                <li>
                                    <img src="../../../app-assets/images/pages/bureau.png" width= 150px; >
                                    <p>Bureaux privatifs</p>
                                </li>
                                <li>
                                    <img src="../../../app-assets/images/pages/coworking.png" width= 150px; >
                                    <p>Coworking</p>
                                </li>
                                <li>
                                    <img src="../../../app-assets/images/pages/domiciliation.png" width= 150px; >
                                    <p>Domiciliation</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="localisation">
                        <div class="form-group">
                            <label class="" style="font-size: 15px; font-family: mukta malar bold; color: #051441; margin-left: 25px">Localisation</label>
                            <input type="text" id="" name="" style="font-family: mukta malar medium; color: #051441; margin-top: 20px;" class="form-control border rounded-pill border-dark" placeholder="Entrez une ville..." required>
                        </div>
                        <div class="form-group" style="text-align: center; margin-top: 50px;">
                            <button type="submit" id='' style="font-family: mukta malar bold; width: 200px; white-space: nowrap; background-color: #29fe8c;" class="btn text-dark glow position-relative border rounded-pill">Rechercher<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Chat-->
    <div class='cible' id="cible2">
        <button class="open-button">Chat</button>
        <button onclick="openForm()">Expand</button>
        <div class="chat-popup" id="myForm">
            <form action="/action_page.php" class="form-container">
                <h1>Chat</h1>
                <label for="msg"><b>Message</b></label>
                <textarea placeholder="Type message.." name="msg" required></textarea>

                <button type="submit" class="btn">Send</button>
                <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
            </form>
        </div>
    </div>
    <!-- END: Chat-->


    <style>

/* Button used to open the chat form - fixed at the bottom of the page */
.open-button {
  background-color: #555;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  opacity: 0.8;
  position: relative;
  width: 280px;
}

/* The popup chat - hidden by default */
.chat-popup {
  display: none;
  position: absolute;
  width: 280px;
  border: 3px solid #f1f1f1;
  z-index: 9;
}

/* Add styles to the form container */
.form-container {
  max-width: 300px;
  padding: 10px;
  background-color: white;
}

/* Full-width textarea */
.form-container textarea {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  border: none;
  background: #f1f1f1;
  resize: none;
  min-height: 200px;
}

/* When the textarea gets focus, do something */
.form-container textarea:focus {
  background-color: #ddd;
  outline: none;
}

/* Set a style for the submit/send button */
.form-container .btn {
  background-color: #04AA6D;
  color: white;
  padding: 16px 20px;
  border: none;
  cursor: pointer;
  width: 100%;
  margin-bottom:10px;
  opacity: 0.8;
}

/* Add a red background color to the cancel button */
.form-container .cancel {
  background-color: red;
}

/* Add some hover effects to buttons */
.form-container .btn:hover, .open-button:hover {
  opacity: 1;
}

.cible { 
  cursor:move;
  /* Obligatoire sur l'élément draggable */
  position:absolute;
}
 
/* Class ajouté quand on dragge */
.oWdgCursorDrag{
 
} 

/* Position initiale */
#cible2{right : 25%; bottom:20%}
</style>


<script>
function openForm() {
  document.getElementById("myForm").style.display = "block";
}

function closeForm() {
  document.getElementById("myForm").style.display = "none";
}


var oWdgCursor = function (sElement, sLimite) {
  this.oLimite = null;
  this.oElement = null;
  this.oLimite = document.getElementById(sLimite);
  this.bDrag = false;
  this.bError = false;
  this.sClassDrag = 'oWdgCursorDrag';
  this.oPos = {x:0,y:0};
  this.moveDiv = this.moveDiv.bind(this); 
  this.getBoundingLimite = function(){
    if(this.oLimite == document.documentElement){
      return  {width:window.innerWidth, 
               height:window.innerHeight,
               top:this.oLimite.offsetTop,
               left:this.oLimite.offsetLeft
              }
    }
    return this.oLimite.getBoundingClientRect();
  }
  /**
  * Initialise les evenements
  */
  this.init = function (sLimite, sElement) {  
    this.oElement = document.getElementById(sElement); 
    this.oLimite =(sLimite === undefined)? document.documentElement:document.getElementById(sLimite);
    if(this.oElement == null || this.oLimite == null){
      return true;
    }//if
    this.oElement.addEventListener('mousedown', this.moveDiv);
    this.oElement.addEventListener('touchstart', this.moveDiv);
    return false;
  }//fct 

  this.bError = this.init(sLimite, sElement);
}//fct

oWdgCursor.prototype.moveDiv  = function (oEvent){
  oEvent.preventDefault();
  if(oEvent.type=="touchstart" || oEvent.type=="mousedown"){
    this.bDrag = true;
    var oTouch = oEvent,
        oRect = this.oElement.getBoundingClientRect();
    if(oEvent.type=="touchstart"){
      oTouch = null;
      if (oEvent.targetTouches.length > 0 ) {
        for(var i = 0; i < oEvent.targetTouches.length ; i++){
          if(oEvent.targetTouches[i].target == this.oElement){
            oTouch = oEvent.targetTouches[i];
            break;
          }//if
        }//for
      }//if
      if(oTouch==null){return}
    } //if
    this.oPos = {'left':(oTouch.clientX - oRect.left),'top': (oTouch.clientY - oRect.top)};
    document.addEventListener('mouseup', this.moveDiv) ;
    this.oElement.addEventListener('mouseup', this.moveDiv) ;
    document.addEventListener('touchend', this.moveDiv) ; 

    document.addEventListener('mousemove', this.moveDiv) ; 
    document.addEventListener('touchmove', this.moveDiv) ; 
  }else if(oEvent.type=="touchend" || oEvent.type=="mouseup"){
    this.bDrag = false;
    this.oElement.classList.remove(this.sClassDrag)
    document.removeEventListener('mousemove', this.moveDiv) ;
    document.removeEventListener('touchmove', this.moveDiv) ;
    document.removeEventListener('mouseup', this.moveDiv) ;
    document.removeEventListener('touchend', this.moveDiv) ; 
    this.oElement.removeEventListener('mouseup', this.moveDiv) ;
  }else if(oEvent.type=="touchmove" || oEvent.type=="mousemove"){
    var oTouch = oEvent;

    if(oEvent.type=="touchmove"){
      oTouch = null;
      if (oEvent.targetTouches.length > 0 ) {
        for(var i = 0; i < oEvent.targetTouches.length ; i++){
          if(oEvent.targetTouches[i].target == this.oElement){
            oTouch = oEvent.targetTouches[i];
            break;
          }//if
        }//for
      }//if
      if(oTouch==null){return}
    }//if
    if(this.bDrag == true){ 
      this.oElement.classList.add(this.sClassDrag)
      var oRect = this.getBoundingLimite(),
          iWidth= this.oElement.offsetWidth,
          iHeight = this.oElement.offsetHeight, 
          iClientX = oTouch.clientX - oRect.left - this.oPos.left,
          iClientY = oTouch.clientY- oRect.top - this.oPos.top 
      ;
      if(iClientX < 0 ){
        iClientX = 0;
      }else if(iClientX + iWidth > oRect.width){
        iClientX = oRect.width - iWidth ;
      }
      if(iClientY < 0 ){
        iClientY = 0;
      }else if(iClientY + iHeight > oRect.height){
        iClientY = oRect.height - iHeight ;
      } 
      this.oElement.style.left = iClientX+'px';
      this.oElement.style.top  = iClientY+'px';   
    }//if
    else{
      this.oElement.classList.remove(this.sClassDrag)
    }
  }//else if
}//fct 

document.addEventListener('DOMContentLoaded',function(){  
  var oZone2 = new oWdgCursor('cible2'); 
});

</script>




    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/editors/quill/quill.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
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