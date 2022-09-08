var d = 0;
var p = 0;
var t = 0; 
var c = 0;

var poidsElement = document.getElementById("annonces1_poids");
poidsElement.addEventListener("change",getPoids);
function getPoids(){
    p = poidsElement.options[poidsElement.selectedIndex].text.substr(-1);
    console.log(p);
    calculatePrice();
}

var tailleElement = document.getElementById("annonces1_taille");
tailleElement.addEventListener("change",getTaille);
function getTaille(){
    t = tailleElement.options[tailleElement.selectedIndex].text.substr(-1);
    console.log(t);
    calculatePrice();
}

var distanceElement = document.getElementById("annonces1_distance");
distanceElement.addEventListener("change",getDistance);
function getDistance(){
    d = distanceElement.options[distanceElement.selectedIndex].text.substr(-1);
    console.log(d);
    calculatePrice();
}

function calculatePrice(){
        var result = Math.round((parseInt(p)+parseInt(t))*(1+(parseInt(d)/10)*(parseInt(c)))*100)/100;
        console.log(result);
        prixRecommandeElement.textContent='Rémunération recommandée : ' + result +'€';
}

var categorieElement = document.getElementById("annonces1_categorie");
categorieElement.addEventListener("change",getCategorie);
function getCategorie(){
    c = categorieElement.options[categorieElement.selectedIndex].text.substr(-1);
    console.log(c);
    calculatePrice();
}

var prixRecommandeElement = document.createElement('p');
var remunerationElement = document.getElementById('annonces1_remuneration_livreur');
remunerationElement.insertAdjacentElement('beforebegin',prixRecommandeElement);