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
<html lang="en">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
        <link rel="preconnect" href="https://fonts.gstatic.com">
        <link href="https://fonts.googleapis.com/css2?family=Staatliches&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Hammersmith+One&display=swap" rel="stylesheet">    
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="css/slider.css">
		<link rel="stylesheet" href="css/deroulant.css">
        <title>White Island | Partenaire</title>
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
                        <a class="nav-item nav-link mr-5" href="about.php" style="color: white;">Rules</a>
                        <!-- <a class="nav-item nav-link mr-5" href="contact.php" style="color: white;">Whitelist</a> -->
                        <a class="nav-item nav-link mr-5" href="contact.php" style="color: white;">Contact</a>
                        <a class="nav-item nav-link mr-5" href="partner.php" style="color: white; border-bottom: 1px solid #3ca918;"">Partner</a>
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

        <section style="margin-top:105px;">
            <div class="container">
                <h1 style="color: white; margin-bottom: 35px;">Partneaire</h1>
                <div class="card " style="width: 18rem;">
                    <img class="card-img-top" src="https://zupimages.net/up/21/02/gyrd.png" alt="Card image cap">
                    <br>
                    <div class="card-body bg-carta">
                        <h3 class="card-text text-center" style="font-family: 'Hammersmith One';">Nidev</h3>
                    </div>
                </div>
            </div>    
        </section>
        
        <!-- Optional JavaScript -->
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->

        <script src="https://kit.fontawesome.com/b862c27f27.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <script src="js/script.js"></script>
        <script src="js/slider.js"></script>
    </body>
</html>