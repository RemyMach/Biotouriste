<form  method="post">
    <div class="modal fade custom-width" id="modal-announce">
        <div class="modal-dialog" style="width: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title modal-title" id="titleAnnounce">efe</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="idAnnounce" id="idAnnounce">
                    <input type="hidden" name="idFavori" id="idFavori">
                    <div class="row">
                        <div class="col-md-6">
                            <p type="text" class="" name="announceComment" id="announceComment"></p>
                            <p type="text" class="" name="announceAdresse" id="announceAdresse"></p>
                            <p type="text" class="" name="announceComment" id="announceComment"></p>
                        </div>
                        <div class="col-md-6">
                            <p name='announcePrice' id="announcePrice"></p>
                            <img src="https://cutt.ly/rrYmuFu" class="img-fluid" alt="imgAnnounce">
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-md-5"><i id='heart' class="far fa-heart" onclick="addFavorite()"></i></div>
                        <div class="col-md-4"><a href="#" class="btn btn-primary">Add to card</a></div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</form>

<script>
    function addFavorite(){
        let path = '/favori/store';
        let data = {idAnnounce: $("#idAnnounce").val(),  _token: '{{csrf_token()}}' };
        if ($('#heart').hasClass('fas')){
            path = 'favori/destroy';
            data = {idAnnounce: $("#idAnnounce").val(), idFavori: 1,  _token: '{{csrf_token()}}' }
        }
       $.ajax({
           url: path,
           type: 'POST',
           data: data,
           dataType: "json",
           success: function(result){
               if($('#heart').hasClass('far')){
                    $('#heart').removeClass('far').addClass('fas');
               } else {
                   $('#heart').removeClass('fas').addClass('far');
               }
           }
       });
   }

</script>
