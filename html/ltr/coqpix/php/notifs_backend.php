<?php
	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
	$select_notif = $bdd->prepare('SELECT * FROM (SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_fiscale" AS type_demande FROM attestation_fiscale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "attestation_sociale" AS type_demande FROM attestation_sociale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, "bulletin_salaire" AS type_demande FROM bulletin_salaire WHERE statut_notif_back != ?) AS temp ORDER BY statut_notif_back DESC, date_demande DESC LIMIT 10');
	$select_notif->execute(array("Inactive", "Inactive", "Inactive"));

    $pdoSt= $bdd->query('SELECT COUNT(*) AS nb FROM (SELECT id FROM attestation_fiscale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM attestation_sociale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM bulletin_salaire WHERE statut_notif_back != "Inactive") AS temp');
    $nb_notif = $pdoSt->fetch();
?>


            <li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#" data-toggle="dropdown"><i class="menu-livicon" data-icon="bell"></i>
                <?php
                    if($nb_notif['nb']){
                        ?>
                        <span style="margin-top: 2px; margin-right: 20px;" class="badge badge-pill badge-danger badge-up"><?= $nb_notif['nb'] ?></span>   <!--NOTIFICATION-->
                        <?php
                     }
                ?>
                </a>
                <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
                    <li class="dropdown-menu-header">
                            <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span class="notification-title"><?= $nb_notif['nb'] ?> Notifications</span></div>
-

<?php              if ($nb_notif['nb']){
?>

                    </li>
                    <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                                                            <!-- CONTENUE ONE -->
                        </a> 

<?php



	while ($result = $select_notif->fetch()) {

        //Récupération de l'id de l'entreprise
        $pdoSt = $bdd->prepare("SELECT id from entreprise WHERE nameentreprise = :name_entreprise");
        $pdoSt->bindValue(":name_entreprise", $result['name_entreprise']);
        $pdoSt->execute();
        $id_entreprise = $pdoSt->fetch();
        

		// si c'est une demande d'attestation fiscale
		if ($result['type_demande'] === "attestation_fiscale") {

			$notif = "Vous avez une attestation fiscale de " .$result['name_entreprise']. " en attente de traitement";


            ?>
            <a href="attestation-fiscale-view.php?num=<?= $id_entreprise['id'] ?>">
            <?php

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			$notif = "Vous avez une attestation sociale de " .$result['name_entreprise']. " en attente de traitement";

            ?>
            <a href="attestation-sociale-view.php?num=<?= $id_entreprise['id'] ?>">
            <?php

		// si c'est un bulletin de salaire
		} else {

			$notif = "Vous avez un bulletin de salaire de " .$result['name_entreprise']. " en attente de traitement";
            
            ?>
            <a href="salaire-view.php?num=<?= $id_entreprise['id'] ?>">
            <?php

		}
        

        
		// affichage de la notification

        ?>
            
	    	<div class="d-flex justify-content-between cursor-pointer">
	            <div class="media d-flex align-items-center border-0">
	                <div class="media-left pr-0">
	                        <div class="avatar mr-1 m-0"><img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="39" width="39"></div>
	                </div>
	                <div class="media-body">
	                        <h6 class="media-heading"><span class="text-bold-500"><?php echo $notif; ?></span></h6><small class="notification-text"><?= $result['date_demande']; ?></small>
	                </div>
	                <div class="col-auto">
	                        <div class="fonticon-wrap">
	                            <button type="button" class="btn btn-icon"><i class="bx bx-x-circle"></i></button>
	                        </div>
	                </div>
	            </div>
	        </div>
            </a> <?php

	    

	}
?>
                    </li>
                    <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center" href="javascript:void(0)">Tout marquer comme lu</a></li>
<?php
        }
else {
?>
    </li>
    <li class="dropdown-menu-footer">
                            <div class="dropdown-footer px-1 py-75 d-flex justify-content-center"><span class="notification-title">Aucune Notification</span></div>
                    </li>
<?php
}
?>
                </ul>
            </li>
