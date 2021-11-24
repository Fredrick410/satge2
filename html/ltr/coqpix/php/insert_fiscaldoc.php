<?php

    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    require_once 'config.php';

    $num = $_GET['num'];
    $etape= $_GET['etape'];
    $type = $_GET['type'];

    // Verifié si le fichier a été télécharger
    if (is_uploaded_file($_FILES['doc_files']['tmp_name'])) {
        echo "File ". $_FILES['doc_files']['name'] ." téléchargé avec succès.\n";
        $dir = '../../../../src/fiscal/'.$etape.'/';

        // Vérification du repertoire de destination
        if(!is_dir($dir)){
            echo " Le répertoire de destination n'existe pas !";
            echo " $dir";
            exit;
        }

        // Fichier temp
        $name_files = $_FILES['doc_files']['name'];                         
        $date_now = '-'.date("H-i-s");
        $type_files = "." . strtolower(substr(strrchr($name_files, '.'), 1));
        $target_file = $_FILES['doc_files']['tmp_name'];                                     
        $real_name = substr($name_files, 0, -4);
        $file_name = $dir. $real_name . $date_now . $type_files; 

        // Verification si le fichier téléchargé a été déplacer
        if($resultat = move_uploaded_file($target_file, $file_name)){
            // Requête pour la vérification de doublon
            $pdoDel = $bdd->prepare('SELECT * FROM fiscal WHERE id = :num');
            $pdoDel->bindValue(':num',$_GET['num']);
            $pdoDel->execute();
            $delfile = $pdoDel->fetch();
    
            // Vérification d'un fichier doublon existant (si vrai, on supprime le fichier doublon)
            if (isset($delfile['doc_'.$type.''])) {
                $dirDel = '../../../../src/fiscal/'.$etape.'/'.$delfile['doc_'.$type.''].'';
                if (file_exists($dirDel)) {
                    unlink($dirDel);
                }
            }
            
            //Mise à jour de la table fiscal
            $update = $bdd->prepare('UPDATE fiscal SET doc_'.$type.' = ? WHERE id = ?');
            $update->execute(array( ($real_name . $date_now . $type_files), $num ));

            //Notification Ajout de fichier
            $select = $bdd->prepare('SELECT name_entreprise FROM fiscal WHERE id=:id LIMIT 1');
            $select->bindValue(':id',$num);
            $select->execute();
            $result=$select->fetch(PDO::FETCH_ASSOC);

            $notif = $bdd->prepare('INSERT INTO notif_back (name_entreprise, date_demande, type_demande, id_session) VALUES(?,?,?,?)');
            $notif->execute(array(
                htmlspecialchars($result['name_entreprise']),
                htmlspecialchars(date('Y-m-d')),
                htmlspecialchars("ajout_doc_fiscal"),
                htmlspecialchars($num)
            ));

            // retour sur la vue
            header('Location: ../control-fiscal-view.php?num='.$num.'');
            exit();
        }else{
            echo "Erreur lors de l'upload de fichier !"; 
            exit;
        }
    
    }else{
        echo "Erreur lors de l'upload du fichier : ";
        echo "Nom du fichier : '". $_FILES['doc_files']['tmp_name'] . "'.";
    }



?>