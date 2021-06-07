

<?php

session_start();

if((!empty($_SESSION['id_comptable'])) || (!empty($_SESSION['id_admin'])))
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

