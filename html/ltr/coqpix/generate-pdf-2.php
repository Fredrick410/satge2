<?php

error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'php/config.php';
require_once 'php/verif_session_crea.php';

require_once('../../../app-assets/data/tcpdf_min/tcpdf.php');
$certificate = "../../../app-assets/data/tcpdf_min/config/cert/tcpdf.crt";

$pdoSta = $bdd->prepare('SELECT * FROM crea_societe WHERE id=:num');
$pdoSta->bindValue(':num',$_SESSION['id_crea'], PDO::PARAM_INT);
$pdoSta->execute();
$info = $pdoSta->fetch();

$today = date("d/m/y");

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

//contenu page 1
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
'.$info['name_crea'].'<br>
Ayant son siège social sis '.$info['adresse_diri'].', '.$info['ville_diri'].' '.$info['cp_diri'].'<br>
Immatriculée au RCS de '.$info['ville_diri'].' au numéro en cours d’immatriculation<br>
Représentée par '.$info['nom_diri'].' '.$info['prenom_diri'].', dûment habilité(e) à l\'effet des présentes,<br>
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
La société '.$info['name_crea'].' est une société ayant une activité dans le secteur '.$info['secteur_dactivite'].'. Elle a souhaité faire appel aux services du Prestataire, en tant que société gérant sa comptabilité, durant une durée indéterminée.<br>
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
$pdf->Ln(5);
$y = $pdf->getY();
$pdf->Cell(0, $y, 'Contrat de prestations de service (Langue : français)', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');

// get current vertical position
$y = $pdf->getY();

$pdf->SetFont('helvetica', '', 10);
// write 
$pdf->writeHTML($contenu, true, false, true, false, '');

$pdf->AddPage();

//contenu page 2
$contenu2 = '
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 1 - OBJET DU CONTRAT</span><br>
<br>
Dans le cadre d’une collaboration effective avec le Client, le Prestataire s\'engage à exécuter les prestations décrites à l\'article 2 du Contrat (ci-après « les Prestations »), en contrepartie du versement par le Client d’honoraires déterminées conformément aux dispositions de l’article 6.<br>
<br>
En fonction de ses besoins et pendant toute la durée du Contrat, le Client pourra faire appel au Prestataire, de manière discontinue, ce que ce dernier accepte.<br>
<br>
Le Client aura la pleine et entière propriété des rapports et documents de travail établis par le Prestataire au fur et à mesure de l\'exécution des prestations objets du Contrat.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 2 - NATURE ET ETENDUE DES PRESTATIONS</span><br>
<br>
Le Prestataire interviendra, à la demande du Client, sur des missions de comptabilité qui sont la gestion et le suivie comptable de la société '.$info['name_crea'].' tel que défini dans l’annexe aux présentes, et de déclarations fiscales par notamment la mise en place des déclarations de TVA, Impôts sur les sociétés et autres taxes et impôts.<br> 
<br>
Le client s’engage à déposer via scan sur la plateforme en ligne Coqpix avant tous les 10 du mois ses pièces comptables du mois précédent avec les éléments suivants :<br>

<span style="font-weight: bold; text-indent: 15px;"><br>
•	Relevés bancaires<br>
•	Factures d’achats<br>
•	Factures de vente (et suivie de caisse)<br>
</span><br>
Le <span style="font-weight: bold;">Prestataire</span> ne sera en aucun cas responsable des quelconques pénalités, majorations ou amendes si le client n’a pas respecté les conditions ci-dessus.<br> 
<br>
De plus le client s’engage à répondre dans un délai raisonnable aux différentes demandes faites sur le tchat de Coqpix ou téléphone par le <span style="font-weight: bold;">Prestataire</span>.<br> 
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 3 - OBLIGATIONS DES PARTIES</span><br>
<br>
<span style="font-weight: bold;">3.1</span>	Le Contrat étant conclu par le Client avec le Prestataire en considération de son expérience dans le domaine comptable et fiscal ainsi que de l\'expérience et des compétences techniques de ses associés et de son personnel dans ce domaine.<br> 
<br>
Cet engagement pris par le Prestataire constitue pour le Client une condition essentielle et déterminante sans laquelle il n\'aurait pas conclu le Contrat.<br>
<br>
<span style="font-weight: bold;">3.2</span>	Le client reste responsable de la bonne gestion de ses documents comptables ainsi que de sa gestion d’entreprise. Le prestataire ne serait tenu en aucun cas pour responsable si le client effectue une mauvaise gestion de son entreprise qui aurait des répercussions négatives sur sa tenue comptable et fiscale. Le client à la pleine responsabilité de son suivie fiscal. Le prestataire ne serait être tenu responsable des majorations, amendes ou pénalités de retard appliquées par l’administration fiscale, en effet c’est au client d’apporter les éléments comptables et fiscaux dans les délais. <br>
<br>
<span style="font-weight: bold;">3.3</span>	Le Prestataire apportera tous les soins et sa compétence professionnelle pour réaliser les Prestations. Il respectera les règles professionnelles et déontologiques applicables à ses missions. <br>
<br><br><br><br>
En outre, le Prestataire demeurera propriétaire des dossiers de travail qu’il aura lui-même constitué dans le cadre de l’exécution des Prestations ; toutefois, il garantit au Client un accès à ses dossiers de travail et s’engage, si le Client lui en fait la demande, à lui en communiquer une copie.<br>
<br>
<span style="font-weight: bold;">3.4</span>	Aucun lien de subordination n’existera entre le Client et le Prestataire, qui continuera à superviser son personnel. Le Prestataire rendra compte au Client de l’ensemble des diligences effectuées au titre des Prestations. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 4 - RELATIONS ENTRE LES PARTIES</span><br>
<br>
Les Parties déclarent et reconnaissent qu’elles sont et demeureront, pendant toute la durée du Contrat, des partenaires professionnels indépendants, assumant chacun les risques de sa propre exploitation, et s’engagent à se présenter comme tels à l’égard des tiers. <br>
<br>
Ainsi, le personnel du Prestataire affecté à l’exécution des Prestations reste en toutes circonstances sous le contrôle administratif et la seule autorité hiérarchique et disciplinaire du Prestataire pendant toute la durée des Prestations.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 5- ASSURANCES ET RESPECT DE LA REGLEMENTATION</span><br>
<br>
Le Prestataire déclare respecter l\'ensemble des réglementations qui lui sont applicables, notamment celles relatives à la fiscalité et à son assurance professionnelle. Le Prestataire déclare également n\'être sous le coup d\'aucune interdiction d\'exercer et être en règle au regard des instances professionnelles dont il relève. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 6 - REMUNERATION DU PRESTATAIRE</span><br>
<br>
En contrepartie des Prestations rendues par le Prestataire, et conformément à la pratique de la profession, le Client paiera au Prestataire des honoraires définis en euros par mensualité suivant le tarif de la prestation annuel défini comme tel :<br>
<span style="text-indent: 15px;"><br>
•	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; € H.T/mois<br>
</span><br>
Ces honoraires seront payables par prélèvement avant le 10 du mois. En cas de non-paiement à son échéance d’une facture, les sommes restantes dues porteront intérêt à compter de ladite échéance un taux égal à 10% du montant par échéance et ce jusqu’au paiement intégral. Dans le cas où le client n’aurait toujours pas honoré son obligation de paiement après relances du prestataire, ce dernier pourra bloquer l’accès aux données du client jusqu’au complet paiement. <br>
<br>
Les factures seront émises par le Prestataire selon un échéancier convenu d’un commun accord avec le Client. <br>
<br>
Le montant des honoraires versés au Prestataire s\'entend hors taxes.<br>
<br>
Dans l\'exercice des Prestations, si le Prestataire est conduit à engager des frais professionnels, ceux-ci seront couverts par le Client dans les limites raisonnablement nécessaires à la mission. Leur montant fera l\'objet d\'un remboursement a posteriori sur présentation de justificatifs.<br>
<br>
<br><br><br><br><br><br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 7 - INDEPENDANCE - SECRET PROFESSIONNEL - CONFIDENTIALITE</span><br>
<br>
<span style="font-weight: bold;">7.1</span> Le Prestataire s\'engage à l’égard du Client à respecter l’intégralité des règles déontologiques applicables en Espagne aux professions comptables, notamment les règles relatives au secret professionnel.<br>
<br>
<span style="font-weight: bold;">7.2 Secret professionnel</span><br>
Le Prestataire, ses associés et les membres de son personnel affectés à l’exécution des Prestations sont, en tant que prestataire du Client, tenus et astreints au secret professionnel, au regard des informations obtenues dans l’exécution des Prestations. <br>
<br>
Le Prestataire s’engage à ne pas divulguer à un tiers, tant pendant la durée du Contrat qu’après sa terminaison pour quelque raison que ce soit, les renseignements ou documents de toute nature sur le Client ou sur les Clients Finaux, dont il aura eu connaissance à l’occasion du Contrat (ci-après « les Informations Confidentielles »). <br>
Constituent des Informations Confidentielles toutes les informations, données, documents de toute natures communiqués, pour les besoins du présent Contrat, par tout moyen, et notamment par écrit, par voie électronique et incluant, sans restriction tous secrets commerciaux, business plans, stratégies, plans marketing, comptes rendus de réunion, que ces informations soient ou non protégeables au titre de la propriété intellectuelle.<br>
<br>
Ne sont cependant pas considérés comme étant des Informations Confidentielles celle qui sont entrées dans le domaine public préalablement à leur divulgation ou postérieurement à celle -ci, sans qu’une obligation du présent article n’ait été violé ; ou ont été reçues de tiers de manière licite sans restriction ni violation du présent article.<br>
<br>
<span style="font-weight: bold;">7.3 Protection des Informations Confidentielles. </span><br>
Le Prestataire s’engage à ce que les informations confidentielles communiquées par le Client dans le cadre du présent contrat : <br>
<span style="text-indent: 15px;"><br>
•	soient protégées et gardées strictement confidentielles et ne soient pas divulguées directement ou<br> indirectement à des tiers, sauf sur injonction d’un Tribunal ou d’une Administration ;<br>
<br>
•	ne soient pas reproduites, copiées, dupliquées totalement ou partiellement sans le consentement exprès et<br> préalable du Client. <br>
</span><br>
Il s’engage également à ce que les membres de son personnel respectent les dispositions visées ci-dessous. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 8 - DUREE DU CONTRAT</span><br>
<br>
Le Contrat est conclu pour une durée indéterminée et prendra effet à compter de la date de signature du présent contrat. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 9 - RESILIATION ANTICIPEE DU CONTRAT</span><br> 
<br>
<span style="font-weight: bold;">9.1</span> En cas de violation par l\'une des Parties de l\'une quelconque des obligations résultant du Contrat, il est expressément convenu que huit (8) jours après une simple mise en demeure adressée par lettre recommandée avec demande d\'avis de réception, demeurée sans effet et mentionnant l\'intention de résilier le Contrat, la Partie non fautive aura le droit de résilier de plein droit le Contrat aux torts et griefs de la Partie défaillante sans préjudice de tous dommages et intérêts qu\'elle pourrait réclamer à la Partie défaillante.<br>
<br><br><br><br><br><br><br>
<span style="font-weight: bold;">9.2</span> En cas de terminaison du Contrat, pour quelque cause que ce soit, le Prestataire s\'engage, à première demande, à restituer intégralement au Client tous les documents, fichiers et matériels qui lui auront été communiqués et mis à disposition dans le cadre de l\'exécution des Prestations. Le Prestataire est autorisé à conserver une copie des documents dans le cas où la réglementation professionnelle espagnole l\'autorise à conserver une telle copie.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 10 - TRANSMISSION DU PRESENT CONTRAT</span><br>
<br>
Le Contrat est conclu intuitu personae avec le Prestataire.<br>
<br>
Le Contrat peut être cessible, et transmissible, à quelque titre que ce soit ou sous quelque modalité que ce soit, par le Prestataire sauf accord écrit préalable du Client.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 11 - MODIFICATIONS - NULLITE PARTIELLE – NOTIFICATIONS</span><br>
<br>
<span style="font-weight: bold;">11.1</span> Le Contrat ne peut être modifié que par accord écrit et exprès des parties. Toute modification sera formalisée dans un avenant écrit, dûment signé par les parties. Cet avenant sera alors considéré comme formant partie du Contrat.<br>
<br>
<span style="font-weight: bold;">11.2</span> Si l\'une quelconque des stipulations du Contrat était nulle ou inapplicable, en partie ou en totalité, les autres stipulations du Contrat continueraient à s\'appliquer. En outre, les parties s\'engagent, lors de négociations de bonne foi, à remplacer les stipulations inapplicables ou nulles par d\'autres stipulations dont les effets seront comparables. Le défaut par l\'une des parties de parvenir au remplacement des stipulations nulles ou inapplicables n\'affectera ni la validité des dispositions restantes ni la partie valide d\'une stipulation en partie invalide qui prendra effet dans la mesure de ce qui est autorisé par la loi.<br>
<br>
<span style="font-weight: bold;">11.3</span> Toutes notifications entre les Parties seront faites par lettre recommandée avec avis de réception à l\'adresse de la Partie destinataire ci-après mentionnée ou à toute autre adresse notifiée dans les conditions précitées, tout délai courant du jour de la première présentation de ladite lettre, les indications des postes faisant foi, ou en cas d\'interruption du service postal, de la réception de ladite lettre par tout moyen utile, tout délai courant du jour de réception de ladite lettre.<br>
<br>
<br>
<span style="text-decoration: underline;">Notification adressée au Client</span> : à son adresse mentionnée à la première page du Contrat.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 12 - LOI APPLICABLE - ATTRIBUTION DE COMPETENCE</span><br>
<br>
Le Contrat est soumis et interprété conformément au droit Espagnol.<br>
<br>
Tout litige concernant l\'interprétation, la validité, l\'exécution du Contrat et/ou des opérations qui en seront la suite et/ou la conséquence sera en premier lieu, résolue par voie de conciliation et en cas d\'échec, de médiation ou d’arbitrage puis soumis à la compétence exclusive des tribunaux compétents du ressort du <span style="font-weight: bold;">Tribunal de Commerce de Barcelone</span> et de la <span style="font-weight: bold;">Cour d\'appel de Barcelone</span>.<br>
<br>
<br><br><br><br><br><br><br><br>
Fait à Barcelone, le '.$today.'.<br>
<br>
En deux exemplaires originaux dont un pour chaque Partie. <br>
<br>
';

$left = '<span style="font-weight: bold;">Pour le Prestataire</span>';

$right = '<span style="font-weight: bold;">Pour le Client</span>';

// get current vertical position
$pdf->Ln(15);

// write 
$pdf->writeHTML($contenu2, true, false, true, false, '');

$y = $pdf->getY();
$pdf->writeHTMLCell(90, '', '', $y, $left, 0, 0, 1, true, 'C', true);
$pdf->writeHTMLCell(90, '', '', '', $right, 0, 1, 1, true, 'C', true);
$y = $pdf->getY();
$pdf->Image(K_PATH_IMAGES.'../../../app-assets/images/pages/sign.png', 30, $y+10, '', 20, 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
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