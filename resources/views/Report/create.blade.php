@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
    <div class="col-md-12">
        <div class="row" style="margin:0;">
            <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3" style="background-color: rgba(255,255,255,0.9); padding: 10px; border-radius: 5px;">
                <h3>Create a Report</h3>
                @if(session('errorValidator'))
                    <div class="alert alert-danger" role="alert">
                        @foreach(session('errorValidator')->error as $errors)
                            @foreach($errors as $label)
                                <p>{{ $label  }}</p>
                            @endforeach
                        @endforeach
                    </div>
                @endif
                @if(session('errorNotSpecified'))
                    <div class="alert alert-danger" role="alert">
                        {{ session('errorNotSpecified') }}
                    </div>
                @endif
                <hr>
                <form method="post" action="{{ url('report/store/') }}">
                    @csrf
                    <h4>The Categorie<span style="color: red;">*</span></h4>
                    <select class="form-control" name="ReportCategorie">
                        <option>Announce</option>
                        <option>Commentary</option>
                        <option>behavior</option>
                        <option>Message</option>
                    </select>
                    <hr>
                    <h4>The TItle<span style="color: red;">*</span></h4>
                    <div class="form-group">
                        <input class="form-control" type="text" name="report_subject" placeholder="What is the most important?">
                    </div>
                    <hr>
                    <h4>Describe your bad experience with this Seller<span style="color: red;">*</span></h4>
                    <textarea class="form-control"  name="report_comment" rows="3" placeholder="What did you dislike?"></textarea>
                    <input type="hidden" name="idUserReported" value="{{ $idUserReported }}">
                    <input type="submit" value="send">
                </form>
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