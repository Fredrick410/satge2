

<?php
session_start();

if(!empty($_SESSION['id']) && (!empty($_SESSION['id_session'])))
{
   //l'utilisateur est connecté
}
else
{  
   sleep(2);
   header('Location: ../../../');
   exit;
}

if (!isset($authorised_roles)){
   //pas de contrainte de rôle définie
}
else
{  
   if (in_array($_SESSION['role'], $authorised_roles)){
      //le role est bien dans la liste des roles authorisés
   }
   else {
   sleep(2);
   header('Location: page-not-authorized.html');
   exit;
   }
}

?>

