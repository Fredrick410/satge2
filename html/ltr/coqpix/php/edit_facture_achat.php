<?php

require_once 'config.php';    
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);




    if($_POST['cout_2'] == ""){
        $cout_2 = "0";
    }else{
        $cout_2 = $_POST['cout_2'];
    }if($_POST['cout_3'] == ""){
        $cout_3 = "0";
    }else{
        $cout_3 = $_POST['cout_3'];
    }if($_POST['cout_4'] == ""){
        $cout_4 = "0";
    }else{
        $cout_4 = $_POST['cout_4'];
    }if($_POST['cout_5'] == ""){
        $cout_5 = "0";
    }else{
        $cout_5 = $_POST['cout_5'];
    }if($_POST['cout_6'] == ""){
        $cout_6 = "0";
    }else{
        $cout_6 = $_POST['cout_6'];
    }if($_POST['cout_7'] == ""){
        $cout_7 = "0";
    }else{
        $cout_7 = $_POST['cout_7'];
    }if($_POST['cout_8'] == ""){
        $cout_8 = "0";
    }else{
        $cout_8 = $_POST['cout_8'];
    }if($_POST['cout_9'] == ""){
        $cout_9 = "0";
    }else{
        $cout_9 = $_POST['cout_9'];
    }if($_POST['cout_10'] == ""){
        $cout_10 = "0";
    }else{
        $cout_10 = $_POST['cout_10'];
    }

    if($_POST['quantite_2'] == ""){
        $quantite_2 = "0";
    }else{
        $quantite_2 = $_POST['quantite_2'];
    }if($_POST['quantite_3'] == ""){
        $quantite_3 = "0";
    }else{
        $quantite_3 = $_POST['quantite_3'];
    }if($_POST['quantite_4'] == ""){
        $quantite_4 = "0";
    }else{
        $quantite_4 = $_POST['quantite_4'];
    }if($_POST['quantite_5'] == ""){
        $quantite_5 = "0";
    }else{
        $quantite_5 = $_POST['quantite_5'];
    }if($_POST['quantite_6'] == ""){
        $quantite_6 = "0";
    }else{
        $quantite_6 = $_POST['quantite_6'];
    }if($_POST['quantite_7'] == ""){
        $quantite_7 = "0";
    }else{
        $quantite_7 = $_POST['quantite_7'];
    }if($_POST['quantite_8'] == ""){
        $quantite_8 = "0";
    }else{
        $quantite_8 = $_POST['quantite_8'];
    }if($_POST['quantite_9'] == ""){
        $quantite_9 = "0";
    }else{
        $quantite_9 = $_POST['quantite_9'];
    }if($_POST['quantite_10'] == ""){
        $quantite_10 = "0";
    }else{
        $quantite_10 = $_POST['quantite_10'];
    }

    if($_POST['status_facture'] == "NON PAYE"){
        $color  = "badge badge-light-danger badge-pill";
    }else{
        $color = "badge badge-light-success badge-pill";
    }

    $pdo = $bdd->prepare('UPDATE facture_achat SET numerosfacture=:numerosfacture, dte=:dte, dateecheance=:dateecheance, nomproduit=:nomproduit, facturepour=:facturepour, adresse=:adresse, email=:email, tel=:tel, departement=:departement, article=:article, referencearticle=:referencearticle, cout=:cout, quantite=:quantite, remise=:remise, tax1=:tax1, tax2=:tax2, article_2=:article_2, referencearticle_2=:referencearticle_2, cout_2=:cout_2, quantite_2=:quantite_2, remise_2=:remise_2, tax1_2=:tax1_2, tax2_2=:tax2_2, article_3=:article_3, referencearticle_3=:referencearticle_3, cout_3=:cout_3, quantite_3=:quantite_3, remise_3=:remise_3, tax1_3=:tax1_3, tax2_3=:tax2_3, article_4=:article_4, referencearticle_4=:referencearticle_4, cout_4=:cout_4, quantite_4=:quantite_4, remise_4=:remise_4, tax1_4=:tax1_4, tax2_4=:tax2_4,article_5=:article_5, referencearticle_5=:referencearticle_5, cout_5=:cout_5, quantite_5=:quantite_5, remise_5=:remise_5, tax1_5=:tax1_5, tax2_5=:tax2_5, article_6=:article_6, referencearticle_6=:referencearticle_6, cout_6=:cout_6, quantite_6=:quantite_6, remise_6=:remise_6, tax1_6=:tax1_6, tax2_6=:tax2_6,article_7=:article_7, referencearticle_7=:referencearticle_7, cout_7=:cout_7, quantite_7=:quantite_7, remise_7=:remise_7, tax1_7=:tax1_7, tax2_7=:tax2_7, article_8=:article_8, referencearticle_8=:referencearticle_8, cout_8=:cout_8, quantite_8=:quantite_8, remise_8=:remise_8, tax1_8=:tax1_8, tax2_8=:tax2_8, article_9=:article_9, referencearticle_9=:referencearticle_9, cout_9=:cout_9, quantite_9=:quantite_9, remise_9=:remise_9, tax1_9=:tax1_9, tax2_9=:tax2_9, article_10=:article_10, referencearticle_10=:referencearticle_10, cout_10=:cout_10, quantite_10=:quantite_10, remise_10=:remise_10, tax1_10=:tax1_10, tax2_10=:tax2_10, modalite=:modalite, monnaie=:monnaie, note=:note, status_facture=:status_facture, status_color=:status_color, etiquette=:etiquette WHERE id=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_POST['numfacture']);
    $pdo->bindValue(':numerosfacture', $_POST['numerosfacture']);
    $pdo->bindValue(':dte', $_POST['dte']);
    $pdo->bindValue(':dateecheance', $_POST['dateecheance']);
    $pdo->bindValue(':nomproduit', $_POST['nomproduit']);
    $pdo->bindValue(':facturepour', $_POST['facturepour']);
    $pdo->bindValue(':adresse', $_POST['adresse']);
    $pdo->bindValue(':email', $_POST['email']);
    $pdo->bindValue(':tel', $_POST['tel']);
    $pdo->bindValue(':departement', $_POST['departement']);
    $pdo->bindValue(':article', $_POST['article']);
    $pdo->bindValue(':referencearticle', $_POST['referencearticle']);
    $pdo->bindValue(':cout', $_POST['cout']);
    $pdo->bindValue(':quantite', $_POST['quantite']);
    $pdo->bindValue(':remise', $_POST['remise']);
    $pdo->bindValue(':tax1', $_POST['tax1']);
    $pdo->bindValue(':tax2', $_POST['tax2']);
    $pdo->bindValue(':article_2', $_POST['article_2']);
    $pdo->bindValue(':referencearticle_2', $_POST['referencearticle_2']);
    $pdo->bindValue(':cout_2', $cout_2);
    $pdo->bindValue(':quantite_2', $quantite_2);
    $pdo->bindValue(':remise_2', $_POST['remise_2']);
    $pdo->bindValue(':tax1_2', $_POST['tax1_2']);
    $pdo->bindValue(':tax2_2', $_POST['tax2_2']);
    $pdo->bindValue(':article_3', $_POST['article_3']);
    $pdo->bindValue(':referencearticle_3', $_POST['referencearticle_3']);
    $pdo->bindValue(':cout_3', $cout_3);
    $pdo->bindValue(':quantite_3', $quantite_3);
    $pdo->bindValue(':remise_3', $_POST['remise_3']);
    $pdo->bindValue(':tax1_3', $_POST['tax1_3']);
    $pdo->bindValue(':tax2_3', $_POST['tax2_3']);
    $pdo->bindValue(':article_4', $_POST['article_4']);
    $pdo->bindValue(':referencearticle_4', $_POST['referencearticle_4']);
    $pdo->bindValue(':cout_4', $cout_4);
    $pdo->bindValue(':quantite_4', $quantite_4);
    $pdo->bindValue(':remise_4', $_POST['remise_4']);
    $pdo->bindValue(':tax1_4', $_POST['tax1_4']);
    $pdo->bindValue(':tax2_4', $_POST['tax2_4']);
    $pdo->bindValue(':article_5', $_POST['article_5']);
    $pdo->bindValue(':referencearticle_5', $_POST['referencearticle_5']);
    $pdo->bindValue(':cout_5', $cout_5);
    $pdo->bindValue(':quantite_5', $quantite_5);
    $pdo->bindValue(':remise_5', $_POST['remise_5']);
    $pdo->bindValue(':tax1_5', $_POST['tax1_5']);
    $pdo->bindValue(':tax2_5', $_POST['tax2_5']);
    $pdo->bindValue(':article_6', $_POST['article_6']);
    $pdo->bindValue(':referencearticle_6', $_POST['referencearticle_6']);
    $pdo->bindValue(':cout_6', $cout_6);
    $pdo->bindValue(':quantite_6', $quantite_6);
    $pdo->bindValue(':remise_6', $_POST['remise_6']);
    $pdo->bindValue(':tax1_6', $_POST['tax1_6']);
    $pdo->bindValue(':tax2_6', $_POST['tax2_6']);
    $pdo->bindValue(':article_7', $_POST['article_7']);
    $pdo->bindValue(':referencearticle_7', $_POST['referencearticle_7']);
    $pdo->bindValue(':cout_7', $cout_7);
    $pdo->bindValue(':quantite_7', $quantite_7);
    $pdo->bindValue(':remise_7', $_POST['remise_7']);
    $pdo->bindValue(':tax1_7', $_POST['tax1_7']);
    $pdo->bindValue(':tax2_7', $_POST['tax2_7']);
    $pdo->bindValue(':article_8', $_POST['article_8']);
    $pdo->bindValue(':referencearticle_8', $_POST['referencearticle_8']);
    $pdo->bindValue(':cout_8', $cout_8);
    $pdo->bindValue(':quantite_8', $quantite_8);
    $pdo->bindValue(':remise_8', $_POST['remise_8']);
    $pdo->bindValue(':tax1_8', $_POST['tax1_8']);
    $pdo->bindValue(':tax2_8', $_POST['tax2_8']);
    $pdo->bindValue(':article_9', $_POST['article_9']);
    $pdo->bindValue(':referencearticle_9', $_POST['referencearticle_9']);
    $pdo->bindValue(':cout_9', $cout_9);
    $pdo->bindValue(':quantite_9', $quantite_9);
    $pdo->bindValue(':remise_9', $_POST['remise_9']);
    $pdo->bindValue(':tax1_9', $_POST['tax1_9']);
    $pdo->bindValue(':tax2_9', $_POST['tax2_9']);
    $pdo->bindValue(':article_10', $_POST['article_10']);
    $pdo->bindValue(':referencearticle_10', $_POST['referencearticle_10']);
    $pdo->bindValue(':cout_10', $cout_10);
    $pdo->bindValue(':quantite_10', $quantite_10);
    $pdo->bindValue(':remise_10', $_POST['remise_10']);
    $pdo->bindValue(':tax1_10', $_POST['tax1_10']);
    $pdo->bindValue(':tax2_10', $_POST['tax2_10']);
    $pdo->bindValue(':modalite', $_POST['modalite']);
    $pdo->bindValue(':monnaie', $_POST['monnaie']);
    $pdo->bindValue(':note', $_POST['note']);
    $pdo->bindValue(':status_facture', $_POST['status_facture']);
    $pdo->bindValue(':status_color', $color);
    $pdo->bindValue(':etiquette', $_POST['etiquette']);
    
    $vrai = $pdo->execute();
    


    session_start();

    $pdoS = $bdd->prepare('SELECT * FROM calculs WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $calculs = $pdoS->fetchAll();


    $cal_cout_1 = ($_POST['cal_cout']) * ($_POST['cal_quantite']);
    $cal_cout_2 = ($_POST['cal_cout_2']) * ($_POST['cal_quantite_2']);
    $cal_cout_3 = ($_POST['cal_cout_3']) * ($_POST['cal_quantite_3']);
    $cal_cout_4 = ($_POST['cal_cout_4']) * ($_POST['cal_quantite_4']);
    $cal_cout_5 = ($_POST['cal_cout_5']) * ($_POST['cal_quantite_5']);
    $cal_cout_6 = ($_POST['cal_cout_6']) * ($_POST['cal_quantite_6']);
    $cal_cout_7 = ($_POST['cal_cout_7']) * ($_POST['cal_quantite_7']);
    $cal_cout_8 = ($_POST['cal_cout_8']) * ($_POST['cal_quantite_8']);
    $cal_cout_9 = ($_POST['cal_cout_9']) * ($_POST['cal_quantite_9']);
    $cal_cout_10 = ($_POST['cal_cout_10']) * ($_POST['cal_quantite_10']);

    $cal_cout_all = $cal_cout_1 + $cal_cout_2 + $cal_cout_3 + $cal_cout_4 + $cal_cout_5 + $cal_cout_6 + $cal_cout_7 + $cal_cout_8 + $cal_cout_9 + $cal_cout_10;


    $cout_1 = ($_POST['cout']) * ($_POST['quantite']);
    $cout_2 = ($cout_2) * ($quantite_2);
    $cout_3 = ($cout_3) * ($quantite_3);
    $cout_4 = ($cout_4) * ($quantite_4);
    $cout_5 = ($cout_5) * ($quantite_5);
    $cout_6 = ($cout_6) * ($quantite_6);
    $cout_7 = ($cout_7) * ($quantite_7);
    $cout_8 = ($cout_8) * ($quantite_8);
    $cout_9 = ($cout_9) * ($quantite_9);
    $cout_10 = ($cout_10) * ($quantite_10);

    $cout_all = $cout_1 + $cout_2 + $cout_3 + $cout_4 + $cout_5 + $cout_6 + $cout_7 + $cout_8 + $cout_9 + $cout_10;   
    
    $all = $cal_cout_all - $cout_all;

    foreach($calculs as $calculss):

    $facture_all = $calculss['facture_all'];
    $facture_all_achat = $calculss['facture_all_achat'] - $all;
    $devis_all = $calculss['devis_all'];
    $lastdte = $calculss['lastdte'];

    endforeach;

    $pdo = $bdd->prepare('UPDATE calculs SET facture_all=:facture_all, facture_all_achat=:facture_all_achat, devis_all=:devis_all, lastdte=:lastdte WHERE id_session=:num LIMIT 1');
    
    $pdo->bindValue(':num', $_SESSION['id_session']);
    $pdo->bindValue(':facture_all', $facture_all);
    $pdo->bindValue(':facture_all_achat', $facture_all_achat);
    $pdo->bindValue(':devis_all', $devis_all);
    $pdo->bindValue(':lastdte', $lastdte);
    $pdo->execute();
        
        sleep(2);
        header('Location: ../app-invoice-achat-list.php');
        
    

?>
