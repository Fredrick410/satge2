<?php
  require_once 'config.php';
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    session_start();
    
     

     if (isset($_POST['id']) and !empty($_POST['id'])) {
    $id_team = htmlspecialchars($_POST['id']);

    try {
                 $pdoSttt = $bdd->prepare('SELECT * FROM teams_membres WHERE team_num = :team_num  ');
                $pdoSttt->bindValue(':team_num', $id_team);
                $pdoSttt->execute();
                $team_membre = $pdoSttt->fetchAll();
           } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage(); 
            }
            $response_array['status'] = 'success';
            $response_array['team_membre'] = $team_membre;
            echo json_encode($response_array);

        }    
?>