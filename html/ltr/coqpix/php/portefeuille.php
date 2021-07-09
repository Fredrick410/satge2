<?php
    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "prospect"');
    $pdoSta->execute();
    $portefeuille_prospect = $pdoSta->fetchAll();

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "actif"');
    $pdoSta->execute();
    $portefeuille_actif = $pdoSta->fetchAll();

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "encours"');
    $pdoSta->execute();
    $portefeuille_encours = $pdoSta->fetchAll();

    $pdoSta = $bdd->prepare('SELECT * FROM portefeuille WHERE statut = "passif"');
    $pdoSta->execute();
    $portefeuille_passif = $pdoSta->fetchAll();
?>