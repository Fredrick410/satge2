<?php

    require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();

    $par = $_POST['par'];
    $date_jm = date("d/m");
    $date_h = date("H") + 1;
    $date_min = date("i");
    $date_hmin = ''.$date_h.':'.$date_min.'';
    $content = $_POST['content'];
    $task_num = $_GET['num'];
    $date_com = date(DATE_RFC2822);

    $insert = $bdd->prepare('INSERT INTO task_commentaire (par, date_jm, date_hmin, content, task_num, id_session) VALUES(?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($par),
        htmlspecialchars($date_jm),
        htmlspecialchars($date_hmin),
        htmlspecialchars($content),
        htmlspecialchars($task_num),
        htmlspecialchars($_SESSION['id_session'])
    ));

    $pdo = $bdd->prepare('UPDATE task SET lastcommentaire_task=:lastcommentaire_task WHERE id=:num LIMIT 1');
    $pdo->bindValue(':num', $_GET['num']);
    $pdo->bindValue(':lastcommentaire_task', $date_com);    
    $pdo->execute();

    $par2 = $_POST['par'];
    $type_task = "commentaire";
    $date_j = date("d");
    $date_m = date("m");
    $date_a = date("Y");
    $img_profile = "";
    $task_num = $_GET['num'];

    $insert = $bdd->prepare('INSERT INTO task_recent (par, type_task, date_j, date_m, date_a, date_h, date_min, img_profile, task_num, id_session) VALUES(?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($par2),
        htmlspecialchars($type_task),
        htmlspecialchars($date_j),
        htmlspecialchars($date_m),
        htmlspecialchars($date_a),
        htmlspecialchars($date_h),
        htmlspecialchars($date_min),
        htmlspecialchars($img_profile),
        htmlspecialchars($task_num),
        htmlspecialchars($_SESSION['id_session'])
    ));

    header('Location: ../task-view.php?num='.$_GET['num'].'');
    exit();
    
?>