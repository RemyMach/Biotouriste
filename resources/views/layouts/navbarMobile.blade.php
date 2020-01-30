<div id="navbar-mobile" class="navigation">
  <nav>
    <div class="row" style="margin: 0;">
      <div class="col-4 text-center menu">
        <button id="menu" type="button" name="button" onclick="menu()"><i class="fas fa-bars"></i></i></button>
      </div>
      <div class="col-4 text-center menu">
        <h1>Healthy's</h1>
      </div>
      <div class="col-4 text-center menu">
        <button type="button" name="button" onclick="window.location.href='{{ url('favorite') }}'"><i class="fas fa-heart"></i></button>
        @if(\Auth::check())
          <button type="button" name="button" onclick="window.location.href='{{ url('test/register1234') }}'"><i class="fas fa-user"></i></button>
        @else
          <button type="button" name="button" onclick="window.location.href='{{ url('test/register1234') }}'"><i class="fas fa-user-plus"></i></button>
        @endif
          <button type="button" name="button" onclick="window.location.href='{{ url('cart') }}'"><i class="fas fa-shopping-bag"></i></button>
      </div>
    </div>
  </nav>
</div>
<div id="overlay" class="overlay text-center menu" style="display:none;" id="sidebar">
  <a href="{{ url('announces') }}">Announces</a>
  <a href="{{ url('product') }}">Products</a>
  <a href="{{ url('about') }}">About us</a>
  <a href="{{ url('contact') }}">Contact</a>
  <a href="{{ url('faq') }}">FAQ</a>
</div>
