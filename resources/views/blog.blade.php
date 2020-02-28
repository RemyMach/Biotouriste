@include('layouts.header')
@include('layouts.navbarDesktop')
@include('layouts.navbarMobile')
<div id="blog">
  <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center">
    <div class="row" style="margin:0;">
      <div class="col-xs-12 col-sm-12 col-md-10 offset-md-1 text-center">
        <div class="row" style="margin:0;">
          <div class="card">
            <div id="article">
              <h3>Blog</h3>
              <div class="article">
                <div class="article_image">
                  <img src="../img/article/article_1.jpg" alt="">
                </div>
                <div class="article_meta">
                  <p>2020-02-02 23:00:00</p>
                </div>
                <div class="article_title">
                  <p>Latest news</p>
                </div>
                <div class="article_cta">
                  <button type="button" name="button" onclick="">Read more</button>
                </div>
              </div>
              <div class="article">
                <div class="article_image">
                  <img src="../img/article/article_2.jpg" alt="">
                </div>
                <div class="article_meta">
                  <p>2020-02-02 23:00:00</p>
                </div>
                <div class="article_title">
                  <p>Latest news</p>
                </div>
                <div class="article_cta">
                  <button type="button" name="button" onclick="">Read more</button>
                </div>
              </div>
              <div class="article">
                <div class="article_image">
                  <img src="../img/article/article_3.jpg" alt="">
                </div>
                <div class="article_meta">
                  <p>2020-02-02 23:00:00</p>
                </div>
                <div class="article_title">
                  <p>Latest news</p>
                </div>
                <div class="article_cta">
                  <button type="button" name="button" onclick="">Read more</button>
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
