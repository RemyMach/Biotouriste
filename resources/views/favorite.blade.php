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
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><img src="../img/product/strawberry.png" alt="">Strawberry</td>
                    <td>$15/Kg</td>
                    <td><button type="button" name="button">Buy</button></td>
                    <td><button type="button" name="button">Remove</button></td>
                  </tr>
                  <tr>
                    <td><img src="../img/product/strawberry.png" alt="">Strawberry</td>
                    <td>$15/Kg</td>
                    <td><button type="button" name="button">Buy</button></td>
                    <td><button type="button" name="button">Remove</button></td>
                  </tr>
                  <tr>
                    <td><img src="../img/product/strawberry.png" alt="">Strawberry</td>
                    <td>$15/Kg</td>
                    <td><button type="button" name="button">Buy</button></td>
                    <td><button type="button" name="button">Remove</button></td>
                  </tr>
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
