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
        $this->SetFont('helvetica', 'B', 8);
        // Header
        $w = array(60, 25, 40, 55);
        $num_headers = count($header);
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 0, $header[$i], 1, 0, 'L', 1);
        }
        $this->Ln();
        /*$this->SetFillColor(200, 200, 200);*/
        $this->SetFont('helvetica', '', 8);
        // Data
        $fill = 0;
        for($i = 0; $i < $num_headers; ++$i) {
            $this->Cell($w[$i], 0, $data[$i], 1, 0, 'C', 1);
        }
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
$pdf->SetFont('helvetica', '', 8);

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
$date = $_POST['date'];
$sign = $_POST['signature'];
$id_crea = $_POST['id_crea'];

//info bdd
$adresse = $_POST['adresse'];
$quantite = $_POST['']; 
$dureecontrat = $_POST['']; 
$prix = $_POST[''];
$prixtotechht = $_POST[''];
$br = '<br>';
 
// Set some content to print
$soustitre = 'Entre les soussignés : <br>
MULTIBURO SA au capital de 4 212 080 € ayant son siège social au Le Shératan 27 bis avenue des Sources 69009 LYON immatriculée au registre du commerce de LYON sous le N° 345250153, et agréée depuis le 28 septembre 2018 par la Préfecture de Lyon, pour exercer l’ activité de domiciliation sous le n° d’ agrément 69-2018-09-28-004. Représentée par sa Directrice Générale Stéphanie AUXENFANS ou toute personne dûment habilitée. ci-après dénommé : le prestataire et le client : '.$raisonsociale.' '.$formejuridique.'<br> ci-après dénommé : l\'utilisateur :';

$coordtop = '<b>Coordonnées de l\'utilisateur :</b>';
$coordleft = 'Raison Sociale : '.$raisonsociale.'
Forme juridique : '.$formejuridique.'
Capital : '.$capital.' €
Représenté par : '.$representant.'
En sa qualité de : '.$representantqualite.'';
$coordright = 'Code postal : '.$codepostal.'
Ville : '.$ville.'
Pays : '.$pays.'
Téléphone : '.$telephone.'
Email : '.$email.'';

$designation = '<b>DESIGNATION DES PRESTATIONS SPECIFIQUES INCLUSES DANS LE CONTRAT</b>';

$adr = 'Adresse de domiciliation, Adresse : '.$adresse;

$header = array('SERTVICE DE DOMICILIATION TYPE', 'QUANTITE', 'PRIX UNITAIRE EN €', 'PRIX TOTAL ECHEANCE HT EN €');
$data = array('Domiciliation Adresse',  $dureecontrat.'Mois', $prix, $prixtotechht);

$soustotal = '<b>SOUS TOTAL (A) DOMICILIATION</b>';

$echeance = '<b>PRIX TOTAL ECHEANCE HT<br>
TVA à 20 %<br>
PRIX TOTAL ECHEANCE TTC POUR L\'UTILISATEUR</b>';
$echeancegauche = 'Date démarrage du présent contrat
Durée initiale du contrat (en mois)
Périodicité de facturation
Montant du dépôt de garantie à verser en €
Mode du règlement du montant du total de l\'échéance
Acompte sur sevices annexes à verser en €
Annexes jointes';
$echeancedroite = $date.'
3 mois minimum
Trimestrielle

-
0,00
Liste des prix des services, Attestation adresse de comptabilité';

$signature = 'Par la signature du présent document reprenant les conditions particulières du contrat, l\'Utilisateur reconnaît expressément avoir reçu, avoir pris connaissance, et accepter les
conditions générales du contrat, le règlement d\'ordre intérieur, les conditions d’utilisation du service internet, et l\'annexe reprenant la liste des services Multiburo en vigueur.';
$checkbox = 'J\'autorise Multiburo à utiliser le nom et le logo de ma société dans sa communication interne et externe.';

