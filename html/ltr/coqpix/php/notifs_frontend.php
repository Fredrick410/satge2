<?php

	// requete qui trouve les 10 dernières notifications de la plus récente à la plus ancienne et en priorités les notifications non lues
    $select_notif = $bdd->prepare("SELECT id, date_donner, type_demande, id_session FROM notif_front WHERE id_session=:id_session ORDER BY STR_TO_DATE(date_donner, '%d/%m/%Y') DESC LIMIT 10;");
	$select_notif->bindValue(':id_session', $_SESSION['id_session']);
    $select_notif->execute();

    $pdoSt= $bdd->prepare('SELECT COUNT(*) AS nb FROM notif_front WHERE id_session=:id_session');
    $pdoSt->bindValue(':id_session', $_SESSION['id_session']);
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

			$notif = "Votre demande de attestation fiscale a été traitée";


            ?>
            <a href="attestation-fiscale.php">
                <?php

		// si c'est une demande d'attestation sociale
		} else if ($result['type_demande'] === "attestation_sociale"){

			$notif = "Votre demande de attestation sociale a été traitée";

            ?>
                <a href="attestation-social.php">
                    <?php

		// si c'est un bulletin de salaire
		} else if ($result['type_demande'] === "bulletin_salaire"){

			$notif = "Vous demande de bulletin de salaire a été traitée";
            
            ?>
                    <a href="bulletin-consulte.php">
                        <?php

        // si c'est un bilan
        
		}else if ($result['type_demande'] === "bilan"){

			$notif = "Votre demande de bilan a été traitée";
            
            ?>
            <a href="bilan.php?5PAx4zf27P=<?= substr($result['date_donner'],-4) ?>&S3q4EvFDk4QZ95b4v3gz">
            <?php 

		} else if ($result['type_demande'] === "teams_membres"){

			$notif = "Vous avez été ajouté à une équipe";
            
            ?>
                    <a href="teams-list.php">
                        <?php

        // si c'est un ajout de membre
        
		} else if ($result['type_demande'] === "taches demain"){

			$notif = "Vous avez des tâches pour demain";
            
            ?>
                    <a href="mission.php">
                        <?php

        // si ce sont des tâches pour demain
        
		} else if ($result['type_demande'] === "tache demain"){

        $notif = "Vous avez une tâche pour demain";
        
        ?>
                <a href="mission.php">
                    <?php

        // si c'est une tâche pour demain
        
        }  else if ($result['type_demande'] === "taches aujourd'hui"){

			$notif = "Vous avez des tâches pour aujourd'hui";
            
            ?>
                    <a href="mission.php">
                        <?php

        // si ce sont des tâches pour aujourd'hui
        
		} else if ($result['type_demande'] === "tache aujourd'hui"){

        $notif = "Vous avez une tâche pour aujourd'hui";
        
        ?>
                <a href="mission.php">
                    <?php

        // si c'est une tâche pour aujourd'hui
        
        } else if ($result['type_demande'] === "taches demarrent"){

			$notif = "Vous avez des tâches démarrées pendant votre absence";
            
            ?>
                    <a href="mission.php">
                        <?php

        // si ce sont des tâches démarrées pendant votre absence
        
		} else if ($result['type_demande'] === "tache demarre"){

            $notif = "Vous avez une tâche démarrée pendant votre absence";
        
        ?>
                <a href="mission.php">
                    <?php

        // si c'est une tâche démarrée pendant votre absence
        
        }
               
        ?>

                        <div class="d-flex justify-content-between cursor-pointer">
                            <div class="media d-flex align-items-center border-0">
                                <div class="media-left pr-0">
                                    <div class="avatar mr-1 m-0"><img
                                            src="../../../src/img/astro1.gif" alt="avatar"
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
