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
  function getCp6(btn){	
    $('#ville6').empty();
    $('#ville6').attr('disabled','disabled');		
    $.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
        var ville = "<option value=''>Selectionnez votre ville</option>";  
        if(data.length>0){
            $('#ville6').removeAttr('disabled');
            $.each(data, function (key, value) { 
                ville+="<option value='"+value.name+"' data-insee_code6='"+value.insee_code6+"'>"+value.name+"</option>";  
            }); 
            $('#ville6').html(ville);  
        }else{
            $('#ville6').empty();
            $('#ville6').attr('disabled','disabled');	
        }
    }); 
};

$('#ville6').change(function(event) { 
    $('#insee_code6').val($('option:selected', this).attr('data-insee_code6'));
});
