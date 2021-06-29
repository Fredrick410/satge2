<?php 
require_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//Affichage des offres associés    
$ville = $_POST["ville"];
$type = $_POST["type"];

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
foreach($tab as $offre){
    
?>

    <li>
        <div class="card-body p-0">
                    <img src="../../../app-assets/images/profile/pages/page-09.jpg">
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
}
?>

</ul>

<?php
}else{

?>
<div><h3>Aucune offre n'est disponible à cette adresse</h3></div>
<?php 
}
?>