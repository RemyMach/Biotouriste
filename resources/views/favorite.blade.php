@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="favorite">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="favorite_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h2>Favorite</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="favorite_container text-center">
        @if($response->status == '400')
        <div class="favorite_empty text-center">
          <i class="fas fa-sad-cry"></i>
          <h3>We are sorry</h3>
          <p>You don't have any favorite yet ! </p>
          <button type="button" name="button" onclick="window.location.href='{{ url('announces') }}'">Go to announces</button>
        </div>
        @else
        <div class="favorite_item">
          <div class="row" style="margin:0;">
            <div class="col-md-4">
              <div class="favorite_pic" style="background-image:url('/img/home/block-3.png')"></div>
            </div>
            <div class="col-md-4 text-left">
              <div class="favorite_name">
                <h2>Orange</h2>
              </div>
              <div class="favorite_price">
                <p>$1,99/kg</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="favorite_remove">
                <button type="button" name="button" onclick="window.location.href='{{ url('register#login') }}">Buy</button>
                <button type="button" name="button" onclick="">Remove</button>
              </div>
            </div>
          </div>
        </div>
        @endif
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
