$(document).ready(function(){
    $("#list-users ul li").click(function(){
        var entreprise = $(this).find("#entreprise").val();
        var img = $(this).find("#img").val();
        $("#id_client").val($(this).attr('id'));
        $("#author").val($(this).attr('value'));
        $("#profil h6 a").html($(this).find('span').html());
        $("#corp").html(entreprise);
        $("#avatar img").attr('src','../../../app-assets/images/ico/'+img);
        if(entreprise == "SARL")
            $("#badge").attr('class','bullet bullet-success bullet-sm');
        else if(entreprise == "SAS")
            $("#badge").attr('class','bullet bullet-primary bullet-sm');
        else if(entreprise == "SASU")
            $("#badge").attr('class','bullet bullet-warning bullet-sm');
        else if(entreprise == "SCI")
            $("#badge").attr('class','bullet bullet-danger bullet-sm');
        else if(entreprise == "EIRL")
            $("#badge").attr('class','bullet bullet-info bullet-sm');
        else if(entreprise == "EI")
            $("#badge").attr('class','bullet bullet-light bullet-sm');
        else if(entreprise == "Micro-entreprise")
            $("#badge").attr('class','bullet bullet-black bullet-sm');

        
    });



 });


function archiver(destination){
    $.ajax({
        type: "POST",
        url: "php/archiver_conv.php",
        data:'destination='+destination,
        });
}

function retablir(destination){
    $.ajax({
        type: "POST",
        url: "php/retablir_conv.php",
        data:'destination='+destination,
        });
}
