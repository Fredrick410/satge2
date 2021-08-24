$(document).ready(function () {
    var id = 0;

    var tables = [
        { table: $('#table'), sendButton: $('#button_send'), id: '', data: {} },
        { table: $('#table2'), sendButton: $('#button_send2'), id: '2', data: {} },
        { table: $('#table3'), sendButton: $('#button_send3'), id: '3', data: {} },
        { table: $('#table4'), sendButton: $('#button_send4'), id: '4', data: {} },
        { table: $('#table5'), sendButton: $('#button_send5'), id: '5', data: {} },
        { table: $('#table6'), sendButton: $('#button_send6'), id: '6', data: {} },
        { table: $('#table7'), sendButton: $('#button_send7'), id: '7', data: {} },
        { table: $('#table8'), sendButton: $('#button_send8'), id: '8', data: {} },
    ];

    var articles = tables.slice(0, 4);
    var prestations = tables.slice(4);

    // Delete des articles ou prestations en local quand on les delete des tables articles/prestations des différentes sections.
    // !DELETE
    tables.forEach(function (el) {
        el.table.on('click', '.remCF', function () {
            var x = $(this);
            var deleteMeta = x.attr('data-remove').split('+');
            var deleteId = parseInt(deleteMeta[0], 10);
            var tableIdx = parseInt(deleteMeta[1], 10);
            var table = tables[tableIdx];
            var dataIdx = table.data.ids.indexOf(deleteId);

            Object.keys(table.data).forEach(function (key) {
                table.data[key].splice(dataIdx, 1);
            });

            x.parent().parent().remove();
        });
    });

    // Création de la table virtuelle d'articles d'une section
    // ? Create Articles
    articles.forEach(function (el, i) {
        el.sendButton.click(function () {
            id++;
            // Init with empty array in case of undefiend values
            el.data.ids = el.data.ids != undefined ? el.data.ids : [];
            el.data.numeros = el.data.numeros != undefined ? el.data.numeros : [];
            el.data.article = el.data.article != undefined ? el.data.article : [];
            el.data.referencearticle = el.data.referencearticle != undefined ? el.data.referencearticle : [];
            el.data.cout = el.data.cout != undefined ? el.data.cout : [];
            el.data.quantite = el.data.quantite != undefined ? el.data.quantite : [];
            el.data.umesure = el.data.umesure != undefined ? el.data.umesure : [];
            el.data.tva = el.data.tva != undefined ? el.data.tva : [];
            el.data.remise = el.data.remise != undefined ? el.data.remise : [];
            el.data.numero_titre = el.data.numero_titre != undefined ? el.data.numero_titre : [];

            // <td width="100px" class="numeros">${$('#numeros').val()}</td>

            var articlee =
                $('#article' + el.id).val() == "Pas d'article"
                    ? $('#newarticle' + el.id).val()
                    : $('#article' + el.id).val();
            el.table.append(`<tr valign="top">
              <td width="100px" class="referencearticle line">${$('#referencearticle' + el.id).val()}</td>
              <td width="100px" class="article line">${articlee}</td>
              <td width="100px" class="cout">${$('#cout' + el.id).val()} €</td>
              <td width="100px" class="quantite">${$('#quantite' + el.id).val()}</td>
              <td width="100px" class="demo">${$('#cout' + el.id).val() * $('#quantite' + el.id).val()} €</td>
              <td width="100px" class="umesure">${$('#umesure' + el.id).val()}</td>
              <td width="100px" class="tva">${$('#tva' + el.id).val()} %</td>
              <td width="100px" class="remise">${$('#remise' + el.id).val()} %</td>
              <td width="100px" class="numero_titre">${$('#numero_titre' + el.id).val()}</td>
              <td width="100px"><a href="javascript:void(0);" class="remCF" data-remove="${id}+${i + + articles.length}"><i class='bx bx-x red'></i></a></td></tr>`);

            el.data.numeros.push($('#numeros').val());
            el.data.referencearticle.push($('#referencearticle' + el.id).val());
            el.data.article.push(articlee);
            el.data.cout.push($('#cout' + el.id).val());
            el.data.quantite.push($('#quantite' + el.id).val());
            el.data.umesure.push($('#umesure' + el.id).val());
            el.data.tva.push($('#tva' + el.id).val() + ' %');
            el.data.remise.push($('#remise' + el.id).val() + ' %');
            el.data.numero_titre.push($('#numero_titre' + el.id).val());
            el.data.ids.push(id);

            // RESET INPUT VALUES -> reset seulement les champs pré-remplis quand on sélectionne un article
            $('#newarticle' + el.id).val('');
            $('#article' + el.id).val('');
            $('#referencearticle' + el.id).val('');
            $('#cout' + el.id).val('');
            $('#quantite' + el.id).val('');
            $('#umesure' + el.id).val('');
            $('#tva' + el.id).val('');
            $('#remise' + el.id).val('');
            // $('#numero_titre' + el.id).val('');
        });
    });

    // Création de la table virtuelle de prestations d'une section
    // ? Create Prestations
    prestations.forEach(function (el, i) {
        el.sendButton.click(function () {
            id++;
            // Init with empty array in case of undefiend values
            el.data.ids = el.data.ids != undefined ? el.data.ids : [];
            el.data.numeros = el.data.numeros != undefined ? el.data.numeros : [];
            el.data.prestation = el.data.prestation != undefined ? el.data.prestation : [];
            el.data.referencepresta = el.data.referencepresta != undefined ? el.data.referencepresta : [];
            el.data.cout = el.data.cout != undefined ? el.data.cout : [];
            el.data.quantite = el.data.quantite != undefined ? el.data.quantite : [];
            el.data.umesure = el.data.umesure != undefined ? el.data.umesure : [];
            el.data.tva = el.data.tva != undefined ? el.data.tva : [];
            el.data.remise = el.data.remise != undefined ? el.data.remise : [];
            el.data.numero_titre = el.data.numero_titre != undefined ? el.data.numero_titre : [];

            // <td width="100px" class="numeros">${$('#numeros').val()}</td>

            var prestationn =
                $('#prestation' + el.id).val() == 'Pas de prestation'
                    ? $('#newprestation' + el.id).val()
                    : $('#prestation' + el.id).val();
            $('#table' + el.id).append(`<tr valign="top">
              <td width="100px" class="referencepresta line">${$('#referencepresta' + el.id).val()}</td>
              <td width="100px" class="prestation line">${prestationn}</td>
              <td width="100px" class="cout">${$('#cout' + el.id).val()} €</td>
              <td width="100px" class="quantite">${$('#quantite' + el.id).val()}</td>
              <td width="100px" class="demo">${$('#cout' + el.id).val() * $('#quantite' + el.id).val()} €</td>
              <td width="100px" class="umesure">${$('#umesure' + el.id).val()}</td>
              <td width="100px" class="tva">${$('#tva' + el.id).val()} %</td>
              <td width="100px" class="remise">${$('#remise' + el.id).val()} %</td>
              <td width="100px" class="numero_titre">${$('#numero_titre' + el.id).val()}</td>
              <td width="100px"><a href="javascript:void(0);" class="remCF" data-remove="${id}+${i + prestations.length}"><i class='bx bx-x red'></i></a></td></tr>`);

            el.data.numeros.push($('#numeros').val());
            el.data.referencepresta.push($('#referencepresta' + el.id).val());
            el.data.prestation.push(prestationn);
            el.data.cout.push($('#cout' + el.id).val());
            el.data.quantite.push($('#quantite' + el.id).val());
            el.data.umesure.push($('#umesure' + el.id).val());
            el.data.tva.push($('#tva' + el.id).val() + ' %');
            el.data.remise.push($('#remise' + el.id).val() + ' %');
            el.data.numero_titre.push($('#numero_titre' + el.id).val());
            el.data.ids.push(id);

            // RESET INPUT VALUES -> reset seulement les champs pré-remplis quand on sélectionne une prestation
            $('#newprestation' + el.id).val('');
            $('#prestation' + el.id).val('');
            $('#referencepresta' + el.id).val('');
            $('#cout' + el.id).val('');
            $('#quantite' + el.id).val('');
            $('#umesure' + el.id).val('');
            $('#tva' + el.id).val('');
            $('#remise' + el.id).val('');
            // $('#numero_titre' + el.id).val('');
        });
    });

    //Partie qui permet l'ajout dans la BDD
    $('#button_save').click(function () {
        // ? Save Articles
        (function () {
            var sendNumeros = [];
            var sendArticle = [];
            var sendRef = [];
            var sendcout = [];
            var sendquantite = [];
            var sendUmesure = [];
            var sendTVA = [];
            var sendremise = [];
            var sendNumeroTitre = [];

            // ? Save Articles
            articles.forEach(function (el) {
                sendNumeros = sendNumeros.concat(el.data.numeros != null ? el.data.numeros : []);
                sendArticle = sendArticle.concat(el.data.article != null ? el.data.article : []);
                sendRef = sendRef.concat(el.data.referencearticle != null ? el.data.referencearticle : []);
                sendcout = sendcout.concat(el.data.cout != null ? el.data.cout : []);
                sendquantite = sendquantite.concat(el.data.quantite != null ? el.data.quantite : []);
                sendUmesure = sendUmesure.concat(el.data.umesure != null ? el.data.umesure : []);
                sendTVA = sendTVA.concat(el.data.tva != null ? el.data.tva : []);
                sendremise = sendremise.concat(el.data.remise != null ? el.data.remise : []);
                sendNumeroTitre = sendNumeroTitre.concat(el.data.numero_titre != null ? el.data.numero_titre : []);
            });
            $.ajax({
                url: '../../../html/ltr/coqpix/php/insert_articles_facture.php', //new path, save your work first before u try
                type: 'POST',
                data: {
                    numeros: JSON.stringify(sendNumeros),
                    article: JSON.stringify(sendArticle),
                    referencearticle: JSON.stringify(sendRef),
                    cout: JSON.stringify(sendcout),
                    quantite: JSON.stringify(sendquantite),
                    umesure: JSON.stringify(sendUmesure),
                    tva: JSON.stringify(sendTVA),
                    remise: JSON.stringify(sendremise),
                    numero_titre: JSON.stringify(sendNumeroTitre),
                },
                success: function (data) { },
            });
        })();

        (function () {
            var sendNumeros = [];
            var sendPrestation = [];
            var sendRef = [];
            var sendcout = [];
            var sendquantite = [];
            var sendUmesure = [];
            var sendTVA = [];
            var sendremise = [];
            var sendNumeroTitre = [];

            // ? Save Prestations
            prestations.forEach(function (el) {
                sendNumeros = sendNumeros.concat(el.data.numeros != null ? el.data.numeros : []);
                sendPrestation = sendPrestation.concat(el.data.prestation != null ? el.data.prestation : []);
                sendRef = sendRef.concat(el.data.referencepresta != null ? el.data.referencepresta : []);
                sendcout = sendcout.concat(el.data.cout != null ? el.data.cout : []);
                sendquantite = sendquantite.concat(el.data.quantite != null ? el.data.quantite : []);
                sendUmesure = sendUmesure.concat(el.data.umesure != null ? el.data.umesure : []);
                sendTVA = sendTVA.concat(el.data.tva != null ? el.data.tva : []);
                sendremise = sendremise.concat(el.data.remise != null ? el.data.remise : []);
                sendNumeroTitre = sendNumeroTitre.concat(el.data.numero_titre != null ? el.data.numero_titre : []);
            });

            $.ajax({
                url: '../../../html/ltr/coqpix/php/insert_prestations_facture.php', //new path, save your work first before u try
                type: 'POST',
                data: {
                    numeros: JSON.stringify(sendNumeros),
                    prestation: JSON.stringify(sendPrestation),
                    referencepresta: JSON.stringify(sendRef),
                    cout: JSON.stringify(sendcout),
                    quantite: JSON.stringify(sendquantite),
                    umesure: JSON.stringify(sendUmesure),
                    tva: JSON.stringify(sendTVA),
                    remise: JSON.stringify(sendremise),
                    numero_titre: JSON.stringify(sendNumeroTitre),
                },
                success: function (data) { },
            });
        })();
    });
});