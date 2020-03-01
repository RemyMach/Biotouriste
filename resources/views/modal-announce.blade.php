<div class="modal fade custom-width" id="modal-announce">
    <div class="modal-dialog modal-lg" style="width: 90%">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="title modal-title" id="titleAnnounce"></h4>
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
            </div>
            <div class="modal-body">
                <form action="{{ url('carte') }}" method="post">
                    @csrf
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
                        <div class="col-md-4">
                            <button type="submit">Add to cart</button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="modal-footer">
                <div id="profil">
                    <div class="col-md-12">
                        <div class="row" style="margin:0;">
                            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3">
                                <span id="modal-announce-footer-comments"></span>
                                <div class="card">
                                    <div class="card-body">
                                        @if(session('errorDisplayForm'))
                                            <div class="alert alert-danger" role="alert">
                                                {{ session('errorDisplayForm') }}
                                            </div>
                                        @endif
                                        <div id="canIPostAComment" class="card-title" style="display: flex; justify-content: space-between; align-items: center;">
                                            <p  class="comment_center">Rate this Seller</p>
                                            <!-- mettre l'id de l'announce à la fin de l'url -->
                                            <input  type="submit"  onclick="verifyAuthorisationToPost()" value="Post a comment">
                                        </div>
                                        <div id="postAComment" style="width: 100%">
                                                <h4>The Grade<span style="color: red;">*</span></h4>
                                                <select id="comment_note" class="form-control" name="comment_note">
                                                    <option>1</option>
                                                    <option>2</option>
                                                    <option>3</option>
                                                    <option>4</option>
                                                    <option>5</option>
                                                </select>
                                                <hr>
                                                <h4>The Title<span style="color: red;">*</span></h4>
                                                <div class="form-group">
                                                    <input id="comment_subject" class="form-control" type="text" name="comment_subject" placeholder="What is the most important?">
                                                </div>
                                                <hr>
                                                <h4>Describe your experience with this Seller<span style="color: red;">*</span></h4>
                                                <textarea id="comment_content" class="form-control"  name="comment_content" rows="3" placeholder="What did you like or dislike?"></textarea>
                                                <button onclick="postComment()">Validate</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>

    function verifyAuthorisationToPost(){
        $.ajax({
            url: "/comment/displayFormToStore/3",
            type: 'GET',
            data: {_token: '{{csrf_token()}}'},
            success: function (retour) {
                if(retour.response.status == 200){
                    $('#canIPostAComment').fadeOut("slow");
                    $('#canIPostAComment').hide();
                    $('#postAComment').show();
                }
            },
        });
    }

    function postComment(){
        console.log('/comment/store/'+$('#idAnnounce').val());
        $.ajax({
            url: '/comment/store/'+$('#idAnnounce').val(),
            type: 'POST',
            data: {
                comment_note:$('#comment_note').val(),
                comment_content:$('#comment_content').val(),
                comment_subject:$('#comment_subject').val(),
                _token: '{{csrf_token()}}'
            },
            success: function (result) {
                console.log(result);
                if(result.response.status == 200){
                    window.location.href = '/announces'; //relative to domain
                }
            }
        });
    }
</script>
