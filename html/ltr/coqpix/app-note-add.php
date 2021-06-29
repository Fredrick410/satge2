<?php 

include 'php/verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
   
    $pdoSta = $bdd->prepare('SELECT * FROM entreprise WHERE id = :num');
    $pdoSta->bindValue(':num',$_SESSION['id'], PDO::PARAM_INT);    
    $pdoSta->execute();
    $entreprise = $pdoSta->fetch();

    $pdoSt = $bdd->prepare('SELECT * FROM membres WHERE id = :num');
    $pdoSt->bindValue(':num',$_GET['numnote'], PDO::PARAM_INT);
    
    $pdoSt->execute();
    
    $memb = $pdoSt->fetch();

    $pdoS = $bdd->prepare('SELECT * FROM membres WHERE id_session = :num');
    $pdoS->bindValue(':num',$_SESSION['id_session']);
    $pdoS->execute();
    $membre = $pdoS->fetchAll();

    $pdoStat = $bdd->prepare('SELECT * FROM entreprise WHERE id = :numentreprise');
    $pdoStat->bindValue(':numentreprise',$_SESSION['id']);
    $true = $pdoStat->execute();
    $entrepri = $pdoStat->fetchAll();

    if(isset($_POST['numnote'])){
        if($memb['doc_note'] == ""){

        $dir = "../../../src/files/note/"; // ex : $dir = "../image/logo";
        $target_file = $dir.basename($_FILES['files']['name']);
        $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if(move_uploaded_file($_FILES['files']['tmp_name'], $target_file)){

        $update = $bdd->prepare('UPDATE membres SET doc_note = ?, nb_doc_note = ? WHERE id = ?');
        $update->execute(array(

            ($_FILES['files']['name']),
            ("1"),
            ($_POST['numnote'])
            
    ));
        header('Location: php/redirection_note.php?numnote='.$_GET['numnote']);
        exit();
    }
}

        if($memb['doc_note_2'] == ""){

        $dir = "../../../src/files/note/"; // ex : $dir = "../image/logo";
        $target_file = $dir.basename($_FILES['files']['name']);
        $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if(move_uploaded_file($_FILES['files']['tmp_name'], $target_file)){

        $update = $bdd->prepare('UPDATE membres SET doc_note_2 = ?, nb_doc_note = ? WHERE id = ?');
        $update->execute(array(

            ($_FILES['files']['name']),
            ("2"),
            ($_POST['numnote'])
            
    ));
        header('Location: php/redirection_note.php?numnote='.$_GET['numnote']);
        exit();
    }
}

        if($memb['doc_note_3'] == ""){

        $dir = "../../../src/files/note/"; // ex : $dir = "../image/logo";
        $target_file = $dir.basename($_FILES['files']['name']);
        $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if(move_uploaded_file($_FILES['files']['tmp_name'], $target_file)){

        $update = $bdd->prepare('UPDATE membres SET doc_note_3 = ?, nb_doc_note = ? WHERE id = ?');
        $update->execute(array(

            ($_FILES['files']['name']),
            ("3"),
            ($_POST['numnote'])
            
    ));
        header('Location: php/redirection_note.php?numnote='.$_GET['numnote']);
        exit();
    }
}


        if($memb['doc_note_4'] == ""){

        $dir = "../../../src/files/note/"; // ex : $dir = "../image/logo";
        $target_file = $dir.basename($_FILES['files']['name']);
        $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if(move_uploaded_file($_FILES['files']['tmp_name'], $target_file)){

        $update = $bdd->prepare('UPDATE membres SET doc_note_4 = ?, nb_doc_note = ? WHERE id = ?');
        $update->execute(array(

            ($_FILES['files']['name']),
            ("4"),
            ($_POST['numnote'])
            
    ));
        header('Location: php/redirection_note.php?numnote='.$_GET['numnote']);
        exit();
    }
}

        if($memb['doc_note_5'] == ""){

        $dir = "../../../src/files/note/"; // ex : $dir = "../image/logo";
        $target_file = $dir.basename($_FILES['files']['name']);
        $imgTypeFile = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    
        if(move_uploaded_file($_FILES['files']['tmp_name'], $target_file)){

        $update = $bdd->prepare('UPDATE membres SET doc_note_5 = ?, nb_doc_note = ? WHERE id = ?');
        $update->execute(array(

            ($_FILES['files']['name']),
            ("5"),
            ($_POST['numnote'])
            
    ));
        header('Location: php/redirection_note.php?numnote='.$_GET['numnote']);
        exit();
    }
}






}
?>
<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Coqpix crée By audit action plus - développé par Youness Haddou">
    <meta name="keywords" content="application, audit action plus, expert comptable, application facile, Youness Haddou, web application">
    <meta name="author" content="Audit action plus - Youness Haddou">
    <title>Ajouter devis</title>
    <link rel="apple-touch-icon" href="../../../app-assets/images/ico/apple-icon-120.png">
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <!-- END: Vendor CSS-->

    <!-- BEGIN: Theme CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/bootstrap-extended.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/colors.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/components.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/dark-layout.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/themes/semi-dark-layout.css">
    <!-- END: Theme CSS-->

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/vertical-menu.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-invoice.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern <?php if($entreprise['theme_web'] == "light"){echo "semi-";} ?>dark-layout 2-columns  navbar-sticky footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="2-columns" data-layout="<?php if($entreprise["theme_web"] == "light"){echo "semi-";} ?>dark-layout">

    <!-- BEGIN: Header-->
    <?php $btnreturn = true;
    include('php/menu_header_front.php'); ?>
    <!-- END: Header-->

    <!-- BEGIN: Main Menu-->
    <?php include('php/menu_front.php'); ?>
    <!-- END: Main Menu-->

    <!-- BEGIN: Content-->
    <div class="app-content content">
        <div class="content-overlay"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <!-- app invoice View Page -->
                <section class="invoice-edit-wrapper">
                    <div class="row">
                        <!-- invoice view page -->
                        <div class="col-xl-9 col-md-8 col-12">
                            <div class="card">
                                <div class="card-content">
                                    <div class="card-body pb-0 mx-25">
                                        <!-- header section -->
                                <form action="../../../src/files/note/insert_note.php" method="POST">
                                <input type="hidden" name="nom" value="<?= $memb['nom'] ?>">
                                <input type="hidden" name="id_session" value="<?= $memb['id_session'] ?>">
                                <input type="hidden" name="img_membres" value="<?= $memb['img_membres'] ?>">
                                        <div class="row mx-0">
                                            <div class="col-xl-6 col-md-12 d-flex align-items-center pl-0">
                                                <h6 class="invoice-number mr-75">Note de frais : </h6>

                                                <div class="dropdown invoice-options">
                                                    <button class="btn mr-2" type="button" id="invoice-options-btn" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <?= $memb['nom'] ?> <?= $memb['prenom'] ?>
                                                    </button>
                                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="invoice-options-btn">
                                                        <?php foreach($membre as $membres): ?>
                                                        <a type="submit" class="dropdown-item" href="php/redirection_note.php?numnote=<?= $membres['id'] ?>"><?= $membres['nom'] ?> <?= $membres['prenom'] ?></a>
                                                        <?php endforeach; ?>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-xl-6 col-md-12 px-0 pt-xl-0 pt-1">
                                                <div class="invoice-date-picker d-flex align-items-center justify-content-xl-end flex-wrap">
                                                    <div class="d-flex align-items-center">
                                                        <small class="text-muted mr-75">*Date : </small>
                                                        <fieldset class="d-flex ">
                                                            <input name="dte" type="date" class="form-control mr-2 mb-50 mb-sm-0" required>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <!-- logo and title -->
                                        <div class="row my-2 py-50">
                                            <div class="col-sm-6 col-12 order-2 order-sm-1">
                                                <h4 class="text-primary">Note de frais</h4>
                                                <input name="objet" type="text" class="form-control" placeholder="Intituler de la note de frais" required> 
                                            </div>
                                            <div class="col-sm-6 col-12 order-1 order-sm-1 d-flex justify-content-end">
                                                <img src="../../../src/img/<?= $entreprise['img_entreprise'] ?>" alt="logo" height="164" width="164">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body pt-50">         
                                        <hr>
                                        <div class="invoice-subtotal pt-50">
                                            <div class="row">
                                                <div class="col-md-5 col-12">
                                                    <div class="form-group">
                                                        <label>*Cout :</label>
                                                        <input name="montant" type="number" class="form-control" placeholder="Cout total" required step="any">
                                                    </div>
                                                    <label for="etiq">*Etiquette :</label>
                                                    <div class="col-12 col-md-6 form-group" id="etiq">
                                                        <select name="etiquette" class="form-control invoice-item-select" required>
                                                            <option></option>
                                                            <option value="Déplacement">Déplacement</option>
                                                            <option value="Nourriture">Nourriture</option>
                                                            <option value="Herbergement">Herbergement</option>
                                                            <option value="Autre">Autre</option>
                                                         </select>
                                                    </div>
                                                    
                                                </div>
                                                <div class="col-lg-5 col-md-7 offset-lg-2 col-12">
                                                    <ul class="list-group list-group-flush">
                                                        <li class="list-group-item d-flex justify-content-between border-0 pb-0">
                                                            <span class="invoice-subtotal-title">Total</span>
                                                            <h6 class="invoice-subtotal-value mb-0">00.00 €</h6>
                                                        </li>
                                                        <li class="list-group-item py-0 border-0 mt-25">
                                                            <hr>
                                                        </li>
                                                        <li class="list-group-item border-0 pb-0">
                                                            <input name="form1" type="submit" value="Sauvegarder" class="btn btn-primary btn-block subtotal-preview-btn">
                                                        </li>
                                </form>
                                                    </ul>
                                                </div>
                                                <form name="myform" action="" method="POST" enctype="multipart/form-data">
                                                    <input type="hidden" name="numnote" value="<?= $memb['id'] ?>">
                                                    <div class="form-group">
                                                        <label> documents justificatifs :</label>
                                                        <input class="form-control" onchange="this.form.submit();" type="file" name="files" id="fichier" size="30" accept="image/png, image/jpg, image/jpeg, application/pdf">
                                                        <p>5 documents max</p><br>
                                                        <p class="primary"><?php if($memb['doc_note'] == ""){}else{echo "1 - ";} ?><?= $memb['doc_note'] ?><!-- &nbsp&nbsp&nbsp&nbsp <?php echo '<a href="php/delete_files_note.php?numnote=' . $memb['id'] . '&numnote_2=&numnote_3=&numnote_4=&numnote_5=&name_files='. $memb['doc_note'] .'"><i class="bx bx-x"></i></a>'; ?></p> -->
                                                        <p class="primary"><?php if($memb['doc_note_2'] == ""){}else{echo "2 - ";} ?><?= $memb['doc_note_2'] ?><!-- &nbsp&nbsp&nbsp&nbsp <?php echo '<a href="php/delete_files_note.php?numnote_2=' . $memb['id'] . '&numnote=&numnote_3=&numnote_4=&numnote_5=&name_files='. $memb['doc_note_2'] .'"><i class="bx bx-x"></i></a>'; ?></p> -->
                                                        <p class="primary"><?php if($memb['doc_note_3'] == ""){}else{echo "3 - ";} ?><?= $memb['doc_note_3'] ?><!-- &nbsp&nbsp&nbsp&nbsp <?php echo '<a href="php/delete_files_note.php?numnote_3=' . $memb['id'] . '&numnote_2=&numnote=&numnote_4=&numnote_5=&name_files='. $memb['doc_note_3'] .'"><i class="bx bx-x"></i></a>'; ?></p> -->
                                                        <p class="primary"><?php if($memb['doc_note_4'] == ""){}else{echo "4 - ";} ?><?= $memb['doc_note_4'] ?><!-- &nbsp&nbsp&nbsp&nbsp <?php echo '<a href="php/delete_files_note.php?numnote_4=' . $memb['id'] . '&numnote_2=&numnote_3=&numnote=&numnote_5=&name_files='. $memb['doc_note_4'] .'"><i class="bx bx-x"></i></a>'; ?></p> -->
                                                        <p class="primary"><?php if($memb['doc_note_5'] == ""){}else{echo "5 - ";} ?><?= $memb['doc_note_5'] ?><!-- &nbsp&nbsp&nbsp&nbsp <?php echo '<a href="php/delete_files_note.php?numnote_5=' . $memb['id'] . '&numnote_2=&numnote_3=&numnote_4=&numnote=&name_files='. $memb['doc_note_5'] .'"><i class="bx bx-x"></i></a>'; ?></p> -->
                                                    </div>
                                                    </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                      
                </section>

            </div>
        </div>
    </div>
    <!-- END: Content-->

    </div>
    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>


    <!-- BEGIN: Vendor JS-->
    <script src="../../../app-assets/vendors/js/vendors.min.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.tools.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.defaults.js"></script>
    <script src="../../../app-assets/fonts/LivIconsEvo/js/LivIconsEvo.min.js"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="../../../app-assets/js/scripts/configs/vertical-menu-dark.js"></script>
    <script src="../../../app-assets/js/core/app-menu.js"></script>
    <script src="../../../app-assets/js/core/app.js"></script>
    <script src="../../../app-assets/js/scripts/components.js"></script>
    <script src="../../../app-assets/js/scripts/footer.js"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="../../../app-assets/js/scripts/pages/app-invoice.js"></script>
    <!-- END: Page JS-->
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
<!-- END: Body-->

</html>