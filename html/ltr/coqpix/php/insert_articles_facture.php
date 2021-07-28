<?php
session_start();

//connexion à la bdd
require_once 'config.php';

//récupération PROPRE des variables AVANT de les utiliser
$numArr = !empty($_POST["numeros"]) ? json_decode($_POST["numeros"]) : NULL; //PAS DE json_decode parce que il n'est pas dans la boucle
$artArr = !empty($_POST["article"]) ? json_decode($_POST["article"]) : NULL;
$refArr = !empty($_POST["referencearticle"]) ? json_decode($_POST["referencearticle"]): NULL;
$coutArr = !empty($_POST["cout"]) ? json_decode($_POST["cout"]): NULL;
$tvaArr = !empty($_POST["tva"]) ? json_decode($_POST["tva"]): NULL;
$remiseArr = !empty($_POST["remise"]) ?json_decode($_POST["remise"]): NULL;
$quantArr = !empty($_POST["quantite"]) ? json_decode($_POST["quantite"]): NULL;
$umesureArr = !empty($_POST["umesure"]) ? json_decode($_POST["umesure"]): NULL;
$typ = "bonachat";
$id_session = !empty($_SESSION['id_session']) ? $_SESSION['id_session'] : NULL ; //$_SESSION


$sql = "INSERT INTO articles 
        (article, referencearticle, cout, quantite, umesure, tva, remise, numeros, typ, id_session) 
        VALUES (?,?,?,?,?,?,?,?,?,?)";

if(!empty($artArr)){
  for ($i = 0; $i < count($artArr); $i++) {

    if((!empty($artArr[$i]))) {

      $datas = array($artArr[$i],
                     $refArr[$i],
                     $coutArr[$i],
                     $quantArr[$i],
                     $umesureArr[$i],
                     $tvaArr[$i],
                     $remiseArr[$i],
                     $numArr[$i],
                     $typ,
                     $id_session
                    );

      try {
        $pdoSt = $bdd->prepare($sql);
        $result['SUCCESS'][] = $pdoSt->execute($datas);
      } catch (Exception $e) {
         $result[] =  array('ERROR'=>  $e->getMessage(), 'DATAS'=>$datas );
      }
    } else{
        $result[] = array('ERROR'=> "variable artArr[".$i."] vide !!") ;
    }

  }
}else{
  $result = array('ERROR'=> "variable vide !!", 'POST'=>$_POST) ;
}

echo json_encode($result); // on renvoi le result dans le javascript au format json
exit;
?>