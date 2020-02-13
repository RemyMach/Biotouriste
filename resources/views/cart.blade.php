@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
@if(session()->has('user'))

<div id="cart">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="card">
          <div id="product">
            <h3>Cart</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col">Order summary</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Price</th>
                    <th scope="col">Total</th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><img src="../img/product/blueberry.png" alt=""> Blueberry</td>
                    <td><input type="number" name="" value="4"></td>
                    <td>$15</td>
                    <td>$60</td>
                    <td><button type="button" name="button">Remove</button></td>
                  </tr>
                  <tr>
                    <td><img src="../img/product/blueberry.png" alt=""> Blueberry</td>
                    <td><input type="number" name="" value="4"></td>
                    <td>$15</td>
                    <td>$60</td>
                    <td><button type="button" name="button">Remove</button></td>
                  </tr>
                  <tr>
                    <td><img src="../img/product/blueberry.png" alt=""> Blueberry</td>
                    <td><input type="number" name="" value="4"></td>
                    <td>$15</td>
                    <td>$60</td>
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
              <button type="submit" name="button" formmethod="post">Proceed to payment</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
