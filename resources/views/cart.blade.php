@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
@if(session()->has('user'))

<div id="cart">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="cart_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h2>Cart</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="cart_container text-center">
        @foreach($announces as $announce)
        <div class="cart_item">
          <form class="" action="" method="post">
          <div class="row" style="margin:0;">
            <div class="col-md-4">
              <div class="cart_pic" style="background-image:url('/img/home/block-3.png')"></div>
            </div>
            <div class="col-md-4 text-left">
              <div class="cart_name">
                <h2>{{ $announce->announce_name }}</h2>
              </div>
              <div class="cart_desc">
                <p>{{ $announce->announce_comment }}</p>
              </div>
              <div class="cart_price">
                <p>{{ $announce->announce_price }}€</p>
              </div>
            </div>
            <div class="col-md-4">
              <div class="cart_remove">
                <button type="button" name="button">Remove</button>
              </div>
            </div>
          </div>
        </form>
        </div>
        @endforeach
        <div class="form-group">
          <button type="button" name="button" onclick="">Continue shopping</button>
          <input type="submit" name="" value="Proceed to payment">
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
            <h2>Cart</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="favorite_container text-center">
        <h3>Please login to access your cart</h3>
        <p>Go to login page</p>
        <button type="button" name="button" onclick="window.location.href='{{ url('register#login') }}'">Login</button>
        <p>Or create an account <a href="{{ url('register#register')}}">here</a> </p>
      </div>
    </div>
  </div>
</div>
@endif
@include('layouts.footer')
