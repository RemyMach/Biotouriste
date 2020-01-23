@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="message">
  <div class="row" style="margin:0;">
    <div class="col-md-12" style="padding:0;">
      <div class="message_banner">
        <div class="row" style="margin:0;">
          <div class="col-md-12 text-center">
            <h2>Message</h2>
            <div class="line"></div>
          </div>
        </div>
      </div>
      <div class="message_link">
        <div class="col-md-12 text-right">
          <a href="{{ url('profil') }}">Return to profil</a>
        </div>
      </div>
      <div class="message_container">
        <div class="message_item">
          <div class="row" style="margin:0;">
            <div class="col-md-12 text-center" style="margin-top: auto;margin-bottom: auto;">
              <div class="message_pic" style="background-image:url('/img/home/jakob-owens-lkMJcGDZLVs-unsplash.jpg')"></div>
              <p>Jakob Owens</p>
              <p>15/01/2020</p>
              <a href="#">click to see the conversation</a>
            </div>
          </div>
        </div>
        <div class="message_item">
          <div class="row" style="margin:0;">
            <div class="col-md-12 text-center" style="margin-top: auto;margin-bottom: auto;">
              <div class="message_pic" style="background-image:url('/img/home/jakob-owens-lkMJcGDZLVs-unsplash.jpg')"></div>
              <p>Jakob Owens</p>
              <p>15/01/2020</p>
              <a href="#">click to see the conversation</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
