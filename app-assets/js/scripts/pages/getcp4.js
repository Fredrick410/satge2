$(function() {
    $("#sortable tbody").sortable({
      cursor: "move",
      placeholder: "sortable-placeholder",
      helper: function(e, tr)
      {
        var $originals = tr.children();
        var $helper = tr.clone();
        $helper.children().each(function(index)
        {
        // Set helper cell sizes to match the original sizes
        $(this).width($originals.eq(index).width());
        });
        return $helper;
      }
    }).disableSelection();
  });
  function getCp4(btn){	
    $('#ville4').empty();
    $('#ville4').attr('disabled','disabled');		
    $.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
        var ville = "<option value=''>Selectionnez votre ville</option>";  
        if(data.length>0){
            $('#ville4').removeAttr('disabled');
            $.each(data, function (key, value) { 
                ville+="<option value='"+value.name+"' data-insee_code4='"+value.insee_code4+"'>"+value.name+"</option>";  
            }); 
            $('#ville4').html(ville);  
        }else{
            $('#ville4').empty();
            $('#ville4').attr('disabled','disabled');	
        }
    }); 
};

$('#ville4').change(function(event) { 
    $('#insee_code4').val($('option:selected', this).attr('data-insee_code4'));
});
