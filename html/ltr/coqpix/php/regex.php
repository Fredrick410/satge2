<?php

include 'config.php';
require_once 'config.php';

// fucntion verif name
function verif_alpha($str){
    preg_match("/([^A-Z])([a-z\s])/",$str,$result);
    if(!empty($result)){
      return false;
    }
    return true;
};
// function verif num
function verif_num($ntr){
    // use strlen if type number
    preg_match("/([^0-9\s])/",$ntr,$results);
    if(!empty($results)){
      return false;
    }
    return true;
};
// fucntion verif mail
function verif_mail($mtr){
    preg_match("/([a-z])([0-9])(@+)(\.+)/",$mtr, $results);
    if (!empty($results)){
        return false;
    }
    return true;
};
// function identify type of variable
function different_type($var) {
    // transforms variable into text + remove spaces
    $var1 = htmlspecialchars(str_replace(' ','',$var));

    if (verif_alpha($var1) === true) {return 1;}
    if (verif_num($var1) === true) {return 2;}
    if (verif_mail($var1) === true) {return 3;}
    // add if necessary

    return false;
};
// function send progress mail with link for resume the candidacy (en cours) pure théorique 
function progress_mail($progress, $mail_candidate, $num_candidacy) {

    if ($progress === 100) {

		$header = 'MINE-Version: 1.0\r\n';
		$header .= 'From:"[Coqpix]"<contact@auditactionplus.com>' . '\n';
		$header .= 'Content-Type:text/html; charset="utf-8"' . '\n';
		$header.='Content-Transfer-Encoding: 8bit';
		$mailconfirm='
			<html>
				<body>
					<div align="center">
                        <p>félicitation vôtre candidature a été complété avec succès !</p>
                        <p>'. $progress .'</p>
						// blablabla
					</div>
				</body>
			</html>
		';
	    mail($mail_candidate, "coqpix candidature", $mailconfirm, $header);
    } else {

        $header = 'MINE-Version: 1.0\r\n';
		$header .= 'From:"[Coqpix]"<contact@auditactionplus.com>' . '\n';
		$header .= 'Content-Type:text/html; charset="utf-8"' . '\n';
		$header.='Content-Transfer-Encoding: 8bit';
		$mailconfirm='
			<html>
				<body>
					<div align="center">
                        <p>Vous n\'avez pas terminé vôtre candiature !</p>
                        <p>'. $progress .'</p>
						<p>Pour continuer, merci d\'utiliser ce lien pour continuer</p>
                        <a>https://coqpix.fr/coqpix-master/html/ltr/coqpix/#.php?num=' . $num_candidacy . '?mail=urlencode(' . $mail_candidate . ')</a>
					</div>
				</body>
			</html>
		';
	    mail($mail_candidate, "coqpix candidature", $mailconfirm, $header);
    }
};



// function crypt key of reset
function crypt_mail($coq_mdp_crypt_mail, $size_of_key) {

    $key = generate_num_key($size_of_key);
    $hash = sha1($key);
    $result = crypt($coq_mdp_crypt_mail, $hash);
    $coq_table_mdp = [$result, $hash];

    return $coq_table_mdp;
};
// generate random num key
function generate_num_key($size_of_key) {

    $key = "";
    for ($i = 1; $i < $size_of_key; $i++) {
        $key .= mt_rand(0,9);
    }
    return $key;
};
// generate random alpha key
// $size_of_key = size of key num. because she uses the function generate_num_key
function generate_alpha_key($size_of_key) {

    $key = generate_num_key($size_of_key);
    $hash = sha1($key);

    return $hash;
};


function send_reset_mail($mail_user_reset, $random_key_reset) {

    $header = 'MINE-Version: 1.0\r\n';
	$header .= 'From:"[Coqpix]"<contact@auditactionplus.com>' . '\n';
	$header .= 'Content-Type:text/html; charset="utf-8"' . '\n';
	$header.='Content-Transfer-Encoding: 8bit';
	$mailconfirm='
		<html>
			<body>
				<div align="center">
                    <p>cliquer sur le lien pour reset vôtre mot de passe</p>
                    <a href="localhost/coqpix/html/ltr/coqpix/forget_password.php?key=' . $random_key_reset . '"
                    >localhost/coqpix/html/ltr/coqpix/forget-password.php?key=' . $random_key_reset . '</a>
				</div>
			</body>
		</html>
	';
	 mail($mail_user_reset, "coqpix reset MDP", $mailconfirm, $header);

};