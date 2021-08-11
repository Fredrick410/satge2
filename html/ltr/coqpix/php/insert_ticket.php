<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if (isset($_POST['btn_envoyer_req'])) {
        if (!empty($_POST['objet']) && !empty($_POST['description'])) {

            $id_membre = $_GET['id_membre'];
            $objet = htmlspecialchars($_POST['objet']);
            $description = htmlspecialchars($_POST['description']);
            
            $query = $bdd->prepare('INSERT INTO support_ticket (id_membre, objet, date_creation) VALUES (:id_membre, :objet, now())');
            $query->bindValue(':id_membre', $id_membre);
            $query->bindValue(':objet', $objet);
            $query->execute();

            $query = $bdd->prepare('SELECT last_insert_id() AS id FROM support_ticket');
            $query->execute();
            $id_ticket = $query->fetch()['id'];

            $query = $bdd->prepare('SELECT date(date_creation) AS date_message, time(date_creation) AS heure_message FROM support_ticket WHERE id_ticket = :id_ticket');
            $query->bindValue(':id_ticket', $id_ticket);
            $query->execute();
            $result = $query->fetch();
            $date_message = $result['date_message'];
            $heure_message = $result['heure_message'];

            $query = $bdd->prepare('INSERT INTO support_message (id_membre, id_ticket, date_message, heure, auteur, texte) VALUES (:id_membre, :id_ticket, :date_message, :heure_message, :auteur, :texte)');
            $query->bindValue(':id_membre', $id_membre);
            $query->bindValue(':id_ticket', $id_ticket);
            $query->bindValue(':date_message', $date_message);
            $query->bindValue(':heure_message', $heure_message);
            $query->bindValue(':auteur', "user");
            $query->bindValue(':texte', $description);
            $query->execute();

            header('Location: ../helpdesk-chat-user.php?req='.$id_ticket);

        }
    }

?>