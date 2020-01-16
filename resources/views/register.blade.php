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
      <div class="register_container text-center">
        <p>Already have an account ? <a href="#">I connect</a> </p>
        <form class="" action="" method="post">
          <div class="form-group">
            <input type="text" name="firstname" value="" placeholder="Firstname*">
            <input type="text" name="lastname" value="" placeholder="Lastname*">
            <input type="text" name="email" value="" placeholder="E-mail*">
          </div>
          <div class="form-group">
            <input type="text" name="password" value="" placeholder="Password*">
            <input type="text" name="confirm_password" value="" placeholder="Confirm password*">
          </div>
          <div class="form-group">
            <input type="text" name="postal_code" value="" placeholder="Postal code*">
            <input type="text" name="phone" value="" placeholder="Phone number*">
          </div>
          <p>* Field required</p>
          <div class="form-group">
            <input type="submit" name="" value="Submit">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
