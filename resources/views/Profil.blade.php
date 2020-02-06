@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 text-center">
        <div class="card">
          <div class="pic" style="background-image: url(../img/img.jpg);"></div>
          <div id="info">
            <div class="name">
              <h2>{{$profil['user']->user_name}} {{$profil['user']->user_surname}}</h2>
            </div>
            <div class="desc">
              <p>{{$profil['active_status']->status_user_label}}</p>
              <p>{{$profil['user']->email}}</p>
            </div>
            <div class="info">
              <p>{{$profil['user']->user_postal_code}}</p>
              <p>{{$profil['user']->user_phone}}</p>
            </div>
          </div>
          <div id="edit">
            <form action="user/update" method="post">
                @csrf
                <input type="text" name="user_name" value="{{$profil['user']->user_name}}">
                <input type="text" name="user_surname" value="{{$profil['user']->user_surname}}">
                <input type="text" name="email" value="{{$profil['user']->email}}">
                @if ($profil['user']->user_postal_code == null)
                <input type="text" name="user_postal_code" value="" placeholder="Postal code">
                @else
                <input type="text" name="user_postal_code" value="{{$profil['user']->user_postal_code}}">
                @endif
                @if ($profil['user']->user_phone == null)
                <input type="text" name="user_phone" value="" placeholder="Phone">
                @else
                <input type="text" name="user_phone" value="{{$profil['user']->user_phone}}">
                @endif
              <input type="submit" name="" value="Save">
            </form>
          </div>
          <div class="message">
            <a href="{{ url('message') }}">My messages</a>
          </div>
          <button type="button" name="button" onclick="btnEdit()">Edit</button>
        </div>
      </div>
    </div>
  </div>
</div>









<div id="profil">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="profil_container text-center">
        <div class="row" style="margin:0;">
          <div class="col-xs-12 col-sm-12 col-md-12 text-center">
            <div class="profil_pic" style="background-image: url();"></div>

            <div class="profil_message">
              <a href="{{ url('message') }}">My messages</a>
            </div>
            <button type="button" name="button" onclick="btnEdit()">Edit</button>
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
      <form class="" action="logout" method="post">
        @csrf
        <div class="form-group text-center">
          <input type="submit" name="" value="Disconnect">
        </div>
      </form>
    </div>
  </div>
</div>
<script type="text/javascript">
  const x = document.getElementById("edit");
  const y = document.getElementById("info");
    function btnEdit() {
      x.style.display = (x.style.display === 'block') ? 'none':'block';
    }
</script>
@include('layouts.footer')
