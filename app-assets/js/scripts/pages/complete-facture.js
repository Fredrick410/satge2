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
          var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
          var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
          var referencearticle = typeof (reponses.referencearticle) != 'undefined' ? reponses.referencearticle : '';
          var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
          var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
          $("#cout").val(coutachat);
          $("#tva").val(tvaachat);
          $("#referencearticle").val(referencearticle);
          $("#umesure").val(unitemesure);
          $("#remise").val(remise);
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

      //Pour permettre la recherche dans la bdd et auto-complète les champs des articles (dans la 2ème section article de la facture) | les 2 autres en dessous, c'est aussi pour la section 3 et 4
      function loadDatasarticle2(article) {
        var datat = {article: article};
        $.ajax({
            type: "POST",
            url: "php/load-cs-article.php",
            data: datat,
            async: true,
            dataType: "json"
        }).done(function (reponses) {
          if (typeof(reponses)!="undefined" && reponses!=null ){  
          var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
          var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
          var referencearticle = typeof (reponses.referencearticle) != 'undefined' ? reponses.referencearticle : '';
          var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
          var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
          $("#cout2").val(coutachat);
          $("#tva2").val(tvaachat);
          $("#referencearticle2").val(referencearticle);
          $("#umesure2").val(unitemesure);
          $("#remise2").val(remise);
        }
        }).fail(function (jqXHR, textStatus) {
          alert('Ajax error');
          console.log({textStatus}, {jqXHR})
        });

      }

      $(document).ready(function (){

        loadDatasarticle2();

        $("#article2").on("change", function (){
            var article = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
            loadDatasarticle2(article);
        });
      });

      function loadDatasarticle3(article) {
        var datat = {article: article};
        $.ajax({
            type: "POST",
            url: "php/load-cs-article.php",
            data: datat,
            async: true,
            dataType: "json"
        }).done(function (reponses) {
          if (typeof(reponses)!="undefined" && reponses!=null ){  
          var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
          var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
          var referencearticle = typeof (reponses.referencearticle) != 'undefined' ? reponses.referencearticle : '';
          var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
          var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
          $("#cout3").val(coutachat);
          $("#tva3").val(tvaachat);
          $("#referencearticle3").val(referencearticle);
          $("#umesure3").val(unitemesure);
          $("#remise3").val(remise);
        }
        }).fail(function (jqXHR, textStatus) {
          alert('Ajax error');
          console.log({textStatus}, {jqXHR})
        });

      }

      $(document).ready(function (){

        loadDatasarticle3();

        $("#article3").on("change", function (){
            var article = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
            loadDatasarticle3(article);
        });
      });

      function loadDatasarticle4(article) {
        var datat = {article: article};
        $.ajax({
            type: "POST",
            url: "php/load-cs-article.php",
            data: datat,
            async: true,
            dataType: "json"
        }).done(function (reponses) {
          if (typeof(reponses)!="undefined" && reponses!=null ){  
          var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
          var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
          var referencearticle = typeof (reponses.referencearticle) != 'undefined' ? reponses.referencearticle : '';
          var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
          var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
          $("#cout4").val(coutachat);
          $("#tva4").val(tvaachat);
          $("#referencearticle4").val(referencearticle);
          $("#umesure4").val(unitemesure);
          $("#remise4").val(remise);
        }
        }).fail(function (jqXHR, textStatus) {
          alert('Ajax error');
          console.log({textStatus}, {jqXHR})
        });

      }

      $(document).ready(function (){

        loadDatasarticle4();

        $("#article4").on("change", function (){
            var article = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
            loadDatasarticle4(article);
        });
      });

//-------------------------------------------------------------------------------
//Même chose que précedemment, chargement des données des prestations pour l'auto-complete des champs dans les sections prestations d'une facture

