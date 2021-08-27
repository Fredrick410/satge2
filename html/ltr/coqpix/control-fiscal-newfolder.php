<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/tables/datatable/datatables.min.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/core/menu/menu-types/horizontal-menu.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <!-- END: Custom CSS-->
</head>

<body class="fiscal-application">

<div class="card shadow-none quill-wrapper p-0">
        <div class="card-header">
            <h3 class="card-title" id="emailCompose">Création du Dossier</h3>
            <button type="button" class="close close-icon">
                <i class="bx bx-x"></i>
            </button>
        </div>

<!-- form start -->
<form action="php/insert_crea.php" id="compose-form" method="POST">
                                <div class="card-content">
                                    <div class="card-body pt-0">
                                        <div class="form-group">
                                            <label>Nom de l'entreprise</label>
                                            <input type="text" id="name_crea" name="crea_societe" class="form-control" placeholder="Nom de l'entreprise" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Période de contrôle</label>
                                            <input type="date">
                                            <input type="date">
                                        </div>
                                        <fieldset class="form-group">
                                            <label>Objet du contrôle</label>
                                            <select name="status_crea" class="form-control invoice-item-select" required>
                                                <option value="" selected disable hidden>Choisir l'objet du contrôle</option>
                                                <option value="TVA">Taxe sur la valeur ajoutée (TVA)</option>
                                                <option value="IR">Impôt sur le revenu (IR)</option>
                                                <option value="IS">Impôt sur les sociétés (IS)</option>
                                            </select>
                                        </fieldset>
                                    </div>
                                </div>
                                <div class="card-footer d-flex justify-content-end pt-0">
                                    <button type="reset" class="btn btn-light-secondary cancel-btn mr-1">
                                        <i class='bx bx-x mr-25'></i>
                                        <span class="d-sm-inline d-none">Annuler</span>
                                    </button>
                                    <button type="submit" class="btn-send btn btn-primary">
                                        <i class='bx bx-send mr-25'></i> <span class="d-sm-inline d-none">Créer</span>
                                    </button>
                                </div>
                            </form>
                            <!-- form start end-->
</div>
</body>
</html>

<button class="btn btn-primary glow mr-1 mb-1">
                                                                <i class="bx bx-plus"></i> 
                                                                Nouveau Dossier
                                                            </button>