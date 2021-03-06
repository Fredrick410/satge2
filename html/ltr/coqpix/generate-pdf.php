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
        $this->Cell(0, 15, 'Domiciliation d\'entreprise : fiche de renseignement', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');
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
$id_crea = $_POST['id_crea'];
$raisonsociale = $_POST['raisonsociale'];
$adressess = $_POST['adressess'];
$ville = $_POST['ville_ss'];
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
$choixenvoi = $_POST['choixenvoi'];
if ($_POST['choixenvoi'] == 'mail'){
    $envoifactures = $_POST['envoi_factures'];
}
if ($_POST['choixenvoi'] == 'courrier'){
    $envoifactures = $_POST['envoi_factures1'];
}
$contactfacture = $_POST['contactfacture'];
$telephone = $_POST['telephone'];
$email = $_POST['email'];

$reglement = $_POST['reglement'];
$nombanque = $_POST['nombanque'];
$adressebanque = $_POST['adressebanque'];
$iban = $_POST['iban'];
$bic = $_POST['bic'];

$id_crea = $_POST['id_crea'];
$status_crea = $_POST['status_crea'];

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
Nom de la soci??t?? :<br>
Adresse du si??ge social ?? ce jour :<br>
Forme juridique :<br>
Capital :<br>
TVA intra-communautaire :<br>
Activit?? de la soci??t?? :<br><br>
<b>INFORMATIONS SUR VOTRE CONTRAT</b><br><br>
Date de d??but du contrat :<br>
Dur??e du contrat :<br>
Service choisi :<br>
Centre Multiburo :<br>
R??exp??dition du courrier :<br>
Scan courrier :<br>
Adresse de facturation (si??ge social) :<br><br>
Envoi factures : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Par '.$choixenvoi.' :<br><br><br><br>
Soci??t?? repr??sent??e par (Nom, Pr??nom) :<br>
En sa qualit?? de :<br>
Nationalit?? :<br>
Adresse domicile du signataire :<br><br>
T??l??phone portable du signataire :<br>
Email du signataire :<br>
Contact pour la facturation (Nom et Pr??nom) :<br>
T??l??phone :<br>
Email :<br>
<p style="text-decoration: underline;">Coordonn??es bancaires :</p>
Mode de r??glement :<br>
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
'.$email.'<br><br><br><br><br>
'.$reglement.'<br>
'.$nombanque.'<br>
'.$adressebanque.'<br><br>
'.$iban.'<br>
'.$bic.'<br>
';

$afournir = '
<b>DOCUMENTS A FOURNIR</b><br>
<b style="font-size: 9px;">Conform??ment aux exigences l??gales sur la mise en conformit?? des dossiers clients domicili??s, NCI / Multiburo se verra dans l\'obligation de r??silier votre contrat si vous ne nous faites pas parvenir ces documents dans un d??lai maximum de 60 jours ?? compter de la signature du contrat.</b><br>
- Copie de la CNI en cours de validit?? du signataire du contrat ou copie du passeport en cours de validit?? du signataire du contrat<br>
- Pouvoir du repr??sentant l??gal (si ce n???est pas le signataire du contrat)<br>
- Justificatif de domicile du repr??sentant l??gal datant de moins de 3 mois (facture ??lectricit??, bail,???)<br>
- Justificatif des coordonn??es t??l??phoniques du signataire de moins de 3 mois (facture t??l??phone)<br>
- Document prouvant la validit?? du num??ro de TVA intracommunautaire (VIES)<br>
- Copie des statuts ou projets de statut<br>
- Pour les soci??t??s ??trang??res : Justificatif local d???enregistrement de la soci??t?? dans le pays d???origine<br><br>
<b>DOCUMENTS SUPPLEMENTAIRES A FOURNIR (POUR LES CLIENTS DOMICILIES EN FRANCE)</b><br>
- Extrait Kbis de moins de 3 mois ou justificatif local d???enregistrement de la soci??t?? dans le pays d???origine (pour les soci??t??s ??trang??res)<br>
- Nouvel extrait Kbis ?? nous fournir dans le mois suivant la signature du contrat, en cas de changement de si??ge social<br>
- D??claration B??n??ficiare Effectif (DBE) Multiburo rempli et sign?? par le client ou Cerfa D??claration B??n??ficiare Effectif (DBE) remis par le client lui-m??me<br>
- Relev?? Identit?? Bancaire (RIB)<br><br><br>
<b>A REMPLIR PAR MULTIBURO &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N?? JDE:_______________ &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; N?? du contrat:_____________</b>
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
$pdf->Ln(2);

$pdf->writeHTML($afournir, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

// Close and output PDF document
ob_clean();

$dir = realpath(__DIR__ . '/../../..');
$dir = $dir.'/src/crea_societe/domiciliation/';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$file_name = 'renseignement_domiciliation_idcrea'.$id_crea.'_date-'.date("H-i-s").'.pdf';
//$pdf->Output($dir.'/src/crea_societe/justificatifss/'.$file_name, 'I');


    $pdf->Output($dir.$file_name, 'F');

//============================================================+
// END OF FILE
//============================================================+

require_once 'php/verif_session_crea.php';
require_once 'php/config.php';

    $update = $bdd->prepare('UPDATE crea_societe SET doc_domiciliation = ? WHERE id = ?');
    $update->execute(array( ($file_name), $id_crea  ));

    $update = $bdd->prepare('UPDATE crea_societe SET adresse_entreprise = ? WHERE id = ?');
    $update->execute(array( ($adressess), $id_crea  ));

    $update = $bdd->prepare('UPDATE crea_societe SET ville_entreprise = ? WHERE id = ?');
    $update->execute(array( ($ville), $id_crea  ));

    //delete notif back
    $date_notif = date("d/m/Y");

    $insert = $bdd->prepare('INSERT INTO notif_back (type_demande, date_demande, name_entreprise, id_session) VALUES(?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars("domiciliation"),
        htmlspecialchars($date_notif),
        htmlspecialchars($raisonsociale),
        htmlspecialchars($id_crea)
    ));

    //ajout de la date du jour dans le depot
    $date_fiche = date("Y-m-d");

    $update = $bdd->prepare('UPDATE crea_societe SET depo_fiche = ? WHERE id = ?');
    $update->execute(array( ($date_fiche), $id_crea  ));

    header('Location: page-creation');

?>