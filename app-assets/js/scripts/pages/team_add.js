$(function(){

        //form one
        $("#paramgeneral").submit(function(){
            $("#loader").show();
            var name_team = $(this).find("input[name=name_team]").val();
            var tags_name = $(this).find("input[name=tags_name]").val();
            var email_team = $(this).find("input[name=email_team]").val();
            var tel_team = $(this).find("input[name=tel_team]").val();

            $.post("php/insert_team.php",{name_team: name_team, tags_name: tags_name, email_team: email_team, tel_team: tel_team}, function(data){
                $("#loader").hide();
                if(data == "Un erreur est survenue lors de l'insertion de votre team"){
                    $(".error").empty().append(data);
                }else{
                    $("#bt_formone").hide();
                    document.getElementById("bt_formone").disabled = "true";
                    document.getElementById("id_name_team").disabled = "true";
                    document.getElementById("id_tags_name").disabled = "true";
                    document.getElementById("id_email_team").disabled = "true";
                    document.getElementById("id_tel_team").disabled = "true";
                    document.getElementById("parammembre").elements["id_team"].value = data;
                    $("#message_good").show();
                    $("#add_membre").show();
                }
            });

            return false;
        });
    });



        function getMessages(){
            var id = document.getElementById("id_team").value;
            // 1. Elle doit créer une requête AJAX pour se connecter au serveur, et notamment au fichier ../../../../html/ltr/coqpix/php/chat_crea.php
            const requeteAjax = new XMLHttpRequest();
            requeteAjax.open("GET", "php/insert_membre_team.php?num="+id);

            // 2. Quand elle reçoit les données, il faut qu'elle les traite (en exploitant le JSON) et il faut qu'elle affiche ces données au format HTML
            requeteAjax.onload = function(){

            const resultat = JSON.parse(requeteAjax.responseText);
            const html = resultat.reverse().map(function(message){

            return `<div class="survol col-3 border text-center">
                        <div class=""><img src="../../../src/img/${message.img_membre}" class="rounded mx-auto d-block img_team" alt="..." width= "200px" height="200px"></div>
                        <label>${message.name_membre}</label>
                        <div class="apparait">
                            <div class=""><a href="php/leave_team.php?num=${message.id}&team=${message.team_num}"><i class='bx bxs-no-entry' style="color: red; font-size: 50px; position:relative; top: 40%;"></i></a></div>
                        </div>
                    </div>`

      }).join('');  

            const messages = document.querySelector('.imgprof');

            messages.innerHTML = html;
            messages.scrollTop = messages.scrollHeight;
        }

        // 3. On envoie la requête
        requeteAjax.send();
        }

        function postMessage(event){
        // 1. Elle doit stoper le submit du formulaire
        event.preventDefault();

        // 2. Elle doit récupérer les données du formulaire
        const name_membre = document.querySelector('#name_membre');
        const team_num = document.querySelector('#id_team');

        // 3. Elle doit conditionner les données
        const data = new FormData();
        data.append('name_membre', name_membre.value);
        data.append('team_num', team_num.value);

        // 4. Elle doit configurer une requête ajax en POST et envoyer les données
        const requeteAjax = new XMLHttpRequest();
        requeteAjax.open('POST', 'php/insert_membre_team.php?task=write');
  
        requeteAjax.onload = function(){
        content.value = '';
        content.focus();
        getMessages();
        }

  

        requeteAjax.send(data);
        return false;

        }

        document.getElementById('btn_submit').addEventListener('click', event => {
        postMessage(event);
});

        const interval = window.setInterval(getMessages, 5000);

        getMessages();