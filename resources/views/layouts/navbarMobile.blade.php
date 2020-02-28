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
        @if(Session::has('user'))
          <button type="button" name="button" onclick="window.location.href='{{ url('favorite') }}'"><i class="fas fa-heart"></i></button>
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
<div id="overlay" class="overlay text-center menu">
  <ul>
    <li><a href="{{ url('announces') }}">Announces</a></li>
    @if(session('active_status'))
      @if(session('active_status')->status_user_label == 'Seller')
      <li><a href="{{ url('/announce/historySeller') }}">My announces</a></li>
      <li><a href="{{ url('/message') }}">Messages</a></li>
      @endif
    @endif
    <li><a href="{{ url('/#about') }}">About us</a></li>
    <li><a href="{{ url('/#contact') }}">Contact</a></li>
    <li><a href="{{ url('/blog') }}">Blog</a></li>
    <li><button id="close" type="button" name="button" onclick="menu()"><i class="fas fa-times"></i></i></button></li>
  </ul>
</div>
