<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $id_membre = htmlspecialchars($_GET['id_membre']);

    $update_membre = $bdd->prepare('UPDATE membres SET nom = :nom,
                                                       prenom = :prenom,
                                                       email = :email,
                                                       tel = :tel,
                                                       dtenaissance = :dtenaissance,
                                                       pays = :pays,
                                                       langue = :langue
                                                       WHERE id = :id');
                                            
    $update_membre->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $update_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom']));
    $update_membre->bindValue(':email', htmlspecialchars($_POST['email']));
    $update_membre->bindValue(':tel', htmlspecialchars($_POST['tel']));
    $update_membre->bindValue(':dtenaissance', htmlspecialchars($_POST['dtenaissance']));
    $update_membre->bindValue(':pays', htmlspecialchars($_POST['pays']));
    $update_membre->bindValue(':langue', htmlspecialchars($_POST['langue']));
    $update_membre->bindValue(':id', $id_membre);
    $update_membre->execute();

    // Si l'option de compte Coqpix a été cochée
    if (isset($_POST['utilisateur_coqpix'])) {

        $query = $bdd->prepare('UPDATE membres SET status_membres = "New" WHERE id = :id');
        $query->bindValue(':id', $id_membre);
        $query->execute();

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

    } else {

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "VENTES" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_ventes']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "ACHATS" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_achats']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "PROJETS" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_projets']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "INVENTAIRE" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_inventaire']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "CLIENTS" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_clients']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "FOURNISSEURS" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_fournisseurs']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "ARTICLES" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_articles']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

        $query = $bdd->prepare('UPDATE permissions_front SET niveau = :niveau WHERE upper(module) = "MEMBRES" AND id_membre = :id_membre');
        $query->bindValue(':niveau', htmlspecialchars($_POST['perm_membres']));
        $query->bindValue(':id_membre', $id_membre);
        $query->execute();

    }

    header('Location: ../membres-liste.php');
    exit();
   
?>
