<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';
require_once 'verif_session_connect.php';

if (isset($_POST['id_task']) and !empty($_POST['id_task'])) {
	$id_task = htmlspecialchars($_POST['id_task']);
} else {
	$response_array['status'] = 'error';
	$response_array['message'] = "Identifiant de tache vide";
	echo json_encode($response_array);
	exit();
}

if (isset($_POST['current_page']) and !empty($_POST['current_page']) and is_numeric($_POST['current_page'])) {
	$current_page = htmlspecialchars($_POST['current_page']);
} else {
	$current_page = 1;
}

try {
	//On recupere le nombre de commentaires associes a la tache
	$pdoS = $bdd->prepare('SELECT COUNT(*) AS nb_comments FROM task_commentaire WHERE task_num = :num');
	$pdoS->bindValue(':num', $id_task);
	$pdoS->execute();
	$nb_comments = $pdoS->fetch();
} catch (Exception $e) {
	$response_array['status'] = 'error';
	$response_array['message'] = $e->getMessage();
	echo json_encode($response_array);
	exit();
}

// On determine le nombre de page en prenant 5 commentaires par page
$nbPages = (int)ceil($nb_comments['nb_comments'] / 5);
$response_array['pagination'] = "";

if ($nbPages <= 5) {
	if ($current_page != 1) {
		$response_array['pagination'] .= "<!-- Lien vers la page précédente -->"
			. "<li class=\"page-item previous\"><a href=\"" . ($current_page - 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	} else {
		$response_array['pagination'] .= "<!-- Lien vers la page précédente desactive si on n'est pas sur la première -->"
			. "<li class=\"page-item previous disabled\"><a href=\"#\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	}
	for ($aPage = 1; $aPage <= $nbPages; $aPage++) {
		if ($current_page == $aPage) {
			$response_array['pagination'] .= "<!-- Lien vers la page actuelle désactivé -->"
				. "<li class=\"page-item active\"><a class=\"page-link\" href=\"#\">$aPage</a></li>";
		} else {
			$response_array['pagination'] .= "<!-- Lien vers les autres pages -->"
				. "<li class=\"page-item\"><a class=\"page-link\" href=\"$aPage\">$aPage</a></li>";
		}
	}
	if ($current_page != $nbPages) {
		$response_array['pagination'] .= "<!-- Lien vers la page suivante si on n'est pas sur la dernière -->"
			. "<li class=\"page-item next\"><a href=\"" . ($current_page + 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
	} else {
		$response_array['pagination'] .= "<!-- Lien vers la page suivante desactive si on n'est pas sur la dernière -->"
			. "<li class=\"page-item next disabled\"><a href=\"#\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
	}
} else if ($current_page < 5) {
	if ($current_page != 1) {
		$response_array['pagination'] .= "<!-- Lien vers la page précédente si on n'est pas sur la première -->"
			. "<li class=\"page-item previous\"><a href=\"" . ($current_page - 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	} else {
		$response_array['pagination'] .= "<!-- Lien vers la page précédente desactive si on n'est pas sur la première -->"
			. "<li class=\"page-item previous disabled\"><a href=\"#\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	}
	for ($aPage = 1; $aPage <= 5; $aPage++) {
		if ($current_page == $aPage) {
			$response_array['pagination'] .= "<!-- Lien vers la page actuelle désactivé -->"
				. "<li class=\"page-item active\"><a href=\"#\" class=\"page-link\">$aPage</a></li>";
		} else {
			$response_array['pagination'] .= "<!-- Lien vers les autres pages -->"
				. "<li class=\"page-item\"><a href=\"$aPage\" class=\"page-link\">$aPage</a></li>";
		}
	}
	$response_array['pagination'] .= "<!-- Lien vers la page suivante -->"
		. "<li class=\"page-item next\"><a href=\"" . ($current_page + 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
} else if ($current_page > $nbPages - 5) {
	$response_array['pagination'] .= "<!-- Lien vers la page précédente -->"
		. "<li class=\"page-item previous\"><a href=\"" . ($current_page - 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	for ($aPage = $nbPages - 5; $aPage <= $nbPages; $aPage++) {
		if ($current_page == $aPage) {
			$response_array['pagination'] .= "<!-- Lien vers la page actuelle désactivé -->"
				. "<li class=\"page-item active\"><a href=\"#\" class=\"page-link\">$aPage</a></li>";
		} else {
			$response_array['pagination'] .= "<!-- Lien vers les autres pages -->"
				. "<li class=\"page-item\"><a href=\"$aPage\" class=\"page-link\">$aPage</a></li>";
		}
	}
	if ($current_page != $nbPages) {
		$response_array['pagination'] .= "<!-- Lien vers la page suivante si on n'est pas sur la dernière -->"
			. "<li class=\"page-item next\"><a href=\"" . ($current_page + 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
	} else {
		$response_array['pagination'] .= "<!-- Lien vers la page suivante desactive si on n'est pas sur la dernière -->"
			. "<li class=\"page-item next disabled\"><a href=\"#\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
	}
} else {
	$response_array['pagination'] .= "<!-- Lien vers la page précédente -->"
		. "<li class=\"page-item previous\"><a href=\"" . ($current_page - 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-left\"></i></a></li>";
	for ($aPage = $current_page - 2; $aPage <= $current_page + 2; $aPage++) {
		if ($current_page == $aPage) {
			$response_array['pagination'] .= "<!-- Lien vers la page actuelle désactivé -->"
				+ "<li class=\"page-item active\"><a href=\"#\" class=\"page-link\">$aPage</a></li>";
		} else {
			$response_array['pagination'] .= "<!-- Lien vers les autres pages -->"
				. "<li class=\"page-item\"><a href=\"$aPage\" class=\"page-link\">$aPage</a></li>";
		}
	}
	$response_array['pagination'] .= "<!-- Lien vers la page suivante -->"
		. "<li class=\"page-item next\"><a href=\"" . ($current_page + 1) . "\" class=\"page-link\"><i class=\"bx bx-chevron-right\"></i></a></li>";
}
$response_array['status'] = 'success';
echo json_encode($response_array);
exit();
