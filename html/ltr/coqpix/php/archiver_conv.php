<?php 
require_once("config.php");
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

$destination = $_POST["destination"];

$sql = $bdd->prepare('UPDATE chat_crea SET lu="1" WHERE destination like :dest');
$sql->bindValue(':dest',$destination);
$sql->execute();

?>