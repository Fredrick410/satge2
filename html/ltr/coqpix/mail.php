<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

function email($mail)
{
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'localhost';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = false;                                   //Enable SMTP authentication                              //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('hr@coqpix.com', 'Ressources humaines Coqpix');
        $mail->addAddress($mail['adresse'], $mail['nom'] . " " . $mail['prenom']);     //Add a recipient

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mail['sujet'];
        $mail->Body    = $mail['message'];
        $mail->AltBody = str_replace("<br>", "\n", $mail['message']);

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

$message = "Bonjour BELLO Abdoul Koudous,<br><br>
        Bravo pour ce premier pas et merci de l’intérêt que vous nous portez.<br><br>
        Votre candidature au poste de Developpeur Web a bien été enregistrée.<br><br>
        Notre équipe de recruteurs va l’étudier avec beaucoup d’attention. Nous ne manquerons pas de vous contacter rapidement si votre profil correspond à nos attentes.<br><br>
        A bientôt !<br><br>
        La Direction des Ressources Humaines.<br><br>
        UC-391";

$mail = [
    'nom' => "BELLO",
    'prenom' => "Abdoul Koudous",
    'adresse' => "belloabdoul@gmail.com",
    'sujet' => "Votre candidature au poste de Developpeur Web",
];

//email($mail);
