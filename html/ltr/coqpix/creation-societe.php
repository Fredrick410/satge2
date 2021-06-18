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
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css"/>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

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

@media only screen and (max-width: 1000px) {
  #img_crea {
    display:none;
  }
}

@media screen and (max-width: 500px){
    #titre{
     font-size: 20px;
	}
}

@media screen and (max-width: 370px){
    #titre{
     font-size: 15px;
	}
}

.line {
    text-decoration: underline;
}

label, button{
    margin-top: 15px;
    font-family: mukta malar bold;
    color: #051441;
}

h2{
    font-family: mukta malar bold;
    color: #051441;
}

input, option{
    font-family: mukta malar medium;
    color: #051441;
}

small{
    font-family: mukta malar light;
    color: #051441;
}

.green-line{
    color: inherit;
    text-decoration: none;
    background: linear-gradient(to bottom, transparent 31px, rgba(41,254,140,1) 45px, white 1px);
}


.green-line:hover{
    color: inherit;
    text-decoration: none;
}

</style>

<!-- BEGIN: Body-->
<body class="vertical-layout vertical-menu-modern 1-column bg-white navbar-sticky footer-static blank-page blank-page p-0 m-0" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">

    <!-- BEGIN: Content-->

            
            

                <!-- register section starts -->
                
                            
                    
                        <div class="container-fluid p-0 m-0" style="">
                            <div class="row p-0 m-0" style="">

                                
                                <!-- image section left -->
                                <div class="col-lg-6">
                                    <div class="card-header pb-0">
                                        <div class="m-3" style="text-align: center; white-space: nowrap;">
                                            <h2 id="titre" class="mb-5"><a class="green-line" href="#">Créez</a> votre société<br> rapidement et <span style="text-decoration: underline wavy #29fe8c;">gratuitement</h2>

                                        </div>
                                    </div>
                                    <img class="img-fluid m-0" id="img_crea" src="../../../app-assets/images/pages/register2.png" alt="branding logo" style="height: 75%; bottom:0; position: absolute;">
                                </div>

                                <!-- register section right -->
                                <div class="col-lg-6">
                                    <div class="card-content" >
                                            <div class="card-body" >
                                                <form action="php/insert_crea_client.php" method="POST">
                                                <br>
                                                    <div class="form-group">
                                                        <label class="line">Remplissez le formulaire de contact</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label>Nom du dirigeant *</label>
                                                            <input type="text" name="nom_diri" class="form-control border rounded-pill border-dark" placeholder="Nom du dirigeant" required>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label for="inputlastname4">Prénom du dirigeant *</label>
                                                            <input type="text" name="prenom_diri" class="form-control border rounded-pill border-dark" placeholder="Prénom du dirigeant" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Nom de l'entreprise *</label>
                                                        <input type="text" name="crea_societe" class="form-control border rounded-pill border-dark" placeholder="Nom de l'entreprise" required></div>
                                                    <div class="form-group mb-50">
                                                        <label class="invoice-address form-group">Forme Juridique</label>
                                                        <span title="Vous pouvez demander de l'aide à un conseiller après votre inscription dans la catégorie chat"><span class="livicon-evo" data-options=" name: bulb.svg; size: 20px "></span></span>
                                                        <select name="status_crea" style="margin-top:-10px;" class="form-control border rounded-pill border-dark invoice-item-select">
                                                            <option value="" selected>Choisir une forme juridique</option>
                                                            <optgroup label="Morale">
                                                                <option value="SARL">SARL</option>
                                                                <option value="SAS">SAS</option>
                                                                <option value="SASU">SASU</option>
                                                                <option value="SCI">SCI</option>
                                                                <option value="EURL">EURL</option>
                                                            </optgroup>
                                                            <optgroup label="Physique">
                                                                <option value="EIRL">EIRL</option>
                                                                <option value="EI">EI</option>
                                                                <option value="Micro-entreprise">Micro-entreprise</option>
                                                            </optgroup>    
                                                        </select>
                                                    </div>
                                                    <div class="form-row" >
                                                        <div class="form-group col-md-6 mb-50" >
                                                            <label class="text-bold-600">Téléphone du dirigeant *</label><br>
                                                            <div class="alert alert-info" style="display: none;"></div>
                                                            <input type="number" name="tel_diri" id="tel_diri" class="form-control border rounded-pill border-dark" required>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-50"></div>
                                                    </div>
                                                    <br>
                                                    <br>
                                                    <div class="form-group">
                                                        <label class="line">Information de connexion</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">E-mail (Identifiant de connexion) *</label>
                                                        <input type="text" name="email_crea" class="form-control border rounded-pill border-dark" placeholder="E-mail de contact" required>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600">Mot de passe (Identifiant de connexion) *</label>

                                                        <input type="password" name="password_crea" class="form-control border rounded-pill border-dark" placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600" style="margin-top:0;">Vérification du mot de passe</label>
                                                        <input type="password" name="password_crea" class="form-control border rounded-pill border-dark" placeholder="Mot de passe" required>

                                                    </div>
                                                    <div class="form-group">
                                                        <small>*Champ obligatoire</small>
                                                    </div>
                                                    <div class="form-group" style="text-align: center;">
                                                    <button type="submit" style="width: 150px; white-space: nowrap; background-color: #29fe8c;" class="btn text-dark glow position-relative border rounded-pill">Je me lance<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                    </div>
                                                </form>
                                            </div>
                                    </div>

                                </div>
                         
                            </div>

                        </div>
                            
                        
                
              
                <!-- register section endss -->
        
    <!-- END: Content-->

    <script>
        const phoneInputField = document.querySelector("#tel_diri");
        const phoneInput = window.intlTelInput(phoneInputField, {
            utilsScript: 
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        const info = document.querySelector(".alert-info");

        function process(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

            info.style.display = "";
            info.innerHTML = `Phone number in E.164 format: <strong>${phoneNumber}</strong>`;
        }
    </script>

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-light.js"></script>
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