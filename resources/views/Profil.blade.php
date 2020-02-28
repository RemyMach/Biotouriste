@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="profil">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-6 offset-md-3 text-center">
        @if(session('successAddStatus'))
          <div class="alert alert-success" role="alert">
            {{session('successAddStatus')}}
          </div>
        @endif
        @if(session('successController'))
          <div class="alert alert-success" role="alert">
            {{session('successController')}}
          </div>
        @elseif(session('errorController'))
            <div class="alert alert-danger" role="alert">
              {{session('errorController')}}
            </div>
          @endif
        <div class="card">
          <div class="pic" style="background-image: url(../img/img.jpg);"></div>
          <div id="info">
            <div class="name">
              <h2>{{$profil->user_name}} {{$profil->user_surname}}</h2>
            </div>
            <div class="desc">
              <p>{{session('active_status')->status_user_label}}</p>
              <p>{{$profil->email}}</p>
            </div>
            <div class="info">
              <p>{{$profil->user_postal_code}}</p>
              <p>{{$profil->user_phone}}</p>
            </div>
          </div>
          <div id="edit">
            <form action="user/update" method="post">
                @csrf
                <input type="text" name="user_name" value="{{$profil->user_name}}">
                <input type="text" name="user_surname" value="{{$profil->user_surname}}">
                <input type="text" name="email" value="{{$profil->email}}">
                @if ($profil->user_postal_code == null)
                <input type="text" name="user_postal_code" value="" placeholder="Postal code">
                @else
                <input type="text" name="user_postal_code" value="{{$profil->user_postal_code}}">
                @endif
                @if ($profil->user_phone == null)
                <input type="text" name="user_phone" value="" placeholder="Phone">
                @else
                <input type="text" name="user_phone" value="{{$profil->user_phone}}">
                @endif
              <input type="submit" name="" value="Save">
            </form>
          </div>
          <div class="message">
            <a href="{{ url('message') }}">My messages</a>
          </div>
          <button type="button" name="button" onclick="btnEdit()">Edit</button>
        </div>
        <div class="card">
          <div id="status">
            <h3>Your status</h3>
            <p>Actual status : {{ session('active_status')->status_user_label }}</p>
            @foreach(session('allStatus') as $status)
              @foreach($allProfils as $key => $profile)
                @if($status->status_user_label == 'Controller')
                  @php $controller = 'Controller' @endphp
                @endif
                @if($profile == $status->status_user_label)
                  @php unset($allProfils[$key]) @endphp
                @endif
              @endforeach
              @if($status->status_user_label != session('active_status')->status_user_label)
                <p>Other status : {{ $status->status_user_label }}</p>
                <form action="{{ url('User_status/change') }}" method="post">
                  @csrf
                  <input type="hidden" name="default_status" value="{{strtolower($status->status_user_label)}}">
                  <button type="submit" name="button">Switch to {{ $status->status_user_label }}</button>
                </form>
              @endif
            @endforeach
          </div>
        </div>

        @if(count($allProfils) >= 1)
          <div class="card">
            <div id="status">
              <h3>Add status</h3>
              @if(session('errorAddStatus'))
                <div class="alert alert-danger" role="alert">
                  {{session('errorAddStatus')}}
                </div>
              @endif
              @foreach($allProfils as $profile)
                  <form id="formInitial" action="{{ url('User_status/addStatus') }}" method="post">
                    @csrf
                    <span id="formAddStatus"></span>
                    <input type="hidden" name="new_status" value="{{ $profile }}"/>
                    <button class="{{ $profile }}" type="button" id="addStatus" name="button">Add {{ $profile }} status</button>
                  </form>
              @endforeach
            </div>
          </div>
        @endif

        @if(session('errorPassword'))
          <div class="alert alert-danger" role="alert">
            {{session('errorPassword')}}
          </div>
        @endif
        @if(session('successPasword'))
          <div class="alert alert-success" role="alert">
            {{session('successPasword')}}
          </div>
        @endif

        <div class="card">
          <div id="password">
            <h3>Change password</h3>
            <p><span style="color:red;">*</span><i>Required field</i></p>
            <form class="" action="{{ url('user/updatePassword') }}" method="post">
              @csrf
              <input type="password" name="oldPassword"  placeholder="Actual password *">
              <input type="password" name="password"  placeholder="New password *">
              <input type="password" name="password_confirmation"  placeholder="Confirm new password *">
              <input type="submit" value="Submit">
            </form>
          </div>
        </div>

          @if(!isset($controller))
            <div class="card">
              <div id="password">
                <h3>Become a Controller</h3>
                <form class="" action="{{ url('controller/become') }}" method="get">
                  <input type="submit" value="Become">
                </form>
              </div>
            </div>
          @endif

        @if($profil->status_user_label === 'Tourist' or $profil->status_user_label === 'Controller')
        <div class="card">
          <div id="order">
            <h3>Order history</h3>
            @foreach($payments as $payment)
            <div class="order">
              <div class="row" style="margin:0;">
                <div class="col-md-4 text-left">
                  <p>{{ $payment->announce_name }}</p>
                </div>
                <div class="col-md-4 text-center">
                  <p>{{ $payment->product_name }}</p>
                </div>
                <div class="col-md-4 text-right">
                  <p>{{ $payment->totalAmount }}  {{ $payment->payment_currency }}</p>
                </div>
              </div>
            </div>
            @endforeach
            <!-- fin  -->
          </div>
        </div>
        @endif
        <form action="logout" method="post">
          @csrf
          <div class="form-group text-center">
            <input type="submit" name="" value="Logout">
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript" src="{{ url('/js/addStatus.js') }}"></script>
<script type="text/javascript">
const x = document.getElementById("edit");
const y = document.getElementById("info");
function btnEdit() {
  x.style.display = (x.style.display === 'block') ? 'none':'block';
}

</script>
@include('layouts.footer')
