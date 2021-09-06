<!DOCTYPE html>
<html lang="fr" >
<head>
  <meta charset="UTF-8">
  <title>Upload de document</title>
  <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.7.2/css/all.min.css'><link rel="stylesheet" href="../../../app-assets/css/pages/creation-upload.css">

</head>
<body>
    <div class="file-container">
        <div class="file-overlay"></div>
        <div class="file-wrapper">
            <form action="php/insert_fiscaldoc.php?num=<?= $_GET['num'] ?>&type=<?= $_GET['type'] ?>" method="POST" enctype="multipart/form-data">
                <input name="doc_files" class="file-input" id="js-file-input" type="file" onchange="this.form.submit();"/>
            </form>
            <div class="file-content">
                <div class="file-infos">
                <p class="file-icon"><i class="fas fa-file-upload fa-7x"></i><span class="icon-shadow"></span><span>Cliquez pour parcourir<span class="has-drag"> ou déposez le fichier ici</span></span></p>
                </div>
                <p class="file-name" id="js-file-name">Aucun fichier sélectionné</p>
            </div>
        </div>
    </div>
    <script src="../../../app-assets/js/scripts/pages/creation-upload.js"></script>
    <!-- TIMEOUT -->
    <?php include('timeout.php'); ?>
</body>
</html>