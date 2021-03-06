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
        // set bacground image
        $img_file = K_PATH_IMAGES.'../../../app-assets/images/pages/specimen.png';
        $this->Image($img_file, 15, 10, 235, 350, '', '', '', false, 300, '', false, false, 0);
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
$pdf->SetTitle('Contrat de prestations de service');
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
<span style="font-weight: bold;">AUDIT ACTION PLUS SLU</span>, inscrite au tableau de l\'ordre de l\'AECA (Asociaci??n Espa??ola de Contabilidad y Administraci??n de Empresas) de Barcelone.<br>
<br>
Ayant son si??ge social sis Calle Floridablanca 98 entresuelo 2, Barcelona 08015<br>
<br>
Num??ro d\'immatriculation CIF: B66713520<br>
<br>
Repr??sent??e par Monsieur MOUFEKKIR Karim, d??ment habilit?? ?? l\'efffet des pr??sentes,<br>
<br>
<br>
Ci-apr??s d??nomm??e <span style="font-weight: bold;">?? Le prestataire ??</span><br>
<span style="text-decoration: underline; font-weight: bold;">D\'UNE PART,</span><br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ET</span><br>
<br>
<br>
'.$info['name_crea'].'<br>
Ayant son si??ge social sis '.$info['adresse_entreprise'].', '.$info['ville_entreprise'].' '.$info['cp_entreprise'].'<br>
Immatricul??e au RCS de '.$info['ville_entreprise'].' au num??ro en cours d???immatriculation<br>
Repr??sent??e par '.$info['nom_diri'].' '.$info['prenom_diri'].', d??ment habilit??(e) ?? l\'effet des pr??sentes,<br>
<br>
<br>
Ci-apr??s d??nomm??e <span style="font-weight: bold;">?? Le client ??</span><br>
<span style="text-decoration: underline; font-weight: bold;">D\'AUTRE PART,</span><br>
<br>
<br>
Ci-apr??s d??nomm??es individuellement <span style="font-weight: bold;">?? la Partie ??</span> et collectivement <span style="font-weight: bold;">?? les Parties ??</span>.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">IL A ETE PREALABLEMENT EXPOSE CE OUI SUIT :</span><br>
<br>
La soci??t?? '.$info['name_crea'].' est une soci??t?? ayant une activit?? dans le secteur '.$info['secteur_dactivite'].'. Elle a souhait?? faire appel aux services du Prestataire, en tant que soci??t?? g??rant sa comptabilit??, durant une dur??e ind??termin??e.<br>
<br>
Par le pr??sent contrat (ci-apr??s ?? le Contrat ??), les Parties ont entendu d??finir les conditions selon lesquelles elles coop??reront.<br>
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
$pdf->Cell(0, $y, 'Contrat de prestations de service (Langue : fran??ais)', 0, 1, 'C', 0, '', 1, false, $calign='T', $valign='M');

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
Dans le cadre d???une collaboration effective avec le Client, le Prestataire s\'engage ?? ex??cuter les prestations d??crites ?? l\'article 2 du Contrat (ci-apr??s ?? les Prestations ??), en contrepartie du versement par le Client d???honoraires d??termin??es conform??ment aux dispositions de l???article 6.<br>
<br>
En fonction de ses besoins et pendant toute la dur??e du Contrat, le Client pourra faire appel au Prestataire, de mani??re discontinue, ce que ce dernier accepte.<br>
<br>
Le Client aura la pleine et enti??re propri??t?? des rapports et documents de travail ??tablis par le Prestataire au fur et ?? mesure de l\'ex??cution des prestations objets du Contrat.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 2 - NATURE ET ETENDUE DES PRESTATIONS</span><br>
<br>
Le Prestataire interviendra, ?? la demande du Client, sur des missions de comptabilit?? qui sont la gestion et le suivie comptable de la soci??t?? '.$info['name_crea'].' tel que d??fini dans l???annexe aux pr??sentes, et de d??clarations fiscales par notamment la mise en place des d??clarations de TVA, Imp??ts sur les soci??t??s et autres taxes et imp??ts.<br> 
<br>
Le client s???engage ?? d??poser via scan sur la plateforme en ligne Coqpix avant tous les 10 du mois ses pi??ces comptables du mois pr??c??dent avec les ??l??ments suivants :<br>