$pourtopleft ='Pour MULTIBURO';
$pourleft = 'Représenté par Madame Nadia TERKI
En sa qualité de Responsable Centre
Date 
Fait à
Signature :';
$pourtopright = 'Pour l\'utilisateur';
$pourright = 'Représenté par '.$representant.'
En sa qualité de '.$representantqualite.'
Date '.$date.'
Fait à '.$ville.'
Signature :';

// Print text 
$pdf->writeHTMLCell(0, 0, '', '', $soustitre, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $coordtop, 1, 1, 0, true, '', true);
$pdf->MultiCell(90, 0, $coordleft, 1, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 0, $coordright, 1, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $designation, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->Cell(0, 0, $adr, 0, 1, 'C', 0, '', 3);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->ColoredTable($header, $data);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $soustotal, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $echeance, 1, 1, 0, true, '', true);
$pdf->MultiCell(90, 0, $echeancegauche, 1, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 0, $echeancedroite, 1, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTML($signature, true, 0, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->SetFont('helvetica', 'B', 10);
$pdf->CheckBox('signature', 5, true, array(), array(), 'OK');
$pdf->writeHTMLCell(0, 0, '', '', $checkbox, 0, 1, 0, true, '', true);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->MultiCell(90, 0, $pourtopleft, 1, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 0, $pourtopright, 1, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('helvetica', '', 8);
$pdf->MultiCell(90, 0, $pourleft, 1, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 0, $pourright, 1, 'L', 1, 1, '', '', true, 0, false, true, 0);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->AddFont('../../../app-assets/data/tcpdf_min/fonts/Holligate.ttf','', '../../../app-assets/data/tcpdf_min/fonts/Holligate.php');
$pdf->SetFont('../../../app-assets/data/tcpdf_min/fonts/Holligate.ttf', '', 15);
$pdf->TextField('prestataire', 50, 10, array(), array(), '', '', false);
$pdf->MultiCell(90, 0, $sign, 0, 'R', 1, 1, '', '', true, 0, false, true, 0);

$pdf->AddPage();

// ---------------------------------------------------------

// Set some content to print
$preambule = 'Les prestations offertes par le prestataire peuvent être cumulatives ou alternatives dans la limite des prestations offertes par le prestataire. Les parties conviennent de leur étendue dans les conditions particulières qui figurent en annexe.';

$objet = 'Le contrat dont les conditions particulières figurent en annexe a pour objet la fourniture par le prestataire au bénéficiaire d\'un ensemble de services liés au travail de bureau.<br>
Les prestations offertes au bénéficiaire par le prestataire dans le cadre d\'une obligation de moyens sont les suivantes : domiciliation, mise à disposition provisoire et ponctuelle de bureaux et/ou d’espaces de réunion, et de services annexes, aux conditions tarifaires mentionnées en annexes.';

$dom = 'Les clauses 1.1 à 1.7 ne prennent effet qu’en cas de domiciliation fiscale ou légale de la société ou de son établissement sur le site précisé dans les conditions particulières.';

$pre = 'Le contrat de domiciliation est conclu conformément aux dispositions des articles L 123-11, L123-11-3, R 123-166-1 et suivants du Code de commerce que l’utilisateur déclare parfaitement connaître.<br>
Il permet à la société domiciliée de fixer, au regard du Tribunal de Commerce compétent, son domicile à l\'adresse du centre domiciliataire dont l\'adresse est indiquée aux conditions particulières. L’utilisateur devra également se conformer aux obligations de l’ordonnance n° 2009-104 du 30 janvier 2009 qu’il déclare parfaitement connaître.';

$dur = 'La date de prise d\'effet du présent contrat ainsi que sa durée initiale sont précisées dans les conditions particulières. Conformément aux dispositions de l’article R123-168 du Code de Commerce, elle ne peut être inférieure à 3 mois. Le renouvellement du présent contrat se fait par tacite reconduction.';

$prea = 'Au terme de la période initiale le présent contrat est résiliable à tout moment par lettre recommandée moyennant un préavis de 3 mois. Ce préavis courra à partir du 1er mois suivant la 1ère présentation de la lettre recommandée.';

$pri = 'Le prix de la présente domiciliation est fixé aux conditions particulières.<br>
Les prix des services, que l’Utilisateur reconnait avoir reçu en annexe du présent contrat, sont modifiables avec un préavis de 1 mois. Les prix des prestations décrites dans les conditions particulières du présent contrat, en particulier le sous total (A) Domiciliation pourront être révisés par le prestataire annuellement, avec un préavis de 1 mois. Le prestataire se réserve également la possibilité, en plus des révisions de prix décrites précédemment, de répercuter dans ses prix les conséquences des modifications éventuelles de la législation fiscale.';

$obl = 'Conformément à l’ordonnance n° 2009-104 du 30 janvier 2009 relative à la lutte contre le blanchiment de capitaux et le financement du terrorisme, le représentant légal de la société domiciliée remet ce jour au prestataire :<br>
    - une pièce d’identité du représentant légal de la société ou signataire du contrat identité<br>
    - un pouvoir du représentant légal (si différent du signataire du contrat)<br>
    - un justificatif de domicile du représentant légal (datant de moins de 3 mois)<br>
    - un justificatif des coordonnées téléphoniques (datant de moins de 3 mois)<br>
    - l’identité du bénéficiaire effectif tel que défini à l’article L.561-2-2 du Code monétaire et financier<br>
    - une copie du Relevé d’Identité Bancaire (RIB) de la société (ou du gérant si la société n’a pas encore été créée)<br>
    - une copie certifiée conforme et à jour des statuts de ladite société<br>
    - une procuration postale signée<br>
    - une attestation signée du lieu de conservation des pièces comptables et sociales<br>
Il s\'engage à remettre au prestataire dans les deux mois au plus tard des présentes : un extrait Kbis.<br>
A date anniversaire du contrat et/ou à chaque modification, l’utilisateur s\'engage à remettre au prestataire un nouveau Kbis (datant de moins de trois mois). Sans réception de ce nouvel extrait K-Bis, le prestataire se réserve la possibilité de le commander et de le facturer à l’utilisateur.<br>
De même, il est dans les obligations de l’utilisateur d’informer immédiatement le prestataire de toute modification liée aux conditions de fonctionnement de son entreprise (activité, mandat social, siège social, lieu de situation de ses pièces sociales et comptables, adresse de réexpédition du courrier, identification des personnes habilitées à venir chercher le courrier, etc.).
L’utilisateur s’engage à utiliser effectivement et exclusivement les locaux mis à sa disposition, soit comme siège de l’entreprise, soit, si le siège est situé à une autre adresse en France ou à l’étranger, comme agence, succursale ou représentation.<br>
L’utilisateur donne mandat au prestataire de recevoir en son nom toute notification.<br>
Le représentant légal de la société domiciliée autorise d\'ores et déjà et de façon définitive au prestataire à remettre les différents documents plus hauts cités aux organismes autorisés par la loi à en requérir copie.';

$pres = 'Selon le centre où il se trouve, l’utilisateur a accès aux services tels que : permanence téléphonique, prise de messages, service courrier, secrétariat, reprographie, télécopie, restauration, parking, etc. Cependant, si l’utilisateur met en place une action commerciale impliquant une opération publicitaire pouvant entraîner une surcharge importante du courrier ou du nombre d’appels reçus par le prestataire, l’utilisateur doit préalablement en informer le prestataire afin d’obtenir son accord, la faisabilité et le coût de cette action.';

$odp = 'Le prestataire met à la disposition de l’utilisateur des locaux permettant une réunion régulière des organes chargés de la direction, de l’administration ou de la surveillance de l’entreprise et l’installation des services nécessaires à la tenue, à la conservation et à la consultation des livres, registres et documents prescrits par les lois et règlements.<br>
Ces locaux seront facturés selon leur utilisation et selon le tarif en vigueur au jour de l’utilisation.';

// Print text
$pdf->SetFont('helvetica', '', 13);
$pdf->Cell(0, 0, 'Conditions générales', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, 'PREAMBULE', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $preambule, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, 'OBJET', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $objet, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1. DOMICILIATION', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $dom, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.1. PRELIMiNAIRE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $pre, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.2. DUREE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $dur, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.3. PREAVIS :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $prea, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.4. PRIX :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $pri, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.5. OBLIGATIONS A LA CHARGE DE L\'UTILISATEUR DOMICILIE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $obl, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.6. PRESTATION DE SERVICES :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $pres, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.7. OBLIGATIONS DU PRESTATAIRE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $odp, 0, 1, 0, true, '', true);

$pdf->AddPage();

// ---------------------------------------------------------

// Set some content to print
$fin = 'A l’expiration du présent contrat, le prestataire informera le Greffe du Tribunal de Commerce compétent de la fin de ce contrat.<br>
La société domiciliée autorise le prestataire dès à présent à informer le Registre du Tribunal de Commerce compétent de ce que la société utilisatrice n\'aura plus son siège social ou son établissement dans les locaux du prestataire. Dès la fin du contrat l\'Utilisateur s\'engage expressément à accomplir toutes les formalités nécessaires au transfert juridique, administratif, commercial, téléphonique et postal, à une autre adresse, de l\'activité du commerce, du siège social ou de l\'établissement exploité dans les lieux occupés. Dans les deux mois de son départ effectif des lieux, l\'utilisateur devra avoir communiqué au prestataire un Kbis justifiant de sa nouvelle adresse et de son nouveau siège social.<br>
A défaut, le prestataire pourra s\'adresser au juge des référés compétent pour obtenir, sous astreinte, que la société utilisatrice soit contrainte de changer son siège social et cesse l’usage de tous services accessoires. De convention expresse le prestataire est autorisé à conserver le dépôt de garantie prévu à l\'entrée dans les lieux jusqu\'à justification du transfert d\'adresse ou de siège social.';

$ass = 'Il appartient à l’utilisateur, sous sa seule responsabilité, de souscrire une assurance de responsabilité civile professionnelle dont il devra justifier au prestataire à la première demande.<br>
L\'utilisateur a l\'obligation d’assurer auprès d’une compagnie d’assurance notoirement solvable :<br>
A ) Les biens lui appartenant ou qui lui sont confiés lorsqu’ils sont à l’intérieur des locaux objets de la présente convention, contre les risques d’incendie, d’explosion, de foudre, de dégât des eaux, de dommages électriques, de tempêtes, ouragan, grêle, neige, de vol, d’attentats, de bris de machine.<br>
B) Sa responsabilité civile (y compris suite à incendie, explosion et dégât des eaux) tant vis-à-vis du prestataire que du propriétaire ou des occupants de l’immeuble et/ou des tiers et/ou des voisins.';

$resp = 'L’utilisateur renonce expressément à tout recours en responsabilité contre le prestataire :<br>
a) en cas de vol, cambriolage ou tout acte criminel ou délictueux dont l\'Utilisateur, ses préposés ou les tiers pourraient être victimes dans les locaux mis à sa disposition ou les dépendances de l\'immeuble.<br>
b) au cas où les locaux viendraient à être détruits en totalité ou en partie, pour quelques causes que ce soient, le présent contrat étant alors résilié de plein droit et sans indemnité pour l\'Utilisateur. Dans ce cas, le prestataire fera ses meilleurs efforts pour rétablir ses services à ses clients, éventuellement à une adresse provisoire.<br>
c) en cas de troubles apportés à la jouissance de l\'utilisateur par la faute de tiers, quelle que soit leur qualité, l\'utilisateur devant agir directement contre eux sans pouvoir mettre en cause le prestataire.<br>
d) en cas de perte, vol ou dégradation de plis ou d’objets remis au prestataire pour compte de l’Utilisateur, ce dernier autorisant le prestataire à recevoir ces objets. Pour des raisons de sécurité, la valeur unitaire de ces colis ne pourra excéder 500 €. Il appartient à l’utilisateur de prévoir la présence d’un membre de son équipe lors de la réception des colis. Le prestataire facturera la garde de ces objets au tarif en vigueur, au-delà d’une journée de livraison.';

