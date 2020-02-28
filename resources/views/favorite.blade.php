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
                @foreach($response as $favorite)
                <form action="{{ url('favori/destroy') }}" method="POST">
                  @csrf
                  <input type="hidden" name="idFavori" value="{{ $favorite->idFavori }}">
                  <tr>
                    <td><div style="background-image:url('../img/product/strawberry.png')"></div>{{ $favorite->announce_name }}</td>
                    <td>{{ $favorite->announce_price}}$/{{ $favorite->announce_quantity }}{{ $favorite->announce_measure }}</td>
                    <td>Remaining : {{ $favorite->announce_lot }}</td>
{{--                    <td><button type="button" name="button">Buy</button></td>--}}
                    <td><button type="submit" name="button">Remove</button></td>
                  </tr>
                  </form>
                @endforeach
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
