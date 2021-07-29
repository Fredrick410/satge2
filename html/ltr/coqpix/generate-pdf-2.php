<?php

require_once('../../../app-assets/data/tcpdf_min/tcpdf.php');
$certificate = "../../../app-assets/data/tcpdf_min/config/cert/tcpdf.crt";

// Extend the TCPDF class to create custom Header and Footer
class MYPDF extends TCPDF {

    //Page header
    public function Header() {
        // Logo
        $image_file = K_PATH_IMAGES.'../../../app-assets/images/pages/aap.png';
        $this->Image($image_file, 15, 10, '', 25, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
        $image_file2 = K_PATH_IMAGES.'../../../app-assets/images/pages/aeca.png';
        $this->Image($image_file2, 140, 12, '', 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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
$pdf->SetTitle('Domiciliation d\'entreprise : fiche de renseignement');
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

//contenu
$contenu = '
<span style="text-decoration: underline; font-weight: bold;">ENTRE</span><br>
<br>
<br>
<span style="font-weight: bold;">AUDIT ACTION PLUS SLU</span>, inscrite au tableau de l\'ordre de l\'AECA (Asociación Española de Contabilidad y Administración de Empresas) de Barcelone.<br>
<br>
Ayant son siège social sis Calle Floridablanca 98 entresuelo 2, Barcelona 08015<br>
<br>
Numéro d\'immatriculation CIF: B66713520<br>
<br>
Représentée par Monsieur MOUFEKKIR Karim, dûment habilité à l\'efffet des présentes,<br>
<br>
<br>
Ci-après dénommée <span style="font-weight: bold;">« Le prestataire »</span><br>
<span style="text-decoration: underline; font-weight: bold;">D\'UNE PART,</span><br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ET</span><br>
<br>
<br>
<span style="color: red;">NOM DE SOCIETE</span><br>
Ayant son siège social sis <span style="color: red;">ADRESSE</span><br>
Immatriculée au RCS de <span style="color: red;">VILLE</span> au numéro en cours d’immatriculation<br>
Représentée par <span style="color: red;">NOM PRENOM</span>, dûment habilité(e) à l\'effet des présentes,<br>
<br>
<br>
Ci-après dénommée <span style="font-weight: bold;">« Le client »</span><br>
<span style="text-decoration: underline; font-weight: bold;">D\'AUTRE PART,</span><br>
<br>
<br>
Ci-après dénommées individuellement <span style="font-weight: bold;">« la Partie »</span> et collectivement <span style="font-weight: bold;">« les Parties »</span>.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">IL A ETE PREALABLEMENT EXPOSE CE OUI SUIT :</span><br>
<br>
La société <span style="color: red;">NOM DE SOCIETE</span> est une société ayant une activité dans le secteur <span style="color: red;">SECTEUR ACTIVITE</span>. Elle a souhaité faire appel aux services du Prestataire, en tant que société gérant sa comptabilité, durant une durée indéterminée.<br>
<br>
Par le présent contrat (ci-après « le Contrat »), les Parties ont entendu définir les conditions selon lesquelles elles coopéreront.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">EN CONSEQUENCE DE QUOI. IL A ETE CONVENU ET ARRETE CE OUI SUIT, LEDIT PREAMBULE FAISANT PARTIE INTEGRANTE DU PRESENT CONTRAT :</span><br>
';

// writeHTMLCell($w, $h, $x, $y, $html='', $border=0, $ln=0, $fill=0, $reseth=true, $align='', $autopadding=true)

// set color for background
$pdf->SetFillColor(255, 255, 255);

// set color for text
$pdf->SetTextColor(0, 0, 0);

// Set font
$pdf->SetFont('helvetica', 'B', 15);
// Title
$y = $pdf->getY();
$pdf->Cell(0, $y, 'Contrat de prestations de service (Langue : français)', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');

// get current vertical position
$y = $pdf->getY();

$pdf->SetFont('helvetica', '', 10);
// write 
$pdf->writeHTML($contenu, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

// Close and output PDF document
ob_clean();
$pdf->Output('contrat', 'I');

/*
$dir = realpath(__DIR__ . '/../../..');
$dir = $dir.'/src/crea_societe/domiciliation/';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$file_name = 'renseignement_domiciliation_idcrea'.$id_crea.'_date-'.date("H-i-s").'.pdf';
//$pdf->Output($dir.'/src/crea_societe/justificatifss/'.$file_name, 'I');


    $pdf->Output($dir.$file_name, 'F');
*/
//============================================================+
// END OF FILE
//============================================================+

require_once 'php/verif_session_crea.php';
require_once 'php/config.php';
/*
    $update = $bdd->prepare('UPDATE crea_societe SET doc_domiciliation = ? WHERE id = ?');
    $update->execute(array( ($file_name), $id_crea  ));
    header('Location: page-creation');*/

?>