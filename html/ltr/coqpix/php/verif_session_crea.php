

<?php

session_start();

if(!empty($_SESSION['id_crea']))
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

