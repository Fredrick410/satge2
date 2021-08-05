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
  function getCp5(btn){	
    $('#ville5').empty();
    $('#ville5').attr('disabled','disabled');		
    $.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
        var ville = "<option value=''>Selectionnez votre ville</option>";  
        if(data.length>0){
            $('#ville5').removeAttr('disabled');
            $.each(data, function (key, value) { 
                ville+="<option value='"+value.name+"' data-insee_code5='"+value.insee_code5+"'>"+value.name+"</option>";  
            }); 
            $('#ville5').html(ville);  
        }else{
            $('#ville5').empty();
            $('#ville5').attr('disabled','disabled');	
        }
    }); 
};

$('#ville5').change(function(event) { 
    $('#insee_code5').val($('option:selected', this).attr('data-insee_code5'));
});
