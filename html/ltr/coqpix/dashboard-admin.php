<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_connect_admin.php';

    $pdoSt = $bdd->prepare('SELECT * FROM comptable');
    $pdoSt->execute();
    $comptables = $pdoSt->fetchAll();

    $pdoSt = $bdd->prepare('SELECT MAX(nb) AS nb FROM (SELECT COUNT(*) AS nb FROM comptable_list GROUP BY id_comptable) AS temp');
    $pdoSt->execute();
    $nb_assigne_max = ($pdoSt->fetch())['nb'];

// DEBUT REQUETES COMPTABILITE

    $annee_actuelle = date("Y");
    $mois = array('01','02','03','04','05','06','07','08','09','10','11','12');
    $status_crea = array('SARL', 'SAS', 'SASU', 'SCI', 'EIRL', 'EI', 'Micr');

    // DEBUT CHART 1

    // Requete pour recuperer le nombre de prospect, en cours, actif
    $query = $bdd->prepare('SELECT substr(date_crea, 7) AS annee, count(case when (statut = "prospect" || statut = "prospect!validation") then 1 else null end) AS count_prospect, count(case when statut = "encours" then 1 else null end) AS count_encours, count(case when statut = "actif" then 1 else null end) AS count_actif FROM portefeuille WHERE substr(date_crea, 7) > (:annee - 5) GROUP BY substr(date_crea, 7)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    $count_prospect = array($annee_actuelle-1 => 0, $annee_actuelle-2 => 0, $annee_actuelle-3 => 0, $annee_actuelle-4 => 0, $annee_actuelle-5 => 0);
    $count_encours = array($annee_actuelle-1 => 0, $annee_actuelle-2 => 0, $annee_actuelle-3 => 0, $annee_actuelle-4 => 0, $annee_actuelle-5 => 0);
    $count_actif = array($annee_actuelle-1 => 0, $annee_actuelle-2 => 0, $annee_actuelle-3 => 0, $annee_actuelle-4 => 0, $annee_actuelle-5 => 0);
    while ($count_portefeuille = $query->fetch()) {
        $count_prospect[$count_portefeuille['annee']] = (int) $count_portefeuille['count_prospect'];
        $count_encours[$count_portefeuille['annee']] = (int) $count_portefeuille['count_encours'];
        $count_actif[$count_portefeuille['annee']] = (int) $count_portefeuille['count_actif'];
    }

    // Requete pour recuperer le nombre d'actifs par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, count(case when substr(date_crea, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(date_crea, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(date_crea, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(date_crea, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(date_crea, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM portefeuille WHERE upper(statut) = "ACTIF" GROUP BY substr(date_crea, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'nb_actif_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($nb_actif = $query->fetch()) {
        ${'nb_actif_'.($annee_actuelle)}[array_search($nb_actif['mois'], $mois)] = (int) $nb_actif['nb_n'];
        ${'nb_actif_'.($annee_actuelle-1)}[array_search($nb_actif['mois'], $mois)] = (int) $nb_actif['nb_n_1'];
        ${'nb_actif_'.($annee_actuelle-2)}[array_search($nb_actif['mois'], $mois)] = (int) $nb_actif['nb_n_2'];
        ${'nb_actif_'.($annee_actuelle-3)}[array_search($nb_actif['mois'], $mois)] = (int) $nb_actif['nb_n_3'];
        ${'nb_actif_'.($annee_actuelle-4)}[array_search($nb_actif['mois'], $mois)] = (int) $nb_actif['nb_n_4'];
    }

    // Requete pour recuperer le nombre d'actifs par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, count(case when substr(date_crea, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(date_crea, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(date_crea, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(date_crea, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(date_crea, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM portefeuille WHERE upper(statut) = "PASSIF" GROUP BY substr(date_crea, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'nb_passif_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($nb_passif = $query->fetch()) {
        ${'nb_passif_'.($annee_actuelle)}[array_search($nb_passif['mois'], $mois)] = (int) $nb_passif['nb_n'];
        ${'nb_passif_'.($annee_actuelle-1)}[array_search($nb_passif['mois'], $mois)] = (int) $nb_passif['nb_n_1'];
        ${'nb_passif_'.($annee_actuelle-2)}[array_search($nb_passif['mois'], $mois)] = (int) $nb_passif['nb_n_2'];
        ${'nb_passif_'.($annee_actuelle-3)}[array_search($nb_passif['mois'], $mois)] = (int) $nb_passif['nb_n_3'];
        ${'nb_passif_'.($annee_actuelle-4)}[array_search($nb_passif['mois'], $mois)] = (int) $nb_passif['nb_n_4'];
    }

    // FIN CHART 1

    // DEBUT CHART 2
    
    // requete pour recuperer les factures en retard 
    $pdoSt= $bdd->query('SELECT * FROM facture');
    $facture = $pdoSt->fetch();

    $pdoSt= $bdd->prepare('SELECT * FROM (SELECT nameentreprise, reffacture, dateecheance, numerosfacture from facture, entreprise where status_facture = "NON PAYE" AND dateecheance < NOW() AND entreprise.id=:id) as temp ORDER BY dateecheance DESC LIMIT 10');
    $pdoSt->bindValue(':id', $facture['id_session']);
    $pdoSt->execute();
    $facture_retard = $pdoSt->fetchAll();

    $count_retard = count($facture_retard);

    // FIN CHART 2

    // DEBUT CHART 3

    // requete pour recupere la liste des comptables
    $pdoSt = $bdd->prepare('SELECT * FROM comptable');
    $pdoSt->execute();
    $comptables = $pdoSt->fetchAll();

    // requete pour recuperer le max de comptable list
    $pdoSt = $bdd->prepare('SELECT MAX(nb) AS nb FROM (SELECT COUNT(*) AS nb FROM comptable_list GROUP BY id_comptable) AS temp');
    $pdoSt->execute();
    $nb_assigne_max = ($pdoSt->fetch())['nb'];

    // FIN CHART 3

    // DEBUT CHART 4
    
    // requete pour recuperer le nombre de prelevements reussis
    $query = $bdd->prepare('SELECT dte_m AS mois, count(case when dte_a = :annee and upper(statut) = "PAYE" then 1 else null end) AS nb_n, count(case when dte_a = :annee - 1 and upper(statut) = "PAYE" then 1 else null end) AS nb_n_1, count(case when dte_a = :annee - 2 and upper(statut) = "PAYE" then 1 else null end) AS nb_n_2, count(case when dte_a = :annee - 3 and upper(statut) = "PAYE" then 1 else null end) AS nb_n_3, count(case when dte_a = :annee - 4 and upper(statut) = "PAYE" then 1 else null end) AS nb_n_4 FROM prelevement GROUP BY dte_m');
    $query->execute(array(':annee' => $annee_actuelle));
    for ($i=0 ; $i<5 ; $i++) {
        ${'nb_prelev_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($prelev_reussis = $query->fetch()) {
        ${'nb_prelev_'.($annee_actuelle)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['nb_n'];
        ${'nb_prelev_'.($annee_actuelle-1)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['nb_n_1'];
        ${'nb_prelev_'.($annee_actuelle-2)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['nb_n_2'];
        ${'nb_prelev_'.($annee_actuelle-3)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['nb_n_3'];
        ${'nb_prelev_'.($annee_actuelle-4)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['nb_n_4'];
    }

    // requete pour recuperer le pourcentage de prelevements reussis
    $query = $bdd->prepare('SELECT dte_m AS mois, round(count(case when dte_a = :annee and upper(statut) = "PAYE" then 1 else null end) / count(case when dte_a = :annee then 1 else null end) * 100) AS pourcent_n, round(count(case when dte_a = :annee - 1 and upper(statut) = "PAYE" then 1 else null end) / count(case when dte_a = :annee - 1 then 1 else null end) * 100) AS pourcent_n_1, round(count(case when dte_a = :annee - 2 and upper(statut) = "PAYE" then 1 else null end) / count(case when dte_a = :annee - 2 then 1 else null end) * 100) AS pourcent_n_2, round(count(case when dte_a = :annee - 3 and upper(statut) = "PAYE" then 1 else null end) / count(case when dte_a = :annee - 3 then 1 else null end) * 100) AS pourcent_n_3, round(count(case when dte_a = :annee - 4 and upper(statut) = "PAYE" then 1 else null end) / count(case when dte_a = :annee - 4 then 1 else null end) * 100) AS pourcent_n_4 FROM prelevement GROUP BY dte_m');
    $query->execute(array(':annee' => $annee_actuelle));
    for ($i=0 ; $i<5 ; $i++) {
        ${'pourcent_prelev_'.($annee_actuelle - $i)} = array(100,100,100,100,100,100,100,100,100,100,100,100);
    }
    while ($prelev_reussis = $query->fetch()) {
        if ($prelev_reussis['pourcent_n'] != null) { ${'pourcent_prelev_'.($annee_actuelle)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['pourcent_n']; }
        if ($prelev_reussis['pourcent_n_1'] != null) {${'pourcent_prelev_'.($annee_actuelle-1)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['pourcent_n_1']; }
        if ($prelev_reussis['pourcent_n_2'] != null) { ${'pourcent_prelev_'.($annee_actuelle-2)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['pourcent_n_2']; }
        if ($prelev_reussis['pourcent_n_3'] != null) { ${'pourcent_prelev_'.($annee_actuelle-3)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['pourcent_n_3']; }
        if ($prelev_reussis['pourcent_n_4'] != null) { ${'pourcent_prelev_'.($annee_actuelle-4)}[array_search($prelev_reussis['mois'], $mois)] = (int) $prelev_reussis['pourcent_n_4']; }
    }
    
    // Requête pour récupérer le bilan annuel pour les 5 dernières années
    $query = $bdd->prepare('SELECT date_a AS annee, count(*) AS nb, round(count(*) / (SELECT count(*) FROM entreprise WHERE upper(new_user) = "ACTIVE") * 100) AS pourcent FROM bilan WHERE date_a > (:annee - 6) GROUP BY date_a');
    $query->execute(array(':annee' => $annee_actuelle));
    $nb_bilan = array($annee_actuelle-1 => 0, $annee_actuelle-2 => 0, $annee_actuelle-3 => 0, $annee_actuelle-4 => 0, $annee_actuelle-5 => 0);
    $pourcent_bilan = array($annee_actuelle-1 => 100, $annee_actuelle-2 => 100, $annee_actuelle-3 => 100, $annee_actuelle-4 => 100, $annee_actuelle-5 => 100);
    while ($bilan_annuel = $query->fetch()) {
        $nb_bilan[$bilan_annuel['annee']] = (int) $bilan_annuel['nb'];
        $pourcent_bilan[$bilan_annuel['annee']] = (int) $bilan_annuel['pourcent'];
    }

    // FIN CHART 4

// FIN REQUETES COMPTABILITE

// DEBUT REQUETES JURIDIQUE

    // DEBUT CHART 1

    // Requete SQL permettant de récupérer le nombre de créations d'entreprise validés par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, count(case when substr(date_crea, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(date_crea, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(date_crea, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(date_crea, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(date_crea, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM crea_societe WHERE doc_pieceid!="" AND doc_cerfaM0!="" AND doc_pouvoir!="" AND doc_attestation!="" AND RIGHT(depo_cfe,3) ="yes" and RIGHT(depo_greffe,3) ="yes" AND RIGHT(frais,3)="yes" AND ( (doc_cerfaMBE!="" AND doc_justificatifss!="" AND doc_statuts!="" AND doc_nomination!="" AND doc_annonce!="" AND doc_depot!="") OR (doc_xp!="" AND doc_justificatifd!="" AND doc_peirl!="" AND doc_attestation!="")) GROUP BY substr(date_crea, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'crea_valide_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($crea_valide = $query->fetch()) {
        ${'crea_valide_'.($annee_actuelle)}[array_search($crea_valide['mois'], $mois)] = (int) $crea_valide['nb_n'];
        ${'crea_valide_'.($annee_actuelle-1)}[array_search($crea_valide['mois'], $mois)] = (int) $crea_valide['nb_n_1'];
        ${'crea_valide_'.($annee_actuelle-2)}[array_search($crea_valide['mois'], $mois)] = (int) $crea_valide['nb_n_2'];
        ${'crea_valide_'.($annee_actuelle-3)}[array_search($crea_valide['mois'], $mois)] = (int) $crea_valide['nb_n_3'];
        ${'crea_valide_'.($annee_actuelle-4)}[array_search($crea_valide['mois'], $mois)] = (int) $crea_valide['nb_n_4'];
    }

    // Requete SQL permettant de récupérer le nombre total créations d'entreprise par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(date_crea, 4,2) AS mois, count(case when substr(date_crea, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(date_crea, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(date_crea, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(date_crea, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(date_crea, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM crea_societe GROUP BY substr(date_crea, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'crea_encours_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($total_crea = $query->fetch()) {
        ${'crea_encours_'.($annee_actuelle)}[array_search($total_crea['mois'], $mois)] = (int) $total_crea['nb_n'] - ${'crea_valide_'.($annee_actuelle)}[array_search($total_crea['mois'], $mois)];
        ${'crea_encours_'.($annee_actuelle-1)}[array_search($total_crea['mois'], $mois)] = (int) $total_crea['nb_n_1'] - ${'crea_valide_'.($annee_actuelle-1)}[array_search($total_crea['mois'], $mois)];
        ${'crea_encours_'.($annee_actuelle-2)}[array_search($total_crea['mois'], $mois)] = (int) $total_crea['nb_n_2'] - ${'crea_valide_'.($annee_actuelle-2)}[array_search($total_crea['mois'], $mois)];
        ${'crea_encours_'.($annee_actuelle-3)}[array_search($total_crea['mois'], $mois)] = (int) $crea_valide['nb_n_3'] - ${'crea_valide_'.($annee_actuelle-3)}[array_search($total_crea['mois'], $mois)];
        ${'crea_encours_'.($annee_actuelle-4)}[array_search($total_crea['mois'], $mois)] = (int) $total_crea['nb_n_4'] - ${'crea_valide_'.($annee_actuelle-4)}[array_search($total_crea['mois'], $mois)];
    }

    // Requete SQL permettant de récupérer le nombre de modifications d'entreprise validés par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(dte, 4,2) AS mois, count(case when substr(dte, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(dte, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(dte, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(dte, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(dte, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM acte WHERE progression = "100" and right(frais, 3) = "yes" and right(honoraire, 3) = "yes" and right(depo_greffe, 3) = "yes" and right(depo_cfe, 3) = "yes" and article_three = "yes" GROUP BY substr(dte, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'modif_valide_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($modif_valide = $query->fetch()) {
        ${'modif_valide_'.($annee_actuelle)}[array_search($modif_valide['mois'], $mois)] = (int) $modif_valide['nb_n'];
        ${'modif_valide_'.($annee_actuelle-1)}[array_search($modif_valide['mois'], $mois)] = (int) $modif_valide['nb_n_1'];
        ${'modif_valide_'.($annee_actuelle-2)}[array_search($modif_valide['mois'], $mois)] = (int) $modif_valide['nb_n_2'];
        ${'modif_valide_'.($annee_actuelle-3)}[array_search($modif_valide['mois'], $mois)] = (int) $modif_valide['nb_n_3'];
        ${'modif_valide_'.($annee_actuelle-4)}[array_search($modif_valide['mois'], $mois)] = (int) $modif_valide['nb_n_4'];
    }

    // Requete SQL permettant de récupérer le nombre total de modifications d'entreprise par mois et pour les 5 dernières années
    $query = $bdd->prepare('SELECT substr(dte, 4,2) AS mois, count(case when substr(dte, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(dte, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(dte, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(dte, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(dte, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM acte GROUP BY substr(dte, 4,2)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'modif_encours_'.($annee_actuelle - $i)} = array(0,0,0,0,0,0,0,0,0,0,0,0);
    }
    while ($total_modif = $query->fetch()) {
        ${'modif_encours_'.($annee_actuelle)}[array_search($total_modif['mois'], $mois)] = (int) $total_modif['nb_n'] - ${'modif_valide_'.($annee_actuelle)}[array_search($total_modif['mois'], $mois)];
        ${'modif_encours_'.($annee_actuelle-1)}[array_search($total_modif['mois'], $mois)] = (int) $total_modif['nb_n_1'] - ${'modif_valide_'.($annee_actuelle-1)}[array_search($total_modif['mois'], $mois)];
        ${'modif_encours_'.($annee_actuelle-2)}[array_search($total_modif['mois'], $mois)] = (int) $total_modif['nb_n_2'] - ${'modif_valide_'.($annee_actuelle-2)}[array_search($total_modif['mois'], $mois)];
        ${'modif_encours_'.($annee_actuelle-3)}[array_search($total_modif['mois'], $mois)] = (int) $total_modif['nb_n_3'] - ${'modif_valide_'.($annee_actuelle-3)}[array_search($total_modif['mois'], $mois)];
        ${'modif_encours_'.($annee_actuelle-4)}[array_search($total_modif['mois'], $mois)] = (int) $total_modif['nb_n_4'] - ${'modif_valide_'.($annee_actuelle-4)}[array_search($total_modif['mois'], $mois)];
    }

    // FIN CHART 1

    // Requete SQL permettant de recuperer le nombre de créa par type
    $query = $bdd->prepare('SELECT LEFT(status_crea, 4) AS status_crea, count(case when substr(date_crea, 7) = :annee then 1 else null end) AS nb_n, count(case when substr(date_crea, 7) = :annee - 1 then 1 else null end) AS nb_n_1, count(case when substr(date_crea, 7) = :annee - 2 then 1 else null end) AS nb_n_2, count(case when substr(date_crea, 7) = :annee - 3 then 1 else null end) AS nb_n_3, count(case when substr(date_crea, 7) = :annee - 4 then 1 else null end) AS nb_n_4 FROM crea_societe GROUP BY status_crea');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'nb_crea_type_'.($annee_actuelle - $i)} = array('SARL'=>0, 'SAS'=>0, 'SASU'=>0, 'SCI'=>0, 'EIRL'=>0, 'EI'=>0, 'Micro-Entreprise'=>0);
    }
    while ($nb_crea_type = $query->fetch()) {
        ${'nb_crea_type_'.($annee_actuelle)}[$nb_crea_type['status_crea']] = (int) $nb_crea_type['nb_n'];
        ${'nb_crea_type_'.($annee_actuelle-1)}[$nb_crea_type['status_crea']] = (int) $nb_crea_type['nb_n_1'];
        ${'nb_crea_type_'.($annee_actuelle-2)}[$nb_crea_type['status_crea']] = (int) $nb_crea_type['nb_n_2'];
        ${'nb_crea_type_'.($annee_actuelle-3)}[$nb_crea_type['status_crea']] = (int) $nb_crea_type['nb_n_3'];
        ${'nb_crea_type_'.($annee_actuelle-4)}[$nb_crea_type['status_crea']] = (int) $nb_crea_type['nb_n_4'];
    }

    // Requete SQL permettant de recuperer le nombre de créa valides
    $query = $bdd->query('SELECT COUNT(*) AS nb FROM crea_societe WHERE doc_pieceid!="" AND doc_cerfaM0!="" AND doc_pouvoir!="" AND doc_attestation!="" AND RIGHT(depo_cfe,3) ="yes" and RIGHT(depo_greffe,3) ="yes" AND RIGHT(frais,3)="yes" AND ((doc_cerfaMBE!="" AND doc_justificatifss!="" AND doc_statuts!="" AND doc_nomination!="" AND doc_annonce!="" AND doc_depot!="") OR (doc_xp!="" AND doc_justificatifd!="" AND doc_peirl!="" AND doc_attestation!=""))');
    $nb_crea_valide = ($query->fetch())['nb'];

    // Nombre de créations d'entreprise en cours
    $nb_crea_en_cours = array_sum(${'nb_crea_type_'.($annee_actuelle)})
                        + array_sum(${'nb_crea_type_'.($annee_actuelle-1)})
                        + array_sum(${'nb_crea_type_'.($annee_actuelle-2)})
                        + array_sum(${'nb_crea_type_'.($annee_actuelle-3)})
                        + array_sum(${'nb_crea_type_'.($annee_actuelle-4)})
                        - $nb_crea_valide;

    // Requete SQL permettant de recuperer le nombre de créa supprimées
    $query = $bdd->query('SELECT COUNT(*) AS nb FROM delete_societe');
    $nb_crea_delete = ($query->fetch())['nb'];

    // Requete SQL permettant de recuperer le nombre de modifications d'entreprise par type de changement
    $query = $bdd->prepare('SELECT substr(dte, 7) AS annee, count(case when one = "on" then 1 else null end) AS nb_one, count(case when two = "on" then 1 else null end) AS nb_two, count(case when three = "on" then 1 else null end) AS nb_three, count(case when four = "on" then 1 else null end) AS nb_four, count(case when five = "on" then 1 else null end) AS nb_five, count(case when six = "on" then 1 else null end) AS nb_six, count(case when seven = "on" then 1 else null end) AS nb_seven, count(case when eight = "on" then 1 else null end) AS nb_eight FROM acte GROUP BY substr(dte, 7)');
    $query->execute(array(':annee' => ($annee_actuelle)));
    for ($i=0 ; $i<5 ; $i++) {
        ${'nb_modif_type_'.($annee_actuelle - $i)} = array('one'=>0, 'two'=>0, 'three'=>0, 'four'=>0, 'five'=>0, 'six'=>0, 'seven'=>0, 'eight'=>0);
    }
    while ($nb_modif_type = $query->fetch()) {
        ${'nb_modif_type_'.$nb_modif_type['annee']}['one'] = (int) $nb_modif_type['nb_one'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['two'] = (int) $nb_modif_type['nb_two'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['three'] = (int) $nb_modif_type['nb_three'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['four'] = (int) $nb_modif_type['nb_four'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['five'] = (int) $nb_modif_type['nb_five'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['six'] = (int) $nb_modif_type['nb_six'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['seven'] = (int) $nb_modif_type['nb_seven'];
        ${'nb_modif_type_'.$nb_modif_type['annee']}['eight'] = (int) $nb_modif_type['nb_eight'];
    }

// FIN REQUETES JURIDIQUE

?>

<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Frest admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Frest admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Dashboard Admin</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.ico">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/charts/apexcharts.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/dragula.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/extensions/swiper.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-ecommerce.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/dashboard-analytics.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/plugins/extensions/swiper.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<style>
    table tbody {
        display: block;
        max-height: 300px;
        overflow-y: auto;
        overflow-x: hidden;
    }

    table thead, table tbody tr {
        display: table;
        width: 100%;
        table-layout: fixed;
    }

    .round {
        position: relative;
        border: 2px solid #fff;
        width: 40px;
        height: 40px;
        border-radius: 100%;
    }

    .round:hover{
        background-color: #5A5E6B;
    }

    .line1, .line2 {
        z-index: 999;
        height: 2px;
        margin:1px;
        width: 12px;
        background: #fff;
        transition: 0.4s ease;
    }

    .line1:first-child {
        display: block;
        position: absolute;
        transform: rotate(45deg);
        right: 33%;
        bottom: 35%;
    }

    .line1:nth-child(2) {
        display: block;
        position: absolute;
        transform: rotate(-45deg);
        right: 33%;
        bottom: 55%;
    }

    .line2:first-child {
        display: block;
        position: absolute;
        transform: rotate(-45deg);
        left: 35%;
        bottom: 35%;
    }

    .line2:nth-child(2) {
        display: block;
        position: absolute;
        transform: rotate(45deg);
        left: 35%;
        bottom: 55%;
    }

    .round:hover .line1:nth-child(1) {
        transform: rotate(225deg);
    }

    .round:hover .line1:nth-child(2) {
        transform: rotate(-225deg);
    }

    .round:hover .line2:nth-child(1) {
        transform: rotate(-225deg);
    }

    .round:hover .line2:nth-child(2) {
        transform: rotate(225deg);
    }

</style>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="horizontal-layout horizontal-menu navbar-static dark-layout 2-columns   footer-static  " data-open="hover" data-menu="horizontal-menu" data-col="2-columns" data-layout="dark-layout">
    <!-- BEGIN: Header-->
    <nav class="header-navbar navbar-expand-lg navbar navbar-with-menu navbar-static-top bg-primary navbar-brand-center">
        <div class="navbar-header d-xl-block d-none">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item"><a class="navbar-brand" href="dashboard-admin.php">
                        <div class="brand-logo"><img class="logo" src="../../../app-assets/images/logo/coqpix1.png"></div>
                    </a></li>
            </ul>
        </div>
        <div class="navbar-wrapper">
            <div class="navbar-container content">
                <div class="navbar-collapse" id="navbar-mobile">
                    <ul class="nav navbar-nav float-right d-flex align-items-center">
                        <li class="dropdown dropdown-user nav-item"><a class="dropdown-toggle nav-link dropdown-user-link" href="#" data-toggle="dropdown">
                            <div class="user-nav d-lg-flex d-none"><span class="user-name">Coqpix</span><span class="user-status">En ligne</span></div><span><img class="round" src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="40" width="40"></span></a>
                            <div class="dropdown-menu dropdown-menu pb-0">
                                <a class="dropdown-item" href="#"><i class="bx bx-user mr-50"></i> Editer Profile (SOON)</a>
                                <a class="dropdown-item" href="php/disconnect-admin.php"><i class="bx bx-power-off mr-50"></i> Déconnexion</a>
                            </div>
                        </li>
                        <li class="nav-item d-none d-lg-block"><a class="nav-link nav-link-expand"><i class="ficon bx bx-fullscreen"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>
    <!-- END: Header-->

    <?php include('php/menu_backend.php'); ?>

    <!-- BEGIN: Content-->
    <div class="mt-xl-0 mt-1 app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper pt-0">
            <div class="content-header row">
            </div>
            <div class="content-body row">
                <!-- DEBUT MENU GAUCHE -->
                <div class="col-3">

                </div>
                <!-- FIN MENU GAUCHE -->
                <!-- Dashboard Analytics Start -->
                <div class="col-9">
                    <section id="component-swiper-gallery dashboard-analytics">
                        <div class="swiper-container gallery-thumbs">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-yellow btn-lg btn-block py-1 py-md-0 px-0" ><strong class="d-none d-md-block text-dark">Comptabilité</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-danger btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Juridique</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-warning btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Fiscalité</strong></button>
                                </div>
                                <div class="swiper-slide">
                                    <button type="button" class="btn btn-info btn-lg btn-block py-1 py-md-0 px-0"><strong class="d-none d-md-block">Sociale</strong></button>
                                </div>
                            </div>
                        </div>
                        <div class="swiper-gallery gallery-top">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <!-- DEBUT COMPTA -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                <div class="d-flex justify-content-end mb-1">
                                                                    <div>
                                                                        <select style="width: 80px;" class="form-control" id="id_select_annee_portefeuille">
                                                                            <option value="<?= $annee_actuelle ?>"><?= $annee_actuelle ?></option>
                                                                            <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                            <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                            <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                            <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="d-flex justify-content-around align-items-center flex-wrap">
                               
                                                                    <div class="user-analytics">                                                                        
                                                                        <h6 class="mb-0 text-center">Prospect</h6>
                                                                        <div class="d-flex">
                                                                            <div class="badge-circle badge-circle-lg badge-circle-light-primary mx-auto my-1">
                                                                                <i class='bx bxs-save font-medium-5'></i>
                                                                            </div>
                                                                        </div>    
                                                                        <h6 class="text-center" id="id_count_prospect"><?= $count_prospect[$annee_actuelle] ?></h6>
                                                                        
                                                                    </div>
                                                                    <div class="sessions-analytics">                                                                    
                                                                        <h6 class="mb-0 text-center">En cours</h6>
                                                                        <div class="d-flex">
                                                                            <div class="badge-circle badge-circle-lg badge-circle-light-warning mx-auto my-1">
                                                                                <i class='bx bx-loader-circle font-medium-5'></i>
                                                                            </div>
                                                                        </div>    
                                                                        <h6 class="text-center" id="id_count_encours"><?= $count_encours[$annee_actuelle] ?></h6>
                                                                        
                                                                    </div>
                                                                    <div class="bounce-rate-analytics">                                                                       
                                                                        <h6 class="mb-0 text-center">Actif</h6>
                                                                        <div class="d-flex">
                                                                            <div class="badge-circle badge-circle-lg badge-circle-light-success mx-auto my-1">
                                                                                <i class='bx bx-badge-check font-medium-5'></i>
                                                                            </div>
                                                                        </div>    
                                                                        <h6 class="text-center" id="id_count_actif"><?= $count_actif[$annee_actuelle] ?></h6>                                                                        
                                                                    </div>
                                                                </div>   

                                                                <div id="analytics-bar-chart-compta">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <section id="horizontal-vertical">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title">Rappel factures retard</h4>
                                                            <?php if ($count_retard != 0) { ?>
                                                                <span class="badge badge-danger badge-pill badge-round float-right mt-50" style="color:black"><?= $count_retard ?></span>
                                                            <?php } ?>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1">
                                                                 <!-- table with no border -->
                                                                <div class="table-responsive d-none d-sm-block">
                                                                    <table class="table table-borderless nowrap scroll-horizontal-vertical">
                                                                        <thead>
                                                                            <tr>
                                                                                <th class="text-center px-0">NAME</th>
                                                                                <th class="text-center px-0">REFF</th>
                                                                                <th class="text-center pl-0">DATE</th>
                                                                                <th class="text-center pl-0">NUMEROS</th>                                                                                
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>                                                                           
                                                                            <?php foreach($facture_retard as $factures): ?>
                                                                            <tr>
                                                                                <td class="text-center px-0"><?= $factures['nameentreprise'] ?></td>
                                                                                <td class="text-center px-0"><?= $factures['reffacture'] ?></td>
                                                                                <td class="text-center px-0"><?= $factures['dateecheance'] ?>&nbsp <i class="bx bxs-circle danger font-small-1 mr-50"></i></td>
                                                                                <td class="text-center px-1"><?= $factures['numerosfacture'] ?></td>                                                                            
                                                                            </tr>
                                                                        <?php endforeach; ?> 
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <?php if ($count_retard == 0) { ?>
                                                                    <h5 class="text-center text-success"> Aucune facture en retard </h5>
                                                                <?php } ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </section>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <!-- FIN TABLE TRESORERIE -->
                                        <div class="col-xl-6 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                                                            <h5 class="card-title"><i class="bx bx-group font-medium-5 align-middle"></i> <span class="align-middle">Comptables</span></h5>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body py-1 px-0">
                                                                <div class="d-flex justify-content-around">
                                                                    <a href="#" id="id_bouton_ventes" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: #5A8DEE;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_ventes">
                                                                        <i class="bx bx-dollar mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Ventes</div>              
                                                                        </div>
                                                                    </div></a>
                                                                    <a href="#" id="id_bouton_achats" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: none;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_achats">
                                                                        <i class="bx bx-wallet mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Achats</div>       
                                                                        </div>
                                                                    </div></a>
                                                                    <a href="#" id="id_bouton_tresorerie" style="
                                                                        font-family: Rubik, Helvetica, Arial, serif;
                                                                        color: #FFFFFF;
                                                                        background-color: none;
                                                                        box-shadow: 0 0 3px 3px rgba(92,111,140,0.7);
                                                                        border-radius: 8px;">
                                                                        <div class="py-50 px-1 d-flex align-items-center" id="id_bouton_tresorerie">
                                                                        <i class="bx bx-diamond mr-50 font-large-1"></i>
                                                                        <div class="d-none d-md-block">
                                                                            <div>Trésorerie</div> 
                                                                        </div>
                                                                    </div></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div id="id_table_ventes" style="display:block;">
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <?php foreach ($comptables as $comptable) :
                                                                            $pdoSt = $bdd->prepare('SELECT COUNT(*) as nb FROM stockage_admin WHERE name_entreprise IN (SELECT name_societe FROM comptable_list WHERE id_comptable=:id) AND (type_files_fac_achat = "fac_achat" OR type_files_avoir = "avoir") AND send_files="nonvalide"');
                                                                            $pdoSt->bindValue(':id', $comptable['id']);
                                                                            $pdoSt->execute();
                                                                            $nb_assigne_perso = ($pdoSt->fetch())['nb'];

                                                                            if ($nb_assigne_max != 0 ) {
                                                                                $pourcent_perso = 100-(100*$nb_assigne_perso / $nb_assigne_max); 
                                                                            } else {
                                                                                $pourcent_perso = 100;
                                                                            }
                                                                            if ($pourcent_perso <34){
                                                                                $color_bar = "danger";
                                                                            } else if ($pourcent_perso <67){
                                                                                $color_bar = "warning";
                                                                            } else if ($pourcent_perso <100){
                                                                                $color_bar = "info";
                                                                            } else {
                                                                                $color_bar = "success";
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pr-75">
                                                                                    <div class="media align-items-center">
                                                                                        <div class="media-body">
                                                                                            <h6 class="media-heading mb-0"><?= $comptable['nom']." ".$comptable['prenom'] ?></h6>
                                                                                            <span class="font-small-2"><?=$comptable['role_comptable'] ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="px-0 w-25">
                                                                                    <div class="progress progress-bar-<?= $color_bar?> progress-sm mb-0">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pourcent_perso ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $pourcent_perso?>%;"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-center"><span class="badge badge-light-<?= $color_bar?>"><?= $nb_assigne_perso?> Restants</span>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE VENTES -->
                                                        <!-- DEBUT TABLE ACHATS -->
                                                        <div id="id_table_achats" style="display:none;"> 
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <?php foreach ($comptables as $comptable) :
                                                                            $pdoSt = $bdd->prepare('SELECT COUNT(*) as nb FROM stockage_admin WHERE name_entreprise IN (SELECT name_societe FROM comptable_list WHERE id_comptable=:id) AND (type_files_fac_ventes = "fac_ventes" OR type_files_note = "note") AND send_files="nonvalide"');
                                                                            $pdoSt->bindValue(':id', $comptable['id']);
                                                                            $pdoSt->execute();
                                                                            $nb_assigne_perso = ($pdoSt->fetch())['nb'];

                                                                            if ($nb_assigne_max != 0 ) {
                                                                                $pourcent_perso = 100-(100*$nb_assigne_perso / $nb_assigne_max); 
                                                                            } else {
                                                                                $pourcent_perso = 100;
                                                                            }
                                                                            if ($pourcent_perso <34){
                                                                                $color_bar = "danger";
                                                                            } else if ($pourcent_perso <67){
                                                                                $color_bar = "warning";
                                                                            } else if ($pourcent_perso <100){
                                                                                $color_bar = "info";
                                                                            } else {
                                                                                $color_bar = "success";
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pr-75">
                                                                                    <div class="media align-items-center">
                                                                                        <div class="media-body">
                                                                                            <h6 class="media-heading mb-0"><?= $comptable['nom']." ".$comptable['prenom'] ?></h6>
                                                                                            <span class="font-small-2"><?=$comptable['role_comptable'] ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="px-0 w-25">
                                                                                    <div class="progress progress-bar-<?= $color_bar?> progress-sm mb-0">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pourcent_perso ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $pourcent_perso?>%;"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-center"><span class="badge badge-light-<?= $color_bar?>"><?= $nb_assigne_perso?> Restants</span>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE ACHATS -->
                                                        <!-- DEBUT TABLE TRESORERIE -->
                                                        <div id="id_table_tresorerie" style="display:none;"> 
                                                            <div class="table-responsive">
                                                                <table class="table table-borderless mb-0">
                                                                    <tbody>
                                                                        <?php foreach ($comptables as $comptable) :
                                                                            $pdoSt = $bdd->prepare('SELECT COUNT(*) as nb FROM stockage_admin WHERE name_entreprise IN (SELECT name_societe FROM comptable_list WHERE id_comptable=:id) AND (type_files_caisse_ventes = "caisse_ventes" OR banque = "banque") AND send_files="nonvalide"');
                                                                            $pdoSt->bindValue(':id', $comptable['id']);
                                                                            $pdoSt->execute();
                                                                            $nb_assigne_perso = ($pdoSt->fetch())['nb'];

                                                                            if ($nb_assigne_max != 0 ) {
                                                                                $pourcent_perso = 100-(100*$nb_assigne_perso / $nb_assigne_max); 
                                                                            } else {
                                                                                $pourcent_perso = 100;
                                                                            }
                                                                            if ($pourcent_perso <34){
                                                                                $color_bar = "danger";
                                                                            } else if ($pourcent_perso <67){
                                                                                $color_bar = "warning";
                                                                            } else if ($pourcent_perso <100){
                                                                                $color_bar = "info";
                                                                            } else {
                                                                                $color_bar = "success";
                                                                            }
                                                                            ?>
                                                                            <tr>
                                                                                <td class="pr-75">
                                                                                    <div class="media align-items-center">
                                                                                        <div class="media-body">
                                                                                            <h6 class="media-heading mb-0"><?= $comptable['nom']." ".$comptable['prenom'] ?></h6>
                                                                                            <span class="font-small-2"><?=$comptable['role_comptable'] ?></span>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="px-0 w-25">
                                                                                    <div class="progress progress-bar-<?= $color_bar?> progress-sm mb-0">
                                                                                        <div class="progress-bar" role="progressbar" aria-valuenow="<?= $pourcent_perso ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $pourcent_perso?>%;"></div>
                                                                                    </div>
                                                                                </td>
                                                                                <td class="text-center"><span class="badge badge-light-<?= $color_bar?>"><?= $nb_assigne_perso?> Restants</span>
                                                                                </td>
                                                                            </tr>
                                                                        <?php endforeach; ?>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <!-- FIN TABLE TRESORERIE -->
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN LIST COMPTABLES -->
                                            <!-- DEBUT PRELEVEMENT ET BILAN -->
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-body text-center">
                                                            <div class="row">
                                                                <div class="col-md-6 col-12">
                                                                    <h6 class="mb-1"> Prélèvement réussis </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <select style="width: 80px;" class="form-control" id="id_select_mois_prelevement">
                                                                            <option value="0">Janv</option>
                                                                            <option value="1">Fevr</option>
                                                                            <option value="2">Mars</option>
                                                                            <option value="3">Avril</option>
                                                                            <option value="4">Mai</option>
                                                                            <option value="5">Juin</option>
                                                                            <option value="6">Juil</option>
                                                                            <option value="7">Aout</option>
                                                                            <option value="8">Sept</option>
                                                                            <option value="9">Oct</option>
                                                                            <option value="10">Nov</option>
                                                                            <option value="11">Dec</option>
                                                                        </select>
                                                                        <select style="width: 80px;" class="form-control" id="id_select_annee_prelevement">
                                                                            <option value="<?= $annee_actuelle ?>"><?= $annee_actuelle ?></option>
                                                                            <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                            <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                            <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                            <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="growth-Chart-prelevement"></div>
                                                                </div>
                                                                <div class="col-md-6 col-12">
                                                                    <h6 class="mb-1"> Bilans annuels </h6>
                                                                    <div class="d-flex justify-content-center">
                                                                        <select style="width: 80px;" class="form-control" id="id_select_bilan">
                                                                            <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                            <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                            <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                            <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                                            <option value="<?= $annee_actuelle-5 ?>"><?= $annee_actuelle-5 ?></option>
                                                                        </select>
                                                                    </div>
                                                                    <div id="growth-Chart-bilan" class="pb-0"></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- FIN PRELEVEMENT ET BILAN -->
                                        </div>
                                    </div>
                                    <!-- FIN COMPTA -->
                                </div>
                                <div class="swiper-slide">
                                    <!-- DEBUT JURIDIQUE -->
                                    <div class="row">
                                        <!-- DEBUT COLONNE GAUCHE -->
                                        <div class="col-xl-7 col-sm-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card-header d-flex justify-content-between align-items-center">
                                                            <h4 class="card-title" id="id_titre_juridique">Création d'entreprise</h4>
                                                            <select style="width: 80px;" class="form-control" id="id_select_annee_juridique">
                                                                <option value="<?= $annee_actuelle ?>"><?= $annee_actuelle ?></option>
                                                                <option value="<?= $annee_actuelle-1 ?>"><?= $annee_actuelle-1 ?></option>
                                                                <option value="<?= $annee_actuelle-2 ?>"><?= $annee_actuelle-2 ?></option>
                                                                <option value="<?= $annee_actuelle-3 ?>"><?= $annee_actuelle-3 ?></option>
                                                                <option value="<?= $annee_actuelle-4 ?>"><?= $annee_actuelle-4 ?></option>
                                                            </select>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body pb-1 d-flex">
                                                                <div class="d-flex flex-column justify-content-center"><a class="display-block" href="#" id="id_fleche_gauche_juridique">
                                                                    <div class="round">
                                                                        <span class="line1"></span>
                                                                        <span class="line1"></span>
                                                                    </div>
                                                                </a></div>
                                                                <div class="flex-grow-1 mr-1" id="analytics-bar-chart-juridique"></div>
                                                                <div class="d-flex flex-column justify-content-center"><a class="display-block" href="#" id="id_fleche_droite_juridique">
                                                                    <div class="round">
                                                                        <span class="line2"></span>
                                                                        <span class="line2"></span>
                                                                    </div>
                                                                </a></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- FIN COLONNE GAUCHE -->
                                        <!-- DEBUT COLONNE DROITE -->
                                        <div class="col-xl-5 col-md-12">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <div class="card">
                                                            <div class="card-header d-flex justify-content-between align-items-center pb-50">
                                                                <h4 class="card-title">Créations</h4>
                                                            </div>
                                                            <div class="card-body p-0 pb-1">
                                                                <ul class="list-group list-group-flush">
                                                                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                                        <div class="list-left d-flex">
                                                                            <div class="list-content">
                                                                                <span class="list-title">Créations en cours</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge badge-light-warning float-right mt-20"><?= $nb_crea_en_cours ?> En cours</span>
                                                                    </li>
                                                                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                                        <div class="list-left d-flex">
                                                                            <div class="list-content">
                                                                                <span class="list-title">Créations validées totales</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge badge-light-success float-right mt-20"><?= $nb_crea_valide ?> Validées</span>
                                                                    </li>
                                                                    <li class="list-group-item list-group-item-action border-0 d-flex align-items-center justify-content-between">
                                                                        <div class="list-left d-flex">
                                                                            <div class="list-content">
                                                                                <span class="list-title">Créations abandonnées</span>
                                                                            </div>
                                                                        </div>
                                                                        <span class="badge badge-light-danger float-right mt-20"><?= $nb_crea_delete ?> Abandons</span>
                                                                    </li>
                                                                    
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Earning Swiper Starts -->
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="card">
                                                        <!-- Impression Radial Chart Starts-->
                                                        <div class="col-12">
                                                            <div class="card">
                                                                <div class="card-content">
                                                                    <div class="card-body donut-chart-wrapper">
                                                                        <div class="row">
                                                                            <div id="id_legende_crea" class="col-5" style="display: block;">
                                                                                <ul class="list-inline d-flex justify-content-around mb-0 flex-column">
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-success mr-50"></span>SARL</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-primary mr-50"></span>SAS</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-warning mr-50"></span>SASU</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-danger mr-50"></span>SCI</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-info mr-50"></span>EIRL</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-light mr-50"></span>EI</li>
                                                                                    <li> <span class="bullet bullet-sm bullet-dark mr-50"></span>Micro-entreprise</li>
                                                                                </ul>
                                                                            </div>
                                                                            <div id="id_legende_modif" class="col-5" style="display: none;">
                                                                                <ul class="list-inline d-flex justify-content-around mb-0 flex-column">
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-success mr-50"></span>Cession de parts / Actions</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-primary mr-50"></span>Gérant / Président</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-warning mr-50"></span>Siège social</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-danger mr-50"></span>Objet social</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-info mr-50"></span>Forme juridique</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-light mr-50"></span>Dénomination</li>
                                                                                    <li class = "mb-1"> <span class="bullet bullet-sm bullet-dark mr-50"></span>Capital social</li>
                                                                                    <li> <span class="bullet bullet-sm mr-50" style="background-color: #FF00FF;"></span>Veille</li>
                                                                                </ul>
                                                                            </div>
                                                                            <div class="col-7">
                                                                                <div id="donut-chart" class="d-flex justify-content-center"></div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- FIN JURIDIQUE -->
                                </div>
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body"></div>
                                    </div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="card">
                                        <div class="card-body"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- Dashboard Analytics end -->
    </div>
    <!-- END: Content-->

    <!-- BEGIN: Footer-->

    <!-- END: Footer-->

    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="../../../app-assets/vendors/js/ui/jquery.sticky.js"></script>
    <script src="../../../app-assets/vendors/js/charts/apexcharts.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/dragula.min.js"></script>
    <script src="../../../app-assets/vendors/js/extensions/swiper.min.js"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/horizontal-menu.js"></script>
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script type="text/javascript">

        var annee_actuelle = (new Date()).getFullYear();

        var count_prospect = <?php echo json_encode($count_prospect); ?>;
        var count_encours = <?php echo json_encode($count_encours); ?>;
        var count_actif = <?php echo json_encode($count_actif); ?>;

        var pourcent_prelev = "pourcent_prelev_";
        this[pourcent_prelev + annee_actuelle] = <?php echo json_encode(${'pourcent_prelev_'.($annee_actuelle)}); ?>;
        this[pourcent_prelev + (annee_actuelle-1)] = <?php echo json_encode(${'pourcent_prelev_'.($annee_actuelle-1)}); ?>;
        this[pourcent_prelev + (annee_actuelle-2)] = <?php echo json_encode(${'pourcent_prelev_'.($annee_actuelle-2)}); ?>;
        this[pourcent_prelev + (annee_actuelle-3)] = <?php echo json_encode(${'pourcent_prelev_'.($annee_actuelle-3)}); ?>;
        this[pourcent_prelev + (annee_actuelle-4)] = <?php echo json_encode(${'pourcent_prelev_'.($annee_actuelle-4)}); ?>;

        var nb_prelev = "nb_prelev_";
        this[nb_prelev + annee_actuelle] = <?php echo json_encode(${'nb_prelev_'.($annee_actuelle)}); ?>;
        this[nb_prelev + (annee_actuelle-1)] = <?php echo json_encode(${'nb_prelev_'.($annee_actuelle-1)}); ?>;
        this[nb_prelev + (annee_actuelle-2)] = <?php echo json_encode(${'nb_prelev_'.($annee_actuelle-2)}); ?>;
        this[nb_prelev + (annee_actuelle-3)] = <?php echo json_encode(${'nb_prelev_'.($annee_actuelle-3)}); ?>;
        this[nb_prelev + (annee_actuelle-4)] = <?php echo json_encode(${'nb_prelev_'.($annee_actuelle-4)}); ?>;

        var nb_bilan = <?php echo json_encode($nb_bilan); ?>;
        var pourcent_bilan = <?php echo json_encode($pourcent_bilan); ?>;

        var nb_actif = "nb_actif_";
        this[nb_actif + annee_actuelle] = <?php echo json_encode(${'nb_actif_'.($annee_actuelle)}); ?>;
        this[nb_actif + (annee_actuelle-1)] = <?php echo json_encode(${'nb_actif_'.($annee_actuelle-1)}); ?>;
        this[nb_actif + (annee_actuelle-2)] = <?php echo json_encode(${'nb_actif_'.($annee_actuelle-2)}); ?>;
        this[nb_actif + (annee_actuelle-3)] = <?php echo json_encode(${'nb_actif_'.($annee_actuelle-3)}); ?>;
        this[nb_actif + (annee_actuelle-4)] = <?php echo json_encode(${'nb_actif_'.($annee_actuelle-4)}); ?>;

        var nb_passif = "nb_passif_";
        this[nb_passif + annee_actuelle] = <?php echo json_encode(${'nb_passif_'.($annee_actuelle)}); ?>;
        this[nb_passif + (annee_actuelle-1)] = <?php echo json_encode(${'nb_passif_'.($annee_actuelle-1)}); ?>;
        this[nb_passif + (annee_actuelle-2)] = <?php echo json_encode(${'nb_passif_'.($annee_actuelle-2)}); ?>;
        this[nb_passif + (annee_actuelle-3)] = <?php echo json_encode(${'nb_passif_'.($annee_actuelle-3)}); ?>;
        this[nb_passif + (annee_actuelle-4)] = <?php echo json_encode(${'nb_passif_'.($annee_actuelle-4)}); ?>;

        var crea_valide = "crea_valide_";
        this[crea_valide + annee_actuelle] = <?php echo json_encode(${'crea_valide_'.($annee_actuelle)}); ?>;
        this[crea_valide + (annee_actuelle-1)] = <?php echo json_encode(${'crea_valide_'.($annee_actuelle-1)}); ?>;
        this[crea_valide + (annee_actuelle-2)] = <?php echo json_encode(${'crea_valide_'.($annee_actuelle-2)}); ?>;
        this[crea_valide + (annee_actuelle-3)] = <?php echo json_encode(${'crea_valide_'.($annee_actuelle-3)}); ?>;
        this[crea_valide + (annee_actuelle-4)] = <?php echo json_encode(${'crea_valide_'.($annee_actuelle-4)}); ?>;

        var crea_encours = "crea_encours_";
        this[crea_encours + annee_actuelle] = <?php echo json_encode(${'crea_encours_'.($annee_actuelle)}); ?>;
        this[crea_encours + (annee_actuelle-1)] = <?php echo json_encode(${'crea_encours_'.($annee_actuelle-1)}); ?>;
        this[crea_encours + (annee_actuelle-2)] = <?php echo json_encode(${'crea_encours_'.($annee_actuelle-2)}); ?>;
        this[crea_encours + (annee_actuelle-3)] = <?php echo json_encode(${'crea_encours_'.($annee_actuelle-3)}); ?>;
        this[crea_encours + (annee_actuelle-4)] = <?php echo json_encode(${'crea_encours_'.($annee_actuelle-4)}); ?>;

        var modif_valide = "modif_valide_";
        this[modif_valide + annee_actuelle] = <?php echo json_encode(${'modif_valide_'.($annee_actuelle)}); ?>;
        this[modif_valide + (annee_actuelle-1)] = <?php echo json_encode(${'modif_valide_'.($annee_actuelle-1)}); ?>;
        this[modif_valide + (annee_actuelle-2)] = <?php echo json_encode(${'modif_valide_'.($annee_actuelle-2)}); ?>;
        this[modif_valide + (annee_actuelle-3)] = <?php echo json_encode(${'modif_valide_'.($annee_actuelle-3)}); ?>;
        this[modif_valide + (annee_actuelle-4)] = <?php echo json_encode(${'modif_valide_'.($annee_actuelle-4)}); ?>;

        var modif_encours = "modif_encours_";
        this[modif_encours + annee_actuelle] = <?php echo json_encode(${'modif_encours_'.($annee_actuelle)}); ?>;
        this[modif_encours + (annee_actuelle-1)] = <?php echo json_encode(${'modif_encours_'.($annee_actuelle-1)}); ?>;
        this[modif_encours + (annee_actuelle-2)] = <?php echo json_encode(${'modif_encours_'.($annee_actuelle-2)}); ?>;
        this[modif_encours + (annee_actuelle-3)] = <?php echo json_encode(${'modif_encours_'.($annee_actuelle-3)}); ?>;
        this[modif_encours + (annee_actuelle-4)] = <?php echo json_encode(${'modif_encours_'.($annee_actuelle-4)}); ?>;

        var nb_crea_type = "nb_crea_type_";
        this[nb_crea_type + annee_actuelle] = <?php echo json_encode(${'nb_crea_type_'.($annee_actuelle)}); ?>;
        this[nb_crea_type + (annee_actuelle-1)] = <?php echo json_encode(${'nb_crea_type_'.($annee_actuelle-1)}); ?>;
        this[nb_crea_type + (annee_actuelle-2)] = <?php echo json_encode(${'nb_crea_type_'.($annee_actuelle-2)}); ?>;
        this[nb_crea_type + (annee_actuelle-3)] = <?php echo json_encode(${'nb_crea_type_'.($annee_actuelle-3)}); ?>;
        this[nb_crea_type + (annee_actuelle-4)] = <?php echo json_encode(${'nb_crea_type_'.($annee_actuelle-4)}); ?>;

        var nb_modif_type = "nb_modif_type_";
        this[nb_modif_type + annee_actuelle] = <?php echo json_encode(${'nb_modif_type_'.($annee_actuelle)}); ?>;
        this[nb_modif_type + (annee_actuelle-1)] = <?php echo json_encode(${'nb_modif_type_'.($annee_actuelle-1)}); ?>;
        this[nb_modif_type + (annee_actuelle-2)] = <?php echo json_encode(${'nb_modif_type_'.($annee_actuelle-2)}); ?>;
        this[nb_modif_type + (annee_actuelle-3)] = <?php echo json_encode(${'nb_modif_type_'.($annee_actuelle-3)}); ?>;
        this[nb_modif_type + (annee_actuelle-4)] = <?php echo json_encode(${'nb_modif_type_'.($annee_actuelle-4)}); ?>;

    </script>
    <script src="../../../app-assets/js/scripts/pages/dashboard-analytics.js"></script>
    <script src="../../../app-assets/js/scripts/pages/dashboard-ecommerce.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/swiper.js"></script>
    <script src="../../../app-assets/js/scripts/extensions/dashboard.js"></script>
    <script src="../../../app-assets/js/scripts/datatables/datatable.js"></script>
    <!-- END: Page JS-->
    
    <script>

        $(document).ready(function() {

            $("#id_select_annee_portefeuille").change(function() {         
                var annee_portefeuille = $("#id_select_annee_portefeuille").children("option:selected").val();
                // Modifier les competeurs de Prospect, En cours et Actif
                document.getElementById("id_count_prospect").innerText = count_prospect[annee_portefeuille];
                document.getElementById("id_count_encours").innerText = count_encours[annee_portefeuille];
                document.getElementById("id_count_actif").innerText = count_actif[annee_portefeuille];
            });

            $("#id_bouton_ventes").click(function(e) {
                e.preventDefault();
                // Changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="#5A8DEE";
                document.getElementById("id_bouton_achats").style.backgroundColor="";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="";
                // Afficher la table correspondant aux ventes et masquer les autres
                document.getElementById("id_table_ventes").style.display = "block";
                document.getElementById("id_table_achats").style.display = "none";
                document.getElementById("id_table_tresorerie").style.display = "none";
            });
            $("#id_bouton_achats").click(function(e) {
                e.preventDefault();
                // Changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="";
                document.getElementById("id_bouton_achats").style.backgroundColor="#5A8DEE";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="";
                // Afficher la table correspondant aux achats et masquer les autres
                document.getElementById("id_table_ventes").style.display = "none";
                document.getElementById("id_table_achats").style.display = "block";
                document.getElementById("id_table_tresorerie").style.display = "none";
            });
            $("#id_bouton_tresorerie").click(function(e) {
                e.preventDefault();
                // Changer la couleur de fond du bouton
                document.getElementById("id_bouton_ventes").style.backgroundColor="";
                document.getElementById("id_bouton_achats").style.backgroundColor="";
                document.getElementById("id_bouton_tresorerie").style.backgroundColor="#5A8DEE";
                // Afficher la table correspondant à la trésorerie et masquer les autres
                document.getElementById("id_table_ventes").style.display = "none";
                document.getElementById("id_table_achats").style.display = "none";
                document.getElementById("id_table_tresorerie").style.display = "block";
            });

        });

    </script>

</body>
<!-- END: Body-->

</html>
