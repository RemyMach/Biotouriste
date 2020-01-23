@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="register">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="register_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h3>Welcome in, please</h3>
            <h2>Register</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="register_error text-center">
        <p></p>
      </div>
      <form action="/register" method="post">
        @csrf
        <div class="register_container text-center">
          <h3>Identifiers</h3>
          <p>Already have an account ? <a href="login">I connect</a> </p>
          <p><span style="color:red;">*</span><i>Champs obligatoires</i></p>
          <div class="form-group">
            <input type="email" name="email" value="" placeholder="Email address *">
            <input type="password" name="password" value="" placeholder="Password *">
            <input type="password" name="password_confirmation" value="" placeholder="Confirm password *">
          </div>
        </div>
        <div class="register_container text-center">
          <h3>Personnals informations</h3>
          <div class="form-group">
            <input type="text" name="user_name" value="" placeholder="Firstname *">
            <input type="text" name="user_surname" value="" placeholder="Lastname *">
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
@include('layouts.footer')
