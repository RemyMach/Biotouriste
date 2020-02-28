@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="favorite">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="card">
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
                    <td><img src="../img/product/strawberry.png" alt="">{{ $favorite->announce_name }}</td>
                    <td>{{ $favorite->announce_price}}$/{{ $favorite->announce_quantity }} {{ $favorite->announce_measure }}</td>
                    <td>Remaining : {{ $favorite->announce_lot }}</td>
                    <td><button type="button" name="button">Buy</button></td>
                    <td><button type="submit" name="button">Remove</button></td>
                  </tr>
                  </form>
                @endforeach
                </tbody>
              </table>
          </div>
        </div>
        <div class="cta">
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
