<?php
function email($mail)
{
  $is_html = false;
  // Detect HTML markdown
  if (substr_count($mail['message'], '</') >= 1) {
    $is_html = true;
  }

  // Build recipient name <email> pair
  $recipient = '=?UTF-8?B?' . base64_encode($mail['nom_recepteur']) . '?= <' . $mail['adresse_recepteur'] . '>' . ' , =?UTF-8?B?' . base64_encode($mail['nom_emetteur']) . '?= <' . $mail['nom_emetteur'] . '>';

  // Build sender name <email> pair
  $sender = '=?UTF-8?B?' . base64_encode($mail['nom_emetteur']) . '?= <' . $mail['adresse_emetteur'] . '>';

  // Determine content type
  $content_type = 'text/plain';
  if ($is_html) {
    $content_type = 'text/html';
  }

  // Subject
  $subject = '=?UTF-8?B?' . base64_encode($mail['sujet']) . '?=';

  // Mail headers
  $header  = 'MIME-Version: 1.0' . "\r\n";
  $header .= 'Content-type: ' . $content_type . '; charset=utf-8' . "\r\n";
  $header .= 'Content-Transfer-Encoding: base64' . "\r\n";
  $header .= 'Date: ' . date('r (T)') . "\r\n";

  $header .= 'From: ' . $sender . "\r\n";
  $header .= 'Reply-To: ' . $sender . "\r\n";
  $header .= 'X-Mailer: PHP ' . phpversion();

  if (mail($recipient, $subject, base64_encode($mail['message']), $header)) {
    return true;
  } else {
    return false;
  }
}
