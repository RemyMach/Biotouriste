var jQueryScript = document.createElement('script');
jQueryScript.setAttribute('src','https://code.jquery.com/jquery-3.4.1.min.js');
jQueryScript.setAttribute('integrity', 'sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=');
jQueryScript.setAttribute('crossorigin', 'anonymous');
document.head.appendChild(jQueryScript);

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