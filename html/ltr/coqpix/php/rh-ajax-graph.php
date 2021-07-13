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

            $result_graph = [
                'status' => $status
            ];
            $req_rep = $bdd->prepare('SELECT idreponse FROM reponses_qcm_candidat WHERE idcandidat = ? AND idqcm = ? AND vrai_ou_faux = ?');
            $req_rep->execute(array($id_candidat, $qcm_candidat, "Vrai"));
            $rep_good = $req_rep->fetchAll(PDO::FETCH_ASSOC);

            $A1 = 0;
            $B1 = 0;
            $C1 = 0;
            $D1 = 0;
            $E1 = 0;
            $F1 = 0;
            $G1 = 0;
            $H1 = 0;
            $I1 = 0;
            $J1 = 0;
            $K1 = 0;
            $L1 = 0;
            $M1 = 0;
            $N1 = 0;
            $O1 = 0;
            $P1 = 0;
            $Q1 = 0;
            $R1 = 0;
            $S1 = 0;
            $T1 = 0;
            //print("<pre>".print_r($rep_good,true)."</pre>");
            for ($i = 0; $i < count($rep_good); $i++) {
                $req_statu = $bdd->prepare('SELECT statu FROM reponse WHERE id = :id');
                $req_statu->bindValue(':id', $rep_good[$i]['idreponse']);
                $req_statu->execute();
                $req_statu_good = $req_statu->fetchAll(PDO::FETCH_ASSOC);
                if (isset($req_statu_good[0]['statu'])) {
                    if ($req_statu_good[0]['statu'] == 'Détermination') {
                        $A1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Ambition') {
                        $B1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Gout de l\'effort') {
                        $C1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Esprit de compétition') {
                        $D1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Assurance en public') {
                        $E1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Ouverture aux autres') {
                        $F1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Diplomatie') {
                        $G1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Persuasion') {
                        $H1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Diriger') {
                        $I1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Prise de responsabilités') {
                        $J1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Organisation') {
                        $K1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Vision') {
                        $L1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Confiance en soi') {
                        $M1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Indépendance d\'esprit') {
                        $N1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Créativité') {
                        $O1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Autonomie') {
                        $P1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Gestion du stress') {
                        $Q1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Réactivité') {
                        $R1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Patience') {
                        $S1++;
                    }
                    if ($req_statu_good[0]['statu'] == 'Respect de la hiérarchie') {
                        $T1++;
                    }
                }
            }
            $A2 = 0;
            $B2 = 0;
            $C2 = 0;
            $D2 = 0;
            $E2 = 0;
            $F2 = 0;
            $G2 = 0;
            $H2 = 0;
            $I2 = 0;
            $J2 = 0;
            $K2 = 0;
            $L2 = 0;
            $M2 = 0;
            $N2 = 0;
            $O2 = 0;
            $P2 = 0;
            $Q2 = 0;
            $R2 = 0;
            $S2 = 0;
            $T2 = 0;
            $req_statu = $bdd->prepare('SELECT statu FROM reponse INNER JOIN reponses_qcm_candidat ON(reponse.id = reponses_qcm_candidat.idreponse) WHERE idcandidat = :idcandidat AND idqcm = :idqcm');
            $req_statu->bindValue(':idcandidat', $id_candidat);
            $req_statu->bindValue(':idqcm', $qcm_candidat);
            $req_statu->execute();
            $req_statu_good = $req_statu->fetchAll(PDO::FETCH_ASSOC);
            if (isset($req_statu_good)) {
                foreach ($req_statu_good as $key => $value) {
                    //print("<pre>".print_r($value,true)."</pre>");
                    if ($value['statu'] == 'Détermination') {
                        $A2++;
                    }
                    if ($value['statu'] == 'Ambition') {
                        $B2++;
                    }
                    if ($value['statu'] == 'Gout de l\'effort') {
                        $C2++;
                    }
                    if ($value['statu'] == 'Esprit de compétition') {
                        $D2++;
                    }
                    if ($value['statu'] == 'Assurance en public') {
                        $E2++;
                    }
                    if ($value['statu'] == 'Ouverture aux autres') {
                        $F2++;
                    }
                    if ($value['statu'] == 'Diplomatie') {
                        $G2++;
                    }
                    if ($value['statu'] == 'Persuasion') {
                        $H2++;
                    }
                    if ($value['statu'] == 'Diriger') {
                        $I2++;
                    }
                    if ($value['statu'] == 'Prise de responsabilités') {
                        $J2++;
                    }
                    if ($value['statu'] == 'Organisation') {
                        $K2++;
                    }
                    if ($value['statu'] == 'Vision') {
                        $L2++;
                    }
                    if ($value['statu'] == 'Confiance en soi') {
                        $M2++;
                    }
                    if ($value['statu'] == 'Indépendance d\'esprit') {
                        $N2++;
                    }
                    if ($value['statu'] == 'Créativité') {
                        $O2++;
                    }
                    if ($value['statu'] == 'Autonomie') {
                        $P2++;
                    }
                    if ($value['statu'] == 'Gestion du stress') {
                        $Q2++;
                    }
                    if ($value['statu'] == 'Réactivité') {
                        $R2++;
                    }
                    if ($value['statu'] == 'Patience') {
                        $S2++;
                    }
                    if ($value['statu'] == 'Respect de la hiérarchie') {
                        $T2++;
                    }
                }
            }
            try {
                $A1 = $A1/$A2;
            } catch (DivisionByZeroError $e) {
                $A1 = 0;
            }
            try {
                $B1 = $B1/$B2;
            } catch (DivisionByZeroError $e) {
                $B1 = 0;
            }
            try {
                $C1 = $C1/$C2;
            } catch (DivisionByZeroError $e) {
                $C1 = 0;
            }
            try {
                $D1 = $D1/$D2;
            } catch (DivisionByZeroError $e) {
                $D1 = 0;
            }
            try {
                $E1 = $E1/$E2;
            } catch (DivisionByZeroError $e) {
                $E1 = 0;
            }
            try {
                $F1 = $F1/$F2;
            } catch (DivisionByZeroError $e) {
                $F1 = 0;
            }
            try {
                $G1 = $G1/$G2;
            } catch (DivisionByZeroError $e) {
                $G1 = 0;
            }
            try {
                $H1 = $H1/$H2;
            } catch (DivisionByZeroError $e) {
                $H1 = 0;
            }
            try {
                $I1 = $I1/$I2;
            } catch (DivisionByZeroError $e) {
                $I1 = 0;
            }
            try {
                $J1 = $J1/$J2;
            } catch (DivisionByZeroError $e) {
                $J1 = 0;
            }
            try {
                $K1 = $K1/$K2;
            } catch (DivisionByZeroError $e) {
                $K1 = 0;
            }
            try {
                $L1 = $L1/$L2;
            } catch (DivisionByZeroError $e) {
                $L1 = 0;
            }
            try {
                $M1 = $M1/$M2;
            } catch (DivisionByZeroError $e) {
                $M1 = 0;
            }
            try {
                $N1 = $N1/$N2;
            } catch (DivisionByZeroError $e) {
                $N1 = 0;
            }
            try {
                $O1 = $O1/$O2;
            } catch (DivisionByZeroError $e) {
                $O1 = 0;
            }
            try {
                $P1 = $P1/$P2;
            } catch (DivisionByZeroError $e) {
                $P1 = 0;
            }
            try {
                $Q1 = $Q1/$Q2;
            } catch (DivisionByZeroError $e) {
                $Q1 = 0;
            }
            try {
                $R1 = $R1/$R2;
            } catch (DivisionByZeroError $e) {
                $R1 = 0;
            }
            try {
                $S1 = $S1/$S2;
            } catch (DivisionByZeroError $e) {
                $S1 = 0;
            }
            try {
                $T1 = $T1/$T2;
            } catch (DivisionByZeroError $e) {
                $T1 = 0;
            }
            $max_value = max($A1, $B1, $C1, $D1, $E1, $F1, $G1, $H1, $I1, $J1, $K1, $L1, $M1, $N1, $O1, $P1, $Q1, $R1, $S1, $T1);
            $result_new_graph = [
                'parametre_rep' => [
                    'A' => $A1,
                    'B' => $B1,
                    'C' => $C1,
                    'D' => $D1,
                    'E' => $E1,
                    'F' => $F1,
                    'G' => $G1,
                    'H' => $H1,
                    'I' => $I1,
                    'J' => $J1,
                    'K' => $K1,
                    'L' => $L1,
                    'M' => $M1,
                    'N' => $N1,
                    'O' => $O1,
                    'P' => $P1,
                    'Q' => $Q1,
                    'R' => $R1,
                    'S' => $S1,
                    'T' => $T1
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
