@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="profil_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h2>Profil</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="profil_container text-center">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <div class="profil_pic" style="background-image: url(../img/home/jakob-owens-lkMJcGDZLVs-unsplash.jpg);"></div>
            <div class="profil_name">
              <h2>Jakob Owens</h2>
            </div>
            <div class="profil_desc">
              <p>User</p>
            </div>
            <div class="profil_info">
              <form class="" action="index.html" method="post">
                <input type="text" name="" value="jakob.owens@gmail.com">
              </form>
            </div>
            <div class="profil_message">
              <a href="{{ url('message') }}">My messages</a>  
            </div>
          </div>
        </div>
      </div>
      <div class="profil_container text-center">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h3>Change password</h3>
            <form class="" action="index.html" method="post">
              <input type="password" name="password" value="" placeholder="New password">
              <input type="password" name="confirm_password" value="" placeholder="Confirm new password">
              <input type="submit" name="" value="Submit">
            </form>
          </div>
        </div>
      </div>
      <div class="profil_container text-center">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h3>Order history</h3>
            <div class="order_history">
              <div class="col-md-12">
                <div class="row" style="margin:0;">
                  <div class="col-md-4 text-left">
                    <p>Order 0001</p>
                  </div>
                  <div class="col-md-4 text-center">
                    <p>Tomatoes</p>
                  </div>
                  <div class="col-md-4 text-right">
                    <p>$15</p>
                  </div>
                </div>
              </div>
            </div>
            <div class="order_history">
              <div class="col-md-12">
                <div class="row" style="margin:0;">
                  <div class="col-md-4 text-left">
                    <p>Order 0002</p>
                  </div>
                  <div class="col-md-4 text-center">
                    <p>Orange</p>
                  </div>
                  <div class="col-md-4 text-right">
                    <p>$6</p>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
