<form  method="post">
  <div id="modal-announce" class="modal fade custom-width">
    <div class="modal-dialog" style="width: 90%">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="title modal-title" id="titleAnnounce"></h4>
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="idAnnounce" id="idAnnounce">
          <div class="col-md-12">
            <table class="table">
              <tbody>
                <tr>
                  <td><img src="../img/product/blueberry.png" class="img-fluid" alt="imgAnnounce"></td>
                  <td><p type="text" class="" name="announceComment" id="announceComment"></p></td>
                  <td><p type="text" class="" name="announceAdresse" id="announceAdresse"></p></td>
                  <td><p type="text" class="" name="announceComment" id="announceComment"></p></td>
                  <td><p name='announcePrice' id="announcePrice"></p></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
              <button type="button" name="button" onclick="addFavorite()">Add to fav</button>
              <button type="button" name="button">Add to cart</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script>
function addFavorite(){
  console.log($("#idAnnounce").val());
  $.ajax({
    url: '/favori/store',
    type: 'POST',
    data: {idAnnounce: $("#idAnnounce").val(),  _token: '{{csrf_token()}}' },
    dataType: "json",
    success: function(result){
      console.log(result);
      // mymap.removeLayer(this);
      // remplirDivAnnonce(result.announces);
    }
  });
}
</script>
