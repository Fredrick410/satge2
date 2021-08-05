<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
require_once 'config.php';

if (isset($_POST['filepath']) and !empty($_POST['filepath']) and isset($_POST['key']) and !empty($_POST['key'])) {
    $filepath = htmlspecialchars($_POST['filepath']);
    $pos = strpos($filepath, 'src');
    $filepath = urldecode("../../../../" . substr($filepath, $pos));
    $key_candidat = htmlspecialchars($_POST['key']);
    $exist = file_exists($filepath);
    if (file_exists($filepath)) {
        if (unlink($filepath)) {
            if (str_contains($filepath, 'cv')) {
                $query = "UPDATE rh_candidature SET cv_doc='' WHERE key_candidat=:key_candidat";
            } else if (str_contains($filepath, 'lettredemotivation')) {
                $query = "UPDATE rh_candidature SET lettredemotivation_doc='' WHERE key_candidat=:key_candidat";
            } else if (str_contains($filepath, 'other')) {
                $query = "UPDATE rh_candidature SET other_doc='' WHERE key_candidat=:key_candidat";
            }
            try {
                $pdo = $bdd->prepare($query);
                $pdo->bindValue(':key_candidat', $key_candidat);
                $pdo->execute();
            } catch (PDOException $e) {
                $response_array['status'] = 'error';
                $response_array['message'] = $e->getMessage();
            }

            // On retourne un code de success
            $response_array['status'] = 'success';
        } else {
            $response_array['status'] = 'error';
            $response_array['message'] = 'Suppression impossible';
        }
    } else {
        $response_array['status'] = 'error';
        $response_array['message'] = 'Fichier inexistant';
    }
} else {
    $response_array['status'] = 'error';
    $response_array['message'] = 'Non autorise';
}
echo json_encode($response_array);
exit();
