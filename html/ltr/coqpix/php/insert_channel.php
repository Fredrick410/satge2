<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if (isset($_POST['btn_creer_channel'])) {
        if (!empty($_POST['nom_channel'])) {

            $id_membre = $_GET['id_membre'];
            $id_entreprise = $_GET['id_entreprise'];
            $nom_channel = htmlspecialchars($_POST['nom_channel']);
            
            $query = $bdd->prepare('INSERT INTO channel (nom) VALUES (:nom)');
            $query->bindValue(':nom', $nom_channel);
            $query->execute();

            $query = $bdd->prepare('SELECT last_insert_id() AS id FROM channel');
            $query->execute();
            $result = $query->fetch();
            $id_channel = $result['id'];

            if (isset($_POST['all_membres'])) {

                $select_membres = $bdd->prepare('SELECT id FROM membres WHERE id_session = :id_entreprise');
                $select_membres->bindValue(':id_entreprise', $id_entreprise);
                $select_membres->execute();

                while ($membre = $select_membres->fetch()) {
                    $query = $bdd->prepare('INSERT INTO channel_membres (id_membre, id_channel) VALUES (:id_membre, :id_channel)');
                    $query->bindValue(':id_membre', $membre['id']);
                    $query->bindValue(':id_channel', $id_channel);
                    $query->execute();
                }

            } else {
                $query = $bdd->prepare('INSERT INTO channel_membres (id_membre, id_channel) VALUES (:id_membre, :id_channel)');
                $query->bindValue(':id_membre', $id_membre);
                $query->bindValue(':id_channel', $id_channel);
                $query->execute();
            }

            header('Location: ../helpdesk-chat-user.php');

        }
    }

?>