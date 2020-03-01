@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="announces">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
    <div id="filter" data-aos="fade-right">
      <div class="card">
        <div class="row" style="margin:0;">
          <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
            <input type="text" name="cityZone" id="cityZone" value="Paris">
            <button type="submit" onclick="findCityData()">Find</button>
            <button onclick="getLocation()"><i class="fas fa-location-arrow"></i></button>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
            <div class="row" style="margin:0;">
              <div class="col-md-9">
                <div id="category">
                  <ul>
                    @php ($categories = ['All','Fruits','Vegetables','Cereals','Drinks','Cakes','Spices'])
                    @for ($i = 0; $i < 7; $i++)
                    <li><button id="btnCateg" type="button" name="button" onClick="filterByCategorieProduct({{ $i }})">{{ $categories[$i] }}</button></li>
                    @endfor
                  </ul>
                </div>
              </div>
              <div class="col-md-3">
                <ul>
                  <li><button id="btnFilter" type="button" name="button" onclick="filter()">Filter <i class="fas fa-plus"></i></button></li>
                  <li><button id="btnMap" type="button" name="button" onclick="map()">Map <i class="fas fa-plus"></i></button></li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="announce" data-aos="fade-left">
      <div class="card" style="min-height:620px;">
        <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 text-center">
            <h3>Announces in <span id="city"></span></h3>
            <table class="table">
              <tbody id="sellerAnnounces">
              </tbody>
            </table>
          </div>
          <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6">
            <div id="mapid" style="height: 600px;"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('modal-announce')
@include('layouts.footer')
<script>
let set = 0;
function filter() {
  if (set == 0) {
    $('#btnFilter').html('filter <i class="fas fa-minus"></i>');
    $('#category').slideDown("slow");
    set = 1;
  }else {
    $('#btnFilter').html('filter <i class="fas fa-plus"></i>');
    $('#category').slideUp("slow");
    set = 0;
  }
}
function map() {
  if (set == 0) {
    $('#btnMap').html('Map <i class="fas fa-minus"></i>');
    $('#mapid').slideDown("slow");
    set = 1;
  }else {
    $('#btnMap').html('Map <i class="fas fa-plus"></i>');
    $('#mapid').slideUp("slow");
    set = 0;
  }
}
</script>
<script src="{{ URL::asset('js/map.js') }}"></script>
<script>
$(function() {
  findCityData();
  $('#postAComment').hide();
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
      $('#city')
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
      $('#city').html($('#cityZone').val());
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
    $('#sellerAnnounces').empty();
    var tbody = '';
    if( typeof announces !== 'undefined'){
      announces.forEach(function (announce) {
      let idFavClass = announce['idFavori'];
      let isActif = 'far fa-heart';
      if(announce['idFavori'] != null){
        isActif = 'fas fa-heart';
      }
        tbody = tbody +
        "<tr id="+idFavori+" class='post'>"+
        "<tr id="+announce['idAnnounce']+" class='post'>"+
        "<td><img src='../img/product/blueberry.png'></td>"+
        "<td>"+announce['announce_name']+"</td>"+
        "<td>"+announce['announce_comment']+"</td>"+
        "<td>"+announce['announce_price']+"$</td>"+
        "<td>"+announce['announce_name']+"</td>"+
        "<td id='announce"+announce['idAnnounce']+"'><button id='btnHeart' type='button' onclick='addFavorite("+announce['idAnnounce']+","+announce['idFavori']+")'><i class='"+idFavClass+" "+isActif+"'></i></button></td>"+
        "<td><button id='btnView' type='button' name='' onclick='showAnnounce("+JSON.stringify(announce)+")'>View</button></td>"+
        "</tr>";

        var marker = new L.marker([announce['announce_lat'], announce['announce_lng']], {icon: icone}).addTo(lgMarkers);
        marker.bindPopup(announce['announce_name']);
      });
      $('#sellerAnnounces').append(tbody);
    } else {
      // faire un toast ici

    }
  }
function addFavorite(idAnnounce, idFavori){
  let path = '/favori/store';
  let data = {idAnnounce: idAnnounce,  _token: '{{csrf_token()}}' };
  if (idFavori != null){
    path = '/favori/destroy';
    data = {idAnnounce: idAnnounce, idFavori: idFavori,  _token: '{{csrf_token()}}' }
  }

  $.ajax({
    url: path,
    type: 'POST',
    data: data,
    dataType: "json",
    success: function(result){
      if(result.response.message == 'Your Favori has been register'){
        $('#announce'+idAnnounce).html("<button id='btnHeart' type='button' onclick='addFavorite("+idAnnounce+", "+result.response.favori.idFavori+")'><i class='"+result.response.favori.idFavori+" fas fa-heart'></i></button>");
      } else {
        $('#announce'+idAnnounce).html("<button id='btnHeart' type='button' onclick='addFavorite("+idAnnounce+", null)'><i class='null far fa-heart'></i></button>");
      }
    }
  });
}
  function showAnnounce(announce) {
    $('#titleAnnounce').html(announce['announce_name']);
    $('#imgAnnounce').html(announce['imgAnnounce']);
    $('#announceComment').html(announce['announce_comment']);
    $('#announceAdresse').html(announce['announce_adresse']);
    $('#announcePrice').html(announce['announce_price']+'$');
    $('#idAnnounce').val(announce['idAnnounce']);
    $('#idUserSeller').val(announce['Users_idUser']);
    let comments = '';
    $.ajax({
      url: '/comment/'+announce['Users_idUser'],
      type: 'GET',
      data: {_token: '{{csrf_token()}}'},
      dataType: "json",
      success: function(result){
        result.response.comments.forEach(function (announce) {
          comments = comments +
            "<div class='card'>"+
                "<div class='card-body'>"+
                    "<h3 class='comment_center'>"+announce['user_name']+" "+announce['user_surname']+"</h3>"+
                    "<hr>"+
                    "<div class='card-title'>"+
                        "<p  class='comment_center' style='display: flex;justify-content: space-between;'>"+
                          "<span>"+announce['comment_subject']+"</span>"+
                          "<span>"+announce['comment_note']+"</span>"+
                        "</p>"+
                    "</div>"+
                    "<div class='card-text'>"+
                        "<p>"+announce['comment_content']+"</p>"+
                    "</div>"+
                "</div>"+
            "</div>"
        });
        $('#modal-announce-footer-comments').html(comments);
      }
    });
    jQuery('#modal-announce').modal('show');
  }

  function getLocation() {
      if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, showError);
      } else {
        x.innerHTML = "Geolocation is not supported by this browser.";
      }
  }

  function showPosition(position) {
    var cityData = { 'lat': position.coords.latitude, 'lng': position.coords.longitude};
    $.ajax({
      url: '/filterByCity',
      type: 'POST',
      data: {cityData: cityData,  _token: '{{csrf_token()}}'},
      dataType: "json",
      success: function(result){
        $("#cityZone").val(result.announces[0]['announce_city']);
        $("#city").val(result.announces[0]['announce_city']);
        mymap.removeLayer(this);
        mymap.setView([result.lat, result.lng], 10, { animation: true });
        remplirDivAnnonce(result.announces);
      }
    });
  }

  function showError(error) {
    console.log('error');
  }
</script>
