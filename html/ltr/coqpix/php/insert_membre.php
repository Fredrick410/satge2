<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $statut = "Désactivé";
    if (isset($_POST['utilisateur_coqpix'])) {
        $statut = "New";
    }

    $insert_membre = $bdd->prepare('INSERT INTO membres (nom,
                                                        prenom,
                                                        email,
                                                        tel,
                                                        dtenaissance,
                                                        pays,
                                                        langue,
                                                        status_membres,
                                                        startdte,
                                                        id_session)
                                                VALUES (:nom,
                                                        :prenom,
                                                        :email,
                                                        :tel,
                                                        :dtenaissance,
                                                        :pays,
                                                        :langue,
                                                        :status_membres,
                                                        curdate(),
                                                        :id_session)');

    $insert_membre->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $insert_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom']));
    $insert_membre->bindValue(':email', htmlspecialchars($_POST['email']));
    $insert_membre->bindValue(':tel', htmlspecialchars($_POST['tel']));
    $insert_membre->bindValue(':dtenaissance', htmlspecialchars($_POST['dtenaissance']));
    $insert_membre->bindValue(':pays', htmlspecialchars($_POST['pays']));
    $insert_membre->bindValue(':langue', htmlspecialchars($_POST['langue']));
    $insert_membre->bindValue(':status_membres', $statut);
    $insert_membre->bindValue(':id_session', htmlspecialchars($_POST['id_entreprise']));
    $insert_membre->execute();

    $query = $bdd->prepare('SELECT last_insert_id() AS id FROM membres');
    $query->execute();
    $id_membre = $query->fetch()['id'];

    // Si l'option de compte Coqpix a été cochée
    if (isset($_POST['utilisateur_coqpix'])) {

        // Requetes permettant d'inserer les permissions
        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "ventes");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_ventes']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "achats");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_achats']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "projets");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_projets']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "inventaire");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_inventaire']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "clients");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_clients']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "fournisseurs");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_fournisseurs']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "articles");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_articles']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('INSERT INTO permissions_front (module, niveau, id_membre) VALUES (:module, :niveau, :id_membre)');
        $query->bindValue(':module', "membres");
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_membres']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

    }

    header('Location: ../membres-liste.php');
    exit();
   
?>