$pai = 'Le règlement des factures de prestation s\'effectue à réception de facture, et suivant le mode de règlement prévu aux conditions particulières. A défaut de paiement des factures de prestations d\'occupation, ou de prestations de services (téléphone, photocopies ou autres prestations) au plus tard cinq jours ouvrés après l\'émission de la facture, et 48 heures après l\'envoi d\'une lettre recommandée, le prestataire se réserve la faculté de suspendre immédiatement ses prestations de services sans préjudice des dispositions contenues dans la clause résolutoire ci-après et d\'entreprendre toutes actions judiciaires.<br>
En outre, un intérêt de retard de 1% par mois sera porté sur la facture suivante, et avec un minimum de 15 Euros, pour tout règlement n\'étant pas parvenu 5 jours ouvrés après la date de la facture. Conformément au décret n°2012-1115 du 2 octobre 2012, une indemnité forfaitaire de 40 € sera également facturée pour tout règlement n’étant pas parvenu 5 jours ouvrés après la date de la facture.';

$sus = 'La suspension de l\'ensemble des prestations n\'entraîne pas la résiliation du contrat, et particulièrement pas de la domiciliation qui ne peuvent intervenir que par le jeu de la clause résolutoire. En cas de suspension du droit d\'occupation et autres prestations, les effets, documents et autres objets de l\'utilisateur seront entreposés par le prestataire aux frais et risques de l\'Utilisateur, et tenus à sa disposition.';

