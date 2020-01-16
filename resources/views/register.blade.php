@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="register">
  <div class="row" style="margin:0;">
    <div class="col-md-12">
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
          <div class="form_content_1">
            <input type="text" name="" value="" placeholder="Firstname">
            <input type="text" name="" value="" placeholder="Lastname">
            <input type="text" name="" value="" placeholder="E-mail">
          </div>
          <div class="form_content_2">
            <input type="text" name="" value="" placeholder="Password">
            <input type="text" name="" value="" placeholder="Confirm password">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