<span style="font-weight: bold; text-indent: 15px;"><br>
???	Relev??s bancaires<br>
???	Factures d???achats<br>
???	Factures de vente (et suivie de caisse)<br>
</span><br>
Le <span style="font-weight: bold;">Prestataire</span> ne sera en aucun cas responsable des quelconques p??nalit??s, majorations ou amendes si le client n???a pas respect?? les conditions ci-dessus.<br> 
<br>
De plus le client s???engage ?? r??pondre dans un d??lai raisonnable aux diff??rentes demandes faites sur le tchat de Coqpix ou t??l??phone par le <span style="font-weight: bold;">Prestataire</span>.<br> 
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 3 - OBLIGATIONS DES PARTIES</span><br>
<br>
<span style="font-weight: bold;">3.1</span>	Le Contrat ??tant conclu par le Client avec le Prestataire en consid??ration de son exp??rience dans le domaine comptable et fiscal ainsi que de l\'exp??rience et des comp??tences techniques de ses associ??s et de son personnel dans ce domaine.<br> 
<br>
Cet engagement pris par le Prestataire constitue pour le Client une condition essentielle et d??terminante sans laquelle il n\'aurait pas conclu le Contrat.<br>
<br>
<span style="font-weight: bold;">3.2</span>	Le client reste responsable de la bonne gestion de ses documents comptables ainsi que de sa gestion d???entreprise. Le prestataire ne serait tenu en aucun cas pour responsable si le client effectue une mauvaise gestion de son entreprise qui aurait des r??percussions n??gatives sur sa tenue comptable et fiscale. Le client ?? la pleine responsabilit?? de son suivie fiscal. Le prestataire ne serait ??tre tenu responsable des majorations, amendes ou p??nalit??s de retard appliqu??es par l???administration fiscale, en effet c???est au client d???apporter les ??l??ments comptables et fiscaux dans les d??lais. <br>
<br>
<span style="font-weight: bold;">3.3</span>	Le Prestataire apportera tous les soins et sa comp??tence professionnelle pour r??aliser les Prestations. Il respectera les r??gles professionnelles et d??ontologiques applicables ?? ses missions. <br>
<br><br><br><br>
En outre, le Prestataire demeurera propri??taire des dossiers de travail qu???il aura lui-m??me constitu?? dans le cadre de l???ex??cution des Prestations ; toutefois, il garantit au Client un acc??s ?? ses dossiers de travail et s???engage, si le Client lui en fait la demande, ?? lui en communiquer une copie.<br>
<br>
<span style="font-weight: bold;">3.4</span>	Aucun lien de subordination n???existera entre le Client et le Prestataire, qui continuera ?? superviser son personnel. Le Prestataire rendra compte au Client de l???ensemble des diligences effectu??es au titre des Prestations. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 4 - RELATIONS ENTRE LES PARTIES</span><br>
<br>
Les Parties d??clarent et reconnaissent qu???elles sont et demeureront, pendant toute la dur??e du Contrat, des partenaires professionnels ind??pendants, assumant chacun les risques de sa propre exploitation, et s???engagent ?? se pr??senter comme tels ?? l?????gard des tiers. <br>
<br>
Ainsi, le personnel du Prestataire affect?? ?? l???ex??cution des Prestations reste en toutes circonstances sous le contr??le administratif et la seule autorit?? hi??rarchique et disciplinaire du Prestataire pendant toute la dur??e des Prestations.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 5- ASSURANCES ET RESPECT DE LA REGLEMENTATION</span><br>
<br>
Le Prestataire d??clare respecter l\'ensemble des r??glementations qui lui sont applicables, notamment celles relatives ?? la fiscalit?? et ?? son assurance professionnelle. Le Prestataire d??clare ??galement n\'??tre sous le coup d\'aucune interdiction d\'exercer et ??tre en r??gle au regard des instances professionnelles dont il rel??ve. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 6 - REMUNERATION DU PRESTATAIRE</span><br>
<br>
En contrepartie des Prestations rendues par le Prestataire, et conform??ment ?? la pratique de la profession, le Client paiera au Prestataire des honoraires d??finis en euros par mensualit?? suivant le tarif de la prestation annuel d??fini comme tel :<br>
<span style="text-indent: 15px;"><br>
???	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ??? H.T/mois<br>
</span><br>
Ces honoraires seront payables par pr??l??vement avant le 10 du mois. En cas de non-paiement ?? son ??ch??ance d???une facture, les sommes restantes dues porteront int??r??t ?? compter de ladite ??ch??ance un taux ??gal ?? 10% du montant par ??ch??ance et ce jusqu???au paiement int??gral. Dans le cas o?? le client n???aurait toujours pas honor?? son obligation de paiement apr??s relances du prestataire, ce dernier pourra bloquer l???acc??s aux donn??es du client jusqu???au complet paiement. <br>
<br>
Les factures seront ??mises par le Prestataire selon un ??ch??ancier convenu d???un commun accord avec le Client. <br>
<br>
Le montant des honoraires vers??s au Prestataire s\'entend hors taxes.<br>
<br>
Dans l\'exercice des Prestations, si le Prestataire est conduit ?? engager des frais professionnels, ceux-ci seront couverts par le Client dans les limites raisonnablement n??cessaires ?? la mission. Leur montant fera l\'objet d\'un remboursement a posteriori sur pr??sentation de justificatifs.<br>
<br>
<br><br><br><br><br><br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 7 - INDEPENDANCE - SECRET PROFESSIONNEL - CONFIDENTIALITE</span><br>
<br>
<span style="font-weight: bold;">7.1</span> Le Prestataire s\'engage ?? l?????gard du Client ?? respecter l???int??gralit?? des r??gles d??ontologiques applicables en Espagne aux professions comptables, notamment les r??gles relatives au secret professionnel.<br>
<br>
<span style="font-weight: bold;">7.2 Secret professionnel</span><br>
Le Prestataire, ses associ??s et les membres de son personnel affect??s ?? l???ex??cution des Prestations sont, en tant que prestataire du Client, tenus et astreints au secret professionnel, au regard des informations obtenues dans l???ex??cution des Prestations. <br>
<br>
Le Prestataire s???engage ?? ne pas divulguer ?? un tiers, tant pendant la dur??e du Contrat qu???apr??s sa terminaison pour quelque raison que ce soit, les renseignements ou documents de toute nature sur le Client ou sur les Clients Finaux, dont il aura eu connaissance ?? l???occasion du Contrat (ci-apr??s ?? les Informations Confidentielles ??). <br>
Constituent des Informations Confidentielles toutes les informations, donn??es, documents de toute natures communiqu??s, pour les besoins du pr??sent Contrat, par tout moyen, et notamment par ??crit, par voie ??lectronique et incluant, sans restriction tous secrets commerciaux, business plans, strat??gies, plans marketing, comptes rendus de r??union, que ces informations soient ou non prot??geables au titre de la propri??t?? intellectuelle.<br>
<br>
Ne sont cependant pas consid??r??s comme ??tant des Informations Confidentielles celle qui sont entr??es dans le domaine public pr??alablement ?? leur divulgation ou post??rieurement ?? celle -ci, sans qu???une obligation du pr??sent article n???ait ??t?? viol?? ; ou ont ??t?? re??ues de tiers de mani??re licite sans restriction ni violation du pr??sent article.<br>
<br>
<span style="font-weight: bold;">7.3 Protection des Informations Confidentielles. </span><br>
Le Prestataire s???engage ?? ce que les informations confidentielles communiqu??es par le Client dans le cadre du pr??sent contrat : <br>
<span style="text-indent: 15px;"><br>
???	soient prot??g??es et gard??es strictement confidentielles et ne soient pas divulgu??es directement ou<br> indirectement ?? des tiers, sauf sur injonction d???un Tribunal ou d???une Administration ;<br>
<br>
???	ne soient pas reproduites, copi??es, dupliqu??es totalement ou partiellement sans le consentement expr??s et<br> pr??alable du Client. <br>
</span><br>
Il s???engage ??galement ?? ce que les membres de son personnel respectent les dispositions vis??es ci-dessous. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 8 - DUREE DU CONTRAT</span><br>
<br>
Le Contrat est conclu pour une dur??e ind??termin??e et prendra effet ?? compter de la date de signature du pr??sent contrat. <br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 9 - RESILIATION ANTICIPEE DU CONTRAT</span><br> 
<br>
<span style="font-weight: bold;">9.1</span> En cas de violation par l\'une des Parties de l\'une quelconque des obligations r??sultant du Contrat, il est express??ment convenu que huit (8) jours apr??s une simple mise en demeure adress??e par lettre recommand??e avec demande d\'avis de r??ception, demeur??e sans effet et mentionnant l\'intention de r??silier le Contrat, la Partie non fautive aura le droit de r??silier de plein droit le Contrat aux torts et griefs de la Partie d??faillante sans pr??judice de tous dommages et int??r??ts qu\'elle pourrait r??clamer ?? la Partie d??faillante.<br>
<br><br><br><br><br><br><br>
<span style="font-weight: bold;">9.2</span> En cas de terminaison du Contrat, pour quelque cause que ce soit, le Prestataire s\'engage, ?? premi??re demande, ?? restituer int??gralement au Client tous les documents, fichiers et mat??riels qui lui auront ??t?? communiqu??s et mis ?? disposition dans le cadre de l\'ex??cution des Prestations. Le Prestataire est autoris?? ?? conserver une copie des documents dans le cas o?? la r??glementation professionnelle espagnole l\'autorise ?? conserver une telle copie.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 10 - TRANSMISSION DU PRESENT CONTRAT</span><br>
<br>
Le Contrat est conclu intuitu personae avec le Prestataire.<br>
<br>
Le Contrat peut ??tre cessible, et transmissible, ?? quelque titre que ce soit ou sous quelque modalit?? que ce soit, par le Prestataire sauf accord ??crit pr??alable du Client.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 11 - MODIFICATIONS - NULLITE PARTIELLE ??? NOTIFICATIONS</span><br>
<br>
<span style="font-weight: bold;">11.1</span> Le Contrat ne peut ??tre modifi?? que par accord ??crit et expr??s des parties. Toute modification sera formalis??e dans un avenant ??crit, d??ment sign?? par les parties. Cet avenant sera alors consid??r?? comme formant partie du Contrat.<br>
<br>
<span style="font-weight: bold;">11.2</span> Si l\'une quelconque des stipulations du Contrat ??tait nulle ou inapplicable, en partie ou en totalit??, les autres stipulations du Contrat continueraient ?? s\'appliquer. En outre, les parties s\'engagent, lors de n??gociations de bonne foi, ?? remplacer les stipulations inapplicables ou nulles par d\'autres stipulations dont les effets seront comparables. Le d??faut par l\'une des parties de parvenir au remplacement des stipulations nulles ou inapplicables n\'affectera ni la validit?? des dispositions restantes ni la partie valide d\'une stipulation en partie invalide qui prendra effet dans la mesure de ce qui est autoris?? par la loi.<br>
<br>
<span style="font-weight: bold;">11.3</span> Toutes notifications entre les Parties seront faites par lettre recommand??e avec avis de r??ception ?? l\'adresse de la Partie destinataire ci-apr??s mentionn??e ou ?? toute autre adresse notifi??e dans les conditions pr??cit??es, tout d??lai courant du jour de la premi??re pr??sentation de ladite lettre, les indications des postes faisant foi, ou en cas d\'interruption du service postal, de la r??ception de ladite lettre par tout moyen utile, tout d??lai courant du jour de r??ception de ladite lettre.<br>
<br>
<br>
<span style="text-decoration: underline;">Notification adress??e au Client</span> : ?? son adresse mentionn??e ?? la premi??re page du Contrat.<br>
<br>
<br>
<span style="text-decoration: underline; font-weight: bold;">ARTICLE 12 - LOI APPLICABLE - ATTRIBUTION DE COMPETENCE</span><br>
<br>
Le Contrat est soumis et interpr??t?? conform??ment au droit Espagnol.<br>
<br>
Tout litige concernant l\'interpr??tation, la validit??, l\'ex??cution du Contrat et/ou des op??rations qui en seront la suite et/ou la cons??quence sera en premier lieu, r??solue par voie de conciliation et en cas d\'??chec, de m??diation ou d???arbitrage puis soumis ?? la comp??tence exclusive des tribunaux comp??tents du ressort du <span style="font-weight: bold;">Tribunal de Commerce de Barcelone</span> et de la <span style="font-weight: bold;">Cour d\'appel de Barcelone</span>.<br>
<br>
<br><br><br><br><br><br><br><br>
Fait ?? Barcelone, le '.$today.'.<br>
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
//$pdf->Output('contrat', 'I');


$dir = realpath(__DIR__ . '/../../..');
$dir = $dir.'/src/crea_societe/contrat/';

if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

$file_name = 'contrat_coqpix_idcrea'.$info['id'].'_date-'.date("H-i-s").'.pdf';


    $pdf->Output($dir.$file_name, 'F');

//============================================================+
// END OF FILE
//============================================================+

require_once 'php/verif_session_crea.php';
require_once 'php/config.php';

    $update = $bdd->prepare('UPDATE crea_societe SET doc_contrat = ? WHERE id = ?');
    $update->execute(array( ($file_name), $info['id']  ));
    header('Location: page-creation');

?>