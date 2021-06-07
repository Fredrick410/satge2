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
        <link rel="stylesheet" href="css/style.css">
		<link rel="stylesheet" href="css/deroulant.css">
        <title>White Island | Start <?= $session_on ?></title>
        <link rel="shortcut icon" href="img/favicon.png">
    </head>
    <body>
    <style>
        .none-validation{display: none;}
    </style>
        <div class="container mb-5 mt-4">
            <nav class="navbar navbar-expand-lg navbar-light">
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <img src="img/wi.png" class="img-fluid logo">
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav text-center">
                        <a class="nav-item nav-link mr-5 pr-0 pl-0" href="index.php" style="color: white; border-bottom: 1px solid #3ca918;">Start</a>
                        <a class="nav-item nav-link mr-5" href="about.php" style="color: white;">Rules</a>
                        <!-- <a class="nav-item nav-link mr-5" href="/contact.php" style="color: white;">Whitelist</a> -->
                        <a class="nav-item nav-link mr-5" href="contact.php" style="color: white;">Contact</a>
                        <a class="nav-item nav-link mr-5" href="partner.php" style="color: white;">Partner</a>
                        <a class="nav-item nav-link mr-5" href="boutique.php" style="color: white;">Shop</a>
                    </div>
					<div class="dropdown text-center">
					  <a class="dropbtn nav-item nav-link mr-5" style="color: white;"><?php if($session_on == "1"){echo "Mon espace";}else{echo "Connexion";} ?></a>
					  <div class="dropdown-content">
                        <a style="<?php if($session_on == "1"){echo "display:none;";} ?>" href="auth.php">S'identifier</a>
						<a style="<?php if($session_on == "0"){echo "display:none;";} ?>" href="#profile.php">Mon profile</a>
                        <a style="<?php if($session_on == "0"){echo "display:none;";} ?> <?php if(!empty($_SESSION['id_player'])){if($member['perms'] == "none"){echo "display: none;";}} ?>" href="backoff/dashboard.php">Adminstration</a>
						<a style="<?php if($session_on == "0"){echo "display:none;";} ?>" href="php/deconnection.php">Se déconnecter</a>
					  </div>
					</div>
                </div>
            </nav>
        </div>  
        <section class="mt-5">
            <div class="container">
                <div class="row section-title">
                    <div class="col-md-12 mt-5 title">
                        <h1 style="color:white">GTA 5</label>
                    </div>
                    <div class="col-md-12 title">
                        <h1 style="color: #3ca918;">ROLEPLAY</label>
                    </div>
                    <div class="col-md-12 subtitle">
                        <p class="text-white">Serveur FiveM [FreeAccess]</p>
                    </div>
                    <div class="col-md-12 mt-5 mb-5 title">
                        <a href="" class="btn-lg btn-success pt-3 pb-3 pl-5 pr-5" style="border-radius: 0%; background-color: #3ca918; color: white;">Rejoindre</a>
                    </div>
                    <img class="position-absolute backguy img-p" src="img/pic1.png">
                </div>
            </div>
        </section>

        <footer>
            <div class="container-fluid sections">
                <div class="row">
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 sec1">
                        <h2 style="color: #3ca918; font-family: 'Hammersmith One';" class="ml-3 mt-5 black sec1time"></h2>
                        <h2 class="ml-3 news" style="font-family: 'Hammersmith One';">News</h2>
                        <p class="ml-3" style="line-height: 10px; color:#a0a0a052" >White Island sur PC arrive </p>
                        <p class="ml-3 mb-4" style="line-height: 10px; color:#a0a0a052;">bientôt.</p>    
                        <br>                    
                    </div>
                    
                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 sec1">
                        <h5 style="font-family: 'Hammersmith One';" class="ml-3 mt-5">FiveM</h5>
                        <h2 class="ml-3 news" style="font-family: 'Staatliches'; color: #3ca918;">Server 01</h2>
                        <a class="gta5-btn">GTA 5 Mod</a>
                        <p class="ml-3" style="line-height: 10px; color:#a0a0a052; font-family: 'Arial';" >0/128</p>    
                        <br>
                        <br>
                        <h3 class="ml-3" style="color: #3ca918;">LINK</h1>
                        <i class="far fa-copy icon-r" style="color: gray;"></i>
                        <div class="secbar">
                            <div class="secinbar"></div>
                        </div>
                        <br>
                        <br>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 sec1">
                        <h5 style="font-family: 'Hammersmith One';" class="ml-3 mt-5">Discord</h5>
                        <h2 class="ml-3 news" style="font-family: 'Staatliches'; color: #1f2ac2 ;">Server 02</h2>
                        <a class="gta5-btn" style=" background-color: #1f2ac2;">Text</a>
                        <p class="ml-3" style="line-height: 10px; color:#a0a0a052; font-family: 'Arial';" ><iframe src="https://discord.com/widget?id=635039569380638721&theme=dark" width="300" height="75" allowtransparency="true" frameborder="0" sandbox="allow-popups allow-popups-to-escape-sandbox allow-same-origin allow-scripts"></iframe></p>
						<table>
							<thead>
								<tr>
									<th><h6 class="ml-3" style="color: #1f2ac2;"><textarea id="to-copy">https://discord.gg/vQBcSM8MBQ</textarea></th>
									<th></th>
									<th></th>
									<th></th>
									<th><button style="background-color: #4CAF50; border: none;  color: white;padding: 7px 20px; font-size: 16px;"id="copy" type="button">Copy</button></h6></th>
								</tr>
							</thead>
						</table>
                        
                        <div class="secbar">
                            <div class="secinbar2"></div>
                        </div>
                        <br>
                        <br>
                    </div>

                    <div class="col-12 col-sm-6 col-md-6 col-lg-3 sec1">
                        <h5 style="font-family: 'Hammersmith One';" class="ml-3 mt-5">White Island</h5>
						<br>
                        <h2 class="ml-3 news" style="font-family: 'Staatliches'; color: #c21f4a ;">Le serveur est actuellement :</h2>
                        <a class="gta5-btn2" style=" background-color: #c21f4a;">Etat</a>
						<br>
                        <p class="ml-3" style="background-color: #4CAF50; border: none;  color: white;padding: 14px 40px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px;" ><b>ON/OFF</b></p>     
                        </div>
                        <br>
                        <br>
                    </div>
                </div>
            </div>
        </footer>
      
        <script src="js/script.js"></script>
		<script>
		var toCopy  = document.getElementById( 'to-copy' ),
			btnCopy = document.getElementById( 'copy' );

		btnCopy.addEventListener( 'click', function(){
			toCopy.select();
			document.execCommand( 'copy' );
			return false;
		} );
		</script>

        <script src="https://kit.fontawesome.com/b862c27f27.js" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </body>
</html>