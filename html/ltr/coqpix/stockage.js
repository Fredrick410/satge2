let btnClientFact = document.querySelector('#btnClient');
let btnClientFact2 = document.querySelector('#btnClient2');
let btnClientFact3 = document.querySelector('#btnClient3');
let btnClientFact4 = document.querySelector('#btnClient4');
let btnClientFact5 = document.querySelector('#btnClient5');
let btnClientFact6 = document.querySelector('#btnClient6');
let btnClientFact7 = document.querySelector('#button_save');
let btnClientFact8 = document.querySelector('#subbt');

btnClientFact.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    //Pour les articles
    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});

btnClientFact2.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});

btnClientFact3.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);

    
});

btnClientFact4.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});


btnClientFact5.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});

btnClientFact6.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});

btnClientFact7.addEventListener("click", () => {
    localStorage.setItem('ref', document.querySelector('#reffacture').value);
    localStorage.setItem('date', document.querySelector('#dte').value);
    localStorage.setItem('dateecheance', document.querySelector('#dateecheance').value);
    localStorage.setItem('nomfacture', document.querySelector('#nomproduit').value);
    localStorage.setItem('descrip', document.querySelector('#descrip').value);

    localStorage.setItem('facpour', document.querySelector('#facturepour').value);
    localStorage.setItem('adress', document.querySelector('#adresse').value);
    // localStorage.setItem('codepost', document.querySelector('#codepostal').value);
    // localStorage.setItem('vill', document.querySelector('#ville').value);
    localStorage.setItem('mail', document.querySelector('#email').value);
    localStorage.setItem('tel', document.querySelector('#telephone').value);

    localStorage.setItem('adress2', document.querySelector('#adresse2').value);
    // localStorage.setItem('codepost2', document.querySelector('#codepostal2').value);
    // localStorage.setItem('vill2', document.querySelector('#ville2').value);

    localStorage.setItem('titre', document.querySelector('#numero_titre').value);
    localStorage.setItem('nomarticle', document.querySelector('#article').value);
    localStorage.setItem('prix', document.querySelector('#cout').value);
    localStorage.setItem('quantitee', document.querySelector('#quantite').value);
    localStorage.setItem('refarticle', document.querySelector('#referencearticle').value);
    localStorage.setItem('remisee', document.querySelector('#remise').value);
    localStorage.setItem('tvaa', document.querySelector('#tva').value);
    localStorage.setItem('unitemesure', document.querySelector('#umesure').value);

    localStorage.setItem('titre2', document.querySelector('#numero_titre2').value);
    localStorage.setItem('nomarticle2', document.querySelector('#article2').value);
    localStorage.setItem('prix2', document.querySelector('#cout2').value);
    localStorage.setItem('quantitee2', document.querySelector('#quantite2').value);
    localStorage.setItem('refarticle2', document.querySelector('#referencearticle2').value);
    localStorage.setItem('remisee2', document.querySelector('#remise2').value);
    localStorage.setItem('tvaa2', document.querySelector('#tva2').value);
    localStorage.setItem('unitemesure2', document.querySelector('#umesure2').value);

    localStorage.setItem('titre3', document.querySelector('#numero_titre3').value);
    localStorage.setItem('nomarticle3', document.querySelector('#article3').value);
    localStorage.setItem('prix3', document.querySelector('#cout3').value);
    localStorage.setItem('quantitee3', document.querySelector('#quantite3').value);
    localStorage.setItem('refarticle3', document.querySelector('#referencearticle3').value);
    localStorage.setItem('remisee3', document.querySelector('#remise3').value);
    localStorage.setItem('tvaa3', document.querySelector('#tva3').value);
    localStorage.setItem('unitemesure3', document.querySelector('#umesure3').value);

    localStorage.setItem('titre4', document.querySelector('#numero_titre4').value);
    localStorage.setItem('nomarticle4', document.querySelector('#article4').value);
    localStorage.setItem('prix4', document.querySelector('#cout4').value);
    localStorage.setItem('quantitee4', document.querySelector('#quantite4').value);
    localStorage.setItem('refarticle4', document.querySelector('#referencearticle4').value);
    localStorage.setItem('remisee4', document.querySelector('#remise4').value);
    localStorage.setItem('tvaa4', document.querySelector('#tva4').value);
    localStorage.setItem('unitemesure4', document.querySelector('#umesure4').value);

    //Pour les prestations
    localStorage.setItem('titre5', document.querySelector('#numero_titre5').value);
    localStorage.setItem('nomprestation5', document.querySelector('#prestation5').value);
    localStorage.setItem('prix5', document.querySelector('#cout5').value);
    localStorage.setItem('quantitee5', document.querySelector('#quantite5').value);
    localStorage.setItem('refprestation5', document.querySelector('#referencepresta5').value);
    localStorage.setItem('remisee5', document.querySelector('#remise5').value);
    localStorage.setItem('tvaa5', document.querySelector('#tva5').value);
    localStorage.setItem('unitemesure5', document.querySelector('#umesure5').value);

    localStorage.setItem('titre6', document.querySelector('#numero_titre6').value);
    localStorage.setItem('nomprestation6', document.querySelector('#prestation6').value);
    localStorage.setItem('prix6', document.querySelector('#cout6').value);
    localStorage.setItem('quantitee6', document.querySelector('#quantite6').value);
    localStorage.setItem('refprestation6', document.querySelector('#referencepresta6').value);
    localStorage.setItem('remisee6', document.querySelector('#remise6').value);
    localStorage.setItem('tvaa6', document.querySelector('#tva6').value);
    localStorage.setItem('unitemesure6', document.querySelector('#umesure6').value);

    localStorage.setItem('titre7', document.querySelector('#numero_titre7').value);
    localStorage.setItem('nomprestation7', document.querySelector('#prestation7').value);
    localStorage.setItem('prix7', document.querySelector('#cout7').value);
    localStorage.setItem('quantitee7', document.querySelector('#quantite7').value);
    localStorage.setItem('refprestation7', document.querySelector('#referencepresta7').value);
    localStorage.setItem('remisee7', document.querySelector('#remise7').value);
    localStorage.setItem('tvaa7', document.querySelector('#tva7').value);
    localStorage.setItem('unitemesure7', document.querySelector('#umesure7').value);

    localStorage.setItem('titre8', document.querySelector('#numero_titre8').value);
    localStorage.setItem('nomprestation8', document.querySelector('#prestation8').value);
    localStorage.setItem('prix8', document.querySelector('#cout8').value);
    localStorage.setItem('quantitee8', document.querySelector('#quantite8').value);
    localStorage.setItem('refprestation8', document.querySelector('#referencepresta8').value);
    localStorage.setItem('remisee8', document.querySelector('#remise8').value);
    localStorage.setItem('tvaa8', document.querySelector('#tva8').value);
    localStorage.setItem('unitemesure8', document.querySelector('#umesure8').value);

    //--------------------------------

    localStorage.setItem('accomptee', document.querySelector('#accompte').value);
    localStorage.setItem('modalitee', document.querySelector('#modalite').value);
    localStorage.setItem('monnaiee', document.querySelector('#monnaie').value);
    localStorage.setItem('notee', document.querySelector('#note').value);
    localStorage.setItem('etiquettee', document.querySelector('#etiquette').value);
    localStorage.setItem('statutt', document.querySelector('#statut').value);
});

