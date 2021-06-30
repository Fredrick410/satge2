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
  function getCp2(btn){	
    $('#ville2').empty();
    $('#ville2').attr('disabled','disabled');		
    $.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
        var ville = "<option value=''>Selectionnez votre ville</option>";  
        if(data.length>0){
            $('#ville2').removeAttr('disabled');
            $.each(data, function (key, value) { 
                ville+="<option value='"+value.name+"' data-insee_code2='"+value.insee_code2+"'>"+value.name+"</option>";  
            }); 
            $('#ville2').html(ville);  
        }else{
            $('#ville2').empty();
            $('#ville2').attr('disabled','disabled');	
        }
    }); 
};

$('#ville2').change(function(event) { 
    $('#insee_code2').val($('option:selected', this).attr('data-insee_code2'));
});
