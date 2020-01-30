@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="content_1">
  <div class="content_1_1">
    <div class="menu_container">
      <div class="row text-center" style="margin:0;">
        <div class="col-xs-1 col-sm-4 col-md-4 m active">
          <button id="btn_a" type="button" name="button" onclick="announce()">
            <i class="fas fa-map-marker-alt"></i>
            <p>Announces</p>
          </button>
        </div>
        <div class="col-xs-1 col-sm-4 col-md-4 m">
          <button id="btn_m" type="button" name="button" onclick="message()">
            <i class="fas fa-comments"></i>
            <p>Messages</p>
          </button>
        </div>
        <div class="col-xs-1 col-sm-4 col-md-4 m">
          <button id="btn_p" type="button" name="button" onclick="product()">
            <i class="fas fa-apple-alt"></i>
            <p>Products</p>
          </button>
        </div>
      </div>
    </div>
    <div id="announces" class="menu_map">
      <div class="row" style="margin:0;">
        <div class="col-md-6" style="padding:0;">
          <div class="m_left">
            <h3>Find Sellers</h3>
            <form class="" action="index.html" method="post">
              <input type="text" name="" value="" placeholder="Indicate the place">
              <input type="text" name="" value="" placeholder="Locate me"><button type="button" name="button"><i class="fas fa-location-arrow"></i></button>
              <input type="submit" name="" value="Find Now">
            </form>
          </div>
        </div>
        <div class="col-md-6" style="padding:0;">
          <div class="m_right"></div>
        </div>
      </div>
    </div>
    <div id="messages" class="menu_message">
      <div class="row" style="margin:0;">
        <div class="col-md-6" style="padding:0;">
          <div class="n_left">
            @if(session()->has('user'))
            <h3>Messages</h3>
            <p>Last exchange</p>
            <button type="button" name="button" onclick="window.location.href='{{ url('message') }}'">Go to messages</button>
            @else
            @endif
          </div>
        </div>
        <div class="col-md-6" style="padding:0;">
          <div class="n_right"></div>
        </div>
      </div>
    </div>
    <div id="products" class="menu_product">
      <div class="row" style="margin:0;">
        <div class="col-md-6" style="padding:0;">
          <div class="n_left">
            @if(session()->has('user'))
            <h3>Products</h3>
            <p>Last exchange</p>
            <button type="button" name="button" onclick="window.location.href='{{ url('message') }}'">Go to messages</button>
            @else
            @endif
          </div>
        </div>
        <div class="col-md-6" style="padding:0;">
          <div class="n_right"></div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="content_2">
  <div class="content_2_1">
    <div class="row" style="margin:0;">
      <div class="col-md-12 text-center">
        <h3>WHAT'S NEW IN</h3>
        <h2>HEALTHY'S</h2>
        <div class="line"></div>
      </div>
    </div>
    <div class="content_2_2">
      <div class="row" style="margin:0;">
        <div class="col-md-4 col-sm-12 text-right">
          <div class="block_left">
            <img src="{{url('/img/home/block-1.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-4 col-sm-12 text-center">
          <div class="block_center">
            <img src="{{url('/img/home/block-2.png')}}" alt="">
          </div>
        </div>
        <div class="col-md-4 col-sm-12 text-left">
          <div class="block_right">
            <img src="{{url('/img/home/block-3.png')}}" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div id="content_3">
  <div class="content_3_1">
    <div class="block_banner">
      <div class="row" style="margin:0;">
        <div class="col-md-12 text-center">
          <h3>Healthy's is ...</h3>
          <p>An e-shop offering you real traders delivering natural and organic products from around the world. <br>You deserve the best!</p>
          <img src="" alt="">
        </div>
      </div>
    </div>
  </div>
</div>
<div id="content_4">
  <div class="content_4_1">
    <div class="row" style="margin:0;">
      <div class="col-md-12 text-center">
        <h3>THE BEST WE KNOW</h3>
        <h2>TO DISCOVER</h2>
        <div class="line"></div>
        <div class="navigation">
          <div class="row" style="margin:0;">
            <div class="col-md-12 text-center">
              <button class="active" type="button" name="button" onclick="">Vendors</button>
              <button class="" type="button" name="button" onclick="">Products</button>
              <button class="" type="button" name="button" onclick="">Places</button>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="content_4_2">
      <div class="col-md-12 col-sm-12">
        <div class="row" style="margin:0;">
          <div class="column">
            <div class="block_vendor top">
              <div class="review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <div class="pic"></div>
              <div class="name">
                <h3>Jakob</h3>
              </div>
              <div class="desc">
                <p>"Farmer from father to son"</p>
              </div>
              <div class="pos">
                <i class="fas fa-map-marker-alt"></i>
                <p>Wyoming</p>
              </div>
              <div class="comment">
                <p>Comments : (34)</p>
              </div>
              <div class="view">
                <button class="btn_top_vendor" type="button" name="button">View Profil</button>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="block_vendor bottom">
              <div class="review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <div class="pic"></div>
              <div class="name">
                <h3>Marc</h3>
              </div>
              <div class="desc">
                <p>"Farmer from father to son"</p>
              </div>
              <div class="pos">
                <i class="fas fa-map-marker-alt"></i>
                <p>Wyoming</p>
              </div>
              <div class="comment">
                <p>Comments : (34)</p>
              </div>
              <div class="view">
                <button class="btn_top_vendor" type="button" name="button">View Profil</button>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="block_vendor top">
              <div class="review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i>
              </div>
              <div class="pic"></div>
              <div class="name">
                <h3>James</h3>
              </div>
              <div class="desc">
                <p>"Farmer from father to son"</p>
              </div>
              <div class="pos">
                <i class="fas fa-map-marker-alt"></i>
                <p>Wyoming</p>
              </div>
              <div class="comment">
                <p>Comments : (34)</p>
              </div>
              <div class="view">
                <button class="btn_top_vendor" type="button" name="button">View Profil</button>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="block_vendor bottom">
              <div class="review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star-half"></i>
              </div>
              <div class="pic"></div>
              <div class="name">
                <h3>Lucas</h3>
              </div>
              <div class="desc">
                <p>"Farmer from father to son"</p>
              </div>
              <div class="pos">
                <i class="fas fa-map-marker-alt"></i>
                <p>Wyoming</p>
              </div>
              <div class="comment">
                <p>Comments : (34)</p>
              </div>
              <div class="view">
                <button class="btn_top_vendor" type="button" name="button">View Profil</button>
              </div>
            </div>
          </div>
          <div class="column">
            <div class="block_vendor top">
              <div class="review">
                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i>
              </div>
              <div class="pic"></div>
              <div class="name">
                <h3>Steve</h3>
              </div>
              <div class="desc">
                <p>"Farmer from father to son"</p>
              </div>
              <div class="pos">
                <i class="fas fa-map-marker-alt"></i>
                <p>Wyoming</p>
              </div>
              <div class="comment">
                <p>Comments : (34)</p>
              </div>
              <div class="view">
                <button class="btn_top_vendor" type="button" name="button">View Profil</button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script type="text/javascript">

</script>
@include('layouts.footer')
