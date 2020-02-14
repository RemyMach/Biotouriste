@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')

<div id="cart">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="card">
          <div id="product">
            @if($announces != null)

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
                @foreach($announces as $key => $announce)

                <tbody>
                  <tr>
                    <td><img src="../img/product/blueberry.png" alt="">{{ $announce['announce_name'] }}</td>
                    <td>

                      <form action="qantmore" method="get">
                        <input type="hidden" value="{{ $key }}" name="index">
                      <button class="+button" value="" onclick="window.location.href='{!!route('qantmore')!!}'">+</button>
                      </form>
                      <form action="qantless" method="get">
                        <input type="hidden" value="{{ $key }}" name="index">
                      <button class="-button" onclick="window.location.href='{!!route('qantless')!!}'">-</button>
                      </form>
                      <form class="" action="cart/remove" method="get">
                      {{ $announce['announce_quantity'] }}
                    </td>
                    <td>{{ $announce['announce_price'] }}$</td>
                    <td>{{ $total = $announce['announce_quantity'] * $announce['announce_price'] }}$</td>
                    <input type="hidden" value="{{ $key }}" name="index">
{{--                      <input type="hidden" value="{{ $announce['announce_quantity'] }}" name="index">--}}
                    <td><button type="submit"  name="button">Remove</button></td>
                    </form>
                  </tr>

                </tbody>
                @endforeach
              </table>
          </div>
        </div>


        <div class="cta">
          <div class="row">
            <div class="col-md-12">
              <button type="button" name="button" onclick="window.location.href='{{ url('announces') }}'">Continue shopping</button>
              <button type="submit" name="button" onclick="window.location.href='{!!route('ccart')!!}'" formmethod="post">Proceed to payment</button>
              @else
                <h2>Your cart is empty</h2>
              @endif
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
