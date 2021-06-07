
<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    $pdoSta = $bdd->prepare('SELECT * FROM stockage_delete WHERE id = :num');
    $pdoSta->bindValue(':num',$_GET['id'], PDO::PARAM_INT);
    $pdoSta->execute();   
    $stockage_delete = $pdoSta->fetch();

    var_dump($stockage_delete);

    $name_files = $stockage_delete['name_files'];
    $size_files = $stockage_delete['size_files'];
    $dte_files = $stockage_delete['dte_files'];
    $dte_j = $stockage_delete['dte_j'];
    $dte_m = $stockage_delete['dte_m'];
    $dte_a = $stockage_delete['dte_a'];
    $img_files = $stockage_delete['img_files'];
    $type_files_note = $stockage_delete['type_files_note'];
    $type_files_avoir = $stockage_delete['type_files_avoir'];
    $type_files_fac_achat = $stockage_delete['type_files_fac_achat'];
    $type_files_fac_ventes = $stockage_delete['type_files_fac_ventes'];
    $type_files_caisse_ventes = $stockage_delete['type_files_caisse_ventes'];
    $banque = $stockage_delete['banque'];
    $send_files = $stockage_delete['send_files'];

    $insert = $bdd->prepare('INSERT INTO stockage (name_files, size_files, dte_files, dte_j, dte_m, dte_a, img_files, type_files_note, type_files_avoir, type_files_fac_achat, type_files_fac_ventes, type_files_caisse_ventes, banque, send_files, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
        $insert->execute(array(
        ($name_files),
        ($size_files),
        ($dte_files),
        ($dte_j),
        ($dte_m),
        ($dte_a),
        ($img_files),
        ($type_files_note),
        ($type_files_avoir),
        ($type_files_fac_achat),
        ($type_files_fac_ventes),
        ($type_files_caisse_ventes),
        ($banque),
        ($send_files),
        ($_SESSION['id_session'])
    ));

    $pdoDel = $bdd->prepare('DELETE FROM stockage_delete WHERE id=:num LIMIT 1');
    $pdoDel->bindValue(':num', $_GET['id']);
    $pdoDel->execute();

    header('Location: ../file-manager.php');
    exit();
?>