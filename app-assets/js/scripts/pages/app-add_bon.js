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
                url: "../../../html/ltr/coqpix/php/insert_articles_bon.php", //new path, save your work first before u try
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

    //Pour le 2nd tableau d'articles dans la facture (le reste en dessous c'est la même pr un 3ème ou 4ème tableau)
    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send2").click(function() {
            var articlee = $("#article2").val() == "Pas d'article" ? $("#newarticle2").val() : $("#article2").val();
            var newid = id++; 
            $("#table2").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencearticle${newid} line">${$("#referencearticle2").val()}</td>
            <td width="100px" class="article${newid} line">${articlee}</td>
            <td width="100px" class="cout${newid}">${$("#cout2").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite2").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure2").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva2").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise2").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout2").value = "";
            document.getElementById("quantite2").value = "";
            document.getElementById("newarticle2").value = "";
            document.getElementById("referencearticle2").value = "";
            document.getElementById("remise2").value = "";
            document.getElementById("tva2").value = "";
            document.getElementById("umesure2").value = "";
        });

        // function to remove article if u don't want it
        $("#table2").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save2").click(function() {
            
            var lastRowId = $('#table2 tr:last').attr("id"); /*finds id of the last row inside table*/
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
                article.push($("#"+i+" .article2"+i).html()); 
                referencearticle.push($("#"+i+" .referencearticle2"+i).html()); 
                cout.push($("#"+i+" .cout2"+i).html());
                quantite.push($("#"+i+" .quantite2"+i).html()); 
                umesure.push($("#"+i+" .umesure2"+i).html());
                tva.push($("#"+i+" .tva2"+i).html()); 
                remise.push($("#"+i+" .remise2"+i).html());
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
                url: "../../../html/ltr/coqpix/php/insert_articles_bon.php", //new path, save your work first before u try
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

    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send3").click(function() {
            var articlee = $("#article3").val() == "Pas d'article" ? $("#newarticle3").val() : $("#article3").val();
            var newid = id++; 
            $("#table3").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencearticle${newid} line">${$("#referencearticle3").val()}</td>
            <td width="100px" class="article${newid} line">${articlee}</td>
            <td width="100px" class="cout${newid}">${$("#cout3").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite3").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure3").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva3").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise3").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout3").value = "";
            document.getElementById("quantite3").value = "";
            document.getElementById("newarticle3").value = "";
            document.getElementById("referencearticle3").value = "";
            document.getElementById("remise3").value = "";
            document.getElementById("tva3").value = "";
            document.getElementById("umesure3").value = "";
        });

        // function to remove article if u don't want it
        $("#table3").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save3").click(function() {
            
            var lastRowId = $('#table3 tr:last').attr("id"); /*finds id of the last row inside table*/
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
                article.push($("#"+i+" .article3"+i).html()); 
                referencearticle.push($("#"+i+" .referencearticle3"+i).html()); 
                cout.push($("#"+i+" .cout3"+i).html());
                quantite.push($("#"+i+" .quantite3"+i).html()); 
                umesure.push($("#"+i+" .umesure3"+i).html());
                tva.push($("#"+i+" .tva3"+i).html()); 
                remise.push($("#"+i+" .remise3"+i).html());
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
                url: "../../../html/ltr/coqpix/php/insert_articles_bon.php", //new path, save your work first before u try
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

    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send4").click(function() {
            var articlee = $("#article4").val() == "Pas d'article" ? $("#newarticle4").val() : $("#article4").val();
            var newid = id++; 
            $("#table4").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencearticle${newid} line">${$("#referencearticle4").val()}</td>
            <td width="100px" class="article${newid} line">${articlee}</td>
            <td width="100px" class="cout${newid}">${$("#cout4").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite4").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure4").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva4").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise4").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout4").value = "";
            document.getElementById("quantite4").value = "";
            document.getElementById("newarticle4").value = "";
            document.getElementById("referencearticle4").value = "";
            document.getElementById("remise4").value = "";
            document.getElementById("tva4").value = "";
            document.getElementById("umesure4").value = "";
        });

        // function to remove article if u don't want it
        $("#table4").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save4").click(function() {
            
            var lastRowId = $('#table4 tr:last').attr("id"); /*finds id of the last row inside table*/
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
                article.push($("#"+i+" .article4"+i).html()); 
                referencearticle.push($("#"+i+" .referencearticle4"+i).html()); 
                cout.push($("#"+i+" .cout4"+i).html());
                quantite.push($("#"+i+" .quantite4"+i).html()); 
                umesure.push($("#"+i+" .umesure4"+i).html());
                tva.push($("#"+i+" .tva4"+i).html()); 
                remise.push($("#"+i+" .remise4"+i).html());
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
                url: "../../../html/ltr/coqpix/php/insert_articles_bon.php", //new path, save your work first before u try
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

    //-------------------------------------------------------------------------------

    //Pour les tableaux de prestation dans la facture (le reste en dessous c'est la même pr les tableaux qui vont suivre)
    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send5").click(function() {
            var prestationn = $("#prestation5").val() == "Pas de prestation" ? $("#newprestation5").val() : $("#prestation5").val();
            var newid = id++; 
            $("#table5").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencepresta${newid} line">${$("#referencepresta5").val()}</td>
            <td width="100px" class="prestation${newid} line">${prestationn}</td>
            <td width="100px" class="cout${newid}">${$("#cout5").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite5").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure5").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva5").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise5").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout5").value = "";
            document.getElementById("quantite5").value = "";
            document.getElementById("newprestation5").value = "";
            document.getElementById("referencepresta5").value = "";
            document.getElementById("remise5").value = "";
            document.getElementById("tva5").value = "";
            document.getElementById("umesure5").value = "";
        });

        // function to remove prestation if u don't want it
        $("#table5").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save5").click(function() {
            
            var lastRowId = $('#table5 tr:last').attr("id"); /*finds id of the last row inside table*/
            var numeros = new Array();
            var prestation = new Array(); 
            var referencepresta = new Array();
            var cout = new Array();
            var quantite = new Array();
            var umesure = new Array();
            var tva = new Array();
            var remise = new Array();
            
            for ( var i = 1; i <= lastRowId; i++) {
                numeros.push($("#"+i+" .numeros"+i).html());
                prestation.push($("#"+i+" .prestation5"+i).html()); 
                referencepresta.push($("#"+i+" .referencepresta5"+i).html()); 
                cout.push($("#"+i+" .cout5"+i).html());
                quantite.push($("#"+i+" .quantite5"+i).html()); 
                umesure.push($("#"+i+" .umesure5"+i).html());
                tva.push($("#"+i+" .tva5"+i).html()); 
                remise.push($("#"+i+" .remise5"+i).html());
            }

            var sendNumeros = JSON.stringify(numeros); 
            var sendPrestation = JSON.stringify(prestation); 
            var sendRef = JSON.stringify(referencepresta);
            var sendcout = JSON.stringify(cout);
            var sendquantite = JSON.stringify(quantite);
            var sendUmesure = JSON.stringify(umesure);
            var sendTVA = JSON.stringify(tva);
            var sendremise = JSON.stringify(remise);

            $.ajax({
                url: "../../../html/ltr/coqpix/php/insert_prestations_bon.php", //new path, save your work first before u try
                type: "POST",
                data: {
                    numeros : sendNumeros,
                    prestation : sendPrestation,
                    referencepresta : sendRef, 
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

    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send6").click(function() {
            var prestationn = $("#prestation6").val() == "Pas de prestation" ? $("#newprestation6").val() : $("#prestation6").val();
            var newid = id++; 
            $("#table6").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencepresta${newid} line">${$("#referencepresta6").val()}</td>
            <td width="100px" class="prestation${newid} line">${prestationn}</td>
            <td width="100px" class="cout${newid}">${$("#cout6").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite6").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure6").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva6").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise6").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout6").value = "";
            document.getElementById("quantite6").value = "";
            document.getElementById("newprestation6").value = "";
            document.getElementById("referencepresta6").value = "";
            document.getElementById("remise6").value = "";
            document.getElementById("tva6").value = "";
            document.getElementById("umesure6").value = "";
        });

        // function to remove prestation if u don't want it
        $("#table6").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save6").click(function() {
            
            var lastRowId = $('#table6 tr:last').attr("id"); /*finds id of the last row inside table*/
            var numeros = new Array();
            var prestation = new Array(); 
            var referencepresta = new Array();
            var cout = new Array();
            var quantite = new Array();
            var umesure = new Array();
            var tva = new Array();
            var remise = new Array();
            
            for ( var i = 1; i <= lastRowId; i++) {
                numeros.push($("#"+i+" .numeros"+i).html());
                prestation.push($("#"+i+" .prestation6"+i).html()); 
                referencepresta.push($("#"+i+" .referencepresta6"+i).html()); 
                cout.push($("#"+i+" .cout6"+i).html());
                quantite.push($("#"+i+" .quantite6"+i).html()); 
                umesure.push($("#"+i+" .umesure6"+i).html());
                tva.push($("#"+i+" .tva6"+i).html()); 
                remise.push($("#"+i+" .remise6"+i).html());
            }

            var sendNumeros = JSON.stringify(numeros); 
            var sendPrestation = JSON.stringify(prestation); 
            var sendRef = JSON.stringify(referencepresta);
            var sendcout = JSON.stringify(cout);
            var sendquantite = JSON.stringify(quantite);
            var sendUmesure = JSON.stringify(umesure);
            var sendTVA = JSON.stringify(tva);
            var sendremise = JSON.stringify(remise);

            $.ajax({
                url: "../../../html/ltr/coqpix/php/insert_prestations_bon.php", //new path, save your work first before u try
                type: "POST",
                data: {
                    numeros : sendNumeros,
                    prestation : sendPrestation,
                    referencepresta : sendRef, 
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

    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send7").click(function() {
            var prestationn = $("#prestation7").val() == "Pas de prestation" ? $("#newprestation7").val() : $("#prestation7").val();
            var newid = id++; 
            $("#table7").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencepresta${newid} line">${$("#referencepresta7").val()}</td>
            <td width="100px" class="prestation${newid} line">${prestationn}</td>
            <td width="100px" class="cout${newid}">${$("#cout7").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite7").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure7").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva7").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise7").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout7").value = "";
            document.getElementById("quantite7").value = "";
            document.getElementById("newprestation7").value = "";
            document.getElementById("referencepresta7").value = "";
            document.getElementById("remise7").value = "";
            document.getElementById("tva7").value = "";
            document.getElementById("umesure7").value = "";
        });

        // function to remove prestation if u don't want it
        $("#table7").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save7").click(function() {
            
            var lastRowId = $('#table7 tr:last').attr("id"); /*finds id of the last row inside table*/
            var numeros = new Array();
            var prestation = new Array(); 
            var referencepresta = new Array();
            var cout = new Array();
            var quantite = new Array();
            var umesure = new Array();
            var tva = new Array();
            var remise = new Array();
            
            for ( var i = 1; i <= lastRowId; i++) {
                numeros.push($("#"+i+" .numeros"+i).html());
                prestation.push($("#"+i+" .prestation7"+i).html()); 
                referencepresta.push($("#"+i+" .referencepresta7"+i).html()); 
                cout.push($("#"+i+" .cout7"+i).html());
                quantite.push($("#"+i+" .quantite7"+i).html()); 
                umesure.push($("#"+i+" .umesure7"+i).html());
                tva.push($("#"+i+" .tva7"+i).html()); 
                remise.push($("#"+i+" .remise7"+i).html());
            }

            var sendNumeros = JSON.stringify(numeros); 
            var sendPrestation = JSON.stringify(prestation); 
            var sendRef = JSON.stringify(referencepresta);
            var sendcout = JSON.stringify(cout);
            var sendquantite = JSON.stringify(quantite);
            var sendUmesure = JSON.stringify(umesure);
            var sendTVA = JSON.stringify(tva);
            var sendremise = JSON.stringify(remise);

            $.ajax({
                url: "../../../html/ltr/coqpix/php/insert_prestations_bon.php", //new path, save your work first before u try
                type: "POST",
                data: {
                    numeros : sendNumeros,
                    prestation : sendPrestation,
                    referencepresta : sendRef, 
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

    $(document).ready(function() {      
        var id = 1; 
        /*Assigning id and class for tr and td tags for separation.*/
        $("#button_send8").click(function() {
            var prestationn = $("#prestation8").val() == "Pas de prestation" ? $("#newprestation8").val() : $("#prestation8").val();
            var newid = id++; 
            $("#table8").append(`<tr valign="top" id="${newid}">
            <td width="100px" class="numeros${newid}">${$("#numeros").val()}</td>
            <td width="100px" class="referencepresta${newid} line">${$("#referencepresta8").val()}</td>
            <td width="100px" class="prestation${newid} line">${prestationn}</td>
            <td width="100px" class="cout${newid}">${$("#cout8").val()}</td>
            <td width="100px" class="quantite${newid}">${$("#quantite8").val()}</td>
            <td width="100px" class="umesure${newid}">${$("#umesure8").val()}</td>
            <td width="100px" class="tva${newid}">${$("#tva8").val()} %</td>
            <td width="100px" class="remise${newid}">${$("#remise8").val()} %</td>
            <td width="100px"><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);
        
            document.getElementById("cout8").value = "";
            document.getElementById("quantite8").value = "";
            document.getElementById("newprestation8").value = "";
            document.getElementById("referencepresta8").value = "";
            document.getElementById("remise8").value = "";
            document.getElementById("tva8").value = "";
            document.getElementById("umesure8").value = "";
        });

        // function to remove prestation if u don't want it
        $("#table8").on('click', '.remCF', function() {
            $(this).parent().parent().remove();
        });
        /*crating new click event for save button this will save to the database*/
        $("#button_save8").click(function() {
            
            var lastRowId = $('#table8 tr:last').attr("id"); /*finds id of the last row inside table*/
            var numeros = new Array();
            var prestation = new Array(); 
            var referencepresta = new Array();
            var cout = new Array();
            var quantite = new Array();
            var umesure = new Array();
            var tva = new Array();
            var remise = new Array();
            
            for ( var i = 1; i <= lastRowId; i++) {
                numeros.push($("#"+i+" .numeros"+i).html());
                prestation.push($("#"+i+" .prestation8"+i).html()); 
                referencepresta.push($("#"+i+" .referencepresta8"+i).html()); 
                cout.push($("#"+i+" .cout8"+i).html());
                quantite.push($("#"+i+" .quantite8"+i).html()); 
                umesure.push($("#"+i+" .umesure8"+i).html());
                tva.push($("#"+i+" .tva8"+i).html()); 
                remise.push($("#"+i+" .remise8"+i).html());
            }

            var sendNumeros = JSON.stringify(numeros); 
            var sendPrestation = JSON.stringify(prestation); 
            var sendRef = JSON.stringify(referencepresta);
            var sendcout = JSON.stringify(cout);
            var sendquantite = JSON.stringify(quantite);
            var sendUmesure = JSON.stringify(umesure);
            var sendTVA = JSON.stringify(tva);
            var sendremise = JSON.stringify(remise);

            $.ajax({
                url: "../../../html/ltr/coqpix/php/insert_prestations_bon.php", //new path, save your work first before u try
                type: "POST",
                data: {
                    numeros : sendNumeros,
                    prestation : sendPrestation,
                    referencepresta : sendRef, 
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