@include('layouts.header')
<div id="content-1">
  @include('layouts.navbarDesktop')
  @include('layouts.navbarMobile')
  @include('layouts.overlay_signup')
  @include('layouts.overlay_cart')
  <div class="main">
    <div class="row" style="margin:0;">
      <div class="col-md-8 col-sm-12" style="padding:0">
        <div class="block-product">
          <div class="b-product">

          </div>
        </div>
      </div>
      <div class="col-md-4 col-sm-12" style="padding:0">
        <div class="block-map">
          <div class="b-map">

          </div>
        </div>
        <div class="block-faq">
          <div class="b-faq">

          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="content-2">
  <div class="main">
    <div class="row" style="margin:0;">
      <div class="col-md-12 text-center">
        <h3>WHAT'S NEW IN</h3>
        <h2>HEALTHY'S</h2>
        <div class="line"></div>
      </div>
    </div>
    <div class="second">
      <div class="row" style="margin:0;">
        <div class="col-md-4 col-sm-12 text-right">
          <div class="block-left">
            <img src="{{url('/img/home/block-1.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
          <div class="block-center">
            <img src="{{url('/img/home/block-2.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-4 col-sm-12 text-left">
          <div class="block-right">
            <img src="{{url('/img/home/block-3.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="third">
    <div class="block-banner">
      <div class="row" style="margin:0;">
        <div class="col-md-12 text-center">
          <h3>Your guarantees</h3>
          <div class="row" style="margin:0;">
            <div class="col-md-4 text-center">
              <i class="fas fa-comments"></i>
              <p>Free Advices</p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-envelope-open-text"></i>
              <p>Support plateform</p>
            </div>
            <div class="col-md-4 text-center">
              <i class="fas fa-medal"></i>
              <p>Quality Above All</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
