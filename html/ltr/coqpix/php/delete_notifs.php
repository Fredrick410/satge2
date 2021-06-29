

<?php    
	session_start();
	require_once 'config.php';
	error_reporting(E_ALL); 
	ini_set('display_errors', TRUE); 
	ini_set('display_startup_errors', TRUE);
	if (isset($_GET['delete'])) {
		if ($_GET['delete'] == 'back') {
			$delete_notifs_back = $bdd->prepare('DELETE FROM notif_back');
			$delete_notifs_back->execute();
		}
		if ($_GET['delete'] == 'front') {
<<<<<<< HEAD
			$delete_notifs_front = $bdd->prepare('DELETE FROM notif_front');
=======
			$delete_notifs_front = $bdd->prepare('DELETE FROM notif_front WHERE id_session=:id_session');
			$delete_notifs_front->bindValue(':id_session', $_SESSION['id_session']);
>>>>>>> 6f1911ef5aed13068443f2acacba0518479933eb
			$delete_notifs_front->execute();
		}
	}       
	sleep(1);
	$previous_page = $_SERVER['HTTP_REFERER'];  
	header('Location: '.$previous_page);        
	exit();    
?>

