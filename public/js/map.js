// on set la position sur la carte
var mymap = L.map('mapid');
// Ajout de la tuile pour la map
L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoiYmlvdG91cmlzdGUiLCJhIjoiY2s0MnRjMW1uMDBxZTNlczVueXk1OXRwbyJ9.6HEfIagqNQob01cRbFVpzQ'
}).addTo(mymap);
//ajout de l'icone du marker
var icone = L.icon({
    iconUrl: 'img/marker.png',
    iconSize: [60, 60]
});
// creation d'un groupe pour les marker que que je peux vider et remplir comme je veux.
lgMarkers = new L.LayerGroup();
mymap.addLayer(lgMarkers);
