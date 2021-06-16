<?php
	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
	$select_notif = $bdd->prepare('SELECT * FROM (SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_fiscale" AS type_demande FROM attestation_fiscale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_sociale" AS type_demande FROM attestation_sociale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "bulletin_salaire" AS type_demande FROM bulletin_salaire WHERE statut_notif_back != ?) AS temp ORDER BY statut_notif_back DESC, date_demande DESC LIMIT 10');
	$select_notif->execute(array("Inactive", "Inactive", "Inactive"));

    $nb_notif_non_lue = $bdd->query('SELECT COUNT(*) AS nb FROM (SELECT id FROM attestation_fiscale WHERE statut_notif_back = "Non lue" UNION ALL SELECT id FROM attestation_sociale WHERE statut_notif_back = "Non lue" UNION ALL SELECT id FROM bulletin_salaire WHERE statut_notif_back = "Non lue") AS temp');
    $nb_notif = $bdd->query('SELECT COUNT(*) AS nb FROM (SELECT id FROM attestation_fiscale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM attestation_sociale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM bulletin_salaire WHERE statut_notif_back != "Inactive") AS temp');
?>


            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="bell"></i>
                <?php
                    if($nb_notif_non_lue){
                        ?>
                        <span style="margin-top: 2px; margin-right: 20px;" class="badge badge-pill badge-danger badge-up"><?php echo ($nb_notif_non_lue->fetch())['nb'] ?></span></a>   <!--NOTIFICATION-->
                        <?php
                     }
                ?>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                            <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title"><?php echo ($nb_notif->fetch())['nb'] ?> Notifications</span><span class="text-bold-400 cursor-pointer">Notification non lu</span></div>
                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                        </a>

<?php



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
                                <svg xmlns="http://www.w3.org/2000/svg" width="8" height="8" fill="red" class="bi bi-circle-fill mb-3" viewBox="0 0 8 8">
  <circle cx="4" cy="4" r="4"/>
</svg>
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

                    </li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
                </ul>
            </li>
