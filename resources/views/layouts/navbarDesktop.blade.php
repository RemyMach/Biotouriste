<div id="navbar_desktop">
  <div class="title col-md-12 text-center">
    <a href="{{ url('/') }}"><img src="../img/nav/logo.png" alt="Healthy's"></a>
  </div>
  <nav>
    <div class="row" style="margin: 0;">
      <div class="col-md-3 menu"></div>
      <div class="col-md-6 text-center menu">
        <a href="{{ url('announces') }}">Announces</a>
        <a href="{{ url('/#about') }}">About us</a>
        <a href="{{ url('/#contact') }}">Contact</a>
        <a href="{{ url('faq') }}">FAQ</a>
      </div>
      <div class="col-md-3 text-center menu">
        @if(Session::has('user'))
          <button type="button" name="button" onclick="window.location.href='{{ url('favori/show') }}'"><i class="fas fa-heart"></i></button>
          <button type="button" name="button" onclick="window.location.href='{{ url('profil') }}'"><i class="fas fa-user"></i></button>
          <button type="button" name="button" onclick="window.location.href='{{ url('cart') }}'"><i class="fas fa-shopping-bag"></i></button>
          <button type="submit" name="button" onclick="window.location.href='{{ url('logout') }}'"><i class="fas fa-sign-out-alt"></i></button>
        @else
          <button type="button" name="button" onclick="window.location.href='{{ url('favorite') }}'"><i class="fas fa-heart"></i></button>
          <button type="button" name="button" onclick="window.location.href='{{ url('register') }}'"><i class="fas fa-user-plus"></i></button>
          <button type="button" name="button" onclick="window.location.href='{{ url('cart') }}'"><i class="fas fa-shopping-bag"></i></button>
        @endif
      </div>
    </div>
  </nav>
</div>
