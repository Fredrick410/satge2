<?php

require_once 'config.php';

const HTTP_OK = 200;
const HTTP_BAD_REQUEST = 400;
const HTTP_METHOD_NOT_ALLOWED = 405;

if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) and $_SERVER['HTTP_X_REQUESTED_WITH'] == 'XMLHttpRequest') {

    $response_code = HTTP_BAD_REQUEST;
    $message = 'erreur dans la requete';

    if ($_POST['action'] == 'showData') {
        $response_code = HTTP_OK;
        $id_candidat = intval($_POST['id_candidat']);
        $qcm_candidat = intval($_POST['qcm_candidat']);
    
        $message = 'action valide !';

        if (isset($qcm_candidat) and isset($id_candidat)) {
            $req_rep_good = $bdd->prepare('SELECT rc.idquestion, count(*) FROM reponse as r INNER JOIN reponses_qcm_candidat as rc ON r.id = rc.idreponse 
                                LEFT JOIN question as q ON q.id = rc.idquestion WHERE rc.idcandidat = ? AND rc.idqcm = ? AND rc.vrai_ou_faux = r.vrai_ou_faux 
                                group by rc.id');
            $req_rep_good->execute(array($id_candidat, $qcm_candidat));
            $quest_good = $req_rep_good->fetchAll(PDO::FETCH_ASSOC);

            $req_mv_rep = $bdd->prepare('SELECT points FROM question WHERE idqcm = ?');
            $req_mv_rep->execute(array($qcm_candidat));
            $nb_mv_rep = $req_mv_rep->rowCount();
            $total_quest_pts = $req_mv_rep->fetchAll(PDO::FETCH_ASSOC);

            // sum of pts in qcm
            for ($z = 0; $z < $nb_mv_rep; $z++) {
                $total += intval($total_quest_pts[$z]['points']);
            }

            // recup points et etat des questions bonne
            for ($j = count($quest_good); $j > 0; $j--) {
                $req_pts_etat = $bdd->prepare('SELECT points, statu FROM question WHERE id = ?');
                $req_pts_etat->execute(array(intval($quest_good[$j - 1]['idquestion'])));
                $final_result[]= $req_pts_etat->fetchAll(PDO::FETCH_ASSOC);
            }

            $A=0;
            $B=0;
            $C=0;
            $D=0;
            $E=0;
            $F=0;
            // repartie les points dans les différentes catégorie
            for ($k = 0; $k < count($final_result); $k++) {
                // modifier les para par les vrais nom des categories
                $total_b = intval($final_result[$k]['points']);

                if ($final_result[$k][0]['statu'] === 'paramA') {
                    $A += intval($final_result[$k][0]['points']);
                }
                if ($final_result[$k][0]['statu'] === 'paramB') {
                    $B += intval($final_result[$k][0]['points']);
                }
                if ($final_result[$k][0]['statu'] === 'paramC') {
                    $C += intval($final_result[$k][0]['points']);
                }
                if ($final_result[$k][0]['statu'] === 'paramD') {
                    $D += intval($final_result[$k][0]['points']);
                }
                if ($final_result[$k][0]['statu'] === 'paramE') {
                    $E += intval($final_result[$k][0]['points']);
                }
                if ($final_result[$k][0]['statu'] === 'paramF') {
                    $F += intval($final_result[$k][0]['points']);
                }
            }

            //print("<pre>".print_r($final_result,true)."</pre>");

            $result = (($total_b / $nb_mv_rep) / $nb_mv_rep) * 20;

            $result_graph = [
                'result20' => $result,
                'parametre' => [
                    'A' => $A,
                    'B' => $B,
                    'C' => $C,
                    'D' => $D,
                    'E' => $E,
                    'F' => $F
                ]
            ];
        }
        response($response_code, $message, $result_graph);
    }
} else {

    $response_code = HTTP_METHOD_NOT_ALLOWED;
    $message = 'Method Not Allowed';
}

function response($response_code, $message, $result_graph_ajax)
{
    header('Content-Type: application/json');
    http_response_code($response_code);

    $response = [
        'response_code' => $response_code,
        'message' => $message,
        'result' => $result_graph_ajax
    ];
    echo json_encode($response);
}
