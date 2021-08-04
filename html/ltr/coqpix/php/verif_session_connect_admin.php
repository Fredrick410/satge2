

<?php

session_start();

if(!empty($_SESSION['id_admin']))
{
   //l'utilisateur est connecté
}
else
{  
   sleep(2);
   header('Location: backend/auth-login-admin.html');
   exit;
}

if (!isset($authorised_roles)){
   //pas de contrainte de rôle définie
}
else
{  if (substr($_SESSION['role'],0,1) == '1' && in_array("comptable", $authorised_roles)){
      //le comptable a accès à cette page
   }  
   elseif (substr($_SESSION['role'],1,2) == '1' && in_array("juriste", $authorised_roles)){
      //le comptable a accès à cette page
   }  
   elseif (substr($_SESSION['role'],2,3) == '1' && in_array("gestionnaire social", $authorised_roles)){
      //le comptable a accès à cette page
   }  
   elseif (substr($_SESSION['role'],3,4) == '1' && in_array("gestionnaire fiscal", $authorised_roles)){
      //le comptable a accès à cette page
   }  
   else {
   sleep(2);
   header('Location: page-not-authorized.html');
   exit;
   }
}


?>

