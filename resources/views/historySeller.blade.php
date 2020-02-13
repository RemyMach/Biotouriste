@include('layouts.header')
<div id="content-1">
    @include('layouts.navbarDesktop')
    <div id="cart">
        <div class="col-md-12 text-center">
            <div class="row" style="margin:0;">
                <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
                    <div class="card">
                        <div id="product">
                            <h3 class="text-center">My announces</h3>
                            <span onclick="modalAddAnnounce()"><a href="#">New announce</a></span>
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col">Price</th>
                                    <th scope="col">Quantity</th>
                                    <th scope="col"></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($announces as $announce)
                                    <tr id="announce{{ $announce->idAnnounce }}">
                                        <td><img src="../img/product/blueberry.png" alt=""></td>
                                        <td>{{ $announce->announce_name }}</td>
                                        <td>{{ $announce->announce_price }} $</td>
                                        <td><input type="text" name="newQuantityToAdd" id="quantity{{ $announce->idAnnounce }}" value="{{ $announce->announce_quantity }}"></td>
                                        <td>
                                            <button type="button" onClick="(removeAnnounce({{ $announce->idAnnounce }}))">Remove</button>
                                            <button type="button" onClick="(updateAnnounce({{ $announce->idAnnounce }}))">Update</button>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('layouts.footer')
@include('modal-addAnnounce')
<script>
function updateAnnounce(idAnnounce){
    $.ajax({
        url: '/announce/update',
        type: 'POST',
        data: {idAnnounce: idAnnounce, newQuantityToAdd: $('#quantity'+idAnnounce).val(),  _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function(result){
            //    toaster
        }
    });
}

function modalAddAnnounce(){
    jQuery('#modal-addAnnounce').modal('show');
}

function removeAnnounce(idAnnounce){
    $.ajax({
        url: '/announce/delete',
        type: 'POST',
        data: {idAnnounce: idAnnounce, _token: '{{csrf_token()}}'},
        dataType: "json",
        success: function(result){
            $('#announce'+idAnnounce).remove();
            console.log();
        }
    });
}
</script>