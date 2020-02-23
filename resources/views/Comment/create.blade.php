@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
    <div class="col-md-12">
        <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3" style="background-color: rgba(255,255,255,0.9); padding: 10px; border-radius: 5px;">
                <h3>Create a Comment</h3>
                @if(session('errorValidator'))
                    <div class="alert alert-danger" role="alert">
                        @foreach(session('errorValidator')->error as $errors)
                            @foreach($errors as $label)
                                <p>{{ $label  }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                <hr>
                <form method="post" action="{{ url('comment/store/' . $idAnnounce) }}">
                    @csrf
                    <h4>The Grade<span style="color: red;">*</span></h4>
                    <select class="form-control" name="comment_note">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                    <hr>
                    <h4>The Title<span style="color: red;">*</span></h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="comment_subject" placeholder="What is the most important?">
                    </div>
                    <hr>
                    <h4>Describe your experience with this Seller<span style="color: red;">*</span></h4>
                    <textarea class="form-control"  name="comment_content" rows="3" placeholder="What did you like or dislike?"></textarea>
                    <input type="submit">
                </form>
                <div class="card-title">
                    <p  class="comment_center" style="display: flex;justify-content: space-between;"><span></span><span></span></p>
                </div>
                <div class="card-text">
                    <p></p>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
</script>
@include('layouts.footer')