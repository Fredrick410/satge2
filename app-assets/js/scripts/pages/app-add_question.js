function htmlEntities(str) {
    return String(str).replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
}

$(document).ready(function () {
    if ($('#table tr:last').attr("id") === undefined)
        var id = 1;
    else {
        var id = $('#table tr:last').attr("id");
        id++;
    }
    /*Assigning id and class for tr and td tags for separation.*/
    $("#button_send").click(function () {
        if (htmlEntities($("#reponse").val()) != '' && htmlEntities($("#vraioufaux").val()) != '') {
            var newid = id++;
            $("#table").append(`<tr valign="top" id="${newid}">
            <td id="reponse${newid}">${htmlEntities($("#reponse").val())}</td>
            <td id="vraioufaux${newid}" class="line">${$("#vraioufaux").val()}</td>
            <td><a href="javascript:void(0);" class="remCF"><i class='bx bx-x red'></i></a></td></tr>`);

            document.getElementById("reponse").value = "";
            document.getElementById("vraioufaux").value = "";
        }
    });

    // function to remove article if u don't want it
    $("#table").on('click', '.remCF', function () {
        $(this).parent().parent().remove();
    });

    /*crating new click event for save button this will save to the database*/
    $("#button_save").click(function () {

        var lastRowId = $('#table tr:last').attr("id"); /*finds id of the last row inside table*/
        var reponses = new Array();
        var vraioufaux = new Array();
        for (var i = 1; i <= lastRowId; i++) {
            if ($("#" + "reponse" + i).html() !== undefined)
                reponses.push($("#" + "reponse" + i).html());
            if ($("#" + "vraioufaux" + i).html() !== undefined)
                vraioufaux.push($("#" + "vraioufaux" + i).html());
        }

        var idqcm = document.getElementById("idqcm").value;
        var libelle = document.getElementById("libelle").value;
        var points = document.getElementById("points").value;

        $.ajax({
            url: "../../../html/ltr/coqpix/php/insert_question.php", //new path, save your work first before u try
            type: "POST",
            data: {
                reponses: reponses,
                vraioufaux: vraioufaux,
                idqcm: idqcm,
                libelle: libelle,
                points: points
            },
            success: function (data) {
                window.location.href = data;
            }
        });
    });

    /*crating new click event for update button this will update the database*/
    $("#button_update").click(function () {

        var lastRowId = $('#table tr:last').attr("id"); /*finds id of the last row inside table*/
        var reponses = new Array();
        var vraioufaux = new Array();
        for (var i = 1; i <= lastRowId; i++) {
            if ($("#" + "reponse" + i).html() !== undefined)
                reponses.push($("#" + "reponse" + i).html());
            if ($("#" + "vraioufaux" + i).html() !== undefined)
                vraioufaux.push($("#" + "vraioufaux" + i).html());
        }

        var idquestion = document.getElementById("idquestion").value;
        var libelle = document.getElementById("libelle").value;
        var points = document.getElementById("points").value;

        $.ajax({
            url: "../../../html/ltr/coqpix/php/edit_question.php", //new path, save your work first before u try
            type: "POST",
            data: {
                reponses: reponses,
                vraioufaux: vraioufaux,
                idquestion: idquestion,
                libelle: libelle,
                points: points
            },
            success: function (data) {
                window.location.href = data;
            }
        });
    });
});

