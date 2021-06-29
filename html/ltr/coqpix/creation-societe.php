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

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern 1-column  navbar-sticky footer-static bg-full-screen-image  blank-page blank-page" data-open="click" data-menu="vertical-menu-modern" data-col="1-column">
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

</style>
    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- register section starts -->
                <section class="row flexbox-container">
                    <div class="col-xl-8 col-10">
                        <div class="card bg-authentication mb-0">
                            <div class="row m-0">
                                <!-- register section left -->
                                <div class="col-md-6 col-12 px-0">
                                    <div class="card disable-rounded-right mb-0 p-2 h-100 d-flex justify-content-center">
                                        <div class="card-header pb-1">
                                            <div class="card-title">
                                                <h4 class="text-center mb-2">Création votre société facilement et rapidement</h4>
                                            </div>
                                        </div>
                                        <div class="card-content">
                                            <div class="card-body">
                                                <form action="php/insert_crea_client.php" method="POST">
                                                    <div class="form-row">
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label>Nom du dirigeant *</label>
                                                            <input type="text" name="nom_diri" class="form-control" placeholder="Nom du dirigeant" required>
                                                        </div>
                                                        <div class="form-group col-md-6 mb-50">
                                                            <label for="inputlastname4">Prénom du dirigeant *</label>
                                                            <input type="text" name="prenom_diri" class="form-control" placeholder="Prénom du dirigeant" required>
                                                        </div>
                                                    </div>
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Nom de l'entreprise *</label>
                                                        <input type="text" name="crea_societe" class="form-control" placeholder="Nom de l'entreprise" required></div>
                                                    <div class="form-group mb-50">
                                                        <label class="invoice-address form-group">Forme Juridique</label>
                                                        <br><span title="Vous pouvez demander de l'aide à un conseiller après votre inscription dans la catégorie chat"><small>Comment bien choisir ma forme juridique?<span class="livicon-evo" data-options=" name: bulb.svg; size: 20px "></span></small></span>
                                                        <select name="status_crea" class="form-control invoice-item-select">
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
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">Téléphone du dirigeant *</label>
                                                        <input type="number" name="tel_diri" class="form-control"placeholder="06.00.00.00.00" required></div>
                                                    <div class="form-group">
                                                        <hr>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="line">Information de connexion</label>
                                                    </div>
                                                    <br>
                                                    <div class="form-group mb-50">
                                                        <label class="text-bold-600">E-mail (Identifiant de connexion) *</label>
                                                        <input type="text" name="email_crea" class="form-control"placeholder="E-mail de contact" required></div>
                                                    <div class="form-group mb-2">
                                                        <label class="text-bold-600">Mot de passe (Identifiant de connexion) *</label>
                                                        <input type="password" name="password_crea" class="form-control" placeholder="Mot de passe" required>
                                                    </div>
                                                    <div class="form-group">
                                                        <small>*Champ obligatoire</small>
                                                    </div>
                                                    <button type="submit" class="btn btn-primary glow position-relative w-100">Créer<i id="icon-arrow" class="bx bx-right-arrow-alt"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- image section right -->
                                <div class="col-md-6 d-md-block d-none text-center align-self-center p-3">
                                    <img class="img-fluid" src="../../../app-assets/images/pages/register.png" alt="branding logo">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- register section endss -->
            </div>
        </div>
    </div>
    <!-- END: Content-->
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
    <script>

    //mot de passe

        //MDP ayant lettres majuscules, minuscules et chiffres
        var condition = new RegExp("^(?=.{6,})(?=.*[A-Za-z])(?=.*[0-9])", "g");
        
        $("#mdp").keyup(function(event){
            if(condition.test($(this).val())){ // mdp valide
                document.getElementById("alert-mdp1").style = "display: none;";
                $('#btn').prop('disabled', false);
            }
            else if(!condition.test($(this).val())){//mdp non valide
                document.getElementById("alert-mdp1").style = "display:inline-block;";
                $('#btn').prop('disabled', true);
            }
               
        });


        $('#mdp_verif').keyup(function (event) {
            if($("#mdp").val() != $("#mdp_verif").val()){ //si les 2 mdp ne correspondent pas
                document.getElementById("alert-mdp2").style = "display:inline-block;"; //on affiche msg d'erreur
                $('#btn').prop('disabled', true);
            }
            else{
                document.getElementById("alert-mdp2").style = "display:none;"; //on n'affiche pas le msg
                $('#btn').prop('disabled', false);
            }
        });
        

    //telephone
        const phoneInputField = document.querySelector("#tel_temp");
        const phoneInput = window.intlTelInput(phoneInputField, {
            preferredCountries: ["fr"],
            utilsScript: 
            "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });
        function process(event) {
            event.preventDefault();

            const phoneNumber = phoneInput.getNumber();

           
            document.getElementById("tel_diri").value=`${phoneNumber}`;
        }

    //email
        function checkEmail(email) {
             var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
             return re.test(email);
         }
         $("#email").keyup(function(event){
             var email = document.getElementById("email").value;
         
            if (!checkEmail(email)){
                document.getElementById("alert-email").style = "display:inline-block;"; //on affiche msg d'erreur
                $('#btn').prop('disabled', true);
            }else{
                document.getElementById("alert-email").style = "display:none;"; //on retire le msg d'erreur
                $('#btn').prop('disabled', false);
            }
             return false;
         });
  
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