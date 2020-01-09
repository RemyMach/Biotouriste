@include('layouts.header')
<div id="content-1">
      @include('layouts.navbar_default')
        <div class="row">
            <div class="col-md-12">
            <input type="text" name="cityZone" id="cityZone" value="paris">
                <button type="submit" onclick="findCityData()">Find</button>
            </div>
            <div class="col-md-12 navbar navbar-expand-lg">
                  <ul class="navbar-nav inline categories">
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(1)">Fruits</a></li>
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(2)">Légumes</a></li>
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(3)">Céréales</a></li>
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(4)">Boissons</a></li>
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(5)">Gateaux</a></li>
                      <li class="col-md-2"><a onClick="filterByCategorieProduct(6)">Epices</a></li>
                  </ul>
            </div>
        </div>
        <div class="row">
            <div id="divAnnounces" class="col-md-6 divAnnounces"></div>
            <div class="col-md-6" id="mapid" style="height: 500px"></div>
        </div>
</div>
@include('layouts.footer')
{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>

{{-- Map --}}
<script>
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
</script>


{{-- Announces --}}
<script>
$(function() {
    findCityData();
});

function showAnnounce(announce) {

}

function findByCity(cityData){
    $.ajax({
        url: '/filterByCity',
        type: 'POST',
        data: {cityData: cityData[0],  _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function(result){
            debugger;
            console.log(result);
            mymap.removeLayer(this);
            mymap.setView([result.lat, result.lng], 10, { animation: true });
            remplirDivAnnonce(result.announces);
        }
    });
}

function findCityData(){
    $.ajax({
        url: 'http://api.geonames.org/searchJSON?&',
        type: 'GET',
        data: {q : $('#cityZone').val(), maxRows: 1, username: 'biotouriste'},
        dataType: "json",
        success: function (result){
            findByCity(result.geonames);
        }
    });
}

function filterByCategorieProduct(categorie){
    $.ajax({
        url: 'http://api.geonames.org/searchJSON?&',
        type: 'GET',
        data: {q : $('#cityZone').val(), maxRows: 1, username: 'biotouriste'},
        dataType: "json",
        success: function (result){
            $.ajax({
                url: "/filterByCategorie",
                type: 'POST',
                data: {cityData: result.geonames[0], categorie: categorie, _token: '{{csrf_token()}}'},
                success: function (retour, statut) {
                    remplirDivAnnonce(retour.announces);
                },
                error: function (resultat, statut, erreur) {
                    console.log('marche pas frero')
                }});
        }
    });
}

function remplirDivAnnonce(announces){
    lgMarkers.clearLayers();
    $('#divAnnounces').empty();
    var div = '';
    announces.forEach(function (announce) {
        div = div +
        "<div class='post' onclick='showAnnounce(announce)'>"+
            "<div class='row'>"+
                "<div class='col-md-4'>"+
                    "<div class='icon'></div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='text'>"+
                        "<h3>"+announce['announce_name']+"</h3>"+
                        "<h5>"+announce['announce_comment']+"</h5>"+
                        "<h6>"+announce['announce_adresse']+"</h6>"+
                    "</div>"+
                "</div>"+
                "<div class='col-md-4'>"+
                    "<div class='text'>"+
                        "<h6>"+announce['announce_price']+"€</h6>"+
                    "</div>"+
                "</div>"+
            "</div>"+
        "</div>";
        var marker = new L.marker([announce['announce_lat'], announce['announce_lng']], {icon: icone}).addTo(lgMarkers);
        marker.bindPopup(announce['announce_name']);
    });
    $('#divAnnounces').append(div);
}
</script>
