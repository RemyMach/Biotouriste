<div id="navbar_mobile">
  <nav>
    <div class="row" style="margin: 0;">
      <div class="col-4 text-center menu">
        <button id="menu" type="button" name="button" onclick="menu()"><i class="fas fa-bars"></i></i></button>
      </div>
      <div class="col-4 text-center menu">
        <a href="{{ url('/') }}"><img src="../img/nav/logo.png" alt="Healthy's"></a>
      </div>
      <div class="col-4 text-center menu">
        <button type="button" name="button" onclick="window.location.href='{{ url('favorite') }}'"><i class="fas fa-heart"></i></button>
        @if(Session::has('user'))
          <button type="button" name="button" onclick="window.location.href='{{ url('profil') }}'"><i class="fas fa-user"></i></button>
        @else
          <button type="button" name="button" onclick="window.location.href='{{ url('register') }}'"><i class="fas fa-user-plus"></i></button>
        @endif
          <button type="button" name="button" onclick="window.location.href='{{ url('cart') }}'"><i class="fas fa-shopping-bag"></i></button>
      </div>
    </div>
  </nav>
</div>
<div id="overlay" class="overlay text-center menu" style="display:none;" id="sidebar">
  <a href="{{ url('announces') }}">Announces</a>
  <a href="{{ url('about') }}">About us</a>
  <a href="{{ url('contact') }}">Contact</a>
  <a href="{{ url('faq') }}">FAQ</a>
</div>
