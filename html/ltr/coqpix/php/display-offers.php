<?php 
require_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

//Affichage des offres associés    
$ville = $_POST["ville"];
$query = $bdd->prepare("SELECT * FROM offre_domiciliation WHERE ville = :ville"); //on recupère les offres de la ville correspondante
$query->bindValue(':ville', $ville);
$query->execute();
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