<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
        
            $pdoDel = $bdd->prepare('DELETE doc_note FROM membres WHERE id=:num LIMIT 1');
            $pdoDel->bindValue(':num', $_GET['numnote']);
            $pdoDel->execute();
            unlink ('../../../../src/files/'. $_GET['name_files'] .'');
            sleep(1);
            header('Location: redirection_note.php?numnote='.$_GET['numnote']);
            exit();

?>