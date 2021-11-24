<?php
    session_start();
    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);

    $link= htmlspecialchars($_GET['link']);

    if ($link === "one") {
        // Verification des valeurs GET non null
        if (!empty($_GET['file'])&&!empty($_GET['destination'])) {
            $filename = basename($_GET['file']);
            $dir = '../../../../src/fiscal/'.$_GET['destination'].'/';
            $filepath = $dir.$filename;
            // Verification de l'existance du fichier et de son chemin
            if (!empty($filename) && file_exists($filepath)) {
                echo "This file exist." ;
                
                // Téléchagement du fichier en PDF
                header("Cache-Control: public");
                header("Content-Description: File Transfer");
                header("Content-Disposition: attachment; filename=$filename");
                header("Content-Type: application/php");
                header("Content-Transfer-Emcoding: binary");
                ob_clean();
                flush();

                readfile($filepath);
                exit;
            }else{
                echo "This file not exist" ;
            }
        }
    }

    if ($link === "all") {
        $archive_file_name='Dossier.zip';
        $zip = new ZipArchive();

        if ($zip->open($archive_file_name, ZIPARCHIVE::CREATE )!==TRUE) {
            exit("cannot open <$archive_file_name>\n");
        }

        $pdoStat = $bdd->prepare('SELECT * FROM fiscal WHERE id = :num');
        $pdoStat->bindValue(':num',$_GET['num']);
        $pdoStat->execute();
        $societe = $pdoStat->fetch();
        
        // Insertion des fichiers dans le fichier ZIP
        function insertZip($doc,$phase,$type,$filezip){
            if($doc !== "" AND is_null($doc)==false ){
                $doc_dir = '../../../../src/fiscal/'.$phase.'/'.$type.'/'.$doc.'';
                if (file_exists($doc_dir)) {
                    $filezip->addFile($doc_dir,$doc);
                }
            }
        }
        /*    
            if($societe['doc_mandat'] !== "" AND is_null($societe['doc_mandat'])==false ){
                $doc_mandat = '../../../../src/fiscal/Phase1/mandat/'.$societe['doc_mandat'].'';
                if (file_exists($doc_mandat)) {
                    $zip->addFile($doc_mandat,$societe['doc_mandat']);
                }
            }
        */
        
        // Phase 1
        insertZip($societe['doc_mandat'],"Phase1","mandat",$zip);
        insertZip($societe['doc_cerfa27'],"Phase1","cerfa_27",$zip);        
        insertZip($societe['doc_cour'],"Phase1","courrier",$zip);        
        insertZip($societe['doc_fec'],"Phase1","fichier_FEC",$zip);        
        insertZip($societe['doc_rdv'],"Phase1","attestation_RDV",$zip);

        // Phase 2
        insertZip($societe['doc_mail'],"Phase2","mail",$zip);
        insertZip($societe['doc_noteV'],"Phase2","note_int",$zip);

        // Phase 3
        insertZip($societe['doc_cerfa24'],"Phase3","cerfa_24",$zip);
        insertZip($societe['doc_cerfa26'],"Phase3","cerfa_26",$zip);
        insertZip($societe['doc_contest'],"Phase3","courrier_contest",$zip);

        // Phase 4
        insertZip($societe['doc_saisine'],"Phase4","saisine",$zip);
        insertZip($societe['doc_noteI'],"Phase4","note_int",$zip);
        
        // Fermeture ZIP
        $zip->close();
        
        // Entête ZIP
        header("Content-type: application/zip"); 
        header("Content-Disposition: attachment; filename=$archive_file_name");
        header("Content-length: " . filesize($archive_file_name));
        header("Pragma: no-cache"); 
        header("Expires: 0");
        ob_clean();
        flush();
        
        readfile($archive_file_name);
        unlink($archive_file_name);
        exit;
    }
?>