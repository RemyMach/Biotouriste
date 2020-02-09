<div class="modal fade" id="modal-addAnnounce" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="modal-register-label">Add announce</h3>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">×</span><span class="sr-only">Close</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formAddAnnounce" class="registration-form">
                    <div class="form-group">
                        <label class="sr-only" for="announce_name">Announce name</label>
                        <input type="text" name="announce_name" placeholder="Announce name..."
                               class="form-control" id="announce_name">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_city">City</label>
                        <input type="text" name="announce_city" placeholder="City..." class="form-control"
                               id="announce_city">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_adresse">Address</label>
                        <input type="text" name="announce_adresse" placeholder="Address..."
                               class="form-control" id="announce_adresse">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="products_idProduct">Product</label>
                        <select name="products_idProduct" id="products_idProduct">
                            @foreach($products as $product)
                                <option value="{{ $product->idProduct }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_quantity">Quantity</label>
                        <input type="text" name="announce_quantity" placeholder="Quantity by lot" class="form-control"
                               id="announce_quantity">
                        <label class="sr-only" for="announce_measure">Quantity</label>
                        <select name="announce_measure" id="announce_measure">
                            <option value="1">Unity</option>
                            <option value="2">Kilogram</option>
                            <option value="3">Liter</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_lot">Lot number</label>
                        <input type="number"  min="1" name="announce_lot" placeholder="Lot number..."
                                  class="form-control" id="announce_lot">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_price">Price by lot</label>
                        <input  type="number" step="0.01" name="announce_price" placeholder="12.2$"
                                  class="form-control" id="announce_price">
                    </div>
                    <div class="form-group">
                        <label class="sr-only" for="announce_comment">Comment</label>
                        <textarea name="announce_comment" placeholder="About the product..."
                                  class="form-control" id="announce_comment"></textarea>
                    </div>
                    <input type="hidden" name="announce_lat" id="announce_lat" value="">
                    <input type="hidden" name="announce_lng" id="announce_lng" value="">
                    <button type="button" class="btn btn-success" onclick="addAnnounce()">Add !</button>
                </form>
            </div>
        </div>
    </div>
<script>
$(function() {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(showPosition, console.log('position not find'));
    } else {
        console.log('Geolocation is not supported by this browser.');
    }
});
function showPosition(position) {
    $('#announce_lat').val(position.coords.latitude);
    $('#announce_lng').val(position.coords.longitude);
}
    function addAnnounce() {
        let data = {
            announce_lot: $('#announce_lot').val(),
            announce_measure: $('#announce_measure').val(),
            announce_name: $('#announce_name').val(),
            announce_price: $('#announce_price').val(),
            announce_comment: $('#announce_comment').val(),
            announce_adresse: $('#announce_adresse').val(),
            announce_city: $('#announce_city').val(),
            products_idProduct: $('#products_idProduct').val(),
            announce_lat: $('#announce_lat').val(),
            announce_lng: $('#announce_lng').val(),
            announce_quantity: $('#announce_quantity').val(),
            _token: '{{ csrf_token() }}'
        };

        $.ajax({
            url: '/announce/store',
            type: 'POST',
            data: data,
            dataType: "json",
            success: function (result) {
            }
        });
    }
</script>