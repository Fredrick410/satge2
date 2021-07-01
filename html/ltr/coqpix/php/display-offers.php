<?php 
require_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//Affichage des offres associés    
$ville = $_POST["ville"];
$type = $_POST["type"];


//Le type (coworking, bureau, domiciliation) fonctionnent comme le chmod unix : 1 pour le bureau, 2 pour le coworking et 4 pour la domiciliation
if ($type == 0) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville'"); //on recupère les offres de la ville correspondante
}
if ($type == 1) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('1', '3', '5', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 2) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('2', '3', '6', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 3) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('3', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 4) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('4', '5', '6', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 5) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('5', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 6) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type IN ('6', '7')"); //on recupère les offres de la ville correspondante
}
if ($type == 7) {
    $query = $bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '$ville' AND type = '7'"); //on recupère les offres de la ville correspondante
}



$query->setFetchMode(PDO::FETCH_ASSOC);
while ($ligne = $query->fetch()) 
    $tab[]= $ligne; //on recupere le tableau des offres


if(!empty($tab)){
?>
    <ul>

<?php 
$i = 1;
foreach($tab as $offre){
    
?>

    <li>
        <div class="card-body p-0">


        <div id="carouselExampleIndicators<?php echo $i;?>" class="carousel slide" data-ride="carousel">
        
                

         
        
        <div class="carousel-inner">
            <div class="carousel-item active" data-mdb-interval="10000000000" id="img1">
    	
              	<img src="../../../app-assets/images/pages/offre-domiciliation/liste-offre/<?php echo $offre['img']; ?>-1.jpg" >
      	
            </div>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../app-assets/images/pages/offre-domiciliation/liste-offre/<?php echo $offre['img']; ?>-2.jpg" >
        
            </div>
            <?php
            $url = $offre['img'];
            $filename = "../../../../app-assets/images/pages/offre-domiciliation/liste-offre/$url-3.jpg";
                if (file_exists($filename)) {
            ?>
            <div class="carousel-item" data-mdb-interval="10000">
    	
      	        <img src="../../../app-assets/images/pages/offre-domiciliation/liste-offre/<?php echo $offre['img']; ?>-3.jpg" >
      	
            </div>
            <?php
                }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators<?php echo $i;?>" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators<?php echo $i;?>" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>


                    <div class="card-descrip">
                            <p id="ville"><?php echo $offre['titre']; ?></p>
                            <p id="adresse"><?php echo $offre['adresse']; ?></p>
                    </div>
                    <div class="card-btn">
                            <a href="domiciliation-offre.php?id=<?php echo $offre['id']; ?>">Découvrir cette adresse</a>
                    </div>
        </div>
    </li>
<?php 
$i=$i+1;}
?>

</ul>

<?php
}else{

?>
<div><h3>Aucune offre n'est disponible à cette adresse</h3></div>
<?php 
}
?>