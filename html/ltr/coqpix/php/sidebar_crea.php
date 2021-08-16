<?php
    
    $pdoStat = $bdd->prepare('SELECT * FROM crea_societe WHERE notification_admin >= "1"');
    $pdoStat->execute();
    $crea = $pdoStat->fetchAll();
    $count = count($crea);

        
    $pdoState = $bdd->prepare('SELECT * FROM chat_crea WHERE lu = "0" AND you NOT LIKE "coqpix"');
    //$pdoState = $bdd->prepare('SELECT DISTINCT you FROM chat_crea WHERE you NOT LIKE "coqpix"');
   
    $pdoState->execute();
    $list_msg_nonlu = $pdoState->fetchAll();
    $count_msg = count($list_msg_nonlu);


    $pdoStatee = $bdd->prepare('SELECT * FROM crea_societe WHERE doc_domiciliation NOT LIKE "" AND depo_domi = ""');
    
    $pdoStatee->execute();
    $list_domi = $pdoStatee->fetchAll();
    $count_domi = count($list_domi);


    $url = $_SERVER['REQUEST_URI'];
?>
<style>
.sidebar-menu-list {
    overflow-y:scroll
};
</style>

<div class="list-group list-group-messages">
                                    <a href="creation-list-conversation-nonlu.php" class="list-group-item <?php if(strpos($url, "creation-list-conversation-nonlu.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: comments.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Conversation
                                        <span class="badge badge-light-danger badge-pill badge-round float-right mt-50"><?= $count_msg ?></span>
                                    </a>
                                    <a href="creation-list-domiciliation.php" class="list-group-item <?php if(strpos($url, "creation-list-domiciliation.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: home.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Domiciliation
                                        <span class="badge badge-light-danger badge-pill badge-round float-right mt-50"><?= $count_domi ?></span>
                                    </a>
                                    <hr>
                                    <a href="creation-list.php" class="list-group-item <?php if(strpos($url, "creation-list.php") !== false){echo "active";} ?>" id="inbox-menu">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: briefcase.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Tous
                                    </a>
                                    </a>
                                    <a href="creation-list-notification.php" class="list-group-item <?php if(strpos($url, "creation-list-notification.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: label-new.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Notification
                                        <span class="badge badge-light-danger badge-pill badge-round float-right mt-50"><?= $count ?></span>
                                    </a>
                                    <a href="creation-list-valide.php" class="list-group-item <?php if(strpos($url, "creation-list-valide.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: check-alt.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div> 
                                        Créa validé
                                    </a>
                                    <a href="creation-list-invalide.php" class="list-group-item <?php if(strpos($url, "creation-list-invalide.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: remove.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Créa en cours
                                    </a>
                                    <a href="crea-list-favo.php" class="list-group-item <?php if(strpos($url, "crea-list-favo.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: star.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Important
                                    </a>
                                    <a href="crea-list-delete.php" class="list-group-item <?php if(strpos($url, "crea-list-delete.php") !== false){echo "active";} ?>">
                                        <div class="fonticon-wrap d-inline mr-25">
                                            <i class="livicon-evo" data-options="name: trash.svg; size: 24px; style: lines; strokeColor:#475f7b; eventOn:grandparent; duration:0.85;">
                                            </i>
                                        </div>
                                        Corbeille
                                        <span class="badge badge-light-success badge-pill badge-round float-right mt-50">NEW</span>
                                    </a>
</div>