@include('layouts.header')
<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
        integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
        crossorigin=""/>
  <title>Document</title>
  <style>
    .divAnnounces{
        overflow-y: scroll;
    }
    .categories li{
        text-align: center;
        margin: 0 10px 0 0;
        padding: 0 20px 0 20px;
        color: darkgrey;
        background-color: white;
        border: 2px solid #1b1e21;
        border-radius: 30%;
    }
  </style>
</head>
<div id="content-1">
      @include('layouts.navbar')
        <div class="row">
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

<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
{{-- Script pour la map  --}}
<script>
  // on set la position sur la carte
  var mymap = L.map('mapid').setView([48.852969, 2.349903], 10);
  //Skin de la map
  // L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
  //   attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
  //   minZoom: 1,
  //   maxZoom: 14
  // }).addTo(mymap);
  L.tileLayer('https://api.mapbox.com/styles/v1/{id}/tiles/{z}/{x}/{y}?access_token={accessToken}', {
    attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
    maxZoom: 18,
    id: 'mapbox/streets-v11',
    accessToken: 'pk.eyJ1IjoiYmlvdG91cmlzdGUiLCJhIjoiY2s0MnRjMW1uMDBxZTNlczVueXk1OXRwbyJ9.6HEfIagqNQob01cRbFVpzQ'
  }).addTo(mymap);
  //ajout du nouveau marqueur
  var icone = L.icon({
    iconUrl: 'img/marker.png',
    iconSize: [60, 60]
  });
  @foreach($announces as $announce)
  var marqueur{{$announce->idAnnounce}} = L.marker([{{ $announce->announce_latLong }}], {icon: icone}).addTo(mymap);
  marqueur{{$announce->idAnnounce}}.bindPopup('{{$announce->announce_name}}');
  @endforeach

</script>

{{-- Functions --}}
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>

function filterByCategorieProduct(categorie){
  $.ajax({
    url: "/filterByCategorie",
    type: 'POST',
    data: {categorie: categorie, _token: '{{csrf_token()}}'},
    success: function (retour, statut) {
        console.log(retour.announces);
        remplirDivAnnonce(retour.announces);
  },
  error: function (resultat, statut, erreur) {
    console.log('NOOOOOOO');
  }});
}

function remplirDivAnnonce(announces){
    $('#divAnnounces').empty();
    var div = '';
    announces.forEach(function (announce) {
         div = div +
            "<div class='post'>"+
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
            "</div>"
    });
    $('#divAnnounces').append(div);
}
</script>