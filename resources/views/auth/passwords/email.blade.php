@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="favorite">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="favorite_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h2>Reset Password</h2>
            @if(session('error'))
              <div class="alert alert-danger" role="alert">
                {{  session('error') }}
              </div>
            @elseif(session('success'))
              <div class="alert alert-success" role="alert">
                {{  session('success') }}
              </div>
            @endif
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="favorite_container text-center">
        <h3>Please fill this field with your email</h3>
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <input id="email" type="email" class="" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
          <button type="submit" class="">
              {{ __('Send Password Reset Link') }}
          </button>
        </form>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
