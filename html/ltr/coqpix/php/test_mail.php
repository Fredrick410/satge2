<?php
include "mail.php";
$message = "Bonjour,\n\n" .
"Vous venez de valider votre dépot de document. La prochaine etape est la réalisation du test prévu pour ce poste.\n\n" .
"Merci d'utiliser le lien suivant pour acceder au test: lien.\n\n" .
"Il est aussi disponible dans le cas ou vous souhaitez le faire plus tard et sera indisponible dès la finalisation de votre candidature.\n\n" .
"A bientôt !\n\n" .
"Service des Ressources Humaines.\n\n" .
"Envoyé par Coqpix.";

$sujet = 'Votre candidature pour le poste de test au sein de test.';

$mail = [
'nom_recepteur' => "Test",
'adresse_recepteur' => "test-cbwjeco48@srv1.mail-tester.com",
'nom_emetteur' => "Service des ressources humaines",
'adresse_emetteur' => "rh-noreply@". $_SERVER['SERVER_NAME'],
'sujet' => $sujet,
'message' => $message
];

$sent = email($mail);
if($sent){
    echo "Message envoye";
}
else {
    echo "Message non envoye";
}