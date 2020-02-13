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
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@include('layouts.footer')
