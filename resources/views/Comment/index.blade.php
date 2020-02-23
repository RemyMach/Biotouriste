@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
    <div class="col-md-12">
        <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3">
                @if(isset($comments))
                    @foreach($comments as $comment)
                    <div class="card">
                        <div class="card-body">
                            <h3  class="comment_center">{{ $comment->user_name }} {{ $comment->user_surname }}</h3>
                            <hr>
                            <div class="card-title">
                                <p  class="comment_center" style="display: flex;justify-content: space-between;"><span>{{ $comment->comment_subject }}</span><span>{{ $comment->comment_note }}</span></p>
                            </div>
                            <div class="card-text">
                                <p>{{ $comment->comment_content }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
                @if(isset($messageError))
                        <div class="card">
                            <div class="card-body">
                                <h3  class="comment_center">{{ $messageError }}</h3>
                            </div>
                        </div>
                    @endif
                    <div class="card">
                        <div class="card-body">
                            @if(session('errorDisplayForm'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('errorDisplayForm') }}
                                </div>
                            @endif
                            <div class="card-title" style="display: flex; justify-content: space-between; align-items: center;">
                                <p  class="comment_center">Rate this Seller</p>
                                <!-- mettre l'id de l'announce à la fin de l'url -->
                                <form action="{{ url('comment/displayFormToStore/3') }}" method="get">
                                    <input type="submit"  value="Post a comment">
                                </form>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@include('layouts.footer')
