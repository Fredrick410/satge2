<?php
    
    $pdoStat = $bdd->prepare('SELECT * FROM crea_societe WHERE notification_admin >= "1"');
    $pdoStat->execute();
    $crea = $pdoStat->fetchAll();
    $count = count($crea);

        
    $pdoState = $bdd->prepare('SELECT * FROM chat_crea WHERE lu = "0" AND you NOT LIKE "coqpix"');
    //$pdoState = $bdd->prepare('SELECT DISTINCT you FROM chat_crea WHERE you NOT LIKE "coqpix"');
   
    $pdoState->execute();
    $list_msg = $pdoState->fetchAll();
    $count_msg = count($list_msg);

?>

<div class="list-group list-group-messages">
                                    <a href="creation-list-conversation.php" class="list-group-item pt-0 active">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: comments.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Conversation
                                        <span class="badge badge-light-danger badge-pill badge-round float-right mt-50"><?= $count_msg ?></span>
                                    <a href="creation-list.php" class="list-group-item pt-0" id="inbox-menu">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: briefcase.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Tous
                                    </a>
                                    </a>
                                    <a href="creation-list-notification.php" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: label-new.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Notification
                                        <span class="badge badge-light-danger badge-pill badge-round float-right mt-50"><?= $count ?></span>
                                    </a>
                                    <a href="creation-list-valide.php" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: check-alt.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div> 
                                        Créa valide
                                    </a>
                                    <a href="creation-list-invalide.php" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: remove.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Créa non valide
                                    </a>
                                    <a href="crea-list-favo.php" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: star.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Important
                                    </a>
                                    <a href="crea-list-delete.php" class="list-group-item">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#5A8DEE; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Corbeille
                                        <span class="badge badge-light-success badge-pill badge-round float-right mt-50">NEW</span>
                                    </a>
</div>