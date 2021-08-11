<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $insert_membre = $bdd->prepare('INSERT INTO membres (nom,
                                                        prenom,
                                                        email,
                                                        tel,
                                                        dtenaissance,
                                                        pays,
                                                        langue,
                                                        startdte,
                                                        perm_ventes,
                                                        perm_achats,
                                                        perm_projets,
                                                        perm_membres,
                                                        id_session)
                                                VALUES (:nom,
                                                        :prenom,
                                                        :email,
                                                        :tel,
                                                        :dtenaissance,
                                                        :pays,
                                                        :langue,
                                                        curdate(),
                                                        :perm_ventes,
                                                        :perm_achats,
                                                        :perm_projets,
                                                        :perm_membres,
                                                        :id_session)');

    $insert_membre->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $insert_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom']));
    $insert_membre->bindValue(':email', htmlspecialchars($_POST['email']));
    $insert_membre->bindValue(':tel', htmlspecialchars($_POST['tel']));
    $insert_membre->bindValue(':dtenaissance', htmlspecialchars($_POST['dtenaissance']));
    $insert_membre->bindValue(':pays', htmlspecialchars($_POST['pays']));
    $insert_membre->bindValue(':langue', htmlspecialchars($_POST['langue']));
    $insert_membre->bindValue(':perm_ventes', htmlspecialchars($_POST['perm_ventes']));
    $insert_membre->bindValue(':perm_achats', htmlspecialchars($_POST['perm_achats']));
    $insert_membre->bindValue(':perm_projets', htmlspecialchars($_POST['perm_projets']));
    $insert_membre->bindValue(':perm_membres', htmlspecialchars($_POST['perm_membres']));
    $insert_membre->bindValue(':id_session', htmlspecialchars($_POST['id_entreprise']));
    $insert_membre->execute();

    header('Location: ../membres-liste.php');
    exit();
   
?>