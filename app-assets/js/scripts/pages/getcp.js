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
function getCp(btn){	
				$('#ville').empty();
				$('#ville').attr('disabled','disabled');		
				$.getJSON("https://comparateurs.hyperassur.com/api/miscellaneous/cities/"+btn.val(), function (data) { 
					var ville = "<option value=''>Selectionnez votre ville</option>";  
					if(data.length>0){
						$('#ville').removeAttr('disabled');
						$.each(data, function (key, value) { 
							ville+="<option value='"+value.name+"' data-insee_code='"+value.insee_code+"'>"+value.name+"</option>";  
						}); 
						$('#ville').html(ville);  
					}else{
						$('#ville').empty();
						$('#ville').attr('disabled','disabled');	
					}
				}); 
			};

			$('#ville').change(function(event) { 
				$('#insee_code').val($('option:selected', this).attr('data-insee_code'));
			});