<?php

/**
 * Fonction permettant de recuperer les permissions de l'utilisateur connecté
 * Retourne le tableau des permissions
 */
function permissions() {

    global $bdd;

    $query = $bdd->prepare('SELECT upper(module) AS module, niveau FROM permissions_front WHERE id_membre = :id_membre');
    $query->bindValue(':id_membre', $_SESSION['id_membre']);
    $query->execute();

    $array = array('ventes' => 0, 'achats' => 0, 'projets' => 0, 'inventaire' => 0, 'clients' => 0, 'fournisseurs' => 0, 'articles' => 0, 'membres' => 0);

    while ($permissions = $query->fetch()) {
        if ($permissions['module'] === "VENTES") {
            $array['ventes'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "ACHATS") {
            $array['achats'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "PROJETS") {
            $array['projets'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "INVENTAIRE") {
            $array['inventaire'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "CLIENTS") {
            $array['clients'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "FOURNISSEURS") {
            $array['fournisseurs'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "ARTICLES") {
            $array['articles'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "MEMBRES") {
            $array['membres'] = $permissions['niveau'];
        }
    }

    return $array;

}

/**
 * Fonction plus specifique permettant de recuperer les permissions de l'utilisateur en parametre
 * Prend en parametre l'id de l'utilisateur
 * Retourne le tableau des permissions
 */
function permissionsMembre($id_membre) {

    global $bdd;

    $query = $bdd->prepare('SELECT upper(module) AS module, niveau FROM permissions_front WHERE id_membre = :id_membre');
    $query->bindValue(':id_membre', $id_membre);
    $query->execute();

    $array = array('ventes' => 0, 'achats' => 0, 'projets' => 0, 'inventaire' => 0, 'clients' => 0, 'fournisseurs' => 0, 'articles' => 0, 'membres' => 0);

    while ($permissions = $query->fetch()) {
        if ($permissions['module'] === "VENTES") {
            $array['ventes'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "ACHATS") {
            $array['achats'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "PROJETS") {
            $array['projets'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "INVENTAIRE") {
            $array['inventaire'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "CLIENTS") {
            $array['clients'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "FOURNISSEURS") {
            $array['fournisseurs'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "ARTICLES") {
            $array['articles'] = $permissions['niveau'];
        }
        if ($permissions['module'] === "MEMBRES") {
            $array['membres'] = $permissions['niveau'];
        }
    }

    return $array;

}

?>