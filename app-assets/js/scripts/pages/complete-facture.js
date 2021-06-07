function loadDatasclient(name_client) {
        var data = {name_client: name_client};
        $.ajax({
            type: "POST",
            url: "php/load-cs-client.php",
            data: data,
            async: true,
            dataType: "json"
        }).done(function (reponse) {
          if (typeof(reponse)!="undefined" && reponse!=null ){  
            var adresse = typeof (reponse.adresse) != 'undefined' ? reponse.adresse : '';
            var email = typeof (reponse.email) != 'undefined' ? reponse.email : '';
            var departement = typeof (reponse.departement) != 'undefined' ? reponse.departement : '';
            var tel = typeof (reponse.tel) != 'undefined' ? reponse.tel : '';
            $("#adresse").val(adresse);
            $("#departement").val(departement);
            $("#email").val(email);
            $("#telephone").val(tel);
          }
        }).fail(function (jqXHR, textStatus) {
          alert('Ajax error');
          console.log({textStatus}, {jqXHR})
        });

      }

      $(document).ready(function (){

        loadDatasclient();

        $("#facturepour").on("change", function (){
            var name_client = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
            loadDatasclient(name_client);
        });
      });


      // article


function loadDatasarticle(article) {
        var datat = {article: article};
        $.ajax({
            type: "POST",
            url: "php/load-cs-article.php",
            data: datat,
            async: true,
            dataType: "json"
        }).done(function (reponses) {
          if (typeof(reponses)!="undefined" && reponses!=null ){  
          var prixvente = typeof (reponses.prixvente) != 'undefined' ? reponses.prixvente : '';
          var tvavente = typeof (reponses.tvavente) != 'undefined' ? reponses.tvavente : '20';
          var referencearticle = typeof (reponses.referencearticle) != 'undefined' ? reponses.referencearticle : '';
          var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
          $("#cout").val(prixvente);
          $("#tva").val(tvavente);
          $("#referencearticle").val(referencearticle);
          $("#umesure").val(unitemesure);
        }
        }).fail(function (jqXHR, textStatus) {
          alert('Ajax error');
          console.log({textStatus}, {jqXHR})
        });

      }

      $(document).ready(function (){

        loadDatasarticle();

        $("#article").on("change", function (){
            var article = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
            loadDatasarticle(article);
        });
      });