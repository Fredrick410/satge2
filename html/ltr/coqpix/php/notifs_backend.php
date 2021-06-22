<?php

	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
	$select_notif = $bdd->prepare("SELECT * FROM (SELECT id, name_entreprise, date_demande, statut_notif_back, 'attestation_fiscale' AS type_demande, id_session FROM attestation_fiscale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, 'attestation_sociale' AS type_demande, id_session FROM attestation_sociale WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, date_demande, statut_notif_back, 'bulletin_salaire' AS type_demande, id_session FROM bulletin_salaire WHERE statut_notif_back != ? UNION ALL SELECT id, name_entreprise, dte,statut_notif_back, 'bilan' AS type_demande, id_session FROM bilan WHERE statut_notif_back != ?) AS temp ORDER BY statut_notif_back DESC, STR_TO_DATE(date_demande, '%d/%m/%Y') DESC LIMIT 10");
	$select_notif->execute(array("Inactive", "Inactive", "Inactive", "Inactive"));

    $pdoSt= $bdd->query('SELECT COUNT(*) AS nb FROM (SELECT id FROM attestation_fiscale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM attestation_sociale WHERE statut_notif_back != "Inactive" UNION ALL SELECT id FROM bulletin_salaire WHERE statut_notif_back != "Inactive") AS temp');
    $nb_notif = $pdoSt->fetch();
    
?>

<li class="dropdown nav-item" data-menu="dropdown"><a class="dropdown-toggle nav-link" href="#"
        data-toggle="dropdown"><i class="menu-livicon" data-icon="bell"></i>
        <?php
                    if($nb_notif['nb']){
                        ?>
        <span style="margin-top: 2px; margin-right: 20px;"
            class="badge badge-pill badge-danger badge-up"><?= $nb_notif['nb'] ?></span>
        <!--NOTIFICATION-->
        <?php
                     }
                ?>
    </a>
    <ul class="dropdown-menu dropdown-menu-media dropdown-menu-right">
        <li class="dropdown-menu-header">
            <div class="dropdown-header px-1 py-75 d-flex justify-content-between"><span
                    class="notification-title"><?= $nb_notif['nb'] ?> Notifications</span></div>


            <?php              if ($nb_notif['nb']){
?>

        </li>
        <li class="scrollable-container media-list"><a class="d-flex justify-content-between" href="javascript:void(0)">
                <!-- CONTENUE ONE -->
            </a>

            <?php



	while ($result = $select_notif->fetch()) {

        

		// si c'est une demande d'attestation fiscale
		if ($result['type_demande'] === "attestation_fiscale") {

			$notif = "Vous avez une attestation fiscale de " .$result['name_entreprise']. " en attente de traitement";


            ?>
            <a href="attestation-fiscale-view.php?num=<?= $result['id_session'] ?>">
                <?php

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			$notif = "Vous avez une attestation sociale de " .$result['name_entreprise']. " en attente de traitement";

            ?>
                <a href="attestation-sociale-view.php?num=<?= $result['id_session'] ?>">
                    <?php

		// si c'est un bulletin de salaire
		} else {

			$notif = "Vous avez un bulletin de salaire de " .$result['name_entreprise']. " en attente de traitement";
            
            ?>
                    <a href="salaire-view.php?num=<?= $result['id_session'] ?>">
                        <?php

		}
        

        
		// affichage de la notification

        $pdoSt = $bdd->prepare('SELECT img_entreprise FROM entreprise WHERE id = :id');
        $pdoSt->bindValue(':id', $result['id_session']);
        $pdoSt->execute();
        $img_entreprise = $pdoSt->fetch();
               
        ?>

                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center border-0">
                                <div class="media-left pr-0">
                                    <div class="avatar mr-1 m-0"><img
                                            src="../../../src/img/<?= $img_entreprise['img_entreprise'] ?>" alt="avatar"
                                            height="39" width="39"></div>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading"><span class="text-bold-500"><?php echo $notif; ?></span>
                                    </h6><small class="notification-text"><?= $result['date_demande']; ?></small>
                                </div>
                            </div>
                        </div>
                    </a> <?php

	    

	}
?>
        </li>

        <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center"
                href="php/delete_notifs.php?delete=back"><span class="text-light">Tout marquer comme lu</span></a></li>

        <?php
        }
else {
?>
</li>
<li class="dropdown-menu-footer">
    <div class="dropdown-footer px-1 py-75 d-flex justify-content-center"><span class="notification-title">Aucune
            Notification</span></div>
</li>
<?php
}
?>
</ul>
</li>