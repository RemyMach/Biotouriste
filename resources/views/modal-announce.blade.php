<form action="{{ url('carte') }}" method="post">
    @csrf
    <div class="modal fade custom-width" id="modal-announce">
        <div class="modal-dialog" style="width: 90%">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="title modal-title" id="titleAnnounce"></h4>
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
                        <div class="col-md-4"><button type="submit">Add to cart</button></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
