

<?php    
	session_start();
	require_once 'config.php';
	error_reporting(E_ALL); 
	ini_set('display_errors', TRUE); 
	ini_set('display_startup_errors', TRUE);
	if (isset($_GET['delete'])) {
		if ($_GET['delete'] == 'back') {
			$delete_notifs_back = $bdd->prepare('UPDATE attestation_fiscale SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
			$delete_notifs_back->bindValue(':statut_notif_back', "Inactive");
			$delete_notifs_back->execute();
			$delete_notifs_back = $bdd->prepare('UPDATE attestation_sociale SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
			$delete_notifs_back->bindValue(':statut_notif_back', "Inactive");
			$delete_notifs_back->execute();
			$delete_notifs_back = $bdd->prepare('UPDATE bulletin_salaire SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
			$delete_notifs_back->bindValue(':statut_notif_back', "Inactive");
			$delete_notifs_back->execute();
			$delete_notifs_back = $bdd->prepare('UPDATE bilan SET statut_notif_back =:statut_notif_back WHERE statut_notif_back = "Non lue"');
			$delete_notifs_back->bindValue(':statut_notif_back', "Inactive");
			$delete_notifs_back->execute();
		}
		if ($_GET['delete'] == 'front') {
			$delete_notifs_front = $bdd->prepare('UPDATE attestation_fiscale SET statut_notif_front =:statut_notif_front WHERE statut_notif_front = "Non lue"');
			$delete_notifs_front->bindValue(':statut_notif_front', "Inactive");
			$delete_notifs_front->execute();
			$delete_notifs_front = $bdd->prepare('UPDATE attestation_sociale SET statut_notif_front =:statut_notif_front WHERE statut_notif_front = "Non lue"');
			$delete_notifs_front->bindValue(':statut_notif_front', "Inactive");
			$delete_notifs_front->execute();
			$delete_notifs_front = $bdd->prepare('UPDATE bulletin_salaire SET statut_notif_front =:statut_notif_front WHERE statut_notif_front = "Non lue"');
			$delete_notifs_front->bindValue(':statut_notif_front', "Inactive");
			$delete_notifs_front->execute();
			$delete_notifs_front = $bdd->prepare('UPDATE bilan SET statut_notif_front =:statut_notif_front WHERE statut_notif_front = "Non lue"');
			$delete_notifs_front->bindValue(':statut_notif_front', "Inactive");
			$delete_notifs_front->execute();
		}
	}       
	sleep(1);
	$previous_page = $_SERVER['HTTP_REFERER'];  
	header('Location: '.$previous_page);        
	exit();    
?>

