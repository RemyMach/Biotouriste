<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.5.1/dist/leaflet.css"
              integrity="sha512-xwE/Az9zrjBIphAcBb3F6JVqxf46+CDLwfLMHloNu6KEQCAWi6HcDUbeOfBIptF7tcCzusKFjFw2yuvEpDL9wQ=="
              crossorigin=""/>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }
            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            #mapid { height: 300px; width: 500px; }

        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}">Register</a>
                        @endif
                    @endauth
                </div>
            @endif

            <div class="content">
                <h2>Ma carte</h2>
                <div id="mapid"></div>

            </div>
        </div>

{{--    AJout du cdn pour la map  --}}
        <script src="https://unpkg.com/leaflet@1.5.1/dist/leaflet.js"
                integrity="sha512-GffPMF3RvMeYyc1LWMHtK8EbPv0iNZ8/oTtHPx9/cc2ILxQ+u905qIwdpULaqDkyBKgOaB57QTMg7ztg8Jm2Og=="
                crossorigin=""></script>
        <script>
            {{--on set la carte --}}
            // var mymap = L.map('mapid').setView([48.852969, 2.349903], 14);
            // //Tuiles de la map
            // L.tileLayer('//{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
            //     attribution: 'donn&eacute;es &copy; <a href="//osm.org/copyright">OpenStreetMap</a>/ODbL - rendu <a href="//openstreetmap.fr">OSM France</a>',
            //     minZoom: 1,
            //     maxZoom: 14
            // }).addTo(mymap);
            // //creation du marqueur et attribution d'une popup
            // var marqueur = L.marker([48.852969, 2.349903]).addTo(mymap);
            // marqueur.bindPopup('<h1>PARIS ICICI</h1>');

            var villes = {
                "Paris": { "lat": 48.852969, "lon": 2.349903 },
                "Brest": { "lat": 48.383, "lon": -4.500 },
                "Quimper": { "lat": 48.000, "lon": -4.100 },
                "Bayonne": { "lat": 43.500, "lon": -1.467 }
            };
            // Fonction d'initialisation de la carte
            function initMap() {
                // Créer l'objet "mymap" et l'insèrer dans l'élément HTML qui a l'ID "map"
                mymap = L.map('map').setView([lat, lon], 11);
                // Leaflet ne récupère pas les cartes (tiles) sur un serveur par défaut. Nous devons lui préciser où nous souhaitons les récupérer. Ici, openstreetmap.fr
                L.tileLayer('https://{s}.tile.openstreetmap.fr/osmfr/{z}/{x}/{y}.png', {
                    attribution: 'données © OpenStreetMap/ODbL - rendu OSM France',
                    minZoom: 1,
                    maxZoom: 20
                }).addTo(mymap);
                // Nous parcourons la liste des villes
                for (ville in villes) {
                    var marker = L.marker([villes[ville].lat, villes[ville].lon]).addTo(mymap);
                }
            }
        </script>
    </body>
</html>
