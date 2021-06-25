<?php
require_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

if(!empty($_POST["keyword"])) {

$recherche = str_replace(" ", "", $_POST["keyword"]); //on supprime les espaces de la recherche
$query =$bdd->query("SELECT * FROM offre_domiciliation WHERE ville like '" . $recherche . "%' ORDER BY ville LIMIT 0,6");
$result = $query->fetch();
if(!empty($result)) {
?>
<ul id="city-list">
<li onClick="selectCity('<?php echo $result['ville']; ?>');"><?php echo $result['ville']; ?></li>
</ul>
<?php } else {
?>
<ul id="city-list"> 
    <li> Aucun résultat </li>
</ul>
    <?php } }
?>