btnClientFact8.addEventListener("click", () => {
    localStorage.clear();
});

document.querySelector('#reffacture').value = localStorage.getItem('ref');
document.querySelector('#dte').value = localStorage.getItem('date');
document.querySelector('#dateecheance').value = localStorage.getItem('dateecheance');
document.querySelector('#nomproduit').value = localStorage.getItem('nomfacture');
document.querySelector('#descrip').value = localStorage.getItem('descrip');

document.querySelector('#facturepour').value = localStorage.getItem('facpour');
document.querySelector('#adresse').value = localStorage.getItem('adress');
// document.querySelector('#codepostal').value = localStorage.getItem('codepost');
// document.querySelector('#ville').value = localStorage.getItem('vill');
document.querySelector('#email').value = localStorage.getItem('mail');
document.querySelector('#telephone').value = localStorage.getItem('tel');

document.querySelector('#adresse2').value = localStorage.getItem('adress2');
// document.querySelector('#codepostal2').value = localStorage.getItem('codepost2');
// document.querySelector('#ville2').value = localStorage.getItem('vill2');

//Pour les articles
document.querySelector('#numero_titre').value = localStorage.getItem('titre');
document.querySelector('#article').value = localStorage.getItem('nomarticle');
document.querySelector('#cout').value = localStorage.getItem('prix');
document.querySelector('#quantite').value = localStorage.getItem('quantitee');
document.querySelector('#referencearticle').value = localStorage.getItem('refarticle');
document.querySelector('#remise').value = localStorage.getItem('remisee');
document.querySelector('#tva').value = localStorage.getItem('tvaa');
document.querySelector('#umesure').value = localStorage.getItem('unitemesure');

