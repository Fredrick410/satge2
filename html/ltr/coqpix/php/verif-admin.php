<?php 

require_once 'config.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

// On vérifie que le formulaire à été complété et si les champs ne sont pas vides

 //On met le résultat pseudo du formulaire dans $pseudo
 $pseudo = htmlspecialchars($_GET["emailentreprise"]) ;
 $pass = htmlspecialchars($_GET["passwordentreprise"]) ;
 
 //On sélectionne dans la table 'utilisateurs' les pseudo qui sont les mêmes que le pseudo tapé dans le formulaire
 $query = $bdd->prepare("SELECT * FROM admin WHERE emailentreprise = :pseudo AND passwordentreprise = :pass"); 
 $query->bindValue(':pseudo', $pseudo);
 $query->bindValue(':pass',$pass);
 $query->execute();
 
 //On compte le nombre de réponse
 $count = $query->rowCount();
 
 //Dans le cas où il y a une réponse, qu'un pseudo dans la table correspont au pseudo tapé
 if($count == 1) 
 { 

        $selectid = $bdd->prepare("SELECT id, role FROM admin WHERE emailentreprise =:pseudo");
        $selectid->bindValue(':pseudo', $pseudo);
        $selectid->execute();
        $viewid = $selectid->fetch();

        session_start();
        $_SESSION['email'] = $pseudo;
        $_SESSION['id_admin'] = $viewid['id'];
        $_SESSION['id_session_admin'] = $viewid['id'];
        $_SESSION['id_comptable'] = $viewid['id'];
        $_SESSION['role']=$viewid['role'];

        header('Location: ../dashboard-admin.php');
        die();

 }else{ 

      header('Location: ../backend/auth-login-admin.html');
      exit;
 } 

?>