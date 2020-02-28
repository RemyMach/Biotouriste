<div class="modal fade" id="modal-addAnnounce" tabindex="-1" role="dialog" aria-labelledby="modal-register-label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="modal-register-label">Add announce</h4>
        <button type="button" class="close" data-dismiss="modal">
          <span aria-hidden="true">×</span><span class="sr-only">Close</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formAddAnnounce" class="registration-form">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <input id="announce_name" type="text" name="announce_name" placeholder="Name">
            <input id="announce_city" type="text" name="announce_city" placeholder="City">
            <input id="announce_adresse" type="text" name="announce_adresse" placeholder="Address">
            <select id="products_idProduct" name="products_idProduct">
              @foreach($products as $product)
              <option value="{{ $product->idProduct }}">{{ $product->product_name }}</option>
              @endforeach
            </select>
            <input id="announce_quantity" type="text" name="announce_quantity" placeholder="Quantity">
            <select id="announce_measure" name="announce_measure">
              <option value="1">Unity</option>
              <option value="2">Kilogram</option>
              <option value="3">Liter</option>
            </select>
            <input id="announce_lot" type="text" name="announce_lot" placeholder="Lot" min="1">
            <input id="announce_price" type="text" name="announce_price" placeholder="$00.0" step="0.01">
            <textarea id="announce_comment" name="announce_comment" placeholder="Description"></textarea>
            <input id="announce_lat" type="hidden" name="announce_lat">
            <input id="announce_lng" type="hidden" name="announce_lng">
            <button type="button" onclick="addAnnounce()">Publish</button>
          </div>
        </form>
      </div>
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
