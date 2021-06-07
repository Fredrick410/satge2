

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


?>

