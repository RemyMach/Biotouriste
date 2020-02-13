@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="connection">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vertical_r">
        <div id="login">
          <div class="card">
            <form action="/login" method="post">
              @csrf
              <h2>Login</h2>
              <div class="line"></div>
              @if(isset($respsonse_login))
              <div id="register_error">
              @foreach($respsonse_login->error as $errors)
              @foreach($errors as $error)
              <p>{{ $error }}</p>
              @endforeach
              @endforeach
              </div>
              @endif
              <div class="login">
                <h3>Identifiers</h3>
                <p><span style="color:red;">*</span><i>Required field</i></p>
                <div class="form-group">
                  <input type="email" name="email" value="" placeholder="Email address *" required>
                  <input type="password" name="password" value="" placeholder="Password *" required>
                </div>
                <a href="password/email">Forgot your password ?</a>
              </div>
              <div class="form-group text-center">
                <input type="submit" name="" value="Login">
              </div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-xs-12 col-sm-12 col-md-6 col-lg-6 vertical_l">
        <div id="register">
          <form action="/register" method="post">
            @csrf
            <div class="card">
              <h2>Register</h2>
              <div class="line"></div>
              @if(isset($response_register))
              <div id="register_error">
              @foreach($response_register->error as $errors)
              @foreach($errors as $error)
              <p>{{ $error }}</p>
              @endforeach
              @endforeach
              </div>
              @endif
              <div class="register">
                <h3>Identifiers</h3>
                <div class="form-group">
                <label for="">I'm a</label>
                <input type="radio" name="status_user" value="Tourist" checked="checked" onclick="click(0)" >
                <label for="tourist">Tourist</label>
                <input type="radio" name="status_user" value="Seller" onclick="click(1)" >
                <label for="seller">Seller</label>
                </div>
                <div class="form-group">
                <input type="email" name="email" value="" placeholder="Email address *" required>
                <input type="password" name="password" value="" placeholder="Password *" required>
                <input type="password" name="password_confirmation" value="" placeholder="Confirm password *" required>
                </div>
              </div>
            </div>
            <div class="card">
              <div class="register">
                <h3>Personnal informations</h3>
                <div class="form-group">
                <input type="text" name="user_name" value="" placeholder="Firstname *" required>
                <input type="text" name="user_surname" value="" placeholder="Lastname *" required>
                </div>
                <div class="form-group">
                <input type="text" name="user_postal_code" value="" placeholder="Postal code">
                <input type="text" name="user_phone" value="" placeholder="Phone number">
                </div>
              </div>
              <div class="form-group text-center">
                <input type="submit" name="" value="Register">
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