function loadDatasprestation5(prestation) {
  var datat = {prestation: prestation};
  $.ajax({
      type: "POST",
      url: "php/load-cs-prestation.php",
      data: datat,
      async: true,
      dataType: "json"
  }).done(function (reponses) {
    if (typeof(reponses)!="undefined" && reponses!=null ){  
    var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
    var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
    var referencepresta = typeof (reponses.referencepresta) != 'undefined' ? reponses.referencepresta : '';
    var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
    var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
    $("#cout5").val(coutachat);
    $("#tva5").val(tvaachat);
    $("#referencepresta5").val(referencepresta);
    $("#umesure5").val(unitemesure);
    $("#remise5").val(remise);
  }
  }).fail(function (jqXHR, textStatus) {
    alert('Ajax error');
    console.log({textStatus}, {jqXHR})
  });

}

$(document).ready(function (){

  loadDatasprestation5();

  $("#prestation5").on("change", function (){
      var prestation = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
      loadDatasprestation5(prestation);
  });
});

function loadDatasprestation6(prestation) {
  var datat = {prestation: prestation};
  $.ajax({
      type: "POST",
      url: "php/load-cs-prestation.php",
      data: datat,
      async: true,
      dataType: "json"
  }).done(function (reponses) {
    if (typeof(reponses)!="undefined" && reponses!=null ){  
    var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
    var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
    var referencepresta = typeof (reponses.referencepresta) != 'undefined' ? reponses.referencepresta : '';
    var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
    var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
    $("#cout6").val(coutachat);
    $("#tva6").val(tvaachat);
    $("#referencepresta6").val(referencepresta);
    $("#umesure6").val(unitemesure);
    $("#remise6").val(remise);
  }
  }).fail(function (jqXHR, textStatus) {
    alert('Ajax error');
    console.log({textStatus}, {jqXHR})
  });

}

$(document).ready(function (){

  loadDatasprestation6();

  $("#prestation6").on("change", function (){
      var prestation = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
      loadDatasprestation6(prestation);
  });
});

function loadDatasprestation7(prestation) {
  var datat = {prestation: prestation};
  $.ajax({
      type: "POST",
      url: "php/load-cs-prestation.php",
      data: datat,
      async: true,
      dataType: "json"
  }).done(function (reponses) {
    if (typeof(reponses)!="undefined" && reponses!=null ){  
    var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
    var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
    var referencepresta = typeof (reponses.referencepresta) != 'undefined' ? reponses.referencepresta : '';
    var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
    var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
    $("#cout7").val(coutachat);
    $("#tva7").val(tvaachat);
    $("#referencepresta7").val(referencepresta);
    $("#umesure7").val(unitemesure);
    $("#remise7").val(remise);
  }
  }).fail(function (jqXHR, textStatus) {
    alert('Ajax error');
    console.log({textStatus}, {jqXHR})
  });

}

$(document).ready(function (){

  loadDatasprestation7();

  $("#prestation7").on("change", function (){
      var prestation = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
      loadDatasprestation7(prestation);
  });
});

function loadDatasprestation8(prestation) {
  var datat = {prestation: prestation};
  $.ajax({
      type: "POST",
      url: "php/load-cs-prestation.php",
      data: datat,
      async: true,
      dataType: "json"
  }).done(function (reponses) {
    if (typeof(reponses)!="undefined" && reponses!=null ){  
    var coutachat = typeof (reponses.coutachat) != 'undefined' ? reponses.coutachat : '';
    var tvaachat = typeof (reponses.tvaachat) != 'undefined' ? reponses.tvaachat : '20';
    var referencepresta = typeof (reponses.referencepresta) != 'undefined' ? reponses.referencepresta : '';
    var unitemesure = typeof (reponses.umesure) != 'undefined' ? reponses.umesure : '';
    var remise = typeof (reponses.remise) != 'undefined' ? reponses.remise : '0';
    $("#cout8").val(coutachat);
    $("#tva8").val(tvaachat);
    $("#referencepresta8").val(referencepresta);
    $("#umesure8").val(unitemesure);
    $("#remise8").val(remise);
  }
  }).fail(function (jqXHR, textStatus) {
    alert('Ajax error');
    console.log({textStatus}, {jqXHR})
  });

}

$(document).ready(function (){

  loadDatasprestation8();

  $("#prestation8").on("change", function (){
      var prestation = $(this).val(); // ID correspondant dans la bdd au facturepour selectionné
      loadDatasprestation8(prestation);
  });
});