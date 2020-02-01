<div id="favorite">
  <div class="row" style="margin:0;">
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
  </div>
</div>
