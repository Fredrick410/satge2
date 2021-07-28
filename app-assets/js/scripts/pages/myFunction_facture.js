// calculs
function myFunction() {
    var c = document.getElementById("cout").value;
    var q = document.getElementById("quantite").value;
    document.getElementById("demo").innerHTML = c * q + ' €';
}

const selectElement = document.getElementById("article");

  selectElement.addEventListener('change', (event) => {

    var inp = document.getElementById("newarticle");
    if (selectElement.value == "Pas d'article") {

      inp.disabled = false;

    }else{

      inp.disabled = true;

    }

  });


// const selectElementt = document.getElementById("facturepour");

//   selectElementt.addEventListener('change', (event) => {

//     var inpp = document.getElementById("newfacturepour");
//     if (selectElementt.value == "Pas de clients") {

//       inpp.disabled = false;

//     }else{

//       inpp.disabled = true;

//     }

//   });