document.querySelector('#numero_titre2').value = localStorage.getItem('titre2');
document.querySelector('#article2').value = localStorage.getItem('nomarticle2');
document.querySelector('#cout2').value = localStorage.getItem('prix2');
document.querySelector('#quantite2').value = localStorage.getItem('quantitee2');
document.querySelector('#referencearticle2').value = localStorage.getItem('refarticle2');
document.querySelector('#remise2').value = localStorage.getItem('remisee2');
document.querySelector('#tva2').value = localStorage.getItem('tvaa2');
document.querySelector('#umesure2').value = localStorage.getItem('unitemesure2');

document.querySelector('#numero_titre3').value = localStorage.getItem('titre3');
document.querySelector('#article3').value = localStorage.getItem('nomarticle3');
document.querySelector('#cout3').value = localStorage.getItem('prix3');
document.querySelector('#quantite3').value = localStorage.getItem('quantitee3');
document.querySelector('#referencearticle3').value = localStorage.getItem('refarticle3');
document.querySelector('#remise3').value = localStorage.getItem('remisee3');
document.querySelector('#tva3').value = localStorage.getItem('tvaa3');
document.querySelector('#umesure3').value = localStorage.getItem('unitemesure3');

document.querySelector('#numero_titre4').value = localStorage.getItem('titre4');
document.querySelector('#article4').value = localStorage.getItem('nomarticle4');
document.querySelector('#cout4').value = localStorage.getItem('prix4');
document.querySelector('#quantite4').value = localStorage.getItem('quantitee4');
document.querySelector('#referencearticle4').value = localStorage.getItem('refarticle4');
document.querySelector('#remise4').value = localStorage.getItem('remisee4');
document.querySelector('#tva4').value = localStorage.getItem('tvaa4');
document.querySelector('#umesure4').value = localStorage.getItem('unitemesure4');

//Pour les prestations
document.querySelector('#numero_titre5').value = localStorage.getItem('titre5');
document.querySelector('#prestation5').value = localStorage.getItem('nomprestation5');
document.querySelector('#cout5').value = localStorage.getItem('prix5');
document.querySelector('#quantite5').value = localStorage.getItem('quantitee5');
document.querySelector('#referencepresta5').value = localStorage.getItem('refprestation5');
document.querySelector('#remise5').value = localStorage.getItem('remisee5');
document.querySelector('#tva5').value = localStorage.getItem('tvaa5');
document.querySelector('#umesure5').value = localStorage.getItem('unitemesure5');

document.querySelector('#numero_titre6').value = localStorage.getItem('titre6');
document.querySelector('#prestation6').value = localStorage.getItem('nomprestation6');
document.querySelector('#cout6').value = localStorage.getItem('prix6');
document.querySelector('#quantite6').value = localStorage.getItem('quantitee6');
document.querySelector('#referencepresta6').value = localStorage.getItem('refprestation6');
document.querySelector('#remise6').value = localStorage.getItem('remisee6');
document.querySelector('#tva6').value = localStorage.getItem('tvaa6');
document.querySelector('#umesure6').value = localStorage.getItem('unitemesure6');

document.querySelector('#numero_titre7').value = localStorage.getItem('titre7');
document.querySelector('#prestation7').value = localStorage.getItem('nomprestation7');
document.querySelector('#cout7').value = localStorage.getItem('prix7');
document.querySelector('#quantite7').value = localStorage.getItem('quantitee7');
document.querySelector('#referencepresta7').value = localStorage.getItem('refprestation7');
document.querySelector('#remise7').value = localStorage.getItem('remisee7');
document.querySelector('#tva7').value = localStorage.getItem('tvaa7');
document.querySelector('#umesure7').value = localStorage.getItem('unitemesure7');

document.querySelector('#numero_titre8').value = localStorage.getItem('titre8');
document.querySelector('#prestation8').value = localStorage.getItem('nomprestation8');
document.querySelector('#cout8').value = localStorage.getItem('prix8');
document.querySelector('#quantite8').value = localStorage.getItem('quantitee8');
document.querySelector('#referencepresta8').value = localStorage.getItem('refprestation8');
document.querySelector('#remise8').value = localStorage.getItem('remisee8');
document.querySelector('#tva8').value = localStorage.getItem('tvaa8');
document.querySelector('#umesure8').value = localStorage.getItem('unitemesure8');

//--------------------------------

document.querySelector('#accompte').value = localStorage.getItem('accomptee');
document.querySelector('#modalite').value = localStorage.getItem('modalitee');
document.querySelector('#monnaie').value = localStorage.getItem('monnaiee');
document.querySelector('#note').value = localStorage.getItem('notee');
document.querySelector('#etiquette').value = localStorage.getItem('etiquettee');
document.querySelector('#statut').value = localStorage.getItem('statutt');