$cla = 'Il est expressément convenu qu\'à défaut de paiement d\'une seule facture de prestation de domiciliation ou de remboursement de frais, charges et prestations diverses, tels qu\'ils peuvent être prévus aux conditions particulières du présent contrat ou en annexe au présent contrat et qui en constituent l\'accessoire ou du paiement d\'un rappel de majoration du coût de la prestation de domiciliation, ainsi qu\'en cas d\'inexécution d\'une seule des conditions du présent contrat et après l\'envoi d\'une lettre recommandée avec accusé de réception ou d\'un commandement ou d\'une sommation restés 10 jours calendaires infructueux, les présentes seront résiliées de plein droit, si bon semble au prestataire. Dans ce cas également, le dépôt de garantie restera acquis au prestataire, à titre de clause pénale irréductible sans préjudice de son droit au paiement des indemnités de prestation de domiciliation échues ou à paiement des indemnités de prestation de domiciliation échues ou à échoir, y compris le mois commencé au moment de la sortie des lieux et sous réserve de tous autres dus, droits et actions.<br>
En outre, le prestataire informera deux mois après la mise en demeure, commandement ou sommation, le registre du commerce compétent de ce que la société Utilisatrice n\'aura plus son siège dans les lieux loués. Enfin, le prestataire cessera, dans le même délai, la distribution du courrier destiné à l\'utilisateur, qui sera retourné avec la mention "n\'habite plus à l\'adresse indiquée".';

