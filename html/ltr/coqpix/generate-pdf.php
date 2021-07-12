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
    <title>Création de société</title>
    <link rel="shortcut icon" type="image/x-icon" href="../../../app-assets/images/ico/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- BEGIN: Vendor CSS-->
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/vendors.min.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/vendors/css/editors/quill/quill.snow.css">
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
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/app-email.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="../../../assets/css/style.css">
    <link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation-offre.css">
    <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<?php

require_once('../../../app-assets/data/tcpdf_min/tcpdf.php');

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../../app-assets/images/pages/multiburo.png';
        $this->Image($image_file, 10, 10, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('times', '', 15);
        // Title
        $this->Cell(0, 15, 'Contrat de prestation de services et domiciliation', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');
    }

    // Page footer
    public function Footer() {
        // Position at 15 mm from bottom
        $this->SetY(-15);
        // Set font
        $this->SetFont('helvetica', 'I', 8);
        // Page number
        $this->Cell(0, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
    }

    // Colored table
    public function ColoredTable($header,$data) {
        // Colors, line width and bold font
        /*$this->SetFillColor(224, 235, 255);*/
        $this->SetDrawColor(128, 0, 0);
        $this->SetLineWidth(0.3);
        $this->SetFont('times', 'B', 8);
        // Header
        $w = array(60, 25, 40, 55);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 0, $header[$i], 0, 0, 'L', 1);
        }
        $this->Ln();
        /*$this->SetFillColor(200, 200, 200);*/
        $this->SetFont('times', '', 8);
        // Data
        $fill = 0;
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 0, $data[$i], 0, 0, 'R', 1);
        }
        /*foreach($data as $row) {
            $this->Cell($w[0], 6, $row[0], 'LR', 0, 'L', $fill);
            $this->Cell($w[1], 6, $row[1], 'LR', 0, 'L', $fill);
            $this->Cell($w[2], 6, number_format($row[2]), 'LR', 0, 'R', $fill);
            $this->Cell($w[3], 6, number_format($row[3]), 'LR', 0, 'R', $fill);
            $this->Ln();
            $fill=!$fill;
        }
        $this->Cell(array_sum($w), 0, '', 'T');*/
    }
}


// create new PDF document
$pdf = new MYPDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Contrat de prestation de services et domiciliation');
$pdf->SetSubject('');
$pdf->SetKeywords('');

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/eng.php')) {
    require_once(dirname(__FILE__).'/lang/eng.php');
    $pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

// set font
$pdf->SetFont('times', '', 8);

// add a page
$pdf->AddPage();
 
// set text shadow effect
$pdf->setTextShadow(array('enabled'=>true, 'depth_w'=>0.2, 'depth_h'=>0.2, 'color'=>array(196,196,196), 'opacity'=>1, 'blend_mode'=>'Normal'));

//info du formulaire
$raisonsociale = $_POST['raisonsociale'];
$formejuridique = $_POST['formejuridique'];
$capital = $_POST['capital'];
$representant = $_POST['representant'];
$representantqualite = $_POST['representantqualite'];
$codepostal = $_POST['codepostal'];
$ville = $_POST['ville'];
$pays = $_POST['pays'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];
$br = '<br>';
 
// Set some content to print
$soustitre = 'Entre les soussignés : <br>
MULTIBURO SA au capital de 4 212 080 € ayant son siège social au Le Shératan 27 bis avenue des Sources 69009 LYON immatriculée au registre du commerce de LYON sous le N° 345250153, et agréée depuis le 28 septembre 2018 par la Préfecture de Lyon, pour exercer l’ activité de domiciliation sous le n° d’ agrément 69-2018-09-28-004. Représentée par sa Directrice Générale Stéphanie AUXENFANS ou toute personne dûment habilitée. ci-après dénommé : le prestataire et le client : XXXXXXXci-après dénommé : l\'utilisateur';

$coordtop = 'Coordonnées de l\'utilisateur :';
$coordleft = 'Raison Sociale : '.$raisonsociale.'
Forme juridique : '.$formejuridique.'
Capital : '.$capital.'
Représenté par : '.$representant.'
En sa qualité de : '.$representantqualite.'';
$coordright = 'Code postal : '.$codepostal.'
Ville : '.$ville.'
Pays : '.$pays.'
Téléphone : '.$telephone.'
Email : '.$email.'';

$designation = 'DESIGNATION DES PRESTATIONS SPECIFIQUES INCLUSES DANS LE CONTRAT';

$adrgauche = 'Adresse de domiciliation';
$adrdroite = 'Adresse 59 allées Jean Jaurès CS 21531 31015 TOULOUSE Cedex 6';

$header = array('SERTVICE DE DOMICILIATION TYPE', 'QUANTITE', 'PRIX UNITAIRE EN €', 'PRIX TOTAL ECHEANCE HT EN €');
$data = array('Domiciliation Adresse', '... Mois', '', '');

// Print text using writeHTMLCell()
$pdf->writeHTMLCell(0, 0, '', '', $soustitre, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $coordtop, 1, 1, 0, true, '', true);
$pdf->MultiCell(90, 0, $coordleft, 1, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 0, $coordright, 1, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $designation, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->MultiCell(0, 0, $adrgauche, 0, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->MultiCell(0, 0, $adrdroite, 0, 'R', 1, 1, '', '', true, 0, false, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->ColoredTable($header, $data);

// ---------------------------------------------------------

// Close and output PDF document
ob_clean();
$pdf->Output('contrat_domiciliation.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+

?>

</html>