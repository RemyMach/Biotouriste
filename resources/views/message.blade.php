@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="message">
  <div class="col-md-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="card" data-aos="fade-down">
          <div id="message_list">
            <h3>Message</h3>
              <table class="table">
                <thead>
                  <tr>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td><div style="background-image:url('../img/img.jpg')"></div></td>
                    <td>John Doe</td>
                    <td>15/04/2020 11:49:05</td>
                    <td><button type="button" name="button">See</button></td>
                    <td><button type="button" name="button">Delete</button></td>
                  </tr>
                  <tr>
                    <td><div style="background-image:url('../img/img.jpg')"></div></td>
                    <td>John Doe</td>
                    <td>15/04/2020 11:49:05</td>
                    <td><button type="button" name="button">See</button></td>
                    <td><button type="button" name="button">Delete</button></td>
                  </tr>
                  <tr>
                    <td><div style="background-image:url('../img/img.jpg')"></div></td>
                    <td>John Doe</td>
                    <td>15/04/2020 11:49:05</td>
                    <td><button type="button" name="button">See</button></td>
                    <td><button type="button" name="button">Delete</button></td>
                  </tr>
                </tbody>
              </table>
          </div>
        </div>
        <div class="cta" data-aos="fade-up">
          <div class="row">
            <div class="col-md-12">
              <button type="button" name="button" onclick="window.location.href='{{ url('profil') }}'">Return to profil</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@include('layouts.footer')
