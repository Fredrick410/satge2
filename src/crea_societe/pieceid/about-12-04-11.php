<?php 
session_start();
require_once ('php/config.php');

    if(!empty($_SESSION['id_player'])){
    $session_on = "1";

    $pdoSta = $bdd->prepare('SELECT * FROM members WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id_player'], PDO::PARAM_INT); //$_SESSION
    $pdoSta->execute(); 
    $member = $pdoSta->fetch();

    }else {
    $session_on = "0";
    }


?>

<!doctype html>
<html lang="fr">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">  
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">  
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/slider.css">
		<link rel="stylesheet" href="css/deroulant.css">
        <title>White Island | Règlements</title>
        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body>
        <div class="container mb-5 mt-4">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img src="img/wi.png" class="img-fluid logo">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav text-center">
                        <a class="nav-item nav-link mr-5 pr-0 pl-0" href="index.php" style="color: white;">Start</a>
                        <a class="nav-item nav-link mr-5" href="about.php" style="color: white; border-bottom: 1px solid #3ca918;">Rules</a>
                        <!-- <a class="nav-item nav-link mr-5" href="apply.php" style="color: white;">Whitelist</a> -->
                        <a class="nav-item nav-link mr-5" href="contact.php" style="color: white;">Contact</a>
                        <a class="nav-item nav-link mr-5" href="partner.php" style="color: white;">Partner</a>
                        <a class="nav-item nav-link mr-5" href="boutique.php" style="color: white;">Shop</a>
                    </div>
					<div class="dropdown text-center">
					  <a class="dropbtn nav-item nav-link mr-5" style="color: white;"><?php if($session_on == "1"){echo "Mon espace";}else{echo "Connexion";} ?></a>
					  <div class="dropdown-content">
                        <a href="auth.php">S'identifier</a>
						<a style="<?php if($session_on == "1"){echo "";}else{echo "display:none;";} ?>" href="#profile.php">Mon profile</a>
                        <a style="<?php if($session_on == "1"){if($member['perms'] == "none"){echo "display:none;";}} ?>" href="backoff/dashboard.php">Adminstration</a>
						<a style="<?php if($session_on == "1"){echo "";}else{echo "display:none;";} ?>" href="php/deconnection.php">Se déconnecter</a>					
                </div>
            </nav>
        </div>  
        <img class="position-absolute backguy2 img-p" src="img/pic2.png">

        <div class="container" style="margin-top: 200px ;">
            <div class="carousel-inner">
                <div class="city w3-animate-right" id="1">
                    <h1 style="color:white; font-family: 'Staatliches';">NOTIONS RP</h1>
                    <p style="font-size:17px; color: white;">Exemple...</p>                                
                </div>
                <div class="city w3-animate-right"  id="2"style="display: none;">
                    <h1 style="color:white; font-family: 'Staatliches';">ECONOMIE</h1>
                    <p style="font-size:17px; color: white;">Exemple...</p>
                </div>
                <div class="city w3-animate-right"  id="3"style="display: none;">
                    <h1 style="color:white; font-family: 'Staatliches';">LISTE METIERS</h1>
                    <p style="font-size:17px; color: white;">Exemple...</p>
                </div>
                <div class="city w3-animate-right" id="4"style="display: none;">
                    <h1 style="color:white; font-family: 'Staatliches';">POLICE</h1>
                    <p style="font-size:17px; color: white;">Exemple...</p>
                </div>
            </div>
        </div>

        <div class="container" style="margin-top: 300px;">
            <div class="row">
                <div class="col-md-2 mt-5" >
                    <button class="h3 textButton active" style="color: white; cursor: pointer;" onclick="openCity('1')">NOTIONS RP</button>
                </div>
                <div class="col-md-2 mt-5" >
                    <button class="h3 textButton" style="color: white; cursor: pointer;" onclick="openCity('2')">ECONOMIE</button>
                </div>
                <div class="col-md-2 mt-5" >
                    <button class="h3 textButton" style="color: white; cursor: pointer;" onclick="openCity('3')">LISTE METIERS</button>
                </div>
                <div class="col-md-2 mt-5">
                    <button class="h3 textButton" style="color: white; cursor: pointer;" onclick="openCity('4')">POLICE</button>
                </div>
            </div>
        </div>

        <script>
            function openCity(cityName) {
              let i;
              let x = document.getElementsByClassName("city");
              for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";  
              }
              document.getElementById(cityName).style.display = "block";  
            }


        </script>

        <script>
            let buttons = document.querySelectorAll('button')

            buttons.forEach(button => {
                button.addEventListener('click', function(){
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');
                    document.getElementsByClassName('active')[0].style.transition = "all .5s";
                    document.getElementsByClassName('active')[0].style.right = "0px";
                    document.getElementsByClassName('active')[0].style.borderBottom = null;
                    document.getElementsByClassName('active')[0].style.borderBottom = null;
                    document.getElementsByClassName('active')[0].style.borderBottom = "0.2px solid rgb(60, 169, 24)";
                    document.getElementsByClassName('active')[0].style.borderBottom = null;
                })
            })

           

        </script>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script src="js/script.js"></script>

        <script src="https://kit.fontawesome.com/b862c27f27.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/slider.js"></script>
    </body>
</html>