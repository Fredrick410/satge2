<?php

require_once 'php/config.php';
 include 'php/regex.php';
for ($i = 0; $i < 6; $i++) {
    $bank = generate_num_key(2);
    if ($bank < 21)
    $result_candidate[$i] = $bank;
    else
    $i--;
}
session_start();

//$req_result_candidate = $bdd->prepare('SELECT * FROM result WHERE id_candidate = ?');
//$req_result_candidate->execute(array($_GET['candidate']));
//$result_candidate = $req_result_candidate->fetch(PDO ::FETCH_ASSOC);


$name_page = 'test result chart';
?>

<!DOCTYPE html>
<html class="loading" lang="fr" data-textdirection="ltr">
    <?php include 'includes/menus/head-front.php'; ?>
    <body>
    <header style="height: 100px; background-color: blue; text-align : center"><div class="spacer10" style="height: 10px;"></div><h1>COQPIX</h1></header>
    
    <!-- code captcha visuel -->
    <img src="php/captcha.php">
    <form method="POST">
        <input type="text" name="captcha" />
        <input type="submit" />
    </form>
    <p>
    <?php 
    if(isset($_POST['captcha'])) {
        if($_POST['captcha'] == $_SESSION['captcha']) {
           echo "Captcha bon";
        } else {
           echo "Captcha faux";
        }
    }
    ?>
    </p>

    <div align="center"><div style="width:20%; height: 20%;"><canvas id="myChart" width="100" height="100"></canvas></div></div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>

    var red = <?php echo $result_candidate[0] ?>;
    var blue = <?php echo $result_candidate[1] ?>;
    var green = <?php echo $result_candidate[2] ?>;
    var purple = <?php echo $result_candidate[3] ?>;
    var yellow = <?php echo $result_candidate[4] ?>;
    var orange = <?php echo $result_candidate[5] ?>;

    var ctx = document.getElementById('myChart').getContext('2d');
    var myChart = new Chart(ctx, {
    type: 'radar',
    data: {
        labels: ['Sympathie', 'Courage', 'Integre', 'Ambitieu', 'Réaliste', 'Sociable'],
        datasets: [{
            label: 'Notes',
            data: [red, blue, yellow, green, purple, orange],
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 2
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
    </script>

    <div style="height: 200px; background-color: black"></div>
    <div style="background-color: grey">
    <?php

    include 'php/config.php';

// recup les noms et les id dse tout les candidats
$req_name_candidat = $bdd->prepare('SELECT id, nom_candidat FROM rh_candidature');
$req_name_candidat->execute();
$name_candidat = $req_name_candidat->fetchAll(PDO::FETCH_ASSOC);
//var_dump($name_candidat); echo '<br><br>';
// $num_candidat = $req_name_candidat->rowCount();
// print_r($num_candidat); echo '<br><br>';
// crée un select avec le nom des candidats pour permettre à l'utilisateur de choisir
if (isset($name_candidat)){
    if (!isset($_POST['list_candidat'])) {

        echo '<form method="post" action="">';
            echo '<select name="list_candidat">';
                echo '<option value="none">choisir un candidat</option>';
                foreach ($name_candidat as $list_name) {
                    echo '<option value="' . $list_name['id'] . '">' . $list_name['nom_candidat'] . '</option>';
                }
            echo '</select>';
            echo '<input type="submit">';
        echo '</form>';
    }
    // recup les qcms du candidat via son id
    if (isset($_POST['list_candidat'])) {
        $_SESSION['id_candidat'] = $_POST['list_candidat'];
        // var_dump($_POST['list_candidat']); echo '<br><br>';
        $req_idqcm_candidat = $bdd->prepare('SELECT idqcm FROM reponses_qcm_candidat WHERE idcandidat = ?');
        $req_idqcm_candidat->execute(array($_POST['list_candidat']));
        $id_qcm_candidat = $req_idqcm_candidat->fetchAll(PDO::FETCH_ASSOC);
        // $num_qcm_candiadat = $req_idqcm_candidat->rowCount();
        // var_dump($id_qcm_candidat); echo '<br><br>';
        $id_qcm_candidats = array_unique($id_qcm_candidat);
        // print_r($id_qcm_candidats);

        if (count($id_qcm_candidat) != 0) {
            // recup le nom et l'id de tous les qcms du candidat via l'id du qcm
            for ($i = count($id_qcm_candidats); $i > 0 ; $i--) {
                $req_list_qcm = $bdd->prepare('SELECT id, libelle FROM qcm WHERE id = ?');
                $req_list_qcm->execute(array(intval($id_qcm_candidats[$i-1]['idqcm'])));
                $list_qcm = $req_list_qcm->fetchAll(PDO::FETCH_ASSOC);
            }
            // var_dump($list_qcm); echo '<br><br>';

            //echo '<h2>' . $n_candidat . '</h2>'; // a faire
            // creer un select pour que l'utilisateur choisise le qcm qu'il désire
            echo '<form method="post" action="">';
                echo '<select name="list_qcm_candidat">';
                    echo '<option value="none">choisir un qcm</option>';
                    foreach ($list_qcm as $key => $qcm) {
                        echo '<option value="' . $qcm['id'] . '>' . $qcm['libelle'] . '</option>"';
                    }
                echo '</select>';
                echo '<input type="submit">';
            echo '</form>';
        } else {
            echo '<h2>Le candidat n\'a pas fait de QCM</h2>';
        }
    }
    if (isset($_POST['list_qcm_candidat'])) {
        $_SESSION['qcm_candidat'] = $_POST['list_qcm_candidat'];
        // var_dump($_POST['list_qcm_candidat']); echo '<br><br>';
        // recupere l'id des questons bonne et le nombres de reponses bonne dans questions via l'id du candidat et l'id du qcm selectionné
        $req_rep_good = $bdd->prepare('SELECT rc.idquestion, count(*) FROM reponse as r INNER JOIN reponses_qcm_candidat as rc ON r.id = rc.idreponse 
                                    LEFT JOIN question as q ON q.id = rc.idquestion WHERE rc.idcandidat = ? AND rc.idqcm = ? AND rc.vrai_ou_faux = r.vrai_ou_faux 
                                    group by rc.id');
        $req_rep_good->execute(array($_SESSION['id_candidat'], $_SESSION['qcm_candidat']));
        $quest_good = $req_rep_good->fetchAll(PDO::FETCH_ASSOC);
        var_dump($quest_good); echo '<br><br>';
        $req_mv_rep = $bdd->prepare('SELECT points FROM question WHERE idqcm = ?');
        $req_mv_rep->execute(array($_SESSION['qcm_candidat']));
        $nb_mv_rep = $req_mv_rep->rowCount();
        $total_quest_pts = $req_mv_rep->fetchAll(PDO::FETCH_ASSOC);

        // sum of pts in qcm
        for ($z = 0; $z < count($nb_mv_rep); $z++) {
            $total+= intval($total_quest_pts[$z]['points']);
        }

        // recup points et etat des questions bonne
        for ($j = count($quest_good); $j > 0; $j--) {
            $req_pts_etat = $bdd->prepare('SELECT points, statu FROM question WHERE id = ?');
            $req_pts_etat->execute(array(intval($quest_good[$j-1]['idquestion'])));
            $final_result = $req_pts_etat->fetchAll(PDO::FETCH_ASSOC);
        }
        var_dump($final_result); echo '<br><br>';
        // repartie les points dans les différentes catégorie
        for ($k = 0; $k < count($final_result); $k++) {

            $total_b = intval($final_result[$k]['points']);

            if($final[$k]['statu'] === 'paraA') {
                $A += intval($final_result[$k]['points']);
            }
            if($final[$k]['statu'] === 'paraB') {
                $B += intval($final_result[$k]['points']);
            }
            if($final[$k]['statu'] === 'paraC') {
                $C += intval($final_result[$k]['points']);
            }
            if($final[$k]['statu'] === 'paraD') {
                $D += intval($final_result[$k]['points']);
            }
            if($final[$k]['statu'] === 'paraE') {
                $E += intval($final_result[$k]['points']);
            }
            if($final[$k]['statu'] === 'paraF') {
                $F += intval($final_result[$k]['points']);
            }
        }

        $result = (($total_b/$nb_mv_rep)/$nb_mv_rep)*20);
    }
} else {
    echo '<h2>il n\'y a pas de candidat</h2>';
}


    ?>
</div>
    </body>
    <?php include 'includes/menus/footer-front.php'; ?>

</html>