
<?php
    
session_start();
require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    if($_GET['page'] == "task"){
        $pdoSta = $bdd->prepare('SELECT * FROM task WHERE id = :num');
        $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
        $pdoSta->execute();   
        $task = $pdoSta->fetch();
    }
    if($_GET['page'] == "del"){
        $pdoSta = $bdd->prepare('SELECT * FROM task_delete WHERE id = :num');
        $pdoSta->bindValue(':num',$_GET['num'], PDO::PARAM_INT);
        $pdoSta->execute();   
        $task = $pdoSta->fetch();
    }

    $status_task = $task['status_task'];
    $id_session = $_SESSION['id_session'];

    if($status_task == "encour"){ 

        $update = $bdd->prepare('UPDATE task SET status_task = ? WHERE id = ?');
        $update->execute(array(
            htmlspecialchars("terminée"),
            htmlspecialchars($_GET['num'])
        ));
        
    header('Location: ../task-done.php');
    exit();

    }else{

        if($status_task == "terminée"){
        
        $update = $bdd->prepare('UPDATE task SET status_task = ? WHERE id = ?');
        $update->execute(array(
            htmlspecialchars("encour"),
            htmlspecialchars($_GET['num'])
        ));

    header('Location: ../task-encour.php');
    exit();

    }   
}

?>