$dep = 'L\'utilisateur versera au plus tard à la date d’effet des présentes au prestataire un dépôt dont le montant est de 3 mois du sous-total A Domiciliation des conditions particulières.<br>
En aucun cas l\'utilisateur ne pourrait exiger que le prestataire impute les sommes versées à titre de dépôt au paiement de ses factures.<br>
Ce dépôt de garantie, non productif d\'intérêts ne sera remboursé à l\'utilisateur qu\'après expiration du présent contrat, déduction faite de toutes sommes dues au prestataire, et après présentation de l\'extrait du Registre du Commerce et des Sociétés portant mention du transfert de siège social, s\'il y a lieu, ainsi que du quitus fiscal délivré par le centre des Impôts de l\'utilisateur. Ce dépôt de garantie sera révisé à chaque révision de prix et selon le même taux.';


// Print text
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '1.8. FIN DE CONTRAT :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $fin, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '2. ASSURANCES :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $ass, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '2.1. RESPONSABILITE ET RECOURS :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $resp, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3. OBLIGATIONS DE L\'UTILISATEUR', 0, 1, 'L', 0, '', 1);
$pdf->Cell(0, 0, '3.1. PAIEMENT :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $pai, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.2. SUSPENSION DES PRESTATIONS :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $sus, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.3. CLAUSE RESOLUTOIRE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $cla, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.4. DEPOT DE GARANTIE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $dep, 0, 1, 0, true, '', true);

$pdf->AddPage();

// ---------------------------------------------------------

// Set some content to print
$pers = 'L\'utilisateur s’interdit d’embaucher, pendant la durée du présent contrat et/ou 1 an après sa résiliation, tout salarié du prestataire ou de ses filiales.<br>
Dans le cas où l’utilisateur ne respecterait pas cette obligation, il s’engage à dédommager le prestataire en lui versant une indemnité forfaitaire et transactionnelle, égale à 6 mois de salaire brut du salarié embauché. Cette indemnité correspond au coût pour le prestataire du recrutement et à la formation d’un nouveau collaborateur ayant la même fonction.';

$com = 'L\'utilisateur autorise le prestataire à utiliser la raison sociale et les marques de l\'utilisateur comme référence client dans tout type de communication externe ou interne que le prestataire jugera bon de réaliser.';

$att = 'De convention expresse, il est convenu que seules les juridictions parisiennes seront compétentes en ce qui concerne les différends pouvant surgir relativement à ce contrat. Dans tous les cas, la loi française, seule, sera applicable.';

$protec = 'NOTA : Dans le présent article, les termes « nous » et « nos » signifient le prestataire tel que défini ci-dessus ; les termes « vous » et « vos » signifient l’utilisateur tel que défini ci-dessus.<br>
Pour toute question ou démarche relatives à vos données personnelles, nous vous invitons à contacter notre responsable de traitement des données (MULTIBURO SA) et notre délégué à la protection des données (M. Emmanuel CHAIZE) dont les coordonnées figurent sur notre site www.multiburo.com rubrique Politique de confidentialité.<br>
Si vous êtes une entreprise, nous vous demandons, en conformité avec l’article 14 du Règlement Européen tel que défini ci-après, de bien vouloir transmettre à vos collaborateurs bénéficiant de l’offre Multiburo la présente politique de confidentialité, également disponible sur www.multiburo.com.<br>
<br>
Conformément à la loi Informatique et Liberté du 6 janvier 1978 modifiée et au règlement européen 2016/679 du 27 avril 2016 (ci-après, « le Règlement Européen »), nous vous fournissons ci-après les informations requises au titre de l’article 13 du Règlement Européen.<br>
Dans le cadre de l’exécution du présent contrat de prestation de services et mise à disposition de bureau(x), nous sommes amenés à récolter des données à caractère personnel vous concernant ou concernant vos collaborateurs bénéficiant de notre offre, et ce afin de pouvoir mener à bien nos missions contractuelles. Ces données concernent principalement les nom, prénom, adresse, adresse e-mail, numéros de téléphone et les données de vidéosurveillance.<br>
Ce traitement de données personnelles réalisé au titre de la signature du présent contrat est fait conformément à l’article 6 du Règlement Européen ; ce traitement est nécessaire à l’exécution dudit contrat et a pour finalité la mise en oeuvre des prestations que vous nous confiez en nous permettant d’avoir dans notre documentation administrative et informatique vos coordonnées de contact et d’identification et celles de vos collaborateurs venant travailler dans nos centres d’affaires. Ces données nous permettent également de personnaliser l’ensemble des services prévus dans l’offre Multiburo à laquelle vous contractez (badge d’accès au(x) centre(s), connexion internet, téléphonie, scan to mail, etc.).<br>
Les destinataires ou catégories de destinataires des données à caractère personnel collectées au titre du présent contrat sont les collaborateurs du groupe Multiburo.<br>
Les données visées au paragraphe précédent sont conservées pendant toute la durée de votre relation contractuelle avec le groupe Multiburo ; à l’expiration de cette relation contractuelle, ces données sont conservées pour une durée supplémentaire de dix années pour nos archives et obligations légales et administratives.<br>
À tout moment, vous disposez du droit de demander au responsable de traitement, à savoir MULTIBURO SA, l’accès à vos données à caractère personnel, la rectification ou l’effacement de celles-ci ou une limitation de leur traitement, ou le droit de vous opposer au traitement, ou encore la portabilité de vos données. Ces droits sont exercés dans les cadres et limites du Règlement Européen.<br>
Nous précisons que nous pouvons ultérieurement être amenés à utiliser vos données à des fins de présentation de nos autres ou nouveaux services, d’envoi de notre newsletter, d’invitation à des évènements ou de toute autre communication susceptible de vous intéresser. Vous disposez dans ce cadre des droits énoncés au paragraphe précédent, et tout particulièrement d’un DROIT D’OPPOSITION.<br>
Le Règlement Européen vous permet d’introduire une réclamation auprès de l’autorité de contrôle compétente en la matière, qui est en France la CNIL à PARIS.';

// Print text
$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.5. PERSONNEL DU PRESTATAIRE :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $pers, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.6. COMMUNICATION :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $com, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '3.7. ATTRIBUTION DE JURIDICTION :', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $att, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', 'B', 8);
$pdf->Cell(0, 0, '4. PROTECTION DES DONNEES PERSONNELLES', 0, 1, 'L', 0, '', 1);
$pdf->SetFont('helvetica', '', 8);
$pdf->writeHTMLCell(0, 0, '', '', $protec, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$FaitA = $_POST['Fait_a'];

$pdf->writeHTMLCell(0, 0, '', '', 'Fait à :', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $FaitA, 0, 1, 0, true, '', true);
$pdf->Ln(2);

$pdf->writeHTMLCell(0, 0, '', '', 'Le :', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->MultiCell(90, 0, 'Pour le prestataire', 0, 'L', 1, 0, '', '', true, 0, false, true, 0);
$pdf->MultiCell(90, 10, 'Pour l\'utilisateur', 0, 'R', 1, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('../../../app-assets/data/tcpdf_min/fonts/Holligate.ttf', '', 15);
$pdf->TextField('prestataire2', 50, 10, array(), array(), '', '', false);
$pdf->MultiCell(125, 0, $sign, 0, 'R', 1, 1, '', '', true, 0, false, true, 0);

$pdf->AddPage();

// ---------------------------------------------------------

// Set some content to print
$soussigne = 'Je soussigné(e) '.$representant.'<br>
<br>
Agissant en qualité de '.$representantqualite.'<br>
<br>
Pour la société '.$raisonsociale.'<br>
<br>
Dont le siège social est '.$adresse.'';

$attest = 'Attestation sur l\'honneur :<br>
<br>
&nbsp;&nbsp;-&nbsp;&nbsp; Que la comptabilité et les factures de la société susnommée sont conservées à l’adresse suivante :';

$engage = '&nbsp;&nbsp;-&nbsp;&nbsp; Que je m’engage, en cas de vérification, à mettre ces documents à la disposition de l’administration à l’adresse de domiciliation, sous peine d’encourir les sanctions prévues à l’article L74 du livre des procédures fiscales en cas d’opposition à contrôle fiscal.';

$que = '&nbsp;&nbsp;-&nbsp;&nbsp; Que la société susnommée emploie des salariés et je tiens l’ensemble des documents obligatoires (Registre Unique du Personnel, double des bulletins de paie, récépissés de l’URSAFF des déclarations préalables à l’embauche, justificatif d’immatriculation au Registre du Commerce et des Sociétés ou au Répertoire des Métiers, fiches d’aptitude délivrées par les services de Santé du Travail, décompte de la durée du travail en cas d’horaires individuels de l’année en cours et de l’année précédente, contrats de travail et contrats de mise à disposition de travailleurs temporaires, liste des lieux de travail provisoires) à la disposition de la Direction Départementale du Travail et de l’Emploi à l’adresse suivante :';

$quebis = '&nbsp;&nbsp;-&nbsp;&nbsp; Que la société susnommée n’emploie pas de salariés';

$adressfacture = $_POST['adresse_factures'];
$adresssalarie = $_POST['adresse_salarie'];

// Print text
$pdf->Ln(10);
$pdf->SetFont('helvetica', '', 20);
$pdf->Cell(0, 0, 'Attestation', 0, 1, 'C', 0, '', 1);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', '', 10);
$pdf->writeHTMLCell(0, 0, '', '', $soussigne, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $attest, 0, 1, 0, true, '', true);
$pdf->Ln(2);
$pdf->writeHTMLCell(0, 0, '', '', $adressfacture, 0, 1, 0, true, '', true);
$pdf->Ln(5);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $engage, 0, 1, 0, true, '', true);
$pdf->Ln(5);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);


if ($_POST['salarie'] == 'emploie'){
$pdf->writeHTMLCell(0, 0, '', '', $que, 0, 1, 0, true, '', true);
$pdf->Ln(2);
$pdf->writeHTMLCell(0, 0, '', '', $adresssalarie, 0, 1, 0, true, '', true);
$pdf->Ln(5);
}
if ($_POST['salarie'] == 'pas_emploie'){
$pdf->writeHTMLCell(0, 0, '', '', $quebis, 0, 1, 0, true, '', true);
}


$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', 'Fait à :', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $FaitA, 0, 1, 0, true, '', true);
$pdf->Ln(2);

$pdf->writeHTMLCell(0, 0, '', '', 'Le :', 0, 1, 0, true, '', true);
$pdf->writeHTMLCell(0, 0, '', '', $date, 0, 1, 0, true, '', true);
$pdf->Ln(4);

$pdf->SetFont('helvetica', 'B', 10);
$pdf->CheckBox('signature', 5, true, array(), array(), 'OK');
$pdf->writeHTMLCell(0, 0, '', '', 'J\'ai lu et j\'accepte les conditions générales', 0, 1, 0, true, '', true);

$pdf->writeHTMLCell(0, 0, '', '', $br, 0, 1, 0, true, '', true);

$pdf->SetFont('helvetica', '', 10);
$pdf->MultiCell(147, 10, 'Signature', 0, 'R', 1, 1, '', '', true, 0, false, true, 0);
$pdf->SetFont('../../../app-assets/data/tcpdf_min/fonts/Holligate.ttf', '', 15);
$pdf->MultiCell(145, 0, $sign, 0, 'R', 1, 1, '', '', true, 0, false, true, 0);


// ---------------------------------------------------------

// Close and output PDF document
ob_clean();
$dir = realpath(__DIR__ . '/../../..');
$file_name = 'contrat_domiciliation_idcrea'.$id_crea.'_date-'.date("H-i-s").'.pdf';
$pdf->Output($dir.'/src/crea_societe/justificatifss/'.$file_name, 'F');

//============================================================+
// END OF FILE
//============================================================+
require_once 'php/verif_session_crea.php';
require_once 'php/config.php';
$update = $bdd->prepare('UPDATE crea_societe SET doc_justificatifss = ? WHERE id = ?');
$update->execute(array( ($file_name), $id_crea  ));

header('Location: creation-view-morale-justificatifss');

?>