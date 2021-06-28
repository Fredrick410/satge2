<!-- CSS -->
<link rel="stylesheet" type="text/css" href="../../../app-assets/css/pages/domiciliation_Btn_Chat.css">

<!-- HTML -->
<img class="open-button" id="icon_chat" src="../../../app-assets/images/ico/chat_icon.png" onclick="openForm(), updateScroll()">
    <div class="chat-popup" id="myForm">
        <form action="/action_page.php" class="form-container tri-right round btm-left">
            
            <img class="cross" src="../../../app-assets/images/ico/cross.png" onclick="closeForm()"></img>
            <div class="profil">
                <img src="../../../app-assets/images/ico/profil2.png" alt="" class="img-profil">
                <p class="nom">Nom Prénom</p>
                <p class="dispo">Actif</p>
            </div>
                    
            <div class="historique" id="historique">
                        
                            
                    <p class="msgSelf round">Bonjour, j'aimerais obtenir quelques renseignements au sujet de la domiciliation.</p>
                        <?php $datemsg = "5:08"; ?>
                        <span class="chat-time right"><?= $datemsg; ?></span>
                    
                    <p class="msgSelf round">Bonjour</p>
                        <?php $datemsg = "5:08"; ?>
                        <span class="chat-time right"><?= $datemsg; ?></span>    
                
                    
                    <p class="msgYou round">Bonjour</p>
                        <?php $dateactuelle = date("H:i"); ?>
                        <span class="chat-time left"><?= $dateactuelle; ?></span>
                    
                        <p class="msgYou round">Bonjour ! Notre Service d'Aide est là pour ça !</p>
                        <?php $dateactuelle = date("H:i"); ?>
                        <span class="chat-time left"><?= $dateactuelle; ?></span>
                        <p class="msgYou round">Bonjour ! Notre Service d'Aide est là pour ça !</p>
                        <?php $dateactuelle = date("H:i"); ?>
                        <span class="chat-time left"><?= $dateactuelle; ?></span>
                        <p class="msgYou round">Bonjour ! Notre Service d'Aide est là pour ça !</p>
                        <?php $dateactuelle = date("H:i"); ?>
                        <span class="chat-time left"><?= $dateactuelle; ?></span>
                        <p class="msgYou round">Bonjour ! Notre Service d'Aide est là pour ça !</p>
                        <?php $dateactuelle = date("H:i"); ?>
                        <span class="chat-time left"><?= $dateactuelle; ?></span>
            </div>

            <div class="message">
                <textarea class="round" placeholder="Message" name="msg" required></textarea> 
                <button type="submit" class="btn"><img src="../../../app-assets/images/ico/send.png" alt=""></button>
            </div>
        </form>
    </div>


<!-- SCRIPT -->
<script src="../../../app-assets/js/scripts/pages/domiciliation_Btn_Chat.js"></script>