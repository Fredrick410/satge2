<?php

require_once('../../../app-assets/data/tcpdf_min/tcpdf.php');
$certificate = "../../../app-assets/data/tcpdf_min/config/cert/tcpdf.crt";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../../app-assets/images/pages/multiburo.png';
        $this->Image($image_file, 15, 10, '', 15, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        // Set font
        $this->SetFont('helvetica', '', 15);
        // Title
        $this->Cell(0, 15, 'Fiche de renseignement : domiciliation d\'entreprise', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');
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
}


// create new PDF document
$pdf = new MYPDF('p', 'mm', 'A4', true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('');
$pdf->SetTitle('Fiche de renseignement : domiciliation d\'entreprise');
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
$pdf->SetFont('helvetica', '', 8);

// add a page
$pdf->AddPage();

//info du formulaire
$id_crea = $_POST['id_crea'];
$raisonsociale = $_POST['raisonsociale'];
$adressess = $_POST['adressess'];
$formejuridique = $_POST['formejuridique'];
$capital = $_POST['capital'];
$tva = $_POST['tva'];
$activite = $_POST['activite'];

$representant = $_POST['representant'];
$representantqualite = $_POST['representantqualite'];
$nationalite = $_POST['nationalite'];
$datedebut = $_POST['datedebut'];
$dureecontrat = $_POST['dureecontrat']; 
$servicechoisi = $_POST['servicechoisi'];
$centremultiburo = $_POST['centremultiburo'];
$reexpedition = $_POST['reexpedition'];
$scancourrier = $_POST['scancourrier'];
$adresseds = $_POST['adresseds'];
$telephoneds = $_POST['telephoneds'];
$emailds = $_POST['emailds'];
$adressfactures = $_POST['adresse_factures'];
$envoifactures = $_POST['envoi_factures'];
$contactfacture = $_POST['contactfacture'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];

 
// create columns content
$left_column = '
<style>
    h4 {
        text-decoration: underline;
    }
</style>

<h4>VOTRE INTERLOCUTEUR :</h4>
Nadia Terki<br>';

$right_column = '<br>
Tel : +33(0)5 67 31 45 45<br>
Fax : +33(0)5 67 31 45 99<br>
Email : nadia.terki@multiburo.com';

$left_column1 = '
<b>INFORMATIONS SUR VOTRE SOCIETE</b><br><br>
Nom de la société :<br>
Adresse du siège social à ce jour :<br>
Forme juridique :<br>
Capital :<br>
TVA intra-communautaire :<br>
Activité de la société :<br><br>
<b>INFORMATIONS SUR VOTRE CONTRAT</b><br><br>
Date de début du contrat :<br>
Durée du contrat :<br>
Service choisi :<br>
Centre Multiburo :<br>
Réexpédition du courrier :<br>
Scan courrier :<br>
Adresse de facturation (siège social) :<br><br>
Envoi factures :<br><br><br><br>
Société représentée par (Nom, Prénom) :<br>
En sa qualité de :<br>
Nationalité :<br>
Adresse domicile du signataire :<br><br>
Téléphone portable du signataire :<br>
Email du signataire :<br>
Contact pour la facturation (Nom et Prénom) :<br>
Téléphone :<br>
Email :<br>
<p style="text-decoration: underline;">Coordonnées bancaires :</p>
Mode de règlement :<br>
Nom de la banque :<br>
Adresse de la banque :<br><br>
IBAN :<br>
BIC :<br>';

$right_column1 = '
<br><br><br>
'.$raisonsociale.'<br>
'.$adressess.'<br>
'.$formejuridique.'<br>
'.$capital.'<br>
'.$tva.'<br>
'.$activite.'<br>
<br><br><br>
'.$datedebut.'<br>
'.$dureecontrat.'<br>
'.$servicechoisi.'<br>
'.$centremultiburo.'<br>
'.$reexpedition.'<br>
'.$scancourrier.'<br>
'.$adressfactures.'<br><br>
'.$envoifactures.'<br><br><br><br>
'.$representant.'<br>
'.$representantqualite.'<br>
'.$nationalite.'<br>
'.$adresseds.'<br><br>
'.$telephoneds.'<br>
'.$emailds.'<br>
'.$contactfacture.'<br>
'.$telephone.'<br>
'.$email.'<br>

';

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// get current vertical position
$y = $pdf->getY();

// write 
$pdf->writeHTMLCell(90, '', '', $y, $left_column, 0, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(90, '', '', '', $right_column, 0, 1, 1, true, 'J', true);

// get current vertical position
$y = $pdf->getY()+5;

$pdf->writeHTMLCell(90, '', '', $y, $left_column1, 0, 0, 1, true, 'L', true);
$pdf->writeHTMLCell(90, '', '', '', $right_column1, 0, 1, 1, true, 'J', true);

// reset pointer to the last page
$pdf->lastPage();



//$pdf->SetFont('helvetica', '', 10);
//$pdf->MultiCell(147, 10, 'Signature', 0, 'R', 1, 1, '', '', true, 0, false, true, 0);
//$pdf->SetFont('../../../app-assets/data/tcpdf_min/fonts/Holligate.ttf', '', 15);
//$pdf->MultiCell(145, 0, $sign, 0, 'R', 1, 1, '', '', true, 0, false, true, 0);


// ---------------------------------------------------------

// Close and output PDF document
ob_clean();
$dir = realpath(__DIR__ . '/../../..');
$file_name = 'contrat_domiciliation_idcrea'.$id_crea.'_date-'.date("H-i-s").'.pdf';
$pdf->Output($dir.'/src/crea_societe/justificatifss/'.$file_name, 'I');

//============================================================+
// END OF FILE
//============================================================+
require_once 'php/verif_session_crea.php';
require_once 'php/config.php';
$update = $bdd->prepare('UPDATE crea_societe SET doc_justificatifss = ? WHERE id = ?');
$update->execute(array( ($file_name), $id_crea  ));

header('Location: creation-view-morale-justificatifss');

?>