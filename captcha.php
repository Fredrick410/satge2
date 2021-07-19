<?php
session_start();
 
$_SESSION['captcha'] = mt_rand(1000,9999);
$img = imagecreate(200,100);
$font = '../fonts/captcha.ttf'; //  a modifier pour utilisation sur site 
 
$bg = imagecolorallocate($img,255,255,255);
$textcolor = imagecolorallocate($img, 0, 0, 0);
 
imagettftext($img, 50, 0, 10, 80, $textcolor, $font, $_SESSION['captcha']);
 
header('Content-type:image/jpeg');
imagejpeg($img);
imagedestroy($img);
 
?>