@include('layouts.header')
@include('layouts.navbar')

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
          integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
          crossorigin=""/>
    <title>Document</title>
    <style>
        #mapid { height: 300px; width: 500px; }
    </style>
</head>
<body>


<h2>Ma carte</h2>


<div id="mapid"></div>

{{--    AJout du cdn pour la map--}}
<script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
        integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
        crossorigin=""></script>
<script>
    // on set la position sur la carte
    var mymap = L.map('mapid').setView([48.852969, 2.349903], 10);
    //Skin de la map
    L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
        attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
        minZoom: 1,
        maxZoom: 14
    }).addTo(mymap);
    //ajout du nouveau marqueur
    var icone = L.icon({
        iconUrl: 'path',
        iconSize: [50, 50]
    });

    //creation des marqueurs et attributions des popups
    // var marqueur = L.marker([48.852969, 2.349903]).addTo(mymap);
    // marqueur.bindPopup('<h1>PARIS ICICI</h1>');
     @foreach($announces as $announce)
        var marqueur{{$announce->idAnnounce}} = L.marker([{{ $announce->announce_latLong }}]).addTo(mymap);
        marqueur{{$announce->idAnnounce}}.bindPopup('{{$announce->announce_name}}');
     @endforeach

</script>
</body>
</html>