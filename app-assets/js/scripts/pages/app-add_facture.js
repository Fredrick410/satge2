    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send").click(function() {
            var articlee = $("#article").val() == "Pas d'article" ? $("#newarticle").val() : $("#article").val();
            var newid = id++; 
            $("#table").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencearticle${newid} line">${$("#referencearticle").val()}</td>
            <td width="100px" class="article${newid} line">${articlee}</td>
            <td width="100px" class="cout${newid}">${$("#cout").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);

            document.getElementById("cout").value = "";
            document.getElementById("quantite").value = "";
            document.getElementById("newarticle").value = "";
            document.getElementById("referencearticle").value = "";
            document.getElementById("remise").value = "";
            document.getElementById("tva").value = "";
            document.getElementById("umesure").value = "";
        });

        // function to remove article if u don't want it
        $("#table").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save").click(function() {
            
            var lastRowId = $('#table tr:last').attr("id"); /*finds id of the last row inside table*/
            var numeros = new Array();
            var article = new Array(); 
            var referencearticle = new Array();
            var cout = new Array();
            var quantite = new Array();
            var umesure = new Array();
            var tva = new Array();
            var remise = new Array();
            
            for ( var i = 1; i <= lastRowId; i++) {
                numeros.push($("#"+i+" .numeros"+i).html());
                article.push($("#"+i+" .article"+i).html()); 
                referencearticle.push($("#"+i+" .referencearticle"+i).html()); 
                cout.push($("#"+i+" .cout"+i).html());
                quantite.push($("#"+i+" .quantite"+i).html()); 
                umesure.push($("#"+i+" .umesure"+i).html());
                tva.push($("#"+i+" .tva"+i).html()); 
                remise.push($("#"+i+" .remise"+i).html());
            }

            var sendNumeros = JSON.stringify(numeros); 
            var sendArticle = JSON.stringify(article); 
            var sendRef = JSON.stringify(referencearticle);
            var sendcout = JSON.stringify(cout);
            var sendquantite = JSON.stringify(quantite);
            var sendUmesure = JSON.stringify(umesure);
            var sendTVA = JSON.stringify(tva);
            var sendremise = JSON.stringify(remise);

            $.ajax({
                url: "../../../html/ltr/coqpix/php/insert_articles_facture.php", //new path, save your work first before u try
                type: "POST",
                data: {
                    numeros : sendNumeros,
                    article : sendArticle,
                    referencearticle : sendRef, 
                    cout : sendcout, 
                    quantite : sendquantite,
                    umesure : sendUmesure,
                    tva : sendTVA,
                    remise : sendremise,
                },
                success:function(data){
                }
            });
        });
    });

