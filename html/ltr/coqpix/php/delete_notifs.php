

<?php    
	session_start();
	require_once 'config.php';
	error_reporting(E_ALL); 
	ini_set('display_errors', TRUE); 
	ini_set('display_startup_errors', TRUE);        
	$delete_notifs = $bdd->prepare('UPDATE attestation_fiscale SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
	$delete_notifs->bindValue(':statut_notif_back', "Inactive");
	$delete_notifs->execute();
	$delete_notifs = $bdd->prepare('UPDATE attestation_sociale SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
	$delete_notifs->bindValue(':statut_notif_back', "Inactive");
	$delete_notifs->execute();
	$delete_notifs = $bdd->prepare('UPDATE bulletin_salaire SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
	$delete_notifs->bindValue(':statut_notif_back', "Inactive");
	$delete_notifs->execute();
	$delete_notifs = $bdd->prepare('UPDATE bilan SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
	$delete_notifs->bindValue(':statut_notif_back', "Inactive");
	$delete_notifs->execute();
	sleep(1);
	$previous_page = $_SERVER['HTTP_REFERER'];  
	header('Location: '.$previous_page);        
	exit();    
?>

