//fonction pour afficher le dropdown selon si c des biens ou des services
    function bien() {
      const index = document.querySelector('select').options.selectedIndex;
      var sstypbien = document.getElementById('sstypbien');
      var sstypservice = document.getElementById('sstypservice');
      if (index === 1) {
        sstypbien.hidden = true;
        sstypservice.hidden = false;
      }
      if (index === 0) {
        sstypbien.hidden = false;
        sstypservice.hidden = true;
      }

    }
