$(document).ready(function(){      

    $("#button_save").click(function(){

        var arrNumeros = $("#numeros").val();
        var arrArticle = [];
        var arrReferencearticle = [];
        var arrCout = [];
        var arrQuantite = [];
        var arrUmesure = [];
        var arrTva = [];
        var arrRemise = [];


        $(".article").each(function(){
          arrArticle.push($(this).val());
        });

        $(".referencearticle").each(function(){
          arrReferencearticle.push($(this).val());
        });

        $(".cout").each(function(){
          arrCout.push($(this).val());
        });

        $(".quantite").each(function(){
          arrQuantite.push($(this).val());
        });

        $(".umesure").each(function(){
          arrUmesure.push($(this).val());
        });

        $(".tva").each(function(){
          arrTva.push($(this).val());
        });

        $(".remise").each(function(){
          arrRemise.push($(this).val());
        });

        var sendArticle = JSON.stringify(arrArticle);
        var sendRef = JSON.stringify(arrReferencearticle);
        var sendCout = JSON.stringify(arrCout);
        var sendQuantite = JSON.stringify(arrQuantite);
        var sendUmesure = JSON.stringify(arrUmesure);
        var sendTva = JSON.stringify(arrTva);
        var sendRemise = JSON.stringify(arrRemise);

        var datas = {
                numeros : arrNumeros,
                article : sendArticle,
                referencearticle : sendRef, 
                cout : sendCout, 
                quantite : sendQuantite,
                umesure : sendUmesure,
                tva : sendTva,
                remise : sendRemise,
              };
        
        // Affiche dans la console les données envoyées dans la requête Ajax
        console.log('Données envoyées dans la requete : ", datas'); 
        
        $.ajax({
        type: "POST",
        url: "../../../html/ltr/coqpix/php/insert_avoir_articles.php", 
        data: datas, // correspond à la variable datas inialisée juste au dessus
        async: true,
        dataType: "json"
        }).done(function (reponse) { // reponse est le nom de la variable qui contiendra la réponse du script php 
            console.log("reponse ajax",reponse); // Affiche dans la console la réponse du script ajax php
        }).fail(function (jqXHR, textStatus) {
            console.log({textStatus}, {jqXHR})
        });
        
    });
});
