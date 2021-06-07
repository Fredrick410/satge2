<?php 
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

if(!empty($_POST['name_entreprise'])){
    $name_entreprise = $_POST['name_entreprise'];
    $tel_entreprise = $_POST['tel_entreprise'];
    $email_entreprise = $_POST['email_entreprise'];
}else{
    $name_entreprise = $_GET['name_entreprise'];
    $tel_entreprise = $_GET['tel_entreprise'];
    $email_entreprise = $_GET['email_entreprise'];
}

function passgen1($nbChar) {
    $chaine ="mnoTUzS5678kVvwxy9WXYZRNCDEFrslq41GtuaHIJKpOPQA23LcdefghiBMbj0";
    srand((double)microtime()*1000000);
    $pass = '';
    for($i=0; $i<$nbChar; $i++){
        $pass .= $chaine[rand()%strlen($chaine)];
        }
    return $pass;
}

function passgen2($nbChar){
    return substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCEFGHIJKLMNOPQRSTUVWXYZ0123456789'),1, $nbChar); 
}

$code = passgen1(10);
$dte = date('d/m/Y');


$insert = $bdd->prepare('INSERT INTO acte (name_entreprise, tel_entreprise, email_entreprise, one, verif_one, two, three, four, five, six, seven, code, dte, forme, progression) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($name_entreprise),
        htmlspecialchars($tel_entreprise),
        htmlspecialchars($email_entreprise),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($code),
        htmlspecialchars($dte),
        htmlspecialchars(""),
        htmlspecialchars("0")
    ));

    header('Location: ../acte-modification-two.php?2sB2y&name_entreprise='.$name_entreprise.'&7Ukt3&t='.$tel_entreprise.'&k7J6e&em='.$email_entreprise.'&tf3M3&num='.$code.'&');
    exit();
?>