@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="favorite">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="card" data-aos="fade-down">
          <div id="wish">
            <h3>Favorite</h3>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                  <th scope="col"></th>
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td><div style="background-image:url('../img/product/strawberry.png')"></div></td>
                  <td>Strawberry</td>
                  <td>$15/Kg</td>
                  <td><button type="button" name="button">Buy</button></td>
                  <td><button type="button" name="button">Remove</button></td>
                </tr>
                <tr>
                  <td><div style="background-image:url('../img/product/strawberry.png')"></div></td>
                  <td>Strawberry</td>
                  <td>$15/Kg</td>
                  <td><button type="button" name="button">Buy</button></td>
                  <td><button type="button" name="button">Remove</button></td>
                </tr>
                <tr>
                  <td><div style="background-image:url('../img/product/strawberry.png')"></div></td>
                  <td>Strawberry</td>
                  <td>$15/Kg</td>
                  <td><button type="button" name="button">Buy</button></td>
                  <td><button type="button" name="button">Remove</button></td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <div class="cta" data-aos="fade-up">
          <div class="row">
            <div class="col-md-12">
              <button type="button" name="button" onclick="window.location.href='{{ url('announces') }}'">Continue shopping</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')


<!-- <div class="row" style="margin:0;">
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
<button type="button" name="button" onclick="window.location.href='{{ url('register#login') }}'">Login</button>
<p>Or create an account <a href="{{ url('register#register')}}">here</a> </p>
</div>
</div>
</div> -->
