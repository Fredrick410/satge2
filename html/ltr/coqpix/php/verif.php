<?php 

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// On vérifie que le formulaire à été complété et si les champs ne sont pas vides

 //On met le résultat pseudo du formulaire dans $pseudo
 $pseudo = htmlspecialchars($_GET["emailentreprise"]) ;
 $pass = htmlspecialchars($_GET["passwordentreprise"]) ;
 $pass_hash = crypt($_GET['passwordentreprise'], '5c725a26307c3b5170634a7e2b');

 //On sélectionne dans la table 'utilisateurs' les pseudo qui sont les mêmes que le pseudo tapé dans le formulaire
 $query = $bdd->prepare("SELECT * FROM entreprise WHERE emailentreprise = :pseudo AND passwordentreprise = :pass"); 
 $query->bindValue(':pseudo', $pseudo);
 $query->bindValue(':pass',$pass);
 $query->execute();
 
 //On compte le nombre de réponse
 $count = $query->rowCount();
 
 //Dans le cas où il y a une réponse, qu'un pseudo dans la table correspont au pseudo tapé
 if($count == 1) 
 {
  
      $pdopass = $bdd->prepare("SELECT new_user FROM entreprise WHERE emailentreprise =:pseudo");
      $pdopass->bindValue(':pseudo', $pseudo);
      $pdopass->execute();
      $verife = $pdopass->fetch();

      $non = "Activé";
      $oui = "Désactivé";
      $video = "New";
      $ban = "Bloqué"; 
      $block = "Supprimé";

      if($verife['new_user'] == $video){
        

        $selectid = $bdd->prepare("SELECT id FROM entreprise WHERE emailentreprise =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();


        session_start();
        $_SESSION['email'] = $pseudo;
        $_SESSION['id'] = $viewid['id'];
        $_SESSION['id_session'] = $_SESSION['id'];

        header('Location: ../../../../video/video.php');
        die();

      }
      
      if($verife['new_user'] == $oui){
        

        $selectid = $bdd->prepare("SELECT id FROM entreprise WHERE emailentreprise =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();


        session_start();
        $_SESSION['email'] = $pseudo;
        $_SESSION['id'] = $viewid['id'];
        $_SESSION['id_session'] = $_SESSION['id'];

        header('Location:../auth-update-first.php');
        die();

      }
      
      if($verife['new_user'] == $non){

        $selectid = $bdd->prepare("SELECT id FROM entreprise WHERE emailentreprise =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();

        session_start();
        $_SESSION['id'] = $viewid['id'];
        $_SESSION['id_session'] = $_SESSION['id'];
        
        sleep(2);
        header('Location:../dashboard-analytics.php');
        die();

      }

      if($verife['new_user'] == $block){

        header('Location:../page-not-authorized.html');
        die();

      }

      if($verife['new_user'] == $ban){

        header('Location:../page-not-authorized.html');
        die();

      } 
 }else{

      $query_c = $bdd->prepare("SELECT * FROM comptable WHERE email = :pseudo AND password_comptable = :pass");
      $query_c->bindValue(':pseudo', $pseudo);
      $query_c->bindValue(':pass',$pass);
      $query_c->execute();
      $count_c = $query_c->rowCount();

      if($count_c == "1"){

        $non = "Activé";
        $oui = "Désactivé";
        $video = "New";
        $ban = "Bloqué"; 
        $block = "Supprimé";

        $pdopass = $bdd->prepare("SELECT new_user FROM comptable WHERE email =:pseudo");
        $pdopass->bindValue(':pseudo', $pseudo);
        $pdopass->execute();
        $verife_c = $pdopass->fetch();


        if($verife_c['new_user'] == $video){
        

        $selectid = $bdd->prepare("SELECT id FROM comptable WHERE email =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();


        session_start();
        $_SESSION['id_comptable'] = $viewid['id'];

        sleep(2);
        header('Location: ../../../../video/video_c.php');

        }

        if($verife_c['new_user'] == $non){
        

        $selectid = $bdd->prepare("SELECT id FROM comptable WHERE email =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();


        session_start();
        $_SESSION['id_comptable'] = $viewid['id'];

        sleep(2);
        header('Location: ../cloudpix.php');

        }

        
      }else{

        $query_crea = $bdd->prepare("SELECT * FROM crea_societe WHERE email_crea = :pseudo AND password_crea = :pass_hash");
        $query_crea->bindValue(':pseudo', $pseudo);
        $query_crea->bindValue(':pass_hash',$pass_hash);
        $query_crea->execute();
        $count_crea = $query_crea->rowCount();

        if($count_crea == "1"){

          $selectid = $bdd->prepare("SELECT id FROM crea_societe WHERE email_crea =:pseudo");
          $selectid->bindValue(':pseudo', $pseudo);
          $selectid->execute();
          $viewid = $selectid->fetch();

          session_start();
          $_SESSION['id_crea'] = $viewid['id'];

          sleep(2);
          header('Location: ../page-creation.php');

        }else{
          header('Location: ../../../../');
          exit();
        }  
      }
      
      
 }
?>