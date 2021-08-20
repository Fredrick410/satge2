<?php
session_start();

//connexion à la bdd
require_once 'config.php';

//récupération PROPRE des variables AVANT de les utiliser
$numArr = !empty($_POST["numeros"]) ? json_decode($_POST["numeros"]) : NULL; //PAS DE json_decode parce qu'il n'est pas dans la boucle
$prestArr = !empty($_POST["prestation"]) ? json_decode($_POST["prestation"]) : NULL;
$refArr = !empty($_POST["referencepresta"]) ? json_decode($_POST["referencepresta"]): NULL;
$coutArr = !empty($_POST["cout"]) ? json_decode($_POST["cout"]): NULL;
$tvaArr = !empty($_POST["tva"]) ? json_decode($_POST["tva"]): NULL;
$remiseArr = !empty($_POST["remise"]) ?json_decode($_POST["remise"]): NULL;
$quantArr = !empty($_POST["quantite"]) ? json_decode($_POST["quantite"]): NULL;
$umesureArr = !empty($_POST["umesure"]) ? json_decode($_POST["umesure"]): NULL;
$typ = "facturevente";
$id_session = !empty($_SESSION['id_session']) ? $_SESSION['id_session'] : NULL ; //$_SESSION
$titreArr = !empty($_POST["numero_titre"]) ? json_decode($_POST["numero_titre"]) : NULL;

$sql = "INSERT INTO prestations
        (prestation, referencepresta, cout, quantite, umesure, tva, remise, numeros, typ, id_session, numero_titre) 
        VALUES (?,?,?,?,?,?,?,?,?,?,?)";

if(!empty($prestArr)){
  for ($i = 0; $i < count($prestArr); $i++) {

    if((!empty($prestArr[$i]))) {

      $datas = array(htmlspecialchars($prestArr[$i]),
                    htmlspecialchars($refArr[$i]),
                    htmlspecialchars($coutArr[$i]),
                    htmlspecialchars($quantArr[$i]),
                    htmlspecialchars($umesureArr[$i]),
                    htmlspecialchars($tvaArr[$i]),
                    htmlspecialchars($remiseArr[$i]),
                    htmlspecialchars($numArr[$i]),
                    htmlspecialchars($typ),
                    htmlspecialchars($id_session),
                    htmlspecialchars($titreArr[$i]),
                    );

      try {
        $pdoSt = $bdd->prepare($sql);
        $result['SUCCESS'][] = $pdoSt->execute($datas);
      } catch (Exception $e) {
         $result[] =  array('ERROR'=>  $e->getMessage(), 'DATAS'=>$datas );
      }
    } else{
        $result[] = array('ERROR'=> "variable prestArr[".$i."] vide !!") ;
    }

  }
}else{
  $result = array('ERROR'=> "variable vide !!", 'POST'=>$_POST) ;
}

echo json_encode($result); // on renvoi le result dans le javascript au format json
exit;
?>