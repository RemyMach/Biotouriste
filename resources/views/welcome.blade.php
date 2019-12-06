@include('layouts.header')
  <div id="content-1">
    @include('layouts.navbar')
    <!-- @include('layouts.navbar_default') -->
    <!-- @include('layouts.navbar_login') -->
    @include('layouts.overlay_login')
    @include('layouts.overlay_profil')
    @include('layouts.overlay_cart')
    @include('layouts.overlay_signup')
    <div class="row">
      <div class="col-md-12">
        <div class="content-1">
          <p class="title">The best products produced by the best farmer</p>
          <p class="txt">Experience the magic of local farming product</p>
          <div class="row">
            <button class="btn-large green" type="button" name="button">Announces</button>
            <button class="btn-large purple" type="button" name="button">Find me</button>
          </div>
          <div class="col-md-12 text-center scroll">
            <button class="btn-next white" type="button" name="button"><a href="#content-2"><i class="fas fa-chevron-down"></i></a></button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div id="content-2">

  </div>
@include('layouts.footer')
