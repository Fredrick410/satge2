<?php

	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
    $select_notif = $bdd->prepare("SELECT * FROM (SELECT id, name_entreprise, date_donner, statut_notif_front, 'attestation_fiscale' AS type_demande, id_session FROM attestation_fiscale WHERE statut_notif_front != :statut UNION ALL SELECT id, name_entreprise, date_donner, statut_notif_front, 'attestation_sociale' AS type_demande, id_session FROM attestation_sociale WHERE statut_notif_front != :statut UNION ALL SELECT id, name_entreprise, date_donner, statut_notif_front, 'bulletin_salaire' AS type_demande, id_session FROM bulletin_salaire WHERE statut_notif_front != :statut UNION ALL SELECT id, name_entreprise, dte, statut_notif_front, 'bilan' AS type_demande, id_session FROM bilan WHERE statut_notif_front != :statut) AS temp WHERE id_session = :num ORDER BY STR_TO_DATE(date_donner, '%d/%m/%Y') DESC LIMIT 10");
    $select_notif->bindValue(':statut', 'Inactive');
    $select_notif->bindValue(':num', $_SESSION['id_session']);
    $select_notif->execute();

    $pdoSt= $bdd->prepare('SELECT COUNT(*) AS nb FROM (SELECT id FROM attestation_fiscale WHERE statut_notif_front != :statut AND id_session = :num UNION ALL SELECT id FROM attestation_sociale WHERE statut_notif_front != :statut AND id_session = :num UNION ALL SELECT id FROM bulletin_salaire WHERE statut_notif_front != :statut AND id_session = :num UNION ALL SELECT id FROM bilan WHERE statut_notif_front != :statut AND id_session = :num) AS temp');
    $pdoSt->bindValue(':statut', 'Inactive');
    $pdoSt->bindValue(':num', $_SESSION['id_session']);
    $pdoSt->execute();
    $nb_notif = $pdoSt->fetch();

?>

<li class="dropdown dropdown-notification nav-item"><a class="nav-link nav-link-label" href="#" data-toggle="dropdown"><i class="ficon bx bx-bell bx-tada bx-flip-horizontal"></i><span class="badge badge-pill badge-danger badge-up"></span></a>
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

			$notif = "Votre attestation fiscale a été traité";


            ?>
            <a href="attestation-fiscale.php">
                <?php

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			$notif = "Votre attestation sociale a été traité";

            ?>
                <a href="attestation-social.php">
                    <?php

		// si c'est un bulletin de salaire
		} else if ($result['type_demande'] === "bulletin_salaire"){

			$notif = "Vous bulletin de salaire a été traité";
            
            ?>
                    <a href="bulletin-consulte.php">
                        <?php

        // si c'est un bilan
        
		}else {

			$notif = "Votre bilan a été traité";
            
            ?>
            <a href="bilan.php?5PAx4zf27P=<?= $result['dte'] ?>&S3q4EvFDk4QZ95b4v3gz">
            <?php 

		}
               
        ?>

                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center border-0">
                                <div class="media-left pr-0">
                                    <div class="avatar mr-1 m-0"><img
                                            src="../../../src/img/astro1" alt="avatar"
                                            height="39" width="39"></div>
                                </div>
                                <div class="media-body">
                                    <h6 class="media-heading"><span class="text-bold-500"><?php echo $notif; ?></span>
                                    </h6><small class="notification-text"><?= $result['date_donner']; ?></small>
                                </div>
                            </div>
                        </div>
                    </a> <?php



	}
?>
        </li>

        <li class="dropdown-menu-footer"><a class="dropdown-item p-50 text-primary justify-content-center"
                href="php/delete_notifs.php?delete=front"><span class="text-light">Tout marquer comme lu</span></a></li>

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