@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
@if(\Auth::check())
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
                <button type="button" name="button" onclick="">Buy</button>
                <button type="button" name="button" onclick="">Remove</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@else
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
        <h3>Please login to access your favorites</h3>
        <p>Go to login page</p>
        <button type="button" name="button" onclick="window.location.href='{{ url('test/register1234') }}'">Login</button>
        <p>Or create an account <a href="{{ url('test/register1234')}}">here</a> </p>
      </div>
    </div>
  </div>
</div>
@endif
@include('layouts.footer')
