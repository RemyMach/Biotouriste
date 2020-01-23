@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="register">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="register_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h3>Welcome to</h3>
            <h2>Healthy's</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
<<<<<<< HEAD
      <div class="row" style="margin:0;">
        <div class="col-md-6" style="border-right: 2px solid #677A70;margin: 2% 0;">
          <form action="/login" method="post">
            <h2 class="text-center">Login</h2>
            @foreach
            @csrf
            <div class="register_container text-center">
              <h3>Identifiers</h3>
              <p><span style="color:red;">*</span><i>Required field</i></p>
              <div class="form-group">
                <input type="email" name="email" value="" placeholder="Email address *" required>
                <input type="password" name="password" value="" placeholder="Password *" required>
              </div>
            </div>
            <div class="form-group text-center">
              <input type="submit" name="" value="Submit">
            </div>
          </form>
=======
      @if(isset($response))
        <div class="alert-danger">
        @foreach($response->error as $errors)
          @foreach($errors as $error)
            <p>{{ $error }}</p>
            @endforeach
        @endforeach
        </div>
      @endif
      <form action="/register" method="post">
        @csrf
        <div class="register_container text-center">
          <h3>Identifiers</h3>
          <p>Already have an account ? <a href="login">I connect</a> </p>
          <p><span style="color:red;">*</span><i>Champs obligatoires</i></p>
          <div class="form-group">
            <input type="text" name="email" value="" placeholder="Email address *">
            <input type="password" name="password" value="" placeholder="Password *">
            <input type="password" name="confirm_password" value="" placeholder="Confirm password *">
          </div>
>>>>>>> remy
        </div>
        <div class="col-md-6" style="border-left: 2px solid #677A70;margin: 2% 0;">
          <form action="/register" method="post">
            <h2 class="text-center">Register</h2>
            <div id="register_error" class="register_error text-center">
              <p></p>
            </div>
            @csrf
            <div class="register_container text-center">
              <h3>Identifiers</h3>
              <p><span style="color:red;">*</span><i>Required field</i></p>
              <div class="form-group">
                <input type="email" name="email" value="" placeholder="Email address *" required>
                <input type="password" name="password" value="" placeholder="Password *" required>
                <input type="password" name="password_confirmation" value="" placeholder="Confirm password *" required>
              </div>
            </div>
            <div class="register_container text-center">
              <h3>Personnals informations</h3>
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
              <input type="submit" name="" value="Submit">
            </div>
          </form>
        </div>





      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
