<?php
if (isset($_POST['critere'])) {
    if ($_POST['critere'] == "paramA") {
        echo "<option value=\"\">Sélectionner un sous critère</option>\n
            <option>Détermination</option>\n
            <option>Ambition</option>\n
            <option>Gout de l'effort</option>\n
            <option>Esprit de compétition</option>\n";
    } elseif ($_POST['critere'] == "paramB") {
        echo "<option value=\"\">Sélectionner un sous critère</option>\n
            <option>Assurance en public</option>\n
            <option>Ouverture aux autres</option>\n
            <option>Diplomatie</option>\n
            <option>Persuasion</option>\n";
    } elseif ($_POST['critere'] == "paramC") {
        echo "<option value=\"\">Sélectionner un sous critère</option>\n
            <option>Diriger</option>\n
            <option>Prise de responsabilités</option>\n
            <option>Organisation</option>\n
            <option>Vision</option>\n";
    } elseif ($_POST['critere'] == "paramD") {
        echo "<option value=\"\">Sélectionner un sous critère</option>\n
            <option>Confiance en soi</option>\n
            <option>Indépendance d'esprit</option>\n
            <option>Créativité</option>\n
            <option>Autonomie</option>\n";
    } elseif ($_POST['critere'] == "paramE") {
        echo "<option value=\"\">Sélectionner un sous critère</option>\n
            <option>Gestion du stress</option>\n
            <option>Réactivité</option>\n
            <option>Patience</option>\n
            <option>Respect de la hiérarchie</option>\n";
    }
    else{
        echo "<option value=\"\">Sélectionner un sous critère</option>\n";
    }
}
exit();
