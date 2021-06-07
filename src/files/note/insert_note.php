<?php 

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once '../../../html/ltr/coqpix/php/config.php';
session_start();

    $pdoSte = $bdd->prepare('SELECT doc_note, doc_note_2, doc_note_3, doc_note_4, doc_note_5 FROM membres WHERE nom = :num');
    $pdoSte->bindValue(':num',$_POST['nom']);
    $pdoSte->execute();
    $info = $pdoSte->fetch();

        $objt = $_POST['objet'];
        $dte = $_POST['dte'];
        $name = $_POST['nom'];

        $insert = $bdd->prepare('INSERT INTO note (objet, img_membres, name_membres, montant, dte, etiquette, doc_note, doc_note_2, doc_note_3, doc_note_4, doc_note_5, zip_name, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        htmlspecialchars($_POST['objet']),
        htmlspecialchars($_POST['img_membres']),
        htmlspecialchars($_POST['nom']),
        htmlspecialchars($_POST['montant']),
        htmlspecialchars($_POST['dte']),
        htmlspecialchars($_POST['etiquette']),
        htmlspecialchars($info['doc_note']),
        htmlspecialchars($info['doc_note_2']),
        htmlspecialchars($info['doc_note_3']),
        htmlspecialchars($info['doc_note_4']),
        htmlspecialchars($info['doc_note_5']),
        htmlspecialchars(''. $name .' - '. $objt .' - '. $dte .''),
        htmlspecialchars($_SESSION['id_session'])
    ));

        $za = new ZipArchive;
        $za->open(''. $name .' - '. $objt .' - '. $dte .'.zip',ZipArchive::CREATE|ZipArchive::OVERWRITE);
        $za->addFromString($info['doc_note'],'yes');
        $za->addFromString($info['doc_note_2'],'yes');
        $za->addFromString($info['doc_note_3'],'yes');
        $za->addFromString($info['doc_note_4'],'yes');
        $za->addFromString($info['doc_note_5'],'yes');
        $za->close();

        $pdo = $bdd->prepare('UPDATE membres SET  doc_note=:doc_note, doc_note_2=:doc_note_2, doc_note_3=:doc_note_3, doc_note_4=:doc_note_4, doc_note_5=:doc_note_5, nb_doc_note=:nb_doc_note  WHERE nom=:num LIMIT 1');
        $pdo->bindValue(':num', $_POST['nom']);
        $pdo->bindValue(':doc_note', "");
        $pdo->bindValue(':doc_note_2', "");
        $pdo->bindValue(':doc_note_3', "");
        $pdo->bindValue(':doc_note_4', "");
        $pdo->bindValue(':doc_note_5', "");
        $pdo->bindValue(':nb_doc_note', "0");
    
        $pdo->execute();

        $name_files = ''. $name .' - '. $objt .' - '. $dte .'.zip';
        $size_files = "";
        $dte_files = $dte;
        $dte_j = "";
        $dte_m = "";
        $dte_a = "";
        $inser = $bdd->prepare('INSERT INTO stockage (name_files, size_files, dte_files, dte_j, dte_m, dte_a, img_files, type_files_note, type_files_avoir, type_files_fac_achat, type_files_fac_ventes, type_files_caisse_ventes, banque, send_files, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $inser->execute(array(
        ($name_files),
        ($size_files),
        ($dte_files),
        ($dte_j),
        ($dte_m),
        ($dte_a),
        (".zip"),
        ("note"),
        (""),
        (""),
        (""),
        (""),
        (""),
        ("#03f322"),
        ($_SESSION['id_session'])
    ));

        

        header('Location: ../../../html/ltr/coqpix/app-note-list.php');
        exit();

?>