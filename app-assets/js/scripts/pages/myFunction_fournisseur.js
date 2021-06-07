const selectElementt = document.getElementById("fournisseur");
selectElementt.addEventListener('change', (event) => {

  var inpp = document.getElementById("newfournisseur");
  if (selectElementt.value == "Pas de fournisseur") {

    inpp.disabled = false;

  } else {

    inpp.disabled = true;

  }

});
