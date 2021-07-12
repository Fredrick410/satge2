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
            $req_mv_rep = $bdd->prepare('SELECT DISTINCT reponse.statu AS statu FROM reponse INNER JOIN question on (reponse.idquestion = question.id) WHERE idqcm = ?');
            $req_mv_rep->execute(array($qcm_candidat));
            $status = $req_mv_rep->fetchAll(PDO::FETCH_ASSOC);

            //print("<pre>".print_r($status,true)."</pre>");

            $result_graph = [
                'status' => $status
            ];
            $req_rep = $bdd->prepare('SELECT idreponse FROM reponses_qcm_candidat WHERE idcandidat = ? AND idqcm = ? AND vrai_ou_faux = ?');
            $req_rep->execute(array($id_candidat, $qcm_candidat, "Vrai"));
            $rep_good = $req_rep->fetchAll(PDO::FETCH_ASSOC);

            $A = 0;
            $B = 0;
            $C = 0;
            $D = 0;
            $E = 0;
            $F = 0;
            $G = 0;
            $H = 0;
            $I = 0;
            $J = 0;
            $K = 0;
            $L = 0;
            $M = 0;
            $N = 0;
            $O = 0;
            $P = 0;
            $Q = 0;
            $R = 0;
            $S = 0;
            $T = 0;
            //print("<pre>".print_r($rep_good,true)."</pre>");
            for ($i = 0; $i < count($rep_good); $i++) {
                $req_statu = $bdd->prepare('SELECT statu FROM reponse WHERE id = :id');
                $req_statu->bindValue(':id', $rep_good[$i]['idreponse']);
                $req_statu->execute();
                $req_statu_good = $req_statu->fetchAll(PDO::FETCH_ASSOC);
                if (isset($req_statu_good[0]['statu'])) {
                    if ($req_statu_good[0]['statu'] == 'Détermination') {
                        $A++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Ambition') {
                        $B++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Gout de l\'effort') {
                        $C++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Esprit de compétition') {
                        $D++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Assurance en public') {
                        $E++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Ouverture aux autres') {
                        $F++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Diplomatie') {
                        $G++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Persuasion') {
                        $H++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Diriger') {
                        $I++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Prise de responsabilités') {
                        $J++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Organisation') {
                        $K++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Vision') {
                        $L++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Confiance en soi') {
                        $M++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Indépendance d\'esprit') {
                        $N++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Créativité') {
                        $O++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Autonomie') {
                        $P++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Gestion du stress') {
                        $Q++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Réactivité') {
                        $R++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Patience') {
                        $S++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Respect de la hiérarchie') {
                        $T++;
                    }
                }
            }
            $max_value = max($A, $B, $C, $D, $E, $F, $G, $H, $I, $J, $K, $L, $M, $N, $O, $P, $Q, $R, $S, $T);
            $result_new_graph = [
                'parametre_rep' => [
                    'A' => $A,
                    'B' => $B,
                    'C' => $C,
                    'D' => $D,
                    'E' => $E,
                    'F' => $F,
                    'G' => $G,
                    'H' => $H,
                    'I' => $I,
                    'J' => $J,
                    'K' => $K,
                    'L' => $L,
                    'M' => $M,
                    'N' => $N,
                    'O' => $O,
                    'P' => $P,
                    'Q' => $Q,
                    'R' => $R,
                    'S' => $S,
                    'T' => $T
                ]
            ];
        }
        response($response_code, $message, $result_graph, $result_new_graph, $max_value, $status);
    }
} else {

    $response_code = HTTP_METHOD_NOT_ALLOWED;
    $message = 'Method Not Allowed';
}

function response($response_code, $message, $result_graph_ajax, $result_new_graph_ajax, $max_value, $status)
{
    header('Content-Type: application/json');
    http_response_code($response_code);

    $response = [
        'response_code' => $response_code,
        'message' => $message,
        'result' => $result_graph_ajax,
        'result_rep' => $result_new_graph_ajax,
        'max_value' => $max_value,
        'status' => $status
    ];
    echo json_encode($response);
}
