<div id="navbar-desktop" class="navigation">
  <div class="title col-md-12 text-center">
    <a href="{{ url('/') }}"><h1>Healthy's</h1></a>
  </div>
  <nav>
    <div class="row" style="margin: 0;">
      <div class="col-md-3 menu"></div>
      <div class="col-md-6 text-center menu">
        <a href="{{ url('announces') }}">Announces</a>
        <a href="{{ url('product') }}">Products</a>
        <a href="{{ url('about') }}">About us</a>
        <a href="{{ url('contact') }}">Contact</a>
        <a href="{{ url('faq') }}">FAQ</a>
      </div>
      <div class="col-md-3 text-center menu">
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
