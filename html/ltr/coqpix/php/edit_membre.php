<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $update_membre = $bdd->prepare('UPDATE membres SET nom = :nom,
                                                       prenom = :prenom,
                                                       email = :email,
                                                       tel = :tel,
                                                       dtenaissance = :dtenaissance,
                                                       pays = :pays,
                                                       langue = :langue,
                                                       perm_ventes = :perm_ventes,
                                                       perm_achats = :perm_achats,
                                                       perm_projets = :perm_projets,
                                                       perm_membres = :perm_membres
                                                       WHERE id = :id');
                                            
    $update_membre->bindValue(':nom', htmlspecialchars($_POST['nom']));
    $update_membre->bindValue(':prenom', htmlspecialchars($_POST['prenom']));
    $update_membre->bindValue(':email', htmlspecialchars($_POST['email']));
    $update_membre->bindValue(':tel', htmlspecialchars($_POST['tel']));
    $update_membre->bindValue(':dtenaissance', htmlspecialchars($_POST['dtenaissance']));
    $update_membre->bindValue(':pays', htmlspecialchars($_POST['pays']));
    $update_membre->bindValue(':langue', htmlspecialchars($_POST['langue']));
    $update_membre->bindValue(':perm_ventes', htmlspecialchars($_POST['perm_ventes']));
    $update_membre->bindValue(':perm_achats', htmlspecialchars($_POST['perm_achats']));
    $update_membre->bindValue(':perm_projets', htmlspecialchars($_POST['perm_projets']));
    $update_membre->bindValue(':perm_membres', htmlspecialchars($_POST['perm_membres']));
    $update_membre->bindValue(':id', htmlspecialchars($_GET['id_membre']));
    $update_membre->execute();

    header('Location: ../membres-liste.php');
    exit();
   
?>
