<?php

	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
	$select_notif = $bdd->prepare('SELECT * FROM (SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_fiscale" AS type_demande FROM attestation_fiscale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_sociale" AS type_demande FROM attestation_sociale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "bulletin_salaire" AS type_demande FROM bulletin_salaire WHERE statut_notif_back != ?) AS temp ORDER BY statut_notif_back DESC, date_demande DESC LIMIT 10');
	$select_notif->execute(array("Inactive", "Inactive", "Inactive"));

	while ($result = $select_notif->fetch()) {

		// si c'est une demande d'attestation fiscale
		if ($result['type_demande'] === "attestation_fiscale") {

			$notif = "Vous avez une attestation fiscale de " .$result['name_entreprise']. " en attente de traitement";

			if ($result['statut_notif_back'] === "Non lue") {
				$nonLue = true;
			}
			if ($result['statut_notif_back'] === "Lue") {
				$nonLue = false;
			}

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			$notif = "Vous avez une attestation sociale de " .$result['name_entreprise']. " en attente de traitement";

			if ($result['statut_notif_back'] === "Non lue") {
				$nonLue = true;
			}
			if ($result['statut_notif_back'] === "Lue") {
				$nonLue = false;
			}

		// si c'est un bon de commande
		} else {

			$notif = "Vous avez un bulletin de salaire de " .$result['name_entreprise']. " en attente de traitement";

			if ($result['statut_notif_back'] === "Non lue") {
				$nonLue = true;
			}
			if ($result['statut_notif_back'] === "Lue") {
				$nonLue = false;
			}

		}

		// affichage de la notification non Lue
		if ($nonLue) { ?>

			<div class="d-flex justify-content-between cursor-pointer">
	            <div class="media d-flex align-items-center border-0">
	                <div class="media-left pr-0">
	                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
	                </div>
	                <div class="media-body">
	                        <h6 class="media-heading"><span class="text-bold-500"><?php echo $notif; ?></span></h6><small class="notification-text"><?php echo $result['date_demande']; ?></small>
	                </div>
	                <div class="col-auto">
	                        <div class="fonticon-wrap">
	                            <button type="button" class="btn btn-icon"><i class="bx bx-x-circle"></i></button>
	                        </div>
	                </div>
	            </div>
	        </div> <?php

	    // affichage de la notification Lue
	    } else { ?>

	    	<div class="d-flex justify-content-between cursor-pointer">
	            <div class="media d-flex align-items-center border-0">
	                <div class="media-left pr-0">
	                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
	                </div>
	                <div class="media-body">
	                        <h6 class="media-heading"><span class="text-bold-500"><?php echo $notif; ?></span></h6><small class="notification-text"><?php echo $result['date_demande']; ?></small>
	                </div>
	                <div class="col-auto">
	                        <div class="fonticon-wrap">
	                            <button type="button" class="btn btn-icon"><i class="bx bx-x-circle"></i></button>
	                        </div>
	                </div>
	            </div>
	        </div> <?php

	    }

	}

?>