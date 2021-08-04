<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';
require_once 'php/get_documents_physique.php';
require_once 'php/get_documents.php';
    
    $pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
    $pdoSta->bindValue(':num',$_SESSION['id_crea'], PDO::PARAM_INT);
    $pdoSta->execute();
    $crea = $pdoSta->fetch();


?>

<embed src=../../../src/crea_societe/contrat/<?= $crea['doc_contrat'] ?> width="100%" height="100%" type='application/pdf'/>