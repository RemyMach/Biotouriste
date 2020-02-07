@include('layouts.header')
<div id="content-1">
      @include('layouts.navbarDesktop')
        <div class="row">
            <div class="col-md-12">
                <input type="text" name="cityZone" id="cityZone" value="paris"><button onclick="getLocation()">try it<i class="fas fa-search-location"></i></button>
                <button type="submit" onclick="findCityData()">Find</button>
                <p id="demo">ef</p>
            </div>
            <div class="col-md-12 navbar navbar-expand-lg">
                  <ul class="navbar-nav inline categories">
                      @php ($categories = ['All','Fruits','Vegetables','Cereals','Drinks','Cakes','Spices'])
                      @for ($i = 0; $i < 7; $i++)
                          <li class="col-md-2"><a onClick="filterByCategorieProduct({{ $i }})">{{ $categories[$i] }}</a></li>
                      @endfor
                  </ul>
            </div>
        </div>
        <div class="row">
            <div id="divAnnounces" class="col-md-6 divAnnounces"></div>
            <div class="col-md-6" id="mapid"></div>
        </div>
</div>

@include('modal-announce')
@include('layouts.footer')
{{-- Jquery --}}
<script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

{{-- Map --}}
<script src="{{ URL::asset('js/map.js') }}"></script>

{{-- Announces --}}
<script>
$(function() {
    findCityData();
});

function findByCity(cityData){
    $.ajax({
        url: '/filterByCity',
        type: 'POST',
        data: {cityData: cityData[0],  _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function(result){
            mymap.removeLayer(this);
            remplirDivAnnonce(result.announces);
        }
    });
}

function findCityData(){
    $.ajax({
        url: 'https://secure.geonames.org/searchJSON?&',
        type: 'GET',
        data: {q : $('#cityZone').val(), maxRows: 1, username: 'biotouriste'},
        dataType: "json",
        success: function (result){
            mymap.setView([result.geonames[0].lat, result.geonames[0].lng], 10, { animation: true });
            findByCity(result.geonames);
        }
    });
}

function filterByCategorieProduct(categorie){
    $.ajax({
        url: 'https://secure.geonames.org/searchJSON?&',
        type: 'GET',
        data: {q : $('#cityZone').val(), maxRows: 1, username: 'biotouriste'},
        dataType: "json",
        success: function (result){
            result.geonames[0]['categorie'] = categorie;
            $.ajax({
                url: "/filterByCategorie",
                type: 'POST',
                data: {cityData: result.geonames[0], _token: '{{csrf_token()}}'},
                success: function (retour, statut) {
                    remplirDivAnnonce(retour.announces);
                },
                error: function (resultat) {
                    console.log('marche pas frero')
                }});
        }
    });
}

function remplirDivAnnonce(announces){
    lgMarkers.clearLayers();
    $('#divAnnounces').empty();
    var div = '';
    if( typeof announces !== 'undefined'){
        announces.forEach(function (announce) {
            div = div +
            "<div id="+announce['idAnnounce']+" class='post' onclick='showAnnounce("+JSON.stringify(announce)+")'>"+
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
                            "<h6>"+announce['announce_price']+"$</h6>"+
                        "</div>"+
                    "</div>"+
                "</div>"+
            "</div>";
            var marker = new L.marker([announce['announce_lat'], announce['announce_lng']], {icon: icone}).addTo(lgMarkers);
            marker.bindPopup(announce['announce_name']);
        });
        $('#divAnnounces').append(div);
    } else {
       // faire un toast ici
    }
}

function showAnnounce(announce) {
    $('#titleAnnounce').html(announce['announce_name']);
    $('#imgAnnounce').html(announce['imgAnnounce']);
    $('#announceComment').html(announce['announce_comment']);
    $('#announceAdresse').html(announce['announce_adresse']);
    $('#announcePrice').html(announce['announce_price']+'$');
    $('#idAnnounce').val(announce['idAnnounce']);

    jQuery('#modal-announce').modal('show');
}

var x = document.getElementById("demo");

function getLocation() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
    } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
    }
}

function showPosition(position) {
    $.ajax({
        url: '/filterByCity',
        type: 'POST',
        data: {lat: position.coords.latitude, long: position.coords.longitude,  _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function(result){
            mymap.removeLayer(this);
            remplirDivAnnonce(result.announces);
        }
    });
}

function showError(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            x.innerHTML = "User denied the request for Geolocation.";
            break;
        case error.POSITION_UNAVAILABLE:
            x.innerHTML = "Location information is unavailable.";
            break;
        case error.TIMEOUT:
            x.innerHTML = "The request to get user location timed out.";
            break;
        case error.UNKNOWN_ERROR:
            x.innerHTML = "An unknown error occurred.";
            break;
    }
}
</script>
