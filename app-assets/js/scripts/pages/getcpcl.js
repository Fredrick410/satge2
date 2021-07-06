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
  function getCpcl(btn){	
    $('#cl').empty();
    $('#cl').attr('disabled','disabled');		
    $.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
        var cl = "<option value=''>Selectionnez votre Département</option>";  
        if(data.length>0){
            $('#cl').removeAttr('disabled');
            $.each(data, function (key, value) { 
                cl+="<option value='"+value.name+"' data-insee_code4='"+value.insee_code4+"'>"+value.name+"</option>";  
            }); 
            $('#cl').html(cl);  
        }else{
            $('#cl').empty();
            $('#cl').attr('disabled','disabled');	
        }
    }); 
};

$('#cl').change(function(event) { 
    $('#insee_code4').val($('option:selected', this).attr('data-insee_code4'));
});