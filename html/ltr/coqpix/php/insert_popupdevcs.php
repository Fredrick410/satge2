<?php 

require_once 'verif_session_connect.php';
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
require_once 'config.php';

    $insert = $bdd->prepare('INSERT INTO client (name_client, prenom, numsiret, tvaintracom, pays, adresse, departement, secteur, tel, siteweb, email, iban, nom_diri, email_diri, tel_diri, cat, id_session) VALUES(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)');
    $insert->execute(array(
        htmlspecialchars($_POST['name_client']),
        htmlspecialchars($_POST['prenom']),
        htmlspecialchars($_POST['numsiret']),
        htmlspecialchars($_POST['tvaintracom']),
        htmlspecialchars($_POST['pays']),
        htmlspecialchars($_POST['adresse']),
        htmlspecialchars($_POST['departement']),
        htmlspecialchars($_POST['secteur']),
        htmlspecialchars($_POST['tel']),
        htmlspecialchars($_POST['siteweb']),
        htmlspecialchars($_POST['email']),
        htmlspecialchars($_POST['iban']),
        htmlspecialchars($_POST['nom_diri']),
        htmlspecialchars(""),
        htmlspecialchars(""),
        htmlspecialchars($_POST['cat']),
        htmlspecialchars($_SESSION['id_session'])
    ));

    header('Location: ../app-devis-add.php?jXN955CbHqqbQ463u5Uq=1');

?>

<script>  $(function() {
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
			});</script>