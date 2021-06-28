<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation_Btn_Chat.css">

<!-- HTML -->
<div id="notification" onclick="notif()" class="d-flex align-items-center">
    <?php
        if($crea['notification_crea'] > 0){
            $notification = '';
            $numero = '1'; 
        }else{
            $notification = "hidden"; 
        }
    ?>
    <div class="open-button">
        <div class="notification" id="notif" <?php echo $notification ?>><?php echo $numero ?></div>
        <img class="open-button" id="icon_chat" src="../../../app-assets/images/ico/chat_icon.png" onclick="openForm(), updateScroll()">
    </div>
</div>

    <div class="chat-popup" id="myForm">
        <div class="form-container tri-right round btm-left">
            
            <img class="cross" src="../../../app-assets/images/ico/cross.png" onclick="closeForm()"></img>
            <div class="profil">
                <img src="../../../app-assets/images/ico/profil2.png" alt="" class="img-profil">
                <p class="nom">Coqpix Support</p>
                <p class="dispo">Actif</p>
            </div>
                    
            <div class="historique" id="historique">
                <div class="chat-content">
                    <div class="chat chat-left">
                        <div class="chat-avatar">
                            <a class="avatar m-0">
                                <img src="../../../app-assets/images/ico/astro1.gif" alt="avatar" height="36" width="36" />
                            </a>
                        </div>
                        <div class="chat-body">
                            <div class="chat-message">
                                <p>Bonjour et bienvenue, n'hésite pas à nous envoyer un petit message.</p>
                                <?php $dateactuelle = date("H:i"); ?>
                                <span class="chat-time"><?= $dateactuelle; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="message">
                <input type="hidden" name="id" id="id_client" value="<?= $_SESSION['id_crea'] ?>">
                <input type="hidden" name="author" id="author" value="<?= $crea['name_crea'] ?>">
                
                <input type="text" name="content" id="content" class="chat-message-send" placeholder="Message">
                
                
                <button type="button" id="btn_submit" class="btn send">
                    <img src="../../../app-assets/images/ico/send.png" alt="">
                </button>                
            </div>
        </div>
    </div>


<!-- SCRIPT -->
<script src="../../../app-assets/js/scripts/pages/domiciliation_Btn_Chat.js"></script>
<script src="../../../app-assets/js/scripts/pages/app-chat.js"></script>
<script src="../../../app-assets/js/scripts/pages/chat_crea_user.js"></script>