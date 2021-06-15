<?php

	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
	$select_notif = $bdd->prepare('SELECT * FROM (SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_fiscale" AS type_demande FROM attestation_fiscale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_sociale" AS type_demande FROM attestation_sociale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "bulletin_salaire" AS type_demande FROM bulletin_salaire WHERE statut_notif_back != ?) AS temp ORDER BY statut_notif_back DESC, STR_TO_DATE(date_demande, '%d/%m/%Y') DESC LIMIT 10');
	$select_notif->execute(array("Inactive", "Inactive", "Inactive"));

	while ($result = $select_notif->fetch()) {

		// si c'est une demande d'attestation fiscale
		if ($result['type_demande'] === "attestation_fiscale") {

			if ($result['statut_notif_back'] === "Non lue") {
				?> <span class="text-danger"><?php echo "Vous avez une attestation fiscale de " .$result['name_entreprise']. " en attente de traitement" ."<br>"; ?></span> <?php
			}
			if ($result['statut_notif_back'] === "Lue") {
				echo "Vous avez une attestation fiscale de " .$result['name_entreprise']. " en attente de traitement" ."<br>";
			}

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			if ($result['statut_notif_back'] === "Non lue") {
				?> <span class="text-danger"><?php echo "Vous avez une attestation sociale de " .$result['name_entreprise']. " en attente de traitement" ."<br>"; ?></span> <?php
			}
			if ($result['statut_notif_back'] === "Lue") {
				echo "Vous avez une attestation sociale de " .$result['name_entreprise']. " en attente de traitement" ."<br>";
			}

		// si c'est un bon de commande
		} else {

			if ($result['statut_notif_back'] === "Non lue") {
				?> <span class="text-danger"><?php echo "Vous avez un bulletin de salaire de " .$result['name_entreprise']. " en attente de traitement" ."<br>"; ?></span> <?php
			}
			if ($result['statut_notif_back'] === "Lue") {
				echo "Vous avez un bulletin de salaire de " .$result['name_entreprise']. " en attente de traitement" ."<br>";
			}

		}

